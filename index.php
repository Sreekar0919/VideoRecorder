<?php
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';
?>

<style>
    button {
        margin: 1em;
        padding: 1em;
    }
</style>

<div class="projhdr"><i class="fas fa-video"></i> Video Recorder</div>

<button id="initBtn">Initialize</button>
<button id="startBtn" disabled>Start Recording</button>
<button id="stopBtn" disabled>Stop Recording</button>
<br>
<input type="checkbox" checked id="cameraToggle" />
<label for="cameraToggle">Capture Camera</label>
<br>
<input type="checkbox" id="audioToggle" />
<label for="audioToggle">Capture Screen (instead of camera)</label>
<br>
<input type="checkbox" checked id="micAudioToggle" />
<label for="micAudioToggle">Capture Audio from Microphone</label><br>
<a id="download" href="#" style="display: none;">Download</a><br>
<video id="preview" autoplay muted playsinline style="max-width: 480px; background: #000;"></video>

<script>
    $("#cameraToggle, #audioToggle, #micAudioToggle").on('click', function() {
        $("#initBtn").prop('disabled', !$("#cameraToggle, #audioToggle, #micAudioToggle").is(":checked"));
        ExternalModules.UWMadison.VideoRecorder.recording.camera = $("#cameraToggle").is(":checked");
        ExternalModules.UWMadison.VideoRecorder.recording.desktop = $("#audioToggle").is(":checked");
        ExternalModules.UWMadison.VideoRecorder.recording.mic = $("#micAudioToggle").is(":checked");
    });
    $("#initBtn").on('click', function() {
        $("#cameraToggle, #audioToggle, #micAudioToggle").prop('disabled', true);
        $("#download").hide();
    });
    $("#stopBtn").on('click', function() {
        $("#cameraToggle, #audioToggle, #micAudioToggle").prop('disabled', false);
        $("#download").show();
    });
</script>

<?php
require_once APP_PATH_DOCROOT . "ProjectGeneral/footer.php";
?>