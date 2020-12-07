<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th></th>
      <th><?php echo $LANG['38']; ?></th>
      <th><?php echo $LANG['96']; ?></th>
      <th style='width: 20px;'><?php echo $LANG['97']; ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th></th>
      <th><?php echo $LANG['38']; ?></th>
      <th><?php echo $LANG['96']; ?></th>
      <th><?php echo $LANG['97']; ?></th>
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
                  <td style='text-align: center;';><img class='img-profile rounded-circle' src='".$result->photo."' style='width:30px; height:30px;' title='".$result->name_user."'/></td>
                  <td>".$result->name_user."</td>
                  <td>".$result->email."</td>

                  <td style='text-align: center;'>";

                  $search_popup2=get_data("SELECT * FROM users u INNER JOIN grupos g on u.id_user = g.id_user_grupos WHERE g.id_prospec_grupos = ".$id_prospec." AND u.id_user = ".$result->id_user);

                  $results_max_popup2 = pg_num_rows($search_popup2);

                  if  ($results_max_popup2 > 0) {
                    
                    $result2=pg_fetch_object($search_popup2);

                      if($result2->accepted == "t")
                        echo "<div style='text-align: center;'>
                        <a href='#' data-target='#modalConfirmaRemoveUsuarioCompartilhamentoTRM' data-toggle='modal' data-id='removecompartilhamentousuario-".$id_prospec."' data-usuarioremovecompartilhamento='".$result->id_user."' style='display: inline-block;'><div style='text-align: center;'><img src='img/remove-user2.png' title='".$LANG['101']." ".$result2->name_user." ".$LANG['102']."' style='width: 24px; height: 24px; display: inline-block; opacity:60%;'/></div></a>
                              </div>";
                      else
                      echo "<div style='text-align: center;'>
                              <button style='border: 0; background: transparent; display: inline-block;' type='submit' name='convidaUsuario' value=''> <img src='/img/wait.png' title='".$LANG['99']." ".$result2->name_user." ".$LANG['100']."' width='20px' height='20px' style='opacity:60%;' /></button >
                            </div>";
                                   
                  }
                  else{
                    echo  "<form action='trms.php?' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block; margin: 0;'>
                            <input type='text' id='idProspec' name='idProspec' class='form-control bg-light border-0 small' value='".$id_prospec."' aria-label='Search' 
                            aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                            <input type='text' id='idUsuarioConvidado' name='idUsuarioConvidado' class='form-control bg-light border-0 small' value='".$result->id_user."' aria-label='Search' 
                            aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                            <input type='text' id='idUsuarioConvite' name='idUsuarioConvite' class='form-control bg-light border-0 small' value='".$id_usuario."' aria-label='Search' 
                            aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                            <div style='text-align: center;'>
                              <button style='border: 0; background: transparent; display: inline-block;' type='submit' name='convidaUsuario' value=''> <img src='/img/invite.png' title='".$LANG['98']." ".$result->name_user."' width='22px' height='22px'/></button >
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



  <!-- Confirma Remoção do usuário do compartilhamento Modal-->
  <div class="modal fade" id="modalConfirmaRemoveUsuarioCompartilhamentoTRM" role="dialog">
    <div id="comfirma-remove-compartilhamento" class="modal-dialog" style="top:16vh;">
      
    </div>
  </div>

<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({                  
      "bDestroy": true,
        "bAutoWidth": true,  
        "bFilter": true,
        "bSort": true, 
        "aaSorting": [[0]],         
        "aoColumns": [
          { "bSortable": false },
          { "bSortable": true },
          { "bSortable": true },
          { "bSortable": true }
        ]   
    });
  });

  var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
          	data_id = $(this).data('id');
          }      

          if (typeof $(this).data('usuarioremovecompartilhamento') !== 'undefined') {
            id_usuarioremovecompartilhamento = $(this).data('usuarioremovecompartilhamento');
          }
          var data_txt =  data_id.toString();
          var data_id_removecompartilhamentousuario = data_txt.replace('removecompartilhamentousuario-','');
          
          if (data_txt.indexOf('removecompartilhamentousuario-') > -1) {
            $.ajax({
              url: "modal-confirma-remover-usuario-compartilhamento.php",
              method: "POST",
              data: { "identificador": data_id_removecompartilhamentousuario,
                      "usuario": id_usuarioremovecompartilhamento},
              success: function(html) {
                $('#comfirma-remove-compartilhamento').html(html);
                $('#modalConfirmaRemoveUsuarioCompartilhamentoTRM').modal('show');
              }
            })
          } 
        })
    });

  
</script>


