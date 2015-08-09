<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION['userid']))
{
    header('location: http://localhost/fz-proto/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Freniz-The Real World</title>
<link href="css/style.css" rel="stylesheet" />
<link href="css/blue-world.css" rel="stylesheet" />

<link rel="stylesheet" href="css/drop.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript" src="js/onload.js"></script> 
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/audio-player.js" type="text/javascript"></script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<script type="text/javascript" src="js/accountsettings.js"></script>

<style type="text/css">
body{
   font-size: 99%;
   background-color: #c1d8a9;
   color: #000;
   font-family: arial, helvetica, geneva, sans-serif;
   margin-left:0px;
   margin-top:0px;
}
.bodycontainer{
	position:fixed;
	width:100%; 
	height:100%; 
	padding:0;
	z-index:5000;
	border:solid 1px;
         
}
#create-button input{
       padding: 6px 10px;
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	font-size:14px;
        font-weight: bold;
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	text-decoration: none;
        cursor: pointer;
}
#create-button input:hover{
	color:#fff;
}
#letmein-button input{
       padding: 6px 10px;
	border-radius: 8px;
	box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	-moz-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	font-size:14px;
         font-weight: bold;
	background: #0C0;
	-webkit-border-radius: 8px;
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0,.5);
	text-decoration: none;
        cursor: pointer;
}
#letmein-button input:hover{
	color:#fff;
}

#musictab{
 /* Path to Image */
right:1px;  /* change this to left: 1px; to put it on the left of the screen */
top:97%;
border:solid 1px;
height:25px;
width:100%;
margin:0;
padding:0;
position:fixed;
z-index:5000;
background-color:#333;
    -moz-box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);
        -webkit-box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);
        -ms-box-shadow:0px 0px 5px 5px rgba(68,68,68,0.6);
	    box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);

}
.createanuser{
	width:150px;
	margin-left:350px; 
	margin-top:-25px;
}
.headername{
	font-family:"Bleeding cowboys";
        text-shadow: 1px 1px #0C0, -1px -1px #444;
	color:#0C0;
        text-shadow: black 0.1em 0.1em 0.2em;
	font-size:60px;
	text-decoration:none;
	cursor:pointer;
	
	margin-left:10px;
	
 
}
.title{
	font:"Comic Sans MS", cursive; font-size:18px;
	font-weight:bold;
}
table{
	font:"Comic Sans MS", cursive; font-size:15px;
	font-weight:bold;
}
.d{
	height:40px; width:300px;
}
.header{
    -moz-box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);
        -webkit-box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);
        -ms-box-shadow:0px 0px 5px 5px rgba(68,68,68,0.6);
	    box-shadow: 0px 0px 5px 5px rgba(68,68,68,0.6);

}
.forgetpass{
	 margin-left:30px; margin-bottom:10px; text-decoration:none; font-size: 14px; font-weight:bold; cursor:pointer; color:#333;
}
.forgetpass:hover{
	 margin-left:30px; margin-bottom:10px;
	 text-decoration:underline;
	 font-weight:bold; cursor:pointer; color:#333;
}
#close-create-acc a{
    text-decoration: none;
    cursor: pointer;
    color: #cccccc;
}
#close-create-acc a:hover{
    color: #000;
}
#thought{
	
	border-radius: 8px;
	box-shadow:2px 2px 8px 3px rgba(0,0,0,.5);
	-moz-border-radius: 8px;
	padding:2px 10px;
	-moz-box-shadow: 2px 2px 8px 3px rgba(0,0,0,.5);
	background: DCF4F5
	-webkit-border-radius: 8px;
	-webkit-box-shadow:2px 2px 8px 3px rgba(0,0,0,.5);

}
</style>
<script type="text/javascript">
       
      
      
      
      function redirect()
       {
   <?php if(isset($_SESSION['userid'])){ ?>
           
           showprofile('<?php echo $_SESSION['userid'] ?>');
           <?php }else{ ?>
               var e=document.getElementById("container");
               e.style.visibility='visible';
               <?php } ?>
       }
         
