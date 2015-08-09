<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

session_start();
require_once '../Classes/Images.php';
?>
<?xml version="1.0" encoding="UTF-8"?>
<?php
    if(isset($_SESSION['userid']) && $_REQUEST['imageids']){
    $Imgs=new Images();
    $imageids=unserialize($_REQUEST['imageids']);
    $images=$Imgs->getArrayOfImages($imageids);
 ?>
<images>
    <?php 
        foreach($images as $key=>$image){
    ?>
    <image1>
        <id><?php echo $key; ?></id>
        <url><?php echo $image['url']; ?></url>
        <pinnedpeople><?php echo serialize($image['pinnedpeople']); ?></pinnedpeople>
        <title><?php echo $image['title']; ?></title>
        <description><?php echo $image['description']; ?></description>
    </image1>
    <?php }
    ?>
    
</images>
<?php } ?>