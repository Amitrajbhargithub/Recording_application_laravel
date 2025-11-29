<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\MessageSent;

class ChatController extends Controller
{
    /**
     * Show the chat page with a specific user
     */
    public function index($userId = null)
    {
        $authUser = Auth::user();
        $users = $this->getChatUsers($authUser->id);
        $selectedUser = null;
        $messages = collect();

        if ($userId) {
            $selectedUser = User::find($userId);
            if ($selectedUser && $selectedUser->id !== $authUser->id) {
                $messages = Chat::where(function ($query) use ($authUser, $userId) {
                    $query->where('sender_id', $authUser->id)
                          ->where('receiver_id', $userId);
                })->orWhere(function ($query) use ($authUser, $userId) {
                    $query->where('sender_id', $userId)
                          ->where('receiver_id', $authUser->id);
                })->orderBy('created_at', 'asc')->get();

                // Mark messages as read
                Chat::where('sender_id', $userId)
                    ->where('receiver_id', $authUser->id)
                    ->update(['is_read' => true]);
            }
        }

        return view('chat.index', compact('users', 'selectedUser', 'messages'));
    }

    /**
     * Get list of all users for chat
     */
    public function getUsers()
    {
        $authUser = Auth::user();
        $users = $this->getChatUsers($authUser->id);

        return response()->json($users);
    }

    /**
     * Get users that current user can chat with
     */
    private function getChatUsers($userId)
    {
        return User::where('id', '!=', $userId)
            ->select('id', 'name', 'email', 'image')
            ->get()
            ->map(function ($user) use ($userId) {
                $unreadCount = Chat::where('sender_id', $user->id)
                    ->where('receiver_id', $userId)
                    ->where('is_read', false)
                    ->count();

                $lastMessage = Chat::where(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $userId)
                          ->where('receiver_id', $user->id);
                })->orWhere(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $user->id)
                          ->where('receiver_id', $userId);
                })->orderBy('created_at', 'desc')->first();

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $user->image,
                    'unread_count' => $unreadCount,
                    'last_message' => $lastMessage?->message ?? null,
                    'last_message_time' => $lastMessage?->created_at,
                    'is_online' => $this->isUserOnline($user->id),
                ];
            });
    }

    /**
     * Get user online status
     */
    public function getUsersStatus()
    {
        $authUser = Auth::user();
        $users = User::where('id', '!=', $authUser->id)
            ->select('id', 'name')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'is_online' => $this->isUserOnline($user->id),
                ];
            });

        return response()->json($users);
    }

    /**
     * Check if user is online (check last activity within 5 minutes)
     */
    private function isUserOnline($userId)
    {
        // Store last activity in cache
        // For a real implementation, you might use Redis or database
        $lastActivity = cache("user_activity_{$userId}");

        if (!$lastActivity) {
            return false;
        }

        $lastActivityTime = strtotime($lastActivity);
        $currentTime = time();
        $differenceInSeconds = $currentTime - $lastActivityTime;

        // Consider user online if active within last 5 minutes
        return $differenceInSeconds < (5 * 60);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id|different:auth.id',
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $authUser = Auth::user();
        $imagePath = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('chat-images', 'public');
        }

        $chat = Chat::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'image_path' => $imagePath,
        ]);

        // Broadcast the message using Reverb
        broadcast(new MessageSent($chat))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $chat,
        ]);
    }

    /**
     * Get messages for a specific user conversation
     */
    public function getMessages($userId)
    {
        $authUser = Auth::user();

        $messages = Chat::where(function ($query) use ($authUser, $userId) {
            $query->where('sender_id', $authUser->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($authUser, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $authUser->id);
        })->orderBy('created_at', 'asc')
          ->with(['sender:id,name,image', 'receiver:id,name,image'])
          ->get();

        // Mark messages as read
        Chat::where('sender_id', $userId)
            ->where('receiver_id', $authUser->id)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    /**
     * Delete a message
     */
    public function deleteMessage($messageId)
    {
        $message = Chat::find($messageId);

        if (!$message || $message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($message->image_path) {
            Storage::disk('public')->delete($message->image_path);
        }

        $message->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Update last user activity
     */
    public function updateActivity()
    {
        $userId = Auth::id();
        cache(["user_activity_{$userId}" => now()->toString()], now()->addMinutes(5));

        return response()->json(['success' => true]);
    }
}
