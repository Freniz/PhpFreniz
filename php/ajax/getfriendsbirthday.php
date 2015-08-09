<?php
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'getminiprofile.php';
?>
<?xml version="1.0" encoding="UTF-8"?>
<?php
if(isset($_SESSION['userid']) && $_SESSION['type']=='user')
{
    mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
    mysql_select_db("fztest1") or die ("coudnt find database");
    $mmdd=strftime('%m-%d');
    $query="select userid from user_info where dob like '%-$mmdd' and (";
    $i=0;$birthdayusers=array();
    foreach($_SESSION['friends'] as $user)
    {
        $i++;
        if($i!=count($_SESSION['friends']))
            $query.=" userid='$user' or ";
        else
            $query.=" userid='$user')";
    }
    $result=mysql_query($query);
    while($row=  mysql_fetch_assoc($result)){
        array_push($birthdayusers, $row['userid']);
    }
}

?>
<users>
    <?php foreach($birthdayusers as $user){ $userpro=  getminipro($user);?>
    <user>
        <userid><?php echo $user; ?></userid>
        <username><?php echo $userpro['username']; ?></username>
        <userpic><?php echo $userpro['propic']; ?></userpic>
        <userurl><?php echo $userpro['url']; ?></userurl>
    </user>
    <?php } ?>
</users>