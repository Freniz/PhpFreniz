<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$people="nizam";
$people1=explode(",", $people);
print_r($people1);
echo ini_get("post_max_size");
echo ini_get("upload_max_filesize");
?>
