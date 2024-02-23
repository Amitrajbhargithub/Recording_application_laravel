<?php

namespace Recordings\Feature;

use Illuminate\Foundation\Recordinging\RefreshDatabase;
use Recordings\RecordingCase;

class ExampleRecording extends RecordingCase
{
    /**
     * A basic Recording example.
     *
     * @return void
     */
    public function Recording_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
