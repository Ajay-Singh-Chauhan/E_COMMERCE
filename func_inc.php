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


function get_product($con,$latest="",$limit=0,$pro_id=0,$cat_id=0){
  $sql='select * from product ';
  $pro=[];

  if (!$pro_id==0) {
    $sql.='where pro_id='.$pro_id;
  }
  if (!$cat_id==0) {
    $sql.='where cat_name=$cat_id';
  }
  if (!$latest=='') {
    $sql.='order by pro_id desc ';
  }
  if (!$limit==0) {
    $sql.='limit '.$limit;
  }
//  prsx($sql);
  $pro_res=mysqli_query($con,$sql);
  while ($pro_row=mysqli_fetch_assoc($pro_res)) {
    $pro[]=$pro_row;
  }
  return $pro;
}


 ?>
