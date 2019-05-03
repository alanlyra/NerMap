<?php
session_start();

header("Content-type: text/html");
header("Expires: Mon, 1 Jan 2000 12:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");




define('PLAY_OFFSET_POSITIVE', '5.0');
define('PLAY_OFFSET_NEGATIVE', '-3.0');



/* URL RECORD FUNCTIONS */
function getAddress()
{
   $protocol = array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
   return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

}

function saveCurrentURL() {
    $_SESSION['currentURL']=getAddress();
}





/* DATA FUNCTIONS */
function get_connection(){
  return pg_connect ('host=localhost port=5432 dbname=roadmap user=alan password=e41e31d932f774da99bea67a010db9fd');
}


function get_data($sql , $param = NULL) {
  $conn = get_connection();
  $sql_name = "sql_" . uniqid();  // make a unique prepared SQL name

  if ($param!=NULL) {
    $result = pg_prepare($conn, $sql_name, $sql);
    return pg_execute($conn, $sql_name, $param);
  }
  else {
      return pg_query($conn, $sql);
  }
}

function set_data($sql , $param = NULL) {
  $conn = get_connection();
  $sql_name = "sql_" . uniqid();  // make a unique prepared SQL name

  if ($param!=NULL) {
    $result = pg_prepare($conn, $sql_name, $sql);
    return pg_execute($conn, $sql_name, $param);
  }
  else {
      return pg_query($conn, $sql);
  }
}



/* LOGIN FUNCTIONS */

// RETURN VALUES
// 0 - Invalid user / password
// 1 - Login OK
// 2 - Invalid POST data
function login($user,$password)
{
  if (!!isset($user) && !!isset($password) && !$password=="")
  {
    $md5password = md5($password);
    $function_ret=0;
    $result = get_data('SELECT * FROM users WHERE email=$1 AND password=$2', array($user, $md5password));
    if (pg_num_rows($result)>0)
    {
      $usuario=pg_fetch_object($result);
      $_SESSION['email']=$usuario->email;
      $_SESSION['name']=$usuario->name;
      $_SESSION['photo']=$usuario->photo;
      $_SESSION['admin']=($usuario->admin=='1'?true:false); //boolean convertion
      $_SESSION['message']=null;
      $function_ret=1;
    }
  }
    else
  {
    $function_ret=2;
  }
  return $function_ret;
}

function logout(){
  session_start();
  session_destroy();
  header("Location: "."/index.php");
}


function convertTime($ss){
  $ms = floor(($ss-floor($ss))*1000);
  $s = $ss%60;
  $m = floor(($ss%3600)/60);
  $h = floor(($ss%86400)/3600);
  //$d = floor(($ss%2592000)/86400);
  return str_pad($h, 2, "0", STR_PAD_LEFT).":".str_pad($m, 2, "0", STR_PAD_LEFT).":".str_pad($s, 2, "0", STR_PAD_LEFT).".".str_pad($ms, 3, "0", STR_PAD_LEFT);
}

?>
