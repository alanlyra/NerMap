<?php
require_once 'system.php';
saveCurrentURL();
?>

 <html>
 <?php include_once("head.php") ?>
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
 <body style="width: 98%">

<video autoplay muted loop id="videoBackground">
  <source src="img/mar_loop.mp4" type="video/mp4">
</video>

   <?php
   // Se o usuario possui sessao
   if (isset($_SESSION['email'])  && $_SESSION['email']!='') {
      header("Location: "."/roadmap.php");
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
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
              
              <div class="w3-display-middle">
                <h1 class="w3-jumbo w3-animate-top" style="color: white;">NERMAP</h1>
                <hr class="w3-border-grey" style="margin:auto;width:60%;color: white;">
                <p class="w3-large w3-center" style="margin-top:5px;color: white;">Coppe UFRJ</p>
              </div>
              
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Entrar no sistema</h1>
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
                <input type="text" id="username" name="email" class="form-control bg-light border-0" style="width:250px;">
              </td>
            </tr>
            <tr>
              <td align="right">Senha:</td>
              <td align="left">
                <input type="password" id="password" name="password" class="form-control bg-light border-0" style="width:250px;">
              </td>
            </tr>
            <tr>
              <td height="70px" valign="middle" align="center" colspan=2>
                <input type="hidden" name="afterLoginGoTo"  value="<?php   echo $_SESSION['afterLoginGoTo'];?>">
                <input class="btn btn-primary" type="submit" value="Entrar">
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
