<?php
require_once 'system.php';
include_once dirname(__FILE__) . '/' .'admin/libs/phpass/PasswordHash.php';

function prepare_login(){
if (!!isset($_POST["email"]) && !!isset($_POST["password"]))
{

  $estado=login(trim($_POST["email"]),trim($_POST["password"]));
  if (!($estado!=1))
  {
    if ($_POST["afterLoginGoTo"]!="")
    {
      header("Location: ".$_POST["afterLoginGoTo"]);
    }
      else
    {
      echo "search";
      header("Location: "."/search.php");
    }
  }
    else
  {
    $_SESSION['message']="Incorrect e-mail or password. Try again.";
  }
}
  else
{
  $_SESSION['message']="Invalid e-mail or password. Try again.";
}
 header("Location: "."/index.php");
}





$action=$_GET["action"];
switch ($action) {
  case 'login':
      prepare_login();
    break;

    case 'logout':
      logout();
      break;

  default:
    $_SESSION['message']="Invalid action. Please contact the system administrator.";
    header("Location: "."/index.php");
    break;
}


?>
