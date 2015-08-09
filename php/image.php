<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'Classes/Images.php';

?>
<?php 
  if(isset($_REQUEST['albumid']) && isset($_SESSION['userid']))
  {
      $ImageClass=new Images();
      $images=$ImageClass->getimages($_REQUEST['albumid']);
      krsort($images);

?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Image Gallery</title>
		<link rel="stylesheet" href="css/basic.css" type="text/css" />
		<link rel="stylesheet" href="css/galleriffic-5_1.css" type="text/css" />
		<link href="css/blue-world.css" rel="stylesheet" type="text/css"/>
                 <link href="css/style.css" rel="stylesheet" />

		<!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->
		<link rel="stylesheet" href="css/black.css" type="text/css" />
		<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery.history_1.js"></script>
		<script type="text/javascript" src="js/jquery.galleriffic_1.js"></script>
		<script type="text/javascript" src="js/jquery.opacityrollover.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
                <script type="text/javascript" src="js/ajax2.js"></script>
                <!-- We only want the thunbnails to display when javascript is disabled -->
		<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
                <script type="text/javascript">
			document.write('<style>.noscript { display: none; }</style>');
		</script>
                <script src="js/jquery.nicescroll.min.js"></script>
                <style>  
                    #commentbox {
       float:left;
	overflow: auto;
     
}</style>

<script type="text/javascript">
    function searchitemsin(element) {
      if(element.value=='Search...'){
  	element.value = '';
      }
  
   }
   function searchitemsout(element) {
       if(element.value==''){
   	element.value = 'Search...';}
     }
    </script>
	</head>
        
	<body>
            <div  class="headerdiv">
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
    <li><a href="dairy.php">Diary</a></li>
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
<input class="search-box" id="searchusers"  type="text" value="Search..." onfocusout="searchitemsout(this)" onfocus="searchitemsin(this)" style="width:200px; height:20px" />
</div>
</div>


