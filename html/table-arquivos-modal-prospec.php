<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

<table class="table table-bordered" id="table-arquivos" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Ano</th>
      <th>Confiabilidade</th>
      <th>Status</th>
      <th>Download</th>
      <th>Roadmap</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Ano</th>
      <th>Confiabilidade</th>
      <th>Status</th>
      <th>Download</th>
      <th>Roadmap</th>
      <th>Ações</th>
    </tr>
  </tfoot>
  <tbody>
  <?php 
      $id_prospec = $_POST["identificador"];
      $search_popup=get_data("SELECT * FROM arquivos WHERE id_prospec_arquivo =". $id_prospec . "order by id_arquivo");   

      $results_max_popup = pg_num_rows($search_popup);

      if  ($results_max_popup>0) {
      while($result=pg_fetch_object($search_popup)) {
          echo "<tr>
                  <td>".$result->id_arquivo."</td>
                  <td>".$result->nome_arquivo."</td>
                  <td>".$result->ano_arquivo."</td>

                  <td><div style='text-align: center;'><img src='img/conf_".$result->conf_arquivo."_bw.png' title='Confiabilidade: ".$result->conf_arquivo." (Min: 1, Máx: 10)' style='width: 20px; height: 20px; display: inline-block;'/></div></td>

                  <td><div style='text-align: center;'><img src='img/".$result->status_ren.".png' title='".$result->status_ren."' style='width: 20px; height: 20px; display: inline-block;'/></div></td>";

                  if (file_exists("uploads/pdf/".$result->id_arquivo.".pdf")) 
                    echo "<td><a href='uploads/pdf/".$result->id_arquivo.".pdf' download><div style='text-align: center;'><img src='img/pdf_download3.png' title='Baixar arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>";
                  else
                    echo "<td><a href='uploads/".$result->id_arquivo.".txt' download><div style='text-align: center;'><img src='img/txt_download2.png' title='Baixar arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>";



                  echo "<td><a href='/seeroadmap.php?arquivo=".$result->id_arquivo."'><div style='text-align: center;'><img src='img/timeline6.png' title='Gerar roadmap do arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                  <td style='text-align: center;'>
                  <a href='#' data-target='#modalEditarArquivo' data-toggle='modal' data-id='editararquivo-".$result->id_arquivo."' data-nomearquivo='".$result->nome_arquivo."' data-anoarquivo='".$result->ano_arquivo."' data-confarquivo='".$result->conf_arquivo."'><div style='text-align: center;'><img src='img/editar7.png' title='Editar informações do arquivo' style='width: 18px; height: 18px; display: inline-block; opacity: 70%;'/></a>
                  <form action='prospeccoes.php?roadmap=".$id_prospec."&arquivo=".$result->id_arquivo."' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
                  <button style='border: 0; background: transparent' type='submit' name='deleteArquivo' value=''> <img src='/img/deletar2.png' title='Remover arquivo' width='20px' height='20px'/></button >
                  </form>
                  </td>
                
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

          var data_txt =  data_id.toString();
          var data_id_editarArquivo = data_txt.replace('editararquivo-','');
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
        })
    });
</script>


