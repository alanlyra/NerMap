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
            <h1 class="h3 mb-0 text-gray-800">Roadmaps</h1>
          </div>

          <!-- Content Row -->

          <div class="col-xl-11 col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Roadmap para a área de...</h6>
                </div>

           <div class="container" style="background: white !important; max-height: 55vh; overflow: auto;">

<!-- query: SELECT DISTINCT id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec, conf_prospec, usuario_prospec, palavra, ordem, tag FROM prospec p, texto t, ren r WHERE t.id_texto = p.id_prospec AND r.id_ren = t.id_texto and t.ordem = r.ordem_texto and id_prospec = 1 AND r.tag != 'O' ORDER BY ordem -->

            <ul class="timeline">
              <li><div class="tldate">2020</div></li>

              <?php 
                      $search_results=get_data('SELECT * FROM prospec p INNER JOIN texto t ON t.id_texto = p.id_prospec INNER JOIN ren r ON r.id_ren = t.id_texto AND r.ordem_texto = t.ordem WHERE id_prospec = 1');

                      $results_max = pg_num_rows($search_results);

                        if  ($results_max>0) {
                        //Processo para coletar os acontecimentos do Roadmap
                        $side_left = true;
                        $prospec = array(
                            date => "",
                            info => "",
                        );
                        $already_info = false;
                        $already_date = false;
                        while($result=pg_fetch_object($search_results)) {
                          

                          $tag = $result->tag;

                          if($tag != "O" && $tag != "" && $tag != null) {

                          if($tag == "UDATEPRED") {
                            $prospec[date] = $result->palavra;
                            $already_date = true;
                          }

                          if($tag == "BPRED" || $tag == "MPRED" || $tag == "EPRED" || $tag == "UPRED") {
                            $prospec[info] .= $result->palavra . " ";
                          }

                          if($tag == "EPRED" || $tag == "UPRED")
                              $already_info = true;

                          if($already_date && $already_info) {
                            if($side_left)
                            echo "<li>";
                            else
                            echo "<li class='timeline-inverted'>";
                            echo "<div class='tl-circ'></div>
                                    <div class='timeline-panel'>
                                      <div class='tl-heading'>
                                        <h4>".$result->assunto_prospec."</h4>
                                        <p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>".$prospec[date]."</small></p>
                                      </div>
                                      <div class='tl-body'>
                                        <p>".$prospec[info]."</p>
                                      </div>
                                    </div>
                                  </li>";
                            $side_left = !$side_left;
                            $already_info = false;
                            $already_date = false;
                            $prospec[date] = "";
                            $prospec[info] = "";
                          }
                          }
                        }
                      }
                    ?>          
              <li>
                <div class="tl-circ"></div>
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>Surprising Headline Right Here</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3 hours ago</small></p>
                  </div>
                  <div class="tl-body">
                    <p>Lorem Ipsum and such.</p>
                  </div>
                </div>
              </li>
              
              <li class="timeline-inverted">
                <div class="tl-circ"></div>
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>Breaking into Spring!</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 4/07/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>Hope the weather gets a bit nicer...</p>
                      
                    <p>Y'know, with more sunlight.</p>
                  </div>
                </div>
              </li>
              
              <li><div class="tldate">2025</div></li>
              
              <li>
                <div class="tl-circ"></div>
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>New Apple Device Release Date</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3/22/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>In memory of Steve Jobs.</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>No icon here</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3/16/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>Here you'll find some beautiful photography for your viewing pleasure, courtesy of <a href="http://lorempixel.com/">lorempixel</a>.</p>
                    
                    <p><img src="http://lorempixel.com/600/300/nightlife/" alt="lorem pixel"></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="tl-circ"></div>
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>Some Important Date!</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3/03/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>Write up a quick summary of the event.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-panel noarrow">
                  <div class="tl-heading">
                    <h4>Secondary Timeline Box</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3/01/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>This might be a follow-up post with related info. Maybe we include some extra links, tweets, user comments, photos, etc.</p>
                  </div>
                </div>
              </li>
              
              <li><div class="tldate">2030</div></li>
              
              <li class="timeline-inverted">
                <div class="tl-circ"></div>
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>The Winter Months</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 02/23/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>Gee time really flies when you're having fun.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="tl-circ"></div>
                <div class="timeline-panel">
                  <div class="tl-heading">
                    <h4>Yeah we're pretty much done here</h4>
                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 02/11/2014</small></p>
                  </div>
                  <div class="tl-body">
                    <p>Wasn't this fun though?</p>
                  </div>
                </div>
              </li>
            </ul>
        </div>
        <input type="text" id="foo" name="foo" class="form-control bg-light border-0 small" placeholder="" aria-label="Search" aria-describedby="basic-addon2">
        <!-- /.container-fluid -->

      </div>
      </div>
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
      document.getElementById("li_seerodmaps").classList.add('active');
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
		    db_prospec($id_prospec, $nome, $tema, $ano, $num_textos, "PROCESSANDO");
		    //popen("java -mx600m -cp '*:lib\*' edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier classifiers/own-ner-model.ser.gz -textFile uploads/" . $id_prospec . ".txt > roadmaps/". $id_prospec . "-tagged.txt", "r");
		    popen("bash /home/alan/NerMap/html/process_input.sh " . $id_prospec, "r");
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
        $save_on_prospec = set_data("INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec) VALUES ($1, $2, $3, $4, $5, $6)", array($id_prospec_db, $nome_db, $tema_db, $ano_db, $num_textos_db, $status_ren_db));
    }
?>