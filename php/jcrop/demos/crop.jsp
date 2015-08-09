
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.util.*,hangpeer.NewMain"  %>
<%NewMain obj=(NewMain)session.getAttribute("object"); %>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" /> 
		<title>Jcrop &raquo; Tutorials &raquo; Event Handler</title>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/jquery.Jcrop.js" type="text/javascript"></script>
		<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
                <script src="../js/ajax.js" type="text/javascript" ></script>
		<script type="text/javascript">

		jQuery(function($){

      var c=$('#target').Jcrop({
        onChange:   showCoords,
        onSelect:   showCoords,
        onRelease:  clearCoords
      }).Coords;

    });
    function donecropping(imageid)
    {
        var url=document.getElementById("target").src;
        alert(url);
        var x=$('#x1').val();
        var y=$('#y1').val();
        var w=$('#w').val();
        var h=$('#h').val();
        setaspropic(imageid,url,x,y,w,h);
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
	</head>
	<body>
	<div id="outer">
	<div class="jcExample">
	<div class="article">

		<h1>Jcrop - Event Handlers</h1>

		<!-- This is the image we're attaching Jcrop to -->
                <img src="demo_files/flowers.jpg" height="200" width="200" id="target" alt="Flowers" />

		<!-- This is the form that our event handler fills -->
                <input type="button" value="done croping" onclick=""/>
                <form id="coords"
      class="coords"
      onsubmit="return false;"
      action="http://example.com/post.php">

      <div>
			<label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
			<label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
			<label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
			<label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
			<label>W <input type="text" size="4" id="w" name="w" /></label>
			<label>H <input type="text" size="4" id="h" name="h" /></label>
      </div>
		</form>

		<p>
			<b>An example with a basic event handler.</b> Here we've tied
			several form values together with a simple event handler invocation.
			The result is that the form values are updated in real-time as
			the selection is changed using Jcrop's <em>onChange</em> handler.
		</p>

		<p>
			That's how easily Jcrop can be integrated into a traditional web form!
		</p>

		<div id="dl_links">
			<a href="http://deepliquid.com/content/Jcrop.html">Jcrop Home</a> |
			<a href="http://deepliquid.com/content/Jcrop_Manual.html">Manual (Docs)</a>
		</div>


	</div>
	</div>
	</div>
	</body>

</html>
