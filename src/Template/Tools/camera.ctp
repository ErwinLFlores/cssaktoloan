<div class="col-md-12" style="max-height:500px";>
    <div id="my_camera"></div>
</div>

<!-- First, include the Webcam.js JavaScript Library -->
<script type="text/javascript" src="/js/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 600,
        height: 460,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera' );
</script>

<div class="col-md-12">
    <!-- A button for taking snaps -->
    <?= $this->Form->create('Snapshot', ['type' => 'post']); ?>
        <input type=button value="Take Snapshot" onClick="take_snapshot()">
    <?= $this->Form->end(); ?>
</div>

<div class="col-md-12 col-xs-12" style="max-height:500px;">
    <div id="results">Your captured image will appear here...</div>
</div>
<hr/>
<div class="col-md-12 col-xs-12" style="color:black;">
    <div id="info_output"><b>[TIPS]</b> If you encounter a "no webcam error", 
        Click <a href="chrome://flags/#unsafely-treat-insecure-origin-as-secure"> here </a> and add <code>http://ec2-13-214-35-205.ap-southeast-1.compute.amazonaws.com/tools/camera</code>, 
        under <b>Insecure origins treated as secure</b>. <br/>Make sure the settings is <b>Enabled</b>. Re-lauch browser, and it should fix the problem. 
        If not, contact developer -SK.</div>
</div>



<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
    function take_snapshot() {
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML = 
                '<h2>Here is your image:</h2>' + 
                '<img src="'+data_uri+'"/>';
        } );
    }
</script>