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
<script type="text/javascript">
function displayinvite(value,eid)
{
	if(value=='5' || value=='6'){
	var e=document.getElementById(eid);
	var e1=document.getElementById('restrict-invite');
	e.style.display='block';
	e1.style.display='none';
	}
	else
	{
	var e=document.getElementById(eid);
	var e1=document.getElementById('restrict-invite');
	e.style.display='none';
	e1.style.display='block';
	}
}
function displaymessage(value,eid)
{
	if(value=='5' || value=='6'){
	var e=document.getElementById(eid);
	var e1=document.getElementById('message-restrict');
	e.style.display='block';
	e1.style.display='none';
	}
	else
	{
	var e=document.getElementById(eid);
	var e1=document.getElementById('message-restrict');
	e.style.display='none';
	e1.style.display='block';
	}
}
function displayupdates(value,eid)
{
	if(value=='5' || value=='6'){
	var e=document.getElementById(eid);
	var e1=document.getElementById('updates-restrict');
	e.style.display='block';
	e1.style.display='none';
	}
	else
	{
	var e=document.getElementById(eid);
	var e1=document.getElementById('updates-restrict');
	e.style.display='none';
	e1.style.display='block';
	}
}
function displayupdatespost(value,eid)
{
	if(value=='5' || value=='6'){
	var e=document.getElementById(eid);
	var e1=document.getElementById('updates-restrict-post');
	e.style.display='block';
	e1.style.display='none';
	}
	else
	{
	var e=document.getElementById(eid);
	var e1=document.getElementById('updates-restrict-post');
	e.style.display='none';
	e1.style.display='block';
	}
}
function displayadmire(value,eid)
{
	if(value=='5' || value=='6'){
	var e=document.getElementById(eid);
	var e1=document.getElementById('admire-restrict');
	e.style.display='block';
	e1.style.display='none';
	}
	else
	{
	var e=document.getElementById(eid);
	var e1=document.getElementById('admire-restrict');
	e.style.display='none';
	e1.style.display='block';
	}
}

</script>
<style>
#privacy-button input{
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	font-size:12px;
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	text-decoration: none;
}
#privacy-button input:hover{
	color:#fff;
}
</style>
</head>

<body>
<div style="width:75%; ">
<div style="width:100%; float:left; border:solid 1px">
Updates
<div style="width:100%; float:left; border:solid 1px">
<table cellpadding="3" cellspacing="3">
<tr><td>Updates Visiblity</td><td><select  id="friends-updates" onchange="displayupdates(document.getElementById('friends-updates').value,'updates-Specific')" style="width:100px;" ><option value="-1">select</option><option value="1">Friends</option><option value="2">FoF</option>
<option value="3">Public</option>
<option value="4">Private</option>
<option value="5">Specific</option>
</select></td></tr><tr id="updates-Specific"  style="display: none"><td>Specific people to view my Updates</td><td><input type="text"  /></td></tr><tr id="updates-restrict"  style="display: block"><td>Restrict people to view my Updates</td><td><input type="text"  /></td></tr><tr><td>Who can Updates me?</td><td><select id="friends-updates-post"  onchange="displayupdatespost(document.getElementById('friends-updates-post').value,'updates-Specific-post')"  style="width:100px;" ><option value="-1">select</option><option value="1">Friends</option><option value="2">FoF</option>
<option value="3">Public</option>
<option value="4">Private</option>
<option value="5">Specific</option>

</select></td></tr><tr id="updates-Specific-post" style="display:none"><td>Specific people to Updates me</td><td><input type="text"  /></td></tr><tr id="updates-restrict-post" style="display:block"><td>Restrict people to updates me</td><td><input type="text"  /></td></tr>

</table>
</div>
</div>
<div style="width:100%; float:left; border:solid 1px">
Admiration
<div style="width:100%; float:left; border:solid #0C0">
<table cellpadding="3" cellspacing="3">
<tr><td>Admiration Visiblity</td><td><select id="friends-admire" onchange="displayadmire(document.getElementById('friends-admire').value,'admire-Specific')" style="width:100px;" ><option value="-1">select</option><option value="1">Friends</option><option value="2">FoF</option>
<option value="3">Public</option>
<option value="4">Private</option>
<option value="5">Specific</option>
</select></td></tr><tr id="admire-Specific" style="display:none"><td>Specific people to view my admiration</td><td><input type="text"  /></td></tr><tr id="admire-restrict" style="display:block"><td>Restrict people to view my admiration</td><td><input type="text"  /></td></tr><tr><td>Who can admire me?</td><td><select style="width:100px;" ><option value="-1">select</option><option value="1">Friends</option><option value="2">FoF</option>
<option value="3">Private</option>
</select></td></tr><tr><td>Restrict people to admire me</td><td><input type="text"  /></td></tr>
</table>
</div>
</div>

<div style="width:100%; float:left; border:solid #C30">
Message
<div style="width:100%;  float:left; border:solid 1px">
<table cellpadding="3" cellspacing="3">
<tr><td>Who can message me?</td><td><select id="friends-message" onchange="displaymessage(document.getElementById('friends-message').value,'message-Specific')" style="width:100px;" ><option value="-1">select</option><option value="1">Friends</option><option value="2">FoF</option>
<option value="3">Public</option>
<option value="4">Private</option>
<option value="5">Specific</option>
</select></td></tr
><tr id="message-Specific"  style="display: none"><td>Specific people to message me</td><td><input type="text"  /></td></tr><tr id="message-restrict"  style="display: block"><td>Restrict people to message me</td><td><input type="text"  /></td></tr></table>
</div>
</div>
<div style="width:100%; float:left; border:solid #3FC">
Invite
<div style="width:100%;  overflow:visible; float:left; border:solid #C90">
<table cellpadding="3" cellspacing="3">
<tr><td>Who can invite me?</td><td><select id="friends-invites" onchange="displayinvite(document.getElementById('friends-invites').value,'friendshidden')" style="width:100px;" ><option value="-1">select</option><option value="1">Friends</option><option value="2">FoF</option>
<option value="3">Public</option>
<option value="4">Private</option>
<option value="5">Specific</option>
</select></td></tr>
<tr id="friendshidden" style="display: none"><td>Specific people to invite me</td><td><input type="text"  /></td></tr
><tr id="restrict-invite" style="display: block;"><td>Restrict people to invite me</td><td><input type="text"  /></td></tr></table>
</div>
</div>

<div id="privacy-button" style="width:100%; background-color:#C1D8A9; height:30px; float:left; border:solid 1px">
<input type="button" style="float:right" value="save change" />
</div>

</div>


</body>
</html>
