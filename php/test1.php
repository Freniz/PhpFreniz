<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ajax/compressimage.php';
function cropImage($x,$y,$nw, $nh, $source,  $dest) {
	$size = getimagesize($source);
	$w = $size[0];
	$h = $size[1];
        $base_h;$base_w;
        if($w>$h)
        {
            $base_w=500;
            $base_h=($h*$base_w)/$w;
        }
        else
        {
            $base_h=500;
            $base_w=($w*$base_h)/$h;
        }
        echo "$base_h<br>$base_w";
        $x=($x/$base_w)*$w;
        $y=($y/$base_h)*$h;
        $nw=($nw/$base_w)*$w;
        $nh=($nh/$base_h)*$h;
        switch($size['mime']) {
		case 'image/gif':
		$simg = imagecreatefromgif($source);
                    $create='imagepng';
		break;
		case 'image/png':
                case 'image/x-png':
		$simg = imagecreatefrompng($source);
                    $create='imagepng';
		break;
                default :
		$simg = imagecreatefromjpeg($source);
                    $create='imagejpeg';
		break;
		
	}
	$dimg = imagecreatetruecolor($nw, $nh);
	imagecopyresampled($dimg,$simg,0,0,$x,$y,$nw,$nh,$nw,$nh);
	$create($dimg,$dest,100);
        imagedestroy($simg);
        imagedestroy($dimg);
        $c=new compressimage($dest);
}
?>
