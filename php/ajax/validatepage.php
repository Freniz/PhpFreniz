<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'dovalidation.php';
?>
<?php
    if(isset($_SESSION['userid']) && isset ($_REQUEST['pageid'])){
       $result=validatepage($_REQUEST['pageid']);
       $output=json_encode(array("userid"=>$_SESSION['userid'],"status"=> $result  ));
       echo $output;
    }
    else
    {
         $output=json_encode(array("userid"=>$_SESSION['userid'],"status"=>"false"));
         echo $output;
    }
    
?>