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
                  <td>".$result->conf_arquivo."</td>

                  <td><div style='text-align: center;'><img src='img/".$result->status_ren.".png' title='".$result->status_ren."' style='width: 20px; height: 20px; display: inline-block;'/></div></td>";

                  if (file_exists("uploads/pdf/".$result->id_arquivo.".pdf")) 
                    echo "<td><a href='uploads/pdf/".$result->id_arquivo.".pdf' download><div style='text-align: center;'><img src='img/pdf_download3.png' title='Baixar arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>";
                  else
                    echo "<td><a href='uploads/".$result->id_arquivo.".txt' download><div style='text-align: center;'><img src='img/txt_download2.png' title='Baixar arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>";



                  echo "<td><a href='/seeroadmap.php?arquivo=".$result->id_arquivo."'><div style='text-align: center;'><img src='img/timeline6.png' title='Gerar roadmap do arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>

                  <td>
                  <form action='prospeccoes.php?roadmap=".$id_prospec."&arquivo=".$result->id_arquivo."' method='post' multipart='' enctype='multipart/form-data' style='text-align: center;'>
                  <button style='border: 0; background: transparent' type='submit' name='deleteArquivo' value=''> <img src='/img/deletar2.png' title='Remover arquivo' width='20px' height='20px'/></button >
                  </form>
                  </td>
                </tr>";
              }
    }
    ?>
  </tbody>
</table>

<script>
  $(document).ready(function() {
      $('#table-arquivos').DataTable();
  });
</script>