//]]>
</script> 

<script type="text/javascript">  
            AudioPlayer.setup("player.swf", {  
                width: 290  
            });  
        </script>  
</head>

<body >
   
<div class="bodycontainer">

<div class="header" style="width:100%;height:80px;background-color:#333; border:solid 1px">
<div class="headername" style="width:200px; float:left; height:80px; ">
Freniz
</div>
</div>




<div style="height:150px; margin-top:200px; margin-left:6px; width:300px; float:left; border:solid 4px">
   
              
   <div class="title" style="height:20px;">
   Log In 
   </div>

<form action="" method="post" onsubmit="">
<table style="margin-top:20px; margin-left:20px">
        <tr>
        <td>User Name:</td><td><input type="text" onkeydown="login(event)" id="userid" name="username" size="20"/></td></tr>
        <tr>
        <td>Password:</td><td><input type="password" id="password" onkeydown="login(event)" name="password" size="20"/></td></tr>
        </table>
<div  style="margin-top:10px; margin-left:20px">
 
<a href = "javascript:void(0)" class="forgetpass"  onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block'"> ForgetPassword?</a>

</div>
<div id="letmein-button" style="width:100px; margin-top: -25px; margin-right: 5px; height:40px; float:right">
 <input type="button"  onclick="login()" value="LetMe In" />
</div>
</form>
</div>

<div id="light" style=" height:500px" class="white_content">
        
       <div style="width:560px; height:500px;float:left; ">
       <div id="close-create-acc" style=" height:20px; font-weight:bold; text-align:center;width:20px; float:right; ">
            <a onClick="document.getElementById('light2').style.display='none';document.getElementById('light').style.display='none';   document.getElementById('fade').style.display='none'";>x</a>
       </div>
<div class="title">
Create Account
</div>
           
<br/>
<div style="width:400px; margin-left:80px; height:250px; float:left">
<form action="" method="post">
<table border="0" width="360" class="subfont" style="text-align:right" cellpadding="8">
<tr>
<td>User Name :</td>
<td><input type="text" size="30" height="20" name="username" id="username" onkeyup="checkusername()" /></td>
</tr>
<tr>
<td>E-Mail ID :</td>
<td><input type="text" size="30" height="20" name="eid" id="eid" onkeyup="checkemail()" onfocus="checkmail()" /></td>
</tr>
<tr>
<td>Password :</td>
<td><input type="password" size="30" height="20" name="password1" id="password1" onkeyup="checkpassword()" /></td>
</tr>
<tr>
<td>Re-Password :</td>
 <td><input type="password" size="30" height="20" name="cpassword" id="cpassword" onkeyup="matchpassword()" /></td>
 </tr>
<tr>
<td>First Name :</td>
<td><input type="text" size="30" height="20" name="fname" id="fname" /></td>
</tr>
<tr></tr>
<tr>
<td>Last Name :</td>
<td><input type="text" size="30" height="20" name="lname" id="lname"/></td>
</tr>

<tr>
<td>Sex :</td>
<td style="text-align:left"><select class="select" name="sex" id="sex"><option value="0">Select Sex:</option><option value="1">Female</option><option value="2">Male</option></select>
</td>
</tr>
<tr>
<td>Birth Day :</td>
<td style="text-align:left"><select class="" id="birthday_month" name="birthday_month"><option value="-1">Month:</option><option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">May</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Aug</option>
<option value="9">Sep</option>
<option value="10">Oct</option>

<option value="11">Nov</option>
<option value="12">Dec</option>
</select> <select name="birthday_day" id="birthday_day"  onchange="bagofholding" autocomplete="off"><option value="-1">Day:</option><option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>

<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>

<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>

<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select> <select name="birthday_year" id="birthday_year"  autocomplete="off"><option value="-1">Year:</option><option value="2011">2011</option>

<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>

<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>

<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>

<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>

<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>

<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>

<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>

<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>

