<?php
require_once 'system.php';
saveCurrentURL();
?>

  <?php 

    echo "<div class='modal-content'>
           
            <div class='modal-body' style='padding:0;'>
              <button type='button' class='close' data-dismiss='modal' style='margin-top: 8px; margin-right: 8px;'>&times;</button>
              <div class='row justify-content-center'>
                <div class='col-xl-6 col-lg-6 bg-login-image'>
                  <div class='w3-display-middle'>
                  <h1 class='w3-jumbo w3-animate-top' style='color: white;'>NERMAP</h1>
                  <hr class='w3-border-grey' style='margin:auto;width:60%;color: white;'>
                  <p class='w3-large w3-center' style='margin-top:5px;color: white;'>Coppe UFRJ</p>
                </div>
              </div>
              <div class='col-xl-6 col-lg-6' style='min-height:742px;'>
                <form onSubmit='return validateSubmit()' action='index.php?' method='post' multipart='' enctype='multipart/form-data' style='text-align:center; min-height: 704px; margin-left: 40px;'>        
                  <div class='avatar-upload' style='height: 100px; margin: 0; margin-bottom: 120px; display: inline-block; margin-top: 1.5rem;'>
                    <div class='avatar-edit'>
                        <input type='file' id='imageUpload'  name='imageUpload' accept='.png, .jpg, .jpeg' />
                        <input type='text' id='imageUploadURL' name='imageUploadURL' value='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAMAAABOo35HAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFNzg0MTZGRTE3M0UxMUUzOTYyOEE4QkM2OUVGODdCNyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFNzg0MTZGRjE3M0UxMUUzOTYyOEE4QkM2OUVGODdCNyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkU3ODQxNkZDMTczRTExRTM5NjI4QThCQzY5RUY4N0I3IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkU3ODQxNkZEMTczRTExRTM5NjI4QThCQzY5RUY4N0I3Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+b5NvTwAAADNQTFRF3t7e6urq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' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' style='display:none;'>
                        <label for='imageUpload'><img src='img/editar7.png' alt='Editar Foto' height='15px' width='15px' style='margin-top:9px; opacity: 70%;'></label>
                    </div>
                    <div class='avatar-preview'>
                        <div id='imagePreview' style='background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAMAAABOo35HAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFNzg0MTZGRTE3M0UxMUUzOTYyOEE4QkM2OUVGODdCNyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFNzg0MTZGRjE3M0UxMUUzOTYyOEE4QkM2OUVGODdCNyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkU3ODQxNkZDMTczRTExRTM5NjI4QThCQzY5RUY4N0I3IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkU3ODQxNkZEMTczRTExRTM5NjI4QThCQzY5RUY4N0I3Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+b5NvTwAAADNQTFRF3t7e6urq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);'>
                        </div>
                    </div>
                  </div>
                  <div class='row justify-content-center' style='margin-bottom: -20px;'>
                    <div class='col-xl-10 col-lg-10 feature-box' style='float: left; margin: 0 1rem 2rem 0; text-align: left;'>
                      <div class='col-xl-12 col-lg-12' style='margin-bottom: 2vh;'>
                        <h5>Nome completo:</h5>
                        <input type='text' id='nomeUsuario' name='nomeUsuario' value='' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>
                      </div>
                      <div class='col-xl-12 col-lg-12' style='margin-bottom: 2vh;'>
                        <h5>Email:</h5>
                          <input type='text' id='emailUsuario' name='emailUsuario' class='form-control bg-light border-0 small' value='' aria-label='Search' aria-describedby='basic-addon2' required>
                          <p id='mensagemEmailJaCadastrado' style='font-style: italic; color: red; font-size: small; display:none; margin: 0;'> * Email já cadastrado!</p>
                      </div>
                      <div class='col-xl-12 col-lg-12' style='margin-bottom: 2vh;'>
                        <h5>Senha:</h5>
                        <input type='password' id='senhaUsuario' name='senhaUsuario' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>                   
                      </div>
                      <div class='col-xl-12 col-lg-12'>
                        <h5>Corfirmar senha:</h5>
                        <input type='password' id='confirmaSenhaUsuario' name='confirmaSenhaUsuario' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>
                        <p id='mensagemSenhaNaoIgual' style='font-style: italic; color: red; font-size: small; display:none; margin: 0;'> * As senhas não coincidem!</p>
                      </div>
                    </div>                    
                  </div>
                  <div class='py-3' style='text-align: center;'>
                    <input class='btn btn-primary btn-icon-split' type='submit' name='salvarCadastroUsuario' value='Finalizar cadastro' style='width: 12em; height: 2em; display: inline-block;' />
                    </br>
                  </div>
                </form>
              </div>
            </div>
            
          </div>";

  ?>

  <!-- Confirma Remoção do TRM Modal-->
  <div class="modal fade" id="modalConfirmarDeleteProspec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="delete-trm" class="modal-dialog" role="document">
      
    </div>
  </div>

  <script>

    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imagePreview').css('background-image', 'url('+e.target.result +')');
              $('#imagePreview').hide();
              $('#imagePreview').fadeIn(650);
              document.getElementById("imageUploadURL").value = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imageUpload").change(function() {
        readURL(this);
    });

    var typingTimerConfirmaSenhaUsuario;             
    var typingTimerEmailUsuario;
    var doneTypingInterval = 300; 
    var $inputConfirmaSenhaUsuario = $('#confirmaSenhaUsuario');
    var $inputEmailUsuario = $('#emailUsuario');

    $inputConfirmaSenhaUsuario.on('keyup', function () {
      clearTimeout(typingTimerConfirmaSenhaUsuario);
      typingTimerConfirmaSenhaUsuario = setTimeout(doneTypingConfirmaSenhaUsuario, doneTypingInterval);
    });

    $inputConfirmaSenhaUsuario.on('keydown', function () {
      clearTimeout(typingTimerConfirmaSenhaUsuario);
    });

    function doneTypingConfirmaSenhaUsuario () {
      if(!validatePassword())
        document.getElementById('mensagemSenhaNaoIgual').style.display = 'block';
      else
        document.getElementById('mensagemSenhaNaoIgual').style.display = 'none';
    }

    function validatePassword() {
      return document.getElementById("senhaUsuario").value==document.getElementById("confirmaSenhaUsuario").value;
    }

    $inputEmailUsuario.on('keyup', function () {
      clearTimeout(typingTimerEmailUsuario);
      typingTimerEmailUsuario = setTimeout(doneTypingEmailUsuario, doneTypingInterval);
    });

    $inputEmailUsuario.on('keydown', function () {
      clearTimeout(typingTimerEmailUsuario);
    });

    function doneTypingEmailUsuario () {
      var email = document.getElementById("emailUsuario").value;
      $.ajax({
          type: "POST",
          url: "validate-cadastro.php",
          data: "emailvalidate="+email,
          success: function(html){
              //in case of success
              if(html > 0) {
                document.getElementById('mensagemEmailJaCadastrado').style.display = 'none';
              }
              //in case of error
              else {
                document.getElementById('mensagemEmailJaCadastrado').style.display = 'block';
              }
          }
      });
    }
      
    
    function validateSubmit() {
      if(validatePassword())
        if(document.getElementById('mensagemEmailJaCadastrado').style.display === 'none')
          return true;
        else 
          return false;
      else
        return false;
    }

  </script>

  

 






