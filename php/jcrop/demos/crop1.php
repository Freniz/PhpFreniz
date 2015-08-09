
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" /> 
		<title>Jcrop &raquo; Tutorials &raquo; Event Handler</title>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/jquery.Jcrop.js" type="text/javascript"></script>
		<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
                <script src="/fz-proto/js/ajax.js" type="text/javascript" ></script>
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
<script type="text/javascript">
function set_propic(imageid,url,deletesrc){
            var main=document.getElementById('light');
            main.innerHTML='<img src="'+url+'"  id="target" alt="Flowers" /><input type="button" value="done croping" onclick="propiccroping(\''+imageid+'\',\''+deletesrc+'\')"/><input type="button" style="float:right" value="Skip" onclick="propiccroping(\''+imageid+'\',\''+deletesrc+'\')"/><form id="coords" class="coords" onsubmit="return false;" ><div style="display:none"><input type="hidden" size="4" id="x1" name="x1" value="0" /><input type="hidden" size="4" id="y1" name="y1" value="0" /><input type="hidden" size="4" id="x2" name="x2" value"0" /><input type="hidden" size="4" id="y2" name="y2" value="0" /><input type="hidden" size="4" id="w" name="w" value="0" /><input type="hidden" size="4" id="h" name="h" value="0" /></div></form>';
            document.getElementById('light').style.display='block';
            document.getElementById('fade').style.display='block';
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
	
	<a href="#" onclick = "set_propic(4,'demo_files/ff4.jpg','false')">set propic</a>
	
	<a href="#" onclick = "set_secpic(4,'demo_files/ff4.jpg','false',1)">set secondary pic1</a>

		<a href="#" onclick = "set_secpic(4,'demo_files/ff4.jpg','false',2)">set secondary pic2</a>

	
	<div id="light" style="" class="white_content">
	
</div>
<div id="fade" onClick="document.getElementById('light').style.display='none';   document.getElementById('fade').style.display='none'" class="black_overlay">
</div>
	</body>

</html>