<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option>
<option value="1934">1934</option>
<option value="1933">1933</option>
<option value="1932">1932</option>
<option value="1931">1931</option>
<option value="1930">1930</option>

<option value="1929">1929</option>
<option value="1928">1928</option>
<option value="1927">1927</option>
<option value="1926">1926</option>
<option value="1925">1925</option>
<option value="1924">1924</option>
<option value="1923">1923</option>
<option value="1922">1922</option>
<option value="1921">1921</option>

<option value="1920">1920</option>
<option value="1919">1919</option>
<option value="1918">1918</option>
<option value="1917">1917</option>
<option value="1916">1916</option>
<option value="1915">1915</option>
<option value="1914">1914</option>
<option value="1913">1913</option>
<option value="1912">1912</option>

<option value="1911">1911</option>
<option value="1910">1910</option>
<option value="1909">1909</option>
<option value="1908">1908</option>
<option value="1907">1907</option>
<option value="1906">1906</option>
<option value="1905">1905</option>
</select></td>
</tr>
</table>
<br />

<div style=" margin-left:40px; width:100px; height:40px; float:left">
 <ul class="roundbuttons rdwidth" style="margin-left:100px">
        <li><a onclick="createaccount()">CREATE </a></li>
        </ul>
</div>
</form>

</div>
</div>

        </div>
		
		

<div id="light2" style="width:900x; height:300px" class="white_content">
        
       <div style="width:750px; height:200px; float:left; ">
       <div id="close-create-acc"  style=" cursor:pointer;height:20px; font-weight:bold; text-align:center;width:20px; float:right; ">
       <a onClick="document.getElementById('light2').style.display='none';document.getElementById('light').style.display='none';   document.getElementById('fade').style.display='none'";>x</a>
     </div>
<div class="title">
Forget Account
</div>
<br/>
<div style="width:400px; margin-left:150px; height:200px; float:left">
<form action="" method="post">
<table border="0" width="360" class="subfont" style="text-align:right" cellpadding="8">
<tr>
<td>E-Mail ID :</td>
<td><input type="text" size="30" height="20" name="eid" /></td>
</tr>
<tr>
</table>
<br />

<div style="width:400px; height:100px; border:solid 1px">
  <div style="height:100px; width:100px; float:left; border:solid 1px">
   </div>
  <div style="height:20px; width:100px; float:left; margin-top:40px; margin-left:10px;border:solid 1px">
   </div>
</div><br/>

<div style=" margin-left:40px; width:100px; height:40px; float:left">
 <ul class="roundbuttons rdwidth" style="margin-left:100px">
        <li><a href="#">Retrive Account</a></li>
        </ul>
</div>
</form>

</div>
</div>

        </div>
		

  <div id="fade" style="height:900px" onClick="document.getElementById('light2').style.display='none';document.getElementById('light').style.display='none';   document.getElementById('fade').style.display='none'" class="black_overlay">
        </div>      
      





<div id="create-button" style="float:right; font-size:22px; font-weight:bold; width:550px; height:50px">
<br/>
Do you wanna create New User?
<input type="button" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" value="Createanuser" /></input>
 
</div>

    <div id="thought" style="float:left; font-family:'Comic Sans MS', cursive;margin: 20px; color:#603; font-weight:bold; font-size:32px;  width: 60%">
<p>Freniz is not just a Social Network , It Connect the people all over the World with 
Profile Smilies,Listening Musics,Diary,Slambook,Blog,Wiki, Pictures,Videos,
Messages,Invites, Admire Others,Votes,Scribbles, Biography and more.</p>
    </div>




<div id="musictab">


  <div style=" float:left; width:40%; ">
   <p id="audioplayer_1" style=" background-color:#333">Alternative content</p>
        </div> 
        <div style="height:20px; float:left; color:#FFF; font-weight:bold; font-size:14px; width:100px; ">
        (c)Freniz.com
  </div>  
        <script type="text/javascript">  
        AudioPlayer.embed("audioplayer_1", {soundFile: "review.mp3"});
       </script> 
       
</div>

</div>
    
</body>
</html>
