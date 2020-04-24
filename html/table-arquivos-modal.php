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
      <th>Roadmap</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Ano</th>
      <th>Confiabilidade</th>
      <th>Status</th>
      <th>Roadmap</th>
    </tr>
  </tfoot>
  <tbody>
  <?php 
      $id_arquivo = $_POST["identificador"];
      $search_popup=get_data("SELECT * FROM arquivos WHERE id_prospec_arquivo =". $id_arquivo . "order by id_arquivo");

      $results_max_popup = pg_num_rows($search_popup);

      if  ($results_max_popup>0) {
      while($result=pg_fetch_object($search_popup)) {
          echo "<tr>
                  <td>".$result->id_arquivo."</td>
                  <td>".$result->nome_arquivo."</td>
                  <td>".$result->ano_arquivo."</td>
                  <td><div style='text-align: center;'><img src='img/conf_".$result->conf_arquivo."_bw.png' title='Confiabilidade: ".$result->conf_arquivo." (Min: 1, Máx: 10)' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                  <td><div style='text-align: center;'><img src='img/".$result->status_ren.".png' title='".$result->status_ren."' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                  <td><a href='/seeroadmap.php?arquivo=".$result->id_arquivo."'><div style='text-align: center;'><img src='img/timeline6.png' title='Gerar roadmap do arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
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


