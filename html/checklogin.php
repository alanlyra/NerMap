<?php
require_once 'system.php';
require_once 'lang.php';

if (!isset($_SESSION) || !isset($_SESSION['email']) || ((isset($_SESSION['email']) && !($_SESSION['email']!='')))) {
 $_SESSION['message']= 'Session expired! Please log in again.';
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
