# VideoRecorder - Redcap External Module

## What does it do?

VideoRecorder captures webcam or screen video, with microphone and screen audio, on REDCap instruments and surveys. Users can upload the recording to a file upload field, the file repo, or the web server, or download it locally. It is a fork of [uwctri/AudioRecorder](https://github.com/uwctri/AudioRecorder) and keeps its configuration and upload paths.

Video is roughly 7.5 MB per minute at the default bitrate (`videoBitsPerSecond` in `recorder.js`). Check PHP `upload_max_filesize`/`post_max_size` and REDCap's max upload size against your max record time.

## Installing

**Upgrading to 1.2.0**: We added two system-level options and attempt to set them to preserve previous module behavior. If you do not have super user access (i.e. access to all projects at full user rights) then this process will fail. Regardless its a good idea to review system level settings and inform end-users to review their settings for the EM after you have made any changes.

You can install the module from the REDCap EM repo or drop it directly in your modules folder (i.e. `redcap/modules/video_recorder_v1.0.0`) manually.

## Configuration

After install please review system level configuration to set a maximum length for all recordings and enable methods for user upload of audio. A REDCap admin must enable uploads to the filerepo or webserver disk via the module's system configuration, otherwise audio recordings must be downloaded to the user's computer or uploaded to a specific file upload field.

Project level configuration is straight forward and requires specifying an instrument to use and css selectors refrencing buttons or "a" elements in a descriptive field for various functions of the recorder. A typical two-button configuration would involve an "Initialize" button and a "Start / Stop & Upload" button. A descriptive field for a two-button setup is below. Remove all line breaks before using. The seletors used here would be ".initRecording" and ".recordingBtn".

```html
<div class="text-center">Begin Recording Now<br />
    <button href="#" class="btn btn-success initRecording" type="button">Initialize Recording</button >
    <button  href="#" class="btn btn-success recordingBtn" type="button">Start/Stop Recording</button >
</div>
```

A three button, less customized layout may look like the below. Here we have used ids for css selectors so the selectors used would be "#initBtn", "#startBtn", and "#stopBtn".

```html
<button id="initBtn">Initialize</button>
<button id="startBtn">Start Recording</button>
<button id="stopBtn">Stop Recording</button>
```

You may also want to set a "Upload Time" or "Saved File Name" field which will allow you to easily create reports for files that have been uploaded.
![Config Example](https://aanunez.io/img/audio_recorder.png)

## Technical Notes

* This EM exposes a JS object `VideoRecorder` that allows you to programmatically invoke start/top/init/upload. You can use these functions if you prefer to integrate the EM into your form.

* Due to limitations in the js implementation of `mediaDevices.getDisplayMedia` in some browsers only chrome and chrome-derivatives are supported. Errors exist to inform end-users of this.

* You will only be able to upload recordings to locations that the php user has write access to. If you wish to write to a network drive you may want to write to the local server and then sync the files via a cron job rather than give the php user write access.

* Redcap has a native log and ajax support in JS, but the EM logs are harder to search and the ajax method doesn't support blob uploads so we are unable to use them.
