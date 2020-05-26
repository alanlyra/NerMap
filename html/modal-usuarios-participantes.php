<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th></th>
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
     
      $search_popup=get_data("SELECT * FROM users u INNER JOIN grupos g on u.id_user = g.id_user_grupos WHERE g.id_prospec_grupos = ".$id_prospec);   

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

                      if($result2->accepted == "t") {
                        if($result2->id_user_convite == null)
                          echo "<div style='text-align: center;'>
                                  <button style='border: 0; background: transparent; display: inline-block;' value=''> <img src='/img/manager2.png' title='Dono do TRM' width='20px' height='20px' style='opacity:60%;' /></button >
                                </div>";
                        else if($result2->id_user == $_SESSION["id"])
                          echo "<div style='text-align: center;'>
                                  <button style='border: 0; background: transparent; display: inline-block;' value=''> <img src='/img/user9.png' title='Você' width='20px' height='20px' style='opacity:60%;' /></button >
                                </div>";
                        else
                          echo "<div style='text-align: center;'>
                                  <button style='border: 0; background: transparent; display: inline-block;' value=''> <img src='/img/shared5.png' title='Compartilhado com ".$result2->name_user."' width='20px' height='20px' style='opacity:60%;' /></button >
                                </div>";
                      }
                        
                      else
                      echo "<div style='text-align: center;'>
                              <button style='border: 0; background: transparent; display: inline-block;' value=''> <img src='/img/wait.png' title='Aguardando ".$result2->name_user." aceitar o convite' width='20px' height='20px' style='opacity:60%;' /></button >
                            </div>";
                                   
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


