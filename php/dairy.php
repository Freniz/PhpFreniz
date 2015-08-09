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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style>
#dairy-div{
	box-shadow: 3px 3px 6px rgba(0,0,0,2.5);
	-moz-box-shadow: 3px 3px 6px rgba(0,0,0,2.5);
	-webkit-box-shadow: 3px 3px 6px rgba(0,0,0,2.5);
	font-size:20px;
	
}

</style>
 	
	<script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/calendar.rc4.js"></script>
	<script type="text/javascript">		
	//<![CDATA[
		/*window.addEvent('domready', function() { 
			
			myCal2 = new Calendar({ date2: 'Y-m-d' }, { classes: ['dashboard'], direction: -1, tweak: {x: 3, y: -3} });
			
		});
	//]]>*/
	</script>
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/demo.css"       rel="stylesheet" type="text/css" />
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        
<script type="text/javascript">

datePickerController.setGlobalVars({"split":["-dd","-mm"]});
            
function disableEasterMonday(argObj) { 
       
        var y = argObj.yyyy,
            a=y%4,
            b=y%7,
            c=y%19,
            d=(19*c+15)%30,
            e=(2*a+4*b-d+34)%7,
            m=Math.floor((d+e+114)/31),
            g=(d+e+114)%31+1,            
            yyyymmdd = y + "0" + m + String(g < 10 ? "0" + g : g);         
        
        datePickerController.addDisabledDates(argObj.id, yyyymmdd); 
       
        return {};
};


function createSpanElement(argObj) {
       
        if(document.getElementById("EnglishDate-" + argObj.id)) return;

        
        var spn = document.createElement('span');
            p   = document.getElementById(argObj.id).parentNode;
            
        spn.id = "EnglishDate-" + argObj.id;
        p.parentNode.appendChild(spn);
        
        p.style.marginBottom = "0";
        
        spn.appendChild(document.createTextNode(String.fromCharCode(160)));
};

function showEnglishDate(argObj) {
        
        var spn = document.getElementById("EnglishDate-" + argObj.id),
            formattedDate = datePickerController.printFormattedDate(argObj.date, "l-cc-sp-d-S-sp-F-sp-Y", false);
       
        if(!spn) {
                createSpanElement(argObj); 
                spn = document.getElementById("EnglishDate-" + argObj.id);
        };
        
      
        while(spn.firstChild) spn.removeChild(spn.firstChild);
        
      
        spn.appendChild(document.createTextNode(formattedDate));
};


            
datePickerController.addEvent(window, "load", function() {
      var opts = {
        
        id:"date2",
       
        format:"Y-ds-m-ds-d",
        // Days to highlight (starts on Monday)
        highlightDays:[0,0,0,0,0,1,1],
        // Days of the week to disable (starts on Monday)
        disabledDays:[0,0,0,0,0,0,0],
        // Dates to disable (YYYYMMDD format, "*" wildcards excepted)
        disabledDates:{
                "20090601":"20090612", // Range of dates
                "20090622":"1",        // Single date
                "****1225":"1"         // Wildcard example 
                },
        // Date to always enable
        enabledDates:{},
        // Don't fade in the datepicker
        // NOTE: Only relevant if "staticPos" is set to false
        noFadeEffect:false,
        // Is it inline or popup
        staticPos:false,
        // Do we hide the associated form element on create
        hideInput:false,
        // Do we hide the today button
        noToday:false,
        // Do we show weeks along the left hand side
        showWeeks:true,
        
        dragDisabled:true,
       
        positioned:"",
        
        fillGrid:true,
        
        constrainSelection:true,
       
        callbacks:{"create":[], "dateselect":[function(){updatediarydiv($('#date2').val())}]},
        
        buttonWrapper:"",
        
        cursorDate:""      
      };
      datePickerController.createDatePicker(opts);
});

// ]]>
</script>
        <script type="text/javascript">
            
            
            function create_or_modify_diary(date1,value1)
            {
                if(date1){
               alert(value1+"\n"+date1);
                if(value1)
                    {
                        document.getElementById("diary-textarea-edit").value=value1;
                    }
                        document.getElementById("diary-hidden-date").value=date1;
                        document.getElementById('light3').style.display='block';
                        document.getElementById('fade3').style.display='block';
                }
            }
            
            function updatediarydiv(date)
            {
                request.onreadystatechange=updtdiarydiv;
                request.open('get','ajax/getdiarynotes.php?date='+date,true);
                request.send(null);
            }
            function updtdiarydiv()
            {
                if(request.readyState==4 && request.status==200)
                    {
                        var json=eval('('+request.responseText+')');
                        document.getElementById('diary-div').innerHTML=json.notes;
                    }
            }
            
            
    $(document).ready(function(){
            $('#date2').data('oldVal', $('#date2').val());
            
   // Look for changes in the value
   $('#date2').bind("propertychange keyup input paste", function(event){
      // If value has changed...
      if ($('#date2').data('oldVal') != $('#date2').val()) {
       // Updated stored value
       $('#date2').data('oldVal', $('#date2').val());
       updatediarydiv($('#date2').val());
       // Do action
     }
   });
           });
           
        </script>
	<link rel="stylesheet" type="text/css" href="css/iframe.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	
	<link rel="stylesheet" type="text/css" href="css/dashboard.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/blue-world.css" media="screen" />
	
