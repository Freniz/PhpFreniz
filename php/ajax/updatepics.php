<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../classes/Images.php';
?>
<?php
$output;
if(isset($_SESSION['userid']) && isset($_REQUEST['imagearray'])){
 $imagearray=unserialize($_REQUEST['imagearray']);
 $Imgs=new Images();
 $Imgs->editImageData($imagearray);
 echo json_encode(array("status"=>"true"));
}
?>