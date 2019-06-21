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
            <div class="col-xl-11 col-lg-10">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Inserir dados</h6>
                </div>
                </br>

                <form action="roadmap.php" method="post" multipart="" enctype="multipart/form-data">
        

                  <div class="col-xl-6 col-lg-7">
                  	<input type="file" name="files[]" multiple accept="text/*">
                    
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Carregar Relatório</a> -->
                    </br>
                  </div>
                  </br>
                  <div class="col-xl-6 col-lg-7">
                   <h5>Nome:</h5>
                    <input type="text" id="nomeRoadmap" name="nomeRoadmap" class="form-control bg-light border-0 small" placeholder="Nome do Roadmap..." aria-label="Search" aria-describedby="basic-addon2">
                  </div>
                  </br>
                  <div class="col-xl-6 col-lg-7">
  		              <h5>Tema:</h5>
                    <select type="text" id="temaRoadmap" name="temaRoadmap" class="form-control" style="cursor: pointer;">
                      <option value="" disabled selected>Selecione o tema...</option>
                      <option value="Educação">Educação</option>
                      <option value="Medicina">Medicina</option>
                      <option value="Transporte">Transporte</option>
                      <option value="Trabalho">Trabalho</option>
                    </select>
                  </div>
  		            </br>
              		<div class="col-xl-6 col-lg-7">
              		<h5>Data:</h5>
                    <input type="text" id="anoRoadmap" name="anoRoadmap" class="form-control bg-light border-0 small" placeholder="Ano de Publicação da Prospecção..." aria-label="Search" aria-describedby="basic-addon2" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                  </div>
                  </br>
                  
                  <div class="col-xl-6 col-lg-7">
                  <h5>Confiabilidade:</h5>
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option1" value="0" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_0.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_0_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option2" value="3" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_2.5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_2.5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option3" value="5" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                     <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option4" value="8" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_7.5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_7.5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                     <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option5" value="10" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_10.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_10_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                  </div>
                </div>
                <div class="card-header py-3" style="text-align: center;">
                <input class="btn btn-primary btn-icon-split" type="submit" name="someAction" value="Iniciar" style="width: 8em; height: 2em; display: inline-block;" />
                  </br>
                </div>
                </form>
              </div>


            </div>

          </div>


        </div>
        <input type="text" id="foo" name="foo" class="form-control bg-light border-0 small" placeholder="" aria-label="Search" aria-describedby="basic-addon2">
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

    function get_rate() {
    return $("input[name='rate']:checked").val();
}
  </script>

</body>
</html>


<?php
	echo '<pre>';
	$file = $_FILES['files'];
	$nome = $_POST['nomeRoadmap'];
	$tema = $_POST['temaRoadmap'];
	$ano = $_POST['anoRoadmap'];

	if(!empty($file))
	{
		if(!$nome == "" && !$tema == "" && !$ano == "") {
	    	echo "<script>console.log( 'Nome: " . $nome . "' );</script>";
	    	echo "<script>console.log( 'Tema: " . $tema . "' );</script>";
	    	echo "<script>console.log( 'Ano: " . $ano . "' );</script>";
	    	
    	    $id_prospec = get_max_id_prospec();
		    $file_desc = reArrayFiles($file);
		    print_r($file_desc);
		    $num_textos = 0;
		    
		    foreach($file_desc as $val)
		    {
		    	//$newname = date('YmdHis',time()).mt_rand().'.jpg';
		        $newname = get_max_id_prospec();
		        if($num_textos > 0) {
		        	$newname .= "_";
		        	$other_text = $num_textos + 1;
		        	$newname .= $other_text;
		        }
		        $newname .= ".txt";
		        move_uploaded_file($val['tmp_name'],'uploads/'.$newname);	
		        $num_textos++;	        
		    }
       
        //$conf_value = $_POST['rate'];
		    db_prospec($id_prospec, $nome, $tema, $ano, $num_textos, "PROCESSANDO");
		    //popen("java -mx600m -cp '*:lib\*' edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier classifiers/own-ner-model.ser.gz -textFile uploads/" . $id_prospec . ".txt > roadmaps/". $id_prospec . "-tagged.txt", "r");
		    popen("bash /home/alan/NerMap/html/process_input.sh " . $id_prospec . " " . $num_textos, "r");
		    }
		else{
			echo "<script>console.log( 'Deu ruim!' );</script>";
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

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction'])) {
		if(!$nome == "" && !$tema == "" && !$ano == "" ) {
		    	echo "<script>console.log( 'Nome: " . $nome . "' );</script>";
		    	echo "<script>console.log( 'Tema: " . $tema . "' );</script>";
		    	echo "<script>console.log( 'Ano: " . $ano . "' );</script>";
    	}
		else{
			if(empty($file)){
				echo "<script>console.log( 'Deu ruim!' );</script>";
			}
		}
	}

	function get_max_id_prospec() {   
		$number1 = get_data("select MAX(id_prospec) from prospec");
		$row = pg_fetch_array($number1);				
		$number2 = $row[0];	
		$number = $number2 + 1;

        return $number;
    }

	function db_prospec($id_prospec_db, $nome_db, $tema_db, $ano_db, $num_textos_db, $status_ren_db) {   
        $save_on_prospec = set_data("INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec, conf_prospec, usuario_prospec) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_prospec_db, $nome_db, $tema_db, $ano_db, $num_textos_db, $status_ren_db, $_POST['rate'], $_SESSION['email']));
    }
?>