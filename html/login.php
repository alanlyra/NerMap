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
    $_SESSION['message']="Senha ou e-mail incorretos. Tente novamente.";
  }
}
  else
{
  $_SESSION['message']="Senha ou e-mail inválidos. Tente novamente.";
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
    $_SESSION['message']="Ação inválida. Contate o administrador do sistema.";
    header("Location: "."/index.php");
    break;
}


?>
