<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style>
.curve {
    -moz-border-radius : 25px; /* Firefox */
    -webkit-border-radius :25px; /* Safari & Chrome */
    -khtml-border-radius : 25px; /* Linux browsers */
    border-radius : 25px; /* CSS3 compatible browsers */
}
body {
    margin: 0;
    padding: 0;
    text-align: center; /* !!! */
}
.centered {
    margin: 0 auto;
    text-align: left;
    width: 1024px;
	
}
</style>
<link href="css/fileuploader.css" rel="stylesheet" type="text/css" />	
<script src="js/fileuploader.js" type="text/javascript"></script>
    <script type="text/javascript">        
     
     function createUploader(albumid,multiple,drag){ 
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader'),
                action: 'ajax/uploadimage.php',
                multiple:multiple,
		    showMessage: function(message){alert(message);},
                    params:{album : albumid},
                    onComplete:function(id, fileName, responseJSON){ alert('1'); },
                debug: true,
                drag:drag
            });
            
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
            window.onload=function(){createUploader('<?php echo  $_SESSION['userdetails']['propicalbum']; ?>',false,false);}
    </script>





</head>

<body>

<div class="centered" style="border:solid 1px">


<div id="fifth" style="width:900px; height:60px; margin-left:50px; border:solid 1px">
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">1</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">2</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">3</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">4</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px;  background-color:#3F0; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">5</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">

</div>



</div>



<div style="width:1024px;border:solid 1px">
<div style="width:500px; margin-left:220px; height:500px; border:solid 1px">
</div>

    <div id="file-uploader">
    </div>
</div>

<div style="width:1024px; height:30px;border:solid 1px">
<input style="float:right" type="button" value="Go"/>
<input style="float:right" type="button" value="Back"/>
<input style="float:right" type="button" value="Skip"/>
</div>

</div>


</body>
</html>
