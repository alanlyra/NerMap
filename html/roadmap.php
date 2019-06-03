<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

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

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Novo Roadmap</h1>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Project Card Example -->
            <div class="col-xl-8 col-lg-9">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Inserir dados</h6>
                </div>
                </br>

                <form action="roadmap.php" method="post" multipart="" enctype="multipart/form-data">
        

                  <div class="col-xl-4 col-lg-5">
                  	<input type="file" name="files[]" multiple accept="text/*">
                    
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Carregar Relatório</a> -->
                    </br>
                  </div>
                  </br>
                  <div class="col-xl-4 col-lg-5">
                   <h5>Nome:</h5>
                    <input type="text" id="nome" name="nome" class="form-control bg-light border-0 small" placeholder="Nome do Roadmap..." aria-label="Search" aria-describedby="basic-addon2">
                  </div>
                  </br>
                  <div class="col-xl-4 col-lg-5">
  		              <h5>Tema:</h5>
                    <select class="form-control" style="cursor: pointer;">
                      <option value="" disabled selected>Selecione o tema...</option>
                      <option value="Educação">Educação</option>
                      <option value="Medicina">Medicina</option>
                      <option value="Transporte">Transporte</option>
                      <option value="Trabalho">Trabalho</option>
                    </select>
                  </div>
  		            </br>
              		<div class="col-xl-4 col-lg-5">
              		<h5>Data:</h5>
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Ano de Publicação da Prospecção..." aria-label="Search" aria-describedby="basic-addon2">
                  </div>
                  </br>
                  <input class="btn btn-primary btn-icon-split" type="submit" name="someAction" value="Iniciar" style="margin-left: 45%; width: 8em; height: 2em; margin-bottom: 15px;" />
                  </br>
                </form>
              </div>


            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">

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
      document.getElementById("li_roadmap").classList.add('active');
    }
  </script>

</body>
</html>

<?php
	echo '<pre>';
	$img = $_FILES['files'];

	if(!empty($img))
	{
	    $img_desc = reArrayFiles($img);
	    print_r($img_desc);
	    
	    foreach($img_desc as $val)
	    {
	        $newname = $val['name'];
	        move_uploaded_file($val['tmp_name'],'uploads/'.$newname);
	    }
	}

	function reArrayFiles($file)
	{
	    $file_ary = array();
	    $file_count = count($file['name']);
	    $file_key = array_keys($file);
	    
	    for($i=0;$i<$file_count;$i++)
	    {
	        foreach($file_key as $val)
	        {
	            $file_ary[$i][$val] = $file[$val][$i];
	        }
	    }
	    return $file_ary;
	}
?>