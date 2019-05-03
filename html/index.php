<?php
require_once 'system.php';
saveCurrentURL();
?>

 <html>
 <head>
   <meta charset="UTF-8">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <title>Dissertação Mestrado </title>
  <link rel="stylesheet" type="text/css" href="/css/default.css"/>
 </head>
 <body style="background-image: url('img/futuro.jpeg')">

   <?php
   // Se o usuario possui sessao
   if (isset($_SESSION['email'])  && $_SESSION['email']!='') {
      header("Location: "."/painel.php");
   ?>
   <div id="top_bar">
         <table width=100% border=0>
           <tr>
             <td align='right' valign='top'>
               Logged as <?php echo $_SESSION['name']?> (<?php echo $_SESSION['email']?>)
               -
   <?php
     if (isset($_SESSION) && $_SESSION['admin']) {
   ?>
<!--               <a href='addmeeting.php'>Add</a>
               -
-->
<?php } ?>
               <a href='login.php?action=logout'>Logout</a>
             </td>
            </tr>
       </table>
   </div>

   <?php

  }
   ?>

    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                    <center>
   <br />
     

     <?php
     // Se o usuario possui sessao
     if (isset($_SESSION['email']) && $_SESSION['email']!='') {
     ?>

    <form action="search.php" method="GET">
      <input type="text" name="query"/>
      <input type="submit" value="Search"/>
    </form>

    <?php
    // Se o usuario nao possui sessao
    } else {
    ?>

   <form action="login.php?action=login" method="post">
    <div style="padding:5px;" >
      <center>
      <table width=200px cellpadding=5px cellspacing=5px>
        	<tr>
   	          <td align="right" width=50%>Usuário:</td>
              <td align="left" width=50%>
                <input type="text" id="username" name="email">
              </td>
            </tr>
            <tr>
              <td align="right">Senha:</td>
              <td align="left">
                <input type="password" id="password" name="password">
              </td>
            </tr>
            <tr>
              <td height="70px" valign="middle" align="center" colspan=2>
                <input type="hidden" name="afterLoginGoTo"  value="<?php   echo $_SESSION['afterLoginGoTo'];?>">
                <input type="submit" value="Entrar">
              </td>
            </tr>
          </table>


          <p>
            <font color=red>
          <?php
        //print messages (usually errors)
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
          }
          $_SESSION['message'] = '';  $_SESSION['afterLoginGoTo'] = '';
          ?>
            </font>
          </p>


        </center>
    </div>
   </form>


  <?php } ?>

</center>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  
</body>
</html>
