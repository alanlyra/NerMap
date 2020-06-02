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

          <a href='#' data-target='#modalCadastroUsuario' data-toggle='modal' data-id='cadastrousuario' style='display: inline-block; margin-left:3px; margin-right:3px; text-decoration:none;'>Cadastre-se</a>
                          


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

      <div id="modalCadastroUsuario" class="modal fade" role="dialog">
        <div id="cadastro-usuario" class="modal-dialog modal-xl">
          <!-- Modal content-->
          
        </div>
      </div>

      <div class="modal fade" id="modalMensagemCadastroUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style='top: 13vh;'>
        <div class='modal-content'>
              <div class='modal-header'>
             
                <h5 class='modal-title' id='exampleModalLabel'>Cadastro realizado com sucesso!</h5>
                <button type='button' class='close' onclick='hideModalMensagem();'> 
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <div class='modal-body'>Faça login para acessar o sistema.
              </div>
              <div class='modal-footer'>
             
                <button class='btn btn-primary' type='button' onclick='hideModalMensagem();'>Fechar</button>
               
                </div>
         
           </div>
        </div>
      </div>

    </div>
    

</body>
</html>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
          	data_id = $(this).data('id');
          }

          var data_txt =  data_id.toString();
          
          if (data_txt.indexOf('cadastrousuario') > -1) {
            $.ajax({
              url: "modal-cadastro-usuario.php",
              method: "POST",
              success: function(html) {
                $('#cadastro-usuario').html(html);
                $('#modalCadastroUsuario').modal('show');
              }
            })
          }
          else {
            
          }
        })
    });

    function hideModalMensagem() {
      $('#modalMensagemCadastroUsuario').modal('hide');
    }
</script>

<?php
	//echo '<pre>';

  if(isset($_POST["salvarCadastroUsuario"])) {

  	$nome = $_POST['nomeUsuario'];
    $email = $_POST['emailUsuario'];
    $password = md5($_POST['senhaUsuario']);
  	$image = $_POST['imageUploadURL'];

  	if(!$nome == "" && !$email == "") {      
      $search_user=get_data("SELECT * FROM users WHERE email = '".$email."'");
      $results_max = pg_num_rows($search_user);

      if ($results_max == 0) {

        $id_user = get_max_id_user();
      
        db_user($id_user, $nome, $email, $password, $image);
      }
      else {
        //echo "<script>console.log('Email já cadastrado');</script>";
      }
  	}
  	else{
      //echo "<script> document.getElementById('messageCampos').style.display = 'block'; </script>";
  		//echo "<script>console.log( 'Deu ruim!' );</script>";
  	}

  }

  function get_max_id_user() {   
    $number1 = get_data("select MAX(id_user) from users");
    $row = pg_fetch_array($number1);        
    $number2 = $row[0]; 
    $number = $number2 + 1;

        return $number;
  }

	function db_user($id_user_db, $nome_db, $email_db, $password_db, $photo_db) {
    $create_user = set_data("INSERT INTO users (id_user, name_user, email, password, photo, admin) VALUES ($1, $2, $3, $4, $5, 'false')", array($id_user_db, $nome_db, $email_db, $password_db, $photo_db));
    //echo "<script>window.location.href = 'index.php';</script>";
    echo "<script>$('#modalMensagemCadastroUsuario').modal('show');</script>";
  }


?>

