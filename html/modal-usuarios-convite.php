<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

<table class="table table-bordered" id="table-arquivos" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th style="position:unset;"></th>
      <th>Usuário</th>
      <th>Email</th>
      <th style='width: 20px;'>Compartilhar</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th></th>
      <th>Usuário</th>
      <th>Email</th>
      <th>Compartilhar</th>
    </tr>
  </tfoot>
  <tbody>
  <?php 
      $id_prospec = $_POST["identificador"];
      $id_usuario = $_POST["usuario"];
     
      $search_popup=get_data("SELECT * FROM users u WHERE u.id_user != ".$_SESSION['id']);   

      $results_max_popup = pg_num_rows($search_popup);

      if  ($results_max_popup>0) {
      while($result=pg_fetch_object($search_popup)) {


          echo "<tr>
                  <td style='text-align: center;' width='30px;'><img class='img-profile rounded-circle' src='".$result->photo."' style='width:30px; height:30px;' title='".$result->name_user."'/></td>
                  <td>".$result->name_user."</td>
                  <td>".$result->email."</td>

                  <td style='text-align: center;'>";

                  $search_popup2=get_data("SELECT * FROM users u INNER JOIN grupos g on u.id_user = g.id_user_grupos WHERE g.id_prospec_grupos = ".$id_prospec." AND u.id_user = ".$result->id_user);

                  $results_max_popup2 = pg_num_rows($search_popup2);

                  if  ($results_max_popup2 > 0) {
                    
                    $result2=pg_fetch_object($search_popup2);

                      if($result2->accepted == "t")
                        echo "<div style='text-align: center;'>
                                <button style='border: 0; background: transparent; display: inline-block;' type='submit' name='convidaUsuario' value=''> <img src='/img/shared5.png' title='".$result2->name_user." já participa do TRM' width='20px' height='20px' style='opacity:70%;' /></button >
                              </div>";
                      else
                      echo "<div style='text-align: center;'>
                              <button style='border: 0; background: transparent; display: inline-block;' type='submit' name='convidaUsuario' value=''> <img src='/img/wait.png' title='Aguardando ".$result2->name_user." aceitar o convite' width='20px' height='20px' style='opacity:60%;' /></button >
                            </div>";
                                   
                  }
                  else{
                    echo  "<form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
                            <input type='text' id='idProspec' name='idProspec' class='form-control bg-light border-0 small' value='".$id_prospec."' aria-label='Search' 
                            aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                            <input type='text' id='idUsuarioConvidado' name='idUsuarioConvidado' class='form-control bg-light border-0 small' value='".$result->id_user."' aria-label='Search' 
                            aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                            <input type='text' id='idUsuarioConvite' name='idUsuarioConvite' class='form-control bg-light border-0 small' value='".$id_usuario."' aria-label='Search' 
                            aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                            <div style='text-align: center;'>
                              <button style='border: 0; background: transparent; display: inline-block;' type='submit' name='convidaUsuario' value=''> <img src='/img/invite.png' title='Enviar convite para ".$result->name_user."' width='20px' height='20px'/></button >
                            </div>  
                          </form>";                    

                  }    
                 
                  echo "</td>   
                    </tr>";
              }
    }
    ?>
  </tbody>
</table>

<div id="modalEditarArquivo" class="modal fade" role="dialog" style="top: 1vh;">
    <div id="edicao-arquivo" class="modal-dialog">
      <!-- Modal content-->
      
    </div>
  </div>

  <!-- Confirma Remoção do arquivo Modal-->
  <div class="modal fade" id="modalConfirmarDeleteArquivo" role="dialog" style="top: 15vh;">
    <div id="delete-arquivo" class="modal-dialog" >
      
    </div>
  </div>

<script>
  $(document).ready(function() {
      $('#table-arquivos').DataTable();
  });

  var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
          	data_id = $(this).data('id');
          }      

          if (typeof $(this).data('nomearquivo') !== 'undefined') {
            data_nomearquivo = $(this).data('nomearquivo');
          }
          if (typeof $(this).data('anoarquivo') !== 'undefined') {
            data_anoarquivo = $(this).data('anoarquivo');
          }
          if (typeof $(this).data('confarquivo') !== 'undefined') {
            data_confarquivo = $(this).data('confarquivo');
          }

          if (typeof $(this).data('deletearquivo') !== 'undefined') {
            data_deletearquivo = $(this).data('deletearquivo');
          }

          var data_txt =  data_id.toString();
          var data_id_editarArquivo = data_txt.replace('editararquivo-','');
          var data_id_deleteprospec = data_txt.replace('deleteprospec-','');
          if (data_txt.indexOf('editararquivo-') > -1) {
            $.ajax({
              url: "modal-editar-arquivo.php",
              method: "POST",
              data: { "identificador": data_id_editarArquivo,
                      "nomearquivo": data_nomearquivo,
                      "anoarquivo": data_anoarquivo,
                      "confarquivo": data_confarquivo },
              success: function(html) {
                $('#edicao-arquivo').html(html);
                $('#modalEditarArquivo').modal('show');
              }
            })
          }
          else if (data_txt.indexOf('deleteprospec-') > -1) {
            $.ajax({
              url: "modal-confirma-delete-arquivo.php",
              method: "POST",
              data: { "identificador": data_id_deleteprospec,
                      "arquivo": data_deletearquivo},
              success: function(html) {
                $('#delete-arquivo').html(html);
                $('#modalConfirmarDeleteArquivo').modal('show');
              }
            })
          } 
        })
    });
</script>


