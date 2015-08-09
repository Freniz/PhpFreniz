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
		<title>Galleriffic | Custom layout with external controls</title>
		<link rel="stylesheet" href="css/basic.css" type="text/css" />
		<link rel="stylesheet" href="css/galleriffic-5_1.css" type="text/css" />
		
		<!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->
		<link rel="stylesheet" href="gallery/css/black.css" type="text/css" />
		<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
                <script src="js/jquery.nicescroll.min.js"></script>
		
                <script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="gallery/js/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="js/jquery.history_1.js"></script>
		<script type="text/javascript" src="js/jquery.galleriffic_1.js"></script>
		<script type="text/javascript" src="gallery/js/jquery.opacityrollover.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
                <script type="text/javascript" src="js/ajax2.js"></script>
                <!-- We only want the thunbnails to display when javascript is disabled -->
		<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
               
		<script type="text/javascript">
			document.write('<style>.noscript { display: none; }</style>');
		</script>
	</head>
	<body>
		<div id="page">
			<div id="container">
				
				

				<!-- Start Advanced Gallery Html Containers -->				
				<div class="navigation-container">
					<div id="thumbs" class="navigation">
						<a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
					
						<ul class="thumbs noscript">
						  <?php $i=0; foreach($images as $key => $image){ ?>	
						<li>
								<a class="thumb"  name="<?php echo $key; ?>" href="images/500/500_<?php echo $image['url'] ?>" title="<?php echo $image['title']; ?>">
                                                                  <img src="images/75/75_<?php echo $image["url"]; ?>" height="75" width="75" alt="<?php echo $image["url"]; ?>" />
								 </a>
								<div class="caption">
									<div style="width:220px; height:50px; border:solid 1px; border-color:#999">
                                                                       title
                                                                        <?php echo $image["title"]; ?>
                                                                           </div>

                                                                        <div style="width:220px; height:100px; border:solid 1px; border-color:#999">
                                                                            pin<input type="text" id="<?php echo $key; ?>_pinnedpeople"/><input type="hidden" id="<?php echo $key; ?>_pinnedpeople_hidden"/><div id="<?php echo $key; ?>_pinnedpeople_display"></div><a onclick="pinpeople('<?php echo $key; ?>',document.getElementById('<?php echo $key; ?>_pinnedpeople_hidden').value)">pin this pic</a>
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
								       
         <div style="height:30px; float:left; width:600px; ">
             <form method="post" >
             <textarea id="<?php echo $key; ?>_comment" style="width:530px; height:30px" name="comment"></textarea>
             
<input type="button" onclick="doimagecomment('<?php echo $key; ?>')" style="float:right; margin-top:5px;" value="update" />
</form>
</div>             <div  style=" float:left; border: solid beige 1px; margin-top: 5px; width:600px; "></div>
			         
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
                   
                    </div> 
                    
				</div>
                
				<!-- End Gallery Html Containers -->
		
		
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
	</body>
</html>
<?php } ?>