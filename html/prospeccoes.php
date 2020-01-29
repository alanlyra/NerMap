<!DOCTYPE html>
<html lang="en">

<?php include_once("head.php") ?>

<body id="page-top" onload="load();">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once("menulateral.php") ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once("menusuperior.php") ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Prospecções Tecnológicas</h1>
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Relatórios de Prospecção</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Identificador</th>
                      <th>Nome</th>
                      <th>Tema</th>
                      <th>Ano</th>
                      <th>Nº de textos</th>
                      <th>Status</th>
                      <th>Arquivo</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Identificador</th>
                      <th>Nome</th>
                      <th>Tema</th>
                      <th>Ano</th>
                      <th>Nº de textos</th>
                      <th>Status</th>
                      <th>Arquivo</th>
                    </tr>
                  </tfoot>
                  <tbody>
              		<?php 
                  		$search_results=get_data("SELECT * FROM prospec WHERE usuario_prospec = '". $_SESSION['email'] ."'order by id_prospec");

		              	$results_max = pg_num_rows($search_results);

				    	if  ($results_max>0) {
							while($result=pg_fetch_object($search_results)) {
						    	echo "<tr>
  							    		  <td>".$result->id_prospec."</td>
  	                      <td>".$result->nome_prospec."</td>
  	                      <td>".$result->assunto_prospec."</td>
  	                      <td>".$result->ano_prospec."</td>
  	                      <td>".$result->num_textos_prospec."</td>
                          <td><div style='text-align: center;'><img src='img/".$result->status_ren_prospec.".png' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                          <td><a href='/relatorios/relatorio_".$result->id_prospec.".txt' download><div style='text-align: center;'><img src='img/icon_doc.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
	                      </tr>";
		                	}
						}
                  	?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once("footer.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clique em "Sair" para encerrar a sessão.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Voltar</button>
          <a class="btn btn-primary" href="login.php?action=logout">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function load(){
      document.getElementById("li_prospec").classList.add('active');
    }
  </script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
