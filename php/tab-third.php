<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
<script type="text/javascript" src="js/accountsettings.js"></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

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

</head>

<body>

<div class="centered" style="border:solid 1px">

<div id="third" style="width:900px; height:60px; border:solid 1px">
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
<div class="curve" style="width:50px;  background-color:#3F0; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">3</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">4</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">
</div>
<div class="curve" style="width:50px; height:50px;float:left; border:solid 1px">
<p style="text-align:center; margin-top:15px">5</p>
</div>
<div style="width:100px;float:left; margin-top:20px; border:solid 1px">

</div>

</div>

<div style="width:1024px;float:left;border:solid 1px">

<table style="margin-left:200px;" cellpadding="5" cellspacing="5">
<tr><td>Home Town</td><td><input id="search-place-update" type="text" style="width:400px; height:20px" /><input id="search-place-update-hidden" type="hidden" style="width:400px; height:20px" /></td></tr>
<tr><td>Current City</td><td><input id="search-cc-place-update" type="text" style="width:400px; height:20px" /><input id="search-cc-place-update-hidden" type="hidden" style="width:400px; height:20px" /></td></tr>
<tr><td>School</td><td><input id="search-school-update" type="text" style="width:400px; height:20px" /><input id="search-school-update-hidden" type="hidden" style="width:400px; height:20px" /></td></tr>
<tr><td>College</td><td><input id="search-college-update" type="text" style="width:400px; height:20px" /><input id="search-college-update-hidden" type="hidden" style="width:400px; height:20px" /></td></tr>
<tr><td>Worked At</td><td><input id="search-work-update" type="text" style="width:400px; height:20px" /><input id="search-work-update-hidden" type="hidden" style="width:400px; height:20px" /></td></tr>

</table>

</div>

<div style="width:1024px;float:left;border:solid 1px">
<input style="float:right" type="button" onclick="updateschoolandcityinfo()" value="Go"/>
<input style="float:right" type="button" onclick="window.location.href='tab-second.php'" value="Back"/>
<input style="float:right" type="button" onclick="window.location.href='tab-fourth.php'" value="Skip"/>
</div>

</div>


 <script type="text/javascript">
     var options_xmlsearch = function(type,appendto){
     if(!appendto)
        appendto='body'; 
     var options={
                script:"ajax/search.php?type="+type+"&",
		varname:"key",
                type:type,
                appendto:appendto
                
            };
            return options;
	}
	 var options_xml = function(type,category,appendto){
     if(!appendto)
        appendto='body'; 
     var options={
                script:"ajax/search.php?type="+type+"&category="+category+"&",
		varname:"key",
                type:type,
                category:category,
                appendto:appendto
                
            };
            return options;
	}
        var as_xmlsearch = new AutoSuggest('search-place-update', options_xmlsearch('places'));
         var as_xmlsearch1 = new AutoSuggest('search-cc-place-update', options_xmlsearch('places'));
          var as_xml = new AutoSuggest('search-school-update', options_xml('pages','school'));
        var as_xml1 = new AutoSuggest('search-college-update', options_xml('pages','college'));
        var as_xml2 = new AutoSuggest('search-work-update', options_xml('pages','work'));
</script>

</body>
</html>