</div>
    
		<div  id="page">
			<div id="container">
				
				<!-- Start Advanced Gallery Html Containers -->				
				<div class="navigation-container">
					<div id="thumbs" class="navigation">
						<a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
					
						<ul class="thumbs noscript">
                                                    <?php $i=0; foreach($images as $key => $image){  ?>
							<li>
								<a class="thumb"  name="<?php echo $key; ?>" href="images/500/500_<?php echo $image['url'] ?>" title="<?php echo $image['title']; ?>">
                                                                  <img src="images/75/75_<?php echo $image["url"]; ?>" height="75" width="75" alt="<?php echo $image["url"]; ?>" />
								 </a>
								<div class="caption" style="float: right">
									<div style="width:220px; height:50px; border:solid 1px; border-color:#999">
                                                                       title
                                                                        <?php echo $image["title"]; ?>
                                                                           </div>

                                                                        <div style="width:220px; height:100px; border:solid 1px; border-color:#999">
                                                                            pin<input type="text" id="<?php echo $key; ?>_pinnedpeople"/><input type="hidden" id="<?php echo $key; ?>_pinnedpeople_hidden"/><div id="<?php echo $key; ?>_pinnedpeople_display"></div><a onclick="pinpeople('<?php echo $key; ?>',document.getElementById('<?php echo $key; ?>_pinnedpeople_hidden').value)">pin this pic</a><br/><a onclick="askforpin('<?php echo $key; ?>')" >Pin me</a>
                                                                            <script type="text/javascript">
                                                                        var as_search=new AutoSuggest('<?php echo $key; ?>_pinnedpeople', options_xmlsearch('friends'));    
                                                                        </script>
                                                                        </div>

                                                                        <div style="width:220px; height:100px; border:solid 1px; border-color:#999">
                                                                            people
                                                                             <?php print_r($image['pinnedpeople']) ?>
                                                                        </div>
                                                                         <div style="width:220px; height:250px; border:solid 1px; border-color:#999">
                                                                            descrip
                                                                             <?php echo $image["description"]; ?>
                                                                        </div>
                                                                    <div style="width:220px; margin-top: 3px; border:solid beige 1px;"></div>
                                                                    <div style="color:white"> <?php echo " Photo ".++$i." of ".  count($images); ?></div>
                                                                     <div style="width:200px; height: 200px; border: solid 1px #009F00; "></div>
						

								</div>
                                                             <div class="comment">
                               
		<div  style=" float:left; border: solid beige 1px; margin-bottom:5px; width:600px; "></div>
									       
         <div  style="height:30px; float:left; width:600px; ">
             <input id="<?php echo $key; ?>_comment" onkeyup="doimagecomment('<?php echo $key; ?>',event)" autocomplete="off" style="width:600px; height:30px" name="comment"/>
          </div>    
                                                                  <div  style=" float:left; border: solid beige 1px; margin-top: 5px; width:600px; "></div>
			<div id="<?php echo $key; ?>_com" style="height:600px; overflow: auto; width: 100%;  float: left; ">					 
                        </div>
                                                                 
<script type="text/javascript">


	var nice = $("html").niceScroll();  // The document page (body)
	
	
    
   
    // Customizable cursor
    // $("#boxscroll").niceScroll({touchbehavior:false,cursorcolor:"#00F",cursoropacitymax:0.7,cursorwidth:11,cursorborder:"1px solid #2848BE",cursorborderradius:"8px"}).cursor.css({"background-image":"url(img/mac6scroll.png)"}); // MAC like scrollbar
 // hw acceleration enabled when using wrapper
    
  
</script>
								</div>
							</li>
	  <?php } ?>
							
						</ul>
						<a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>
					</div>
				</div>
				<div class="content">
					<div class="slideshow-container">
						<div id="controls" class="controls"></div>
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container">
                                           
                                                
					</div>
				</div>
                                 <div id="comment" class="comment-container">
                                 </div>  
				<!-- End Gallery Html Containers -->
				<div style="clear: both;"></div>
			</div>
		</div>
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// We only want these styles applied when javascript is enabled
				$('div.content').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				
				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 10,
					preloadAhead:              10,
					enableTopPager:            false,
					enableBottomPager:         false,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
                                        commentContainerSel:       '#comment',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             true,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);

						// Update the photo index display
						this.$captionContainer.find('div.photo-index')
							.html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
						var nextPageLink = this.find('a.next').css('visibility', 'hidden');
						
						// Show appropriate next / prev page links
						if (this.displayedPage > 0)
							prevPageLink.css('visibility', 'visible');

						var lastPage = this.getNumPages() - 1;
						if (this.displayedPage < lastPage)
							nextPageLink.css('visibility', 'visible');

						this.fadeTo('fast', 1.0);
					}
				});

				/**************** Event handlers for custom next / prev page links **********************/

				gallery.find('a.prev').click(function(e) {
					gallery.previousPage();
					e.preventDefault();
				});

				gallery.find('a.next').click(function(e) {
					gallery.nextPage();
					e.preventDefault();
				});

				/****************************************************************************************/

				/**** Functions to support integration of galleriffic with the jquery.history plugin ****/

				// PageLoad function
				// This function is called when:
				// 1. after calling $.historyInit();
				// 2. after calling $.historyLoad();
				// 3. after pushing "Go Back" button of a browser
				function pageload(hash) {
					// alert("pageload: " + hash);
					// hash doesn't contain the first # character.
					if(hash) {
						$.galleriffic.gotoImage(hash);
					} else {
						gallery.gotoIndex(0);
					}
				}

				// Initialize history plugin.
				// The callback is called at once by present location.hash. 
				$.historyInit(pageload, "advanced.html");

				// set onlick event for buttons using the jQuery 1.3 live method
				$("a[rel='history']").live('click', function(e) {
					if (e.button != 0) return true;

					var hash = this.href;
					hash = hash.replace(/^.*#/, '');

					// moves to a new page. 
					// pageload is called at once. 
					// hash don't contain "#", "?"
					$.historyLoad(hash);

					return false;
				});

				/****************************************************************************************/
			});
		</script>
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
        var as_xmlsearch = new AutoSuggest('searchusers', options_xmlsearch('all'));
</script>
	</body>
</html>
<?php } ?>