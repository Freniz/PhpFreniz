
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Slam Book</title>
<script src="js/ajax.js" type="text/javascript" ></script>
<style type="text/css">
td {
	font-family:"Comic Sans MS", cursive;
	font-size:20px;
	font-weight:bold;
}
</style>

</head>

<body>
<div style="width:100%; height:100px; float:left; ">
<div style="width:40%; height:100px;  float:left">
</div>
<div style="width:40%; font-size:50px; font-weight:bold; font-family:'Comic Sans MS', cursive; color:#090; height:100px; float:left">
Slam Book
</div>
<div style="width:49%;float:left">
<form name="aboutme" >
<table cellpadding="5px" cellspacing="3px">
<tr>
<td>Name:</td><td><textarea cols="30" rows="2" name="name"></textarea></td></tr>
<tr>
<td>Born On:</td><td><textarea cols="30" rows="2" name="bday"></textarea></td></tr>
<tr>
<td>Email:</td><td><textarea cols="30" rows="2" name="email"></textarea></td></tr>
<tr>
<td>Ring me:</td><td><textarea cols="30" rows="2" name="phone"></textarea></td></tr>
<tr>
<td>Ambition:</td><td><textarea cols="30" rows="2" name="ambition"></textarea></td></tr>
<tr>
<td>My Hobby:</td><td><textarea cols="30" rows="2" name="hobby"></textarea></td></tr>
<tr>
<td>I Believe in:</td><td><textarea cols="30" rows="2" name="believe"></textarea></td></tr>
<tr>
<td>About Friendship:</td><td><textarea cols="30" rows="2" name="friendship"></textarea></td></tr>
<tr>
<td>About Love:</td><td><textarea cols="30" rows="2" name="love"></textarea></td></tr>
<tr>
<td>i hate:</td><td><textarea cols="30" rows="2" name="hate"></textarea></td></tr>
<tr>
<td>My Philosophy:</td><td><textarea cols="30" rows="2" name="philosophy"></textarea></td></tr>
</table></form>


</div>
<div style="width:49%;  float:right">
    <form name="fav" >
<table cellpadding="5px" cellspacing="3px">
<tr>
<td>favourite Film:</td><td><textarea cols="30" rows="2" name="film"></textarea></td></tr>
<tr>
<td>favourite Music:</td><td><textarea cols="30" rows="2" name="music"></textarea></td></tr>
<tr>
<td>favourite Actor:</td><td><textarea cols="30" rows="2" name="actor"></textarea></td></tr>
<tr>
<td>favourite Actress:</td><td><textarea cols="30" rows="2" name="actress"></textarea></td></tr>
<tr>
<td>favourite Sports:</td><td><textarea cols="30" rows="2" name="sports"></textarea></td></tr>
<tr>
<td>favourite Sportsman:</td><td><textarea cols="30" rows="2" name="sportsman"></textarea></td></tr>
<tr>
<td>favourite Dress:</td><td><textarea cols="30" rows="2" name="dress"></textarea></td></tr>
<tr>
<td>favourite Food:</td><td><textarea cols="30" rows="2" name="food"></textarea></td></tr>
<tr>
<td>favourite Place:</td><td><textarea cols="30" rows="2" name="place"></textarea></td></tr>
<tr>
<td>Close Friends:</td><td><textarea cols="30" rows="2" name="friends"></textarea></td></tr>
<tr>
<td>I Feel About You:</td><td><textarea cols="30" rows="2" name="feel"></textarea></td></tr>
</table></form>

</div>
<div style="width:30%; float:left; height:50px; ">
</div>
<div style="width:69%; float:left; height:50px; ">
<form name="advice">
<table cellpadding="5px" cellspacing="3px">
<tr>
<td>My Advice For You:</td><td><textarea cols="30" rows="2" name="advice"></textarea></td>
<td></td><td><input type="button" name="create" value="Create" onclick="writeslambook('<?php echo $_REQUEST['userid']; ?>')" /></td></tr>
</table>
</form>
</div>


</div>

</body>
</html>
