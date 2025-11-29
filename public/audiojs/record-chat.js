//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recordinger.js object
var input; 							//MediaStreamAudioSourceNode we'll be Recordinging

// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us Recording

// Recording timer Variables
var startTime;
var elapsedTime = 0;
var timerInterval;

var RecordingButton = document.getElementById("RecordingButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.querySelector(".pauseButton");
var againAudioRecording = document.querySelector(".custom-audio-send");
var saveAudio = document.getElementById("saveAudio");
var timer = document.getElementById('timer');
var trashedAudio = document.getElementById('fa-trash');

//add events to those 2 buttons
RecordingButton.addEventListener("click", startRecordinging);
stopButton.addEventListener("click", stopRecordinging);
pauseButton.addEventListener("click", pauseRecordinging);
againAudioRecording.addEventListener('click',againPauseRecordinging)
trashedAudio.addEventListener('click',trashedAudioRecordinging);


function trashedAudioRecordinging() {
	$('.msger-inputarea').show();
	$('.msger-audio').hide();
	$('#RecordingingsList').find('li').remove();
	$('#RecordingingsList').find('li').remove();
	gumStream.getAudioTracks()[0].stop();
	clearInterval(timerInterval);
	elapsedTime = 0;
	timer.textContent = '00:00:00';
}

function startRecordinging() {
	console.log("RecordingButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/


    var constraints = { audio: true, video:false }

 	/*
    	Disable the Recording button until we get a success or fail from getUserMedia()
	*/

	$('#fa-trash').hide();
	$('.send-audio').hide();
	$('.custom-audio-send').hide();
	$('.audio-Recording1').show();
	$('#controls').show();
	$('.msger-inputarea').hide();
    $('#audio-box').show();

	/*
    	We're using the standard promise based getUserMedia()
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recordinger.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when Recordinging through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format
		// document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;

		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/*
			Create the Recordinger object and configure to Recording mono sound (1 channel)
			Recordinging 2 channels  will double the file size
		*/
		rec = new Recordinger(input,{numChannels:1})

		//start the Recordinging process
		rec.Recording()

		//start timer
		startTime = Date.now() - elapsedTime;
	    timerInterval = setInterval(() => {
	    	elapsedTime = Date.now() - startTime;
	    	timer.textContent = formatTime(elapsedTime);
	  	}, 1000);

	}).catch(function(err) {
	  	//enable the Recording button if getUserMedia() fails
    	RecordingButton.disabled = false;
    	stopButton.disabled = true;
    	pauseButton.disabled = true
	});
}

function againPauseRecordinging () {
	$('.send-audio').hide();
	$("#fa-trash").hide();
	$(".custom-audio-send").hide();
	$('#controls').show();
	$('#RecordingingsList').find('li').remove();
	$('li').find('audio').remove();
	rec.Recording();
	startTime = Date.now() - elapsedTime;
	timerInterval = setInterval(() => {
		elapsedTime = Date.now() - startTime;
		timer.textContent = formatTime(elapsedTime);
	}, 1000);

}

function pauseRecordinging(){
	console.log("pauseButton clicked rec.Recordinging=",rec.Recordinging );
	if (rec.Recordinging){
		console.log("pause clicked");

		//disable the stop button, enable the Recording too allow for new Recordingings
		// stopButton.disabled = true;
		// RecordingButton.disabled = false;
		// pauseButton.disabled = true;

		//tell the Recordinger to stop the Recordinging
		rec.stop();
		clearInterval(timerInterval);
		rec.exportWAV(createDownloadLink);

	}
}

function stopRecordinging() {
	console.log("stopButton clicked");

	//disable the stop button, enable the Recording too allow for new Recordingings
	// stopButton.disabled = true;
	// RecordingButton.disabled = false;
	// pauseButton.disabled = true;

	//reset button just in case the Recordinging is stopped while paused
	// pauseButton.innerHTML="Pause";

	//tell the Recordinger to stop the Recordinging
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);

	//stop the timer
	clearInterval(timerInterval);
  	elapsedTime = 0;
  	timer.textContent = '00:00:00';
}
var filename = '';
var blob_name = '';
function createDownloadLink(blob) {

	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');
	//name of .wav file to use during upload and download (without extendion)
	filename =  new Date().toISOString();
	blob_name = blob;
	$('#audio_file').val(filename);
	$('#blob_name').val(blob_name);
	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//add the new audio element to li
	li.appendChild(au);

	$('.send-audio').show();
	$("#fa-trash").show();
	$(".custom-audio-send").show();
	$('#controls').hide();
	//add the li element to the ol
	RecordingingsList.appendChild(li);

}
saveAudio.addEventListener('click',function(){
	rec.stop();
	gumStream.getAudioTracks()[0].stop();
	clearInterval(timerInterval);
	elapsedTime = 0;
	timer.textContent = '00:00:00';
	var xhr=new XMLHttpRequest();
	xhr.onload=function(e) {
		if(this.readyState === 4) {
			console.log("Server returned: ",e.target.responseText);
		}
	};
	var url = 'save-Recording-audio';
	var fd=new FormData();
	fd.append("_token", $('meta[name="csrf-token"]').attr('content'));
	fd.append("audio_data",blob_name,$('#audio_file').val());
	xhr.open("POST",url,true);
	xhr.send(fd);
	ref = 0;
	$('.msger-audio').hide();
	$('li').find('audio').remove();

});

function formatTime(time) {
	let hours = Math.floor(time / (60 * 60 * 1000));
	let minutes = Math.floor((time / (60 * 1000)) % 60);
	let seconds = Math.floor((time / 1000) % 60);
	hours = hours < 10 ? `0${hours}` : hours;
	minutes = minutes < 10 ? `0${minutes}` : minutes;
	seconds = seconds < 10 ? `0${seconds}` : seconds;
	return `${hours}:${minutes}:${seconds}`;
}