</head>

<body>
    
  <div class="headerdiv">
<div style="width:200px; float:left; height:80px; ">
<a style="text-decoration:none; cursor: pointer;" class="headername" href="#">Freniz</a>
</div>
<div style="width:40px; float:left; height:80px; ">
    <div style="width:40px; margin-top: 10px; float:left; height:40px; "><img style="marin-top:10px" src="images/mood/<?php echo $_SESSION['mood'];?>" width="40" height="40"/></div>

</div>
<div style=" float:left; height:80px; ">
<div id="top-menu-bar" style="height:30px; margin-top: 20px; margin-left: 30px;  float:left; ">
<ul id="menu">
  <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Streams</a></li>
  <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>">Biog</a>
  </li>
  <li><a href="message.php">Messages</a>
   </li>
   <li><a href="invitations.php">Alert</a>
   </li>
    <li><a href="profile.php?userid=<?php echo $_SESSION['userid']; ?>&tab=blogs">Blog</a>
   </li> 
  <li><a href="">Apps</a>
    <ul>
    <li><a href="">Music</a></li>
    <li><a href="">Diary</a></li>
    <li><a href="slambook.php?userid=<?php echo $_SESSION['userid']; ?>">Slambook</a></li>
    </ul>
  </li>
</ul>
</div>

</div>
<div style=" width: 250px; margin-right: 10px; float:right; height:80px; ">
<div style=" float:right; font-weight: bold; color: #fff; height:40px;">
   
<div class="popup" style=" float:left; ">
<div style=" float:left; margin-top: 5px; font-size:16px;  font-weight:bold;">
    <center><?php echo $_SESSION['username']; ?></center>
</div>
<div style="width:32px; position: relative; height:32px; float:right; ">
<a class="arow"></a>
<span>
<div style="background-image:url(/images/prettyGallery/arrow.png); margin-top:-7px; width:20px; height:6px; float:right"></div>
<ul><li><a href="accountsettings.php">Account settings</a></li>
<li><a href="#2">Privacy settings</a></li>
</ul>

<div style="width:150px; height:20px; background-color:#6699FF">
<a id="letmeout" href="#3" >Letme out</a></div>
</span>
</div>

</div>

</div>
<div style="width:200px; float:left; height:20px; ">
<input class="search-box" type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div>  
    
<div style="width:100%; float:left">
<div style="width:100%; font-weight: bold; font-family: cursive; font-size: 30px;  height: 50px; float:left">
    Secret Diary
</div>    
<div style="width:60%; height:25px; margin-left:20%; border:solid 2px; float:left">
<form action="/">
<label for="date2">Date</label>
<input id="date2" name="date2" class="w16em" type="text" />
</form>
    <input onclick="create_or_modify_diary(document.getElementById('date2').value,document.getElementById('diary-div').innerHTML);  " type="button" onclick="" value="CreateNotes" style="float:right; margin-top: -15px" />
</div>
<div id="diary-div" style="width:60%; margin-left:20%; height:500px; float:left; border:solid 8px">

</div>
<div style="width:60%; margin-left:21%; height:20px; margin-top:20px; float:left; ">
<a style="float:left" href="#">Previous</a>
<a style="float:right" href="#">Next</a>

</div>
</div>
    <div id="light3" style="width:550px; height:240px; " class="white_content">
        
       
<div style="width:500px; height:200px; margin-left:20px; margin-top:20px; ">
<div style=" height:30px; margin-top:5px; margin-left:5px; float:left; ">
Write whatever u felt today</div>

<div style="width:350px; height:100px; margin-top:10px; margin-left:60px; float:left;">
<textarea id="diary-textarea-edit" rows="4" cols="40" name="msg" >
</textarea>
    <input type="text" readonly='true' id="diary-hidden-date"/>
</div>


<div style="width:300px; ">

  <ul class="roundbuttons sendmessagewidth">
  <li><input type="button" name="cancel" value="cancel" onClick="document.getElementById('light3').style.display='none';   document.getElementById('fade3').style.display='none';"  /></li>
  <li><input type="button" name="send" value="Post" onclick="writediary(document.getElementById('diary-hidden-date').value,document.getElementById('diary-textarea-edit').value);" /></li>
  </ul>


</div>
</div>
        
        </div>
    <div id="fade3" onClick="document.getElementById('light3').style.display='none';  document.getElementById('fade3').style.display='none'" class="black_overlay">
        </div>
</body>
</html>
