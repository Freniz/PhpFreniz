<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php 
$output;
    if(isset($_SESSION['userid']) && isset($_REQUEST['pt']) &&isset($_REQUEST['specific']) && isset($_REQUEST['hidden'])){
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        mysql_query("update privacy set postvisi='".$_REQUEST['pt']."', postspeci='".$_REQUEST['specific']."',posthidden='".$_REQUEST['hidden']."' where userid='".$_SESSION['userid']."'");
       $output=json_encode(array("status"=>"true"));
    }
 else {
    $output=json_encode(array("status"=>"false"));
}
echo $output;

?>
