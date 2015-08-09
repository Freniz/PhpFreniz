<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<?php 
    if(isset($_REQUEST['date']) && isset($_SESSION['userid']))
    {
        if(isset($_SESSION['diary'][$_REQUEST['date']]))
            echo json_encode (array('notes'=>$_SESSION['diary'][$_REQUEST['date']]['notes']));
        else
            echo json_encode(array('notes'=>''));
    }


?>