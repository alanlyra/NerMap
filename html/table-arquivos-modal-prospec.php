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
      <th>Arquivo</th>
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
      <th>Arquivo</th>
      <th>Roadmap</th>
      <th>Ações</th>
    </tr>
  </tfoot>
  <tbody>
  <?php 
      $id_arquivo = $_POST["identificador"];
      $search_popup=get_data("SELECT * FROM arquivos WHERE id_prospec_arquivo =". $id_arquivo . "order by id_arquivo");

      $number1 = get_data("SELECT id_prospec_arquivo FROM arquivos WHERE id_arquivo =".intval($id_arquivo));
      $row = pg_fetch_array($number1);        
      $id_prospec = $row[0]; 

      $results_max_popup = pg_num_rows($search_popup);

      if  ($results_max_popup>0) {
      while($result=pg_fetch_object($search_popup)) {
          echo "<tr>
                  <td>".$result->id_arquivo."</td>
                  <td>".$result->nome_arquivo."</td>
                  <td>".$result->ano_prospec."</td>
                  <td>".$result->conf_arquivo."</td>

                  <td><div style='text-align: center;'><img src='img/".$result->status_ren.".png' style='width: 20px; height: 20px; display: inline-block;'/></div></td>

                  <td><a href='/relatorios/relatorio_".$id_prospec.".txt' download><div style='text-align: center;'><img src='img/icon_doc.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>

                  <td><a href='/seeroadmap.php?arquivo=".$result->id_arquivo."'><div style='text-align: center;'><img src='img/timeline6.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>

                  <td>
                  <form action='prospeccoes.php?roadmap=".$id_prospec."&arquivo=".$result->id_arquivo."' method='post' multipart='' enctype='multipart/form-data' style='text-align: center;'>
                  <button style='border: 0; background: transparent' type='submit' name='deleteArquivo' value=''> <img src='/img/deletar2.png' width='20px' height='20px'/></button >
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

