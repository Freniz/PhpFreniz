<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../classes/Images.php';
?>
<?php 
    if(isset($_SESSION['userid']) && $_REQUEST['imageid']){
        $Imgs=new Images();
        echo $Imgs->pinmereq($_REQUEST['imageid']);
     }


?>