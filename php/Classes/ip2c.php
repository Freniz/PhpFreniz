<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ip2c{
    private $ip='';private $ip1='';
    public function __construct() {
        $this->ip=(!empty($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR'] :((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']: @getenv('REMOTE_ADDR'));
        if(isset($_SERVER['HTTP_CLIENT_IP']))
            $this->ip1=$_SERVER['HTTP_CLIENT_IP'];
    }
    
    function getIpAdd()
    {
        if(!empty($this->ip1))
            return $this->ip1."@".$this->ip;
        else
            return $this->ip;
    }
    function getCountrycode()
    {
        mysql_connect('localhost','nizam','ajith786') or die("cannot connected");
        mysql_select_db("fztest1") or die ("coudnt find database");
        $sq="SELECT country,city FROM ip2city_list WHERE locationid=(select locid from ip2city where $this->ip BETWEEN beginip AND endip)";
        $r=mysql_query($sq);
        while($row=  mysql_fetch_assoc($r))
        {
            return $row;
        }
    }
}


?>
