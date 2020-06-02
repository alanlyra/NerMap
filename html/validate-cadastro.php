
<?php
  require_once 'system.php';

  $email = $_POST['emailvalidate'];

  $search_user=get_data("SELECT * FROM users WHERE email = '".$email."'");
  $results_max = pg_num_rows($search_user);
  if ($results_max == 0)
    echo 1;
  else
    echo 0;

?>
