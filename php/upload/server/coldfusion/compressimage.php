<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compressimage
 *
 * @author jameema
 */
class compressimage {
    function __construct($path) {
       $filename= basename($path);
       if(isset($filename)){
           $resolutions=array(32,50,75,200);
           foreach($resolutions as $res)
            $this->compress($path, $res);
           
       }
    }
    //put your code here
    function compress($path,$res)
    {
        $size=getimagesize($path);
        $width=$size[0];
        $height=$size[1];
        $quality=75;
        $xRatio		= $res / $width;
        $yRatio		= $res / $height;
        $tnHeight;$tnWidth;
        if ($xRatio * $height < $rse)
        { // Resize the image based on width
                $tnHeight	= ceil($xRatio * $height);
                $tnWidth	= $res;
        }
        else // Resize the image based on height
        {
                $tnWidth	= ceil($yRatio * $width);
                $tnHeight	= $res;
        }
        ini_set('memory_limit', MEMORY_TO_ALLOCATE);
        $dst	= imagecreatetruecolor($tnWidth, $tnHeight);
        $src;
        $newfile=dirname($path).'/'.$res.'/'.$res.'_'.  basename($path);
        switch($size['mime'])
        {
            case 'image/gif':
               $src=imagecreatefromgif($path);
               $this->setalpha($dst);
               $quality=round(10 - ($quality / 10));
               $sharpen=false;
               $createfile='imagepng';
               break;
            case 'image/x-png':
            case 'image/png':
               $src=imagecreatefrompng($path);
               $this->setalpha($dst);
               $quality=round(10 - ($quality / 10));
               $sharpen=false;
               $createfile='imagepng';
               break;
           default:
               $src=imagecreatefromjpeg($path);
               $sharpen=true;
               $createfile='imagejpeg';
            break;
           
        }
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $tnWidth, $tnHeight, $width, $height);
        if($sharpen)
        {
            $sharpness	= $this->findSharp($width, $tnWidth);
            $sharpenMatrix	= array(
                    array(-1, -2, -1),
                    array(-2, $sharpness + 12, -2),
                    array(-1, -2, -1)
            );
            $divisor		= $sharpness;
            $offset			= 0;
            imageconvolution($dst, $sharpenMatrix, $divisor, $offset);
        }
        if(!file_exists(dirname($path)))
            mkdir (dirname ($path));
        $createfile($dst,$newfile,$quality);
        imagedestroy($src);
        imagedestroy($dst);
    }
    function findSharp($orig, $final) // function from Ryan Rud (http://adryrun.com)
    {
        $final	= $final * (750.0 / $orig);
        $a		= 52;
        $b		= -0.27810650887573124;
        $c		= .00047337278106508946;

        $result = $a + $b * $final + $c * $final * $final;

        return max(round($result), 0);
    }
    function setalpha($dst)
    {
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
    }
    
    
}

?>
