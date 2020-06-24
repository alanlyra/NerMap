<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

<table class="table table-bordered" id="table-arquivos" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th><?php echo $LANG['3']; ?></th>
      <th><?php echo $LANG['74']; ?></th>
      <th><?php echo $LANG['51']; ?></th>
      <th><?php echo $LANG['76']; ?></th>
      <th><?php echo $LANG['53']; ?></th>
      <th><?php echo $LANG['55']; ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th><?php echo $LANG['3']; ?></th>
      <th><?php echo $LANG['74']; ?></th>
      <th><?php echo $LANG['51']; ?></th>
      <th><?php echo $LANG['76']; ?></th>
      <th><?php echo $LANG['53']; ?></th>
      <th><?php echo $LANG['55']; ?></th>
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
                  <td>".$result->nome_arquivo."</td>
                  <td>".$result->autores."</td>
                  <td>".$result->ano_arquivo."</td>
                  <td><div style='text-align: center;'><img src='img/conf_".$result->conf_arquivo."_bw.png' title='".$LANG['76'].": ".$result->conf_arquivo." (".$LANG['88'].": 1, ".$LANG['89'].": 10)' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                  <td><div style='text-align: center;'><img src='img/".$result->status_ren.".png' title='".$result->status_ren."' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                  <td><a href='/seeroadmap.php?arquivo=".$result->id_arquivo."'><div style='text-align: center;'><img src='img/timeline6.png' title='".$LANG['91']."' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                </tr>";
              }
    }
    ?>
  </tbody>
</table>

<script>
  $(document).ready(function() {
      $('#table-arquivos').DataTable({                  
        "bDestroy": true,
          "bAutoWidth": true,  
          "bFilter": true,
          "bSort": true, 
          "aaSorting": [[0]],         
          "aoColumns": [
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
          ]   
      });
    });
</script>


