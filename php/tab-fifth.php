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
                    onComplete:function(id, fileName, responseJSON){ set_propic(responseJSON.fileid,"images/500/500_"+responseJSON.imgurl,"true");},
                debug: true,
                drag:drag
            });
            
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
            window.onload=function(){createUploader('<?php echo  $_SESSION['userdetails']['propicalbum']; ?>',false,false);}
    </script>



<script src="js/jquery-latest.js" type="text/javascript"></script>
		<script src="js/jquery.Jcrop.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
		<script src="js/ajax.js" type="text/javascript" ></script>
		<script type="text/javascript">
                    function initcrop(aspectRatio){
		jQuery(function($){

      var c=$('#target').Jcrop({
        onChange:   showCoords,
        onSelect:   showCoords,
        onRelease:  clearCoords,
        aspectRatio: aspectRatio
      }).Coords;

    });
    }
    function propiccroping(imageid,deletesrc)
    {
        
        var url=document.getElementById("target").src;
        var x=$('#x1').val();
        var y=$('#y1').val();
        var w=$('#w').val();
        var h=$('#h').val();
        alert(x+"\n"+y+"\n"+w+"\n"+h);
        setaspropic(imageid,deletesrc,x,y,w,h);
    }
    function secpiccroping(imageid,deletesrc,secpicno)
    {
        
        var url=document.getElementById("target").src;
        var x=$('#x1').val();
        var y=$('#y1').val();
        var w=$('#w').val();
        var h=$('#h').val();
        alert(x+"\n"+y+"\n"+w+"\n"+h);
        setassecpic(imageid,deletesrc,secpicno,x,y,w,h);
    }
    

    // Simple event handler, called from onChange and onSelect
    // event handlers, as per the Jcrop invocation above
    function showCoords(c)
    {
        
      $('#x1').val(c.x);
      $('#y1').val(c.y);
      $('#x2').val(c.x2);
      $('#y2').val(c.y2);
      $('#w').val(c.w);
      $('#h').val(c.h);
    };

    function clearCoords()
    {
      $('#coords input').val('');
      $('#h').css({color:'red'});
      window.setTimeout(function(){
        $('#h').css({color:'inherit'});
      },500);
    };

		</script>
		<style>
		.black_overlay{
			display: none;
			position: fixed;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 5%;
			left: 25%;
			padding: 16px;
			border: 16px solid black;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
		
</style>
                <script src="js/php_serialize.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
function set_propic(imageid,url,deletesrc){
            var main=document.getElementById('target-container');
            main.innerHTML='<img src="'+url+'"  id="target" alt="Flowers" /><input type="button" value="done croping" onclick="propiccroping(\''+imageid+'\',\''+deletesrc+'\')"/><input type="button" style="float:right" value="Skip" onclick="propiccroping(\''+imageid+'\',\''+deletesrc+'\')"/><form id="coords" class="coords" onsubmit="return false;" ><div style="display:none"><input type="hidden" size="4" id="x1" name="x1" value="0" /><input type="hidden" size="4" id="y1" name="y1" value="0" /><input type="hidden" size="4" id="x2" name="x2" value"0" /><input type="hidden" size="4" id="y2" name="y2" value="0" /><input type="hidden" size="4" id="w" name="w" value="0" /><input type="hidden" size="4" id="h" name="h" value="0" /></div></form>';
            initcrop(1/1);

}
function set_secpic(imageid,url,deletesrc,secpicno){
            var main=document.getElementById('light');
            main.innerHTML='<img src="'+url+'"  id="target" alt="Flowers" /><input type="button" value="done croping" onclick="secpiccroping(\''+imageid+'\',\''+deletesrc+'\',\''+secpicno+'\')"/><input type="button" style="float:right" value="Skip" onclick="secpiccroping(\''+imageid+'\',\''+deletesrc+'\',\''+secpicno+'\')"/><form id="coords" class="coords" onsubmit="return false;" ><div style="display:none"><input type="hidden" size="4" id="x1" name="x1" value="0" /><input type="hidden" size="4" id="y1" name="y1" value="0" /><input type="hidden" size="4" id="x2" name="x2" value"0" /><input type="hidden" size="4" id="y2" name="y2" value="0" /><input type="hidden" size="4" id="w" name="w" value="0" /><input type="hidden" size="4" id="h" name="h" value="0" /></div></form>';
            document.getElementById('light').style.display='block';
            document.getElementById('fade').style.display='block';
            initcrop(2/1);

}</script>

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
<div id="target-container" style="width:500px; margin-left:220px; border:solid 1px">
</div>

    <div id="file-uploader">
    </div>
</div>

<div style="width:1024px; height:30px;border:solid 1px">
<input style="float:right" type="button" value="Go"/>
<input style="float:right" type="button" onclick="window.location.href='tab-fourth.php'" value="Back"/>
<input style="float:right" type="button" onclick="window.location.href='profile.php?userid=<?php echo $_SESSION['userid']; ?>'" value="Skip"/>
</div>

</div>


</body>
</html>
