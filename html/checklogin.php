<?php
require_once 'system.php';

if (!isset($_SESSION) || !isset($_SESSION['email']) || ((isset($_SESSION['email']) && !($_SESSION['email']!='')))) {
 $_SESSION['message']='Sessão expirada! Faça login novamente.';
?>
<html>
<head>

  <script>

  if (window.opener) {
    window.opener.document.reload();
    window.close();
  }
  else {
    window.location.href='/index.php';
  }

  </script>
</head>

</html>

<?php
}
?>
