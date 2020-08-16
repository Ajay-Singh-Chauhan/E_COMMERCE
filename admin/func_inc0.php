<?php

 function pr($array)
{
    echo "<pre>";
          print_r($array);
    echo "</pre>";
}

 function prx($array)
{
    echo "<pre>";
          print_r($array);
    echo "</pre>";

    die();
}

function prs($str){
  echo $str;
}
function prsx($str){
  echo $str;
  die();
}


function get_safe_value($con,$str)
{
  if ($str!="") {
    return mysqli_real_escape_string($con,$str);
  }

}

define('server_path',$_SERVER["DOCUMENT_ROOT"].'/E_commerce/');
define('site_path','http://localhost/E_commerce/');
define('images_site',site_path.'admin/upload');
define('images_server',server_path.'admin/upload');

 ?>
