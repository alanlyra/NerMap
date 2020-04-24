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
            <h1 class="h3 mb-0 text-gray-800">Geração de Roadmaps</h1>
          </div>

          <!-- Content Row -->

              <?php 

                if(isset($_GET["arquivo"]) || isset($_GET["roadmap-completo"])) {
               

                          if(isset($_GET["arquivo"])) {
                            $id_arquivo = $_GET["arquivo"];
                            $number1 = get_data("SELECT id_prospec_arquivo FROM arquivos WHERE id_arquivo =".intval($id_arquivo));
                            $row = pg_fetch_array($number1);        
                            $id_roadmap = $row[0]; 
                          }
                          if(isset($_GET["roadmap-completo"])) {  
                            $id_roadmap = $_GET["roadmap-completo"];
                            $id_busca = $id_roadmap;
                            $key = "a.id_prospec_arquivo";
                            $key_roadmap_table = "id_roadmap";
                            $tipoCabecalho = "roadmap-completo";
                          }
                          else {
                            $id_busca = $id_arquivo;
                            $key = "a.id_arquivo";
                            $key_roadmap_table = "id_arquivo_unico";
                            $tipoCabecalho = "arquivo";
                          }

	                      	$side_left = true;
	                        $section = array(
	                            date => "",
	                            temppred => "",
	                            info => "",
                              info_original => "",
	                            assunto => "",
	                            section => "",
	                            id_section => "",
	                            ordem => "",
	                            id_arquivo => "",
	                            id_roadmap => "",
	                            arquivo_origem => "",
                              nome_arquivo => "",
                              ano_arquivo => "",
	                            is_prospec => false,
	                            has_date => false,
	                            has_temppred => false,
	                        );
	                        $assunto_roadmap = "";
	                        $array_sections = [];
	                        $i = 0;
	                        $i_section = 0;

                          if($tipoCabecalho != "arquivo") {
                            $ids_arquivos = get_data("SELECT id_arquivo FROM arquivos WHERE id_prospec_arquivo = $1", array($id_roadmap));
                            $query1 = "IS NULL";
                            $query2 = "r.arquivo_origem";

                          }
                          else{
                            $ids_arquivos = get_data("SELECT id_arquivo FROM arquivos WHERE id_prospec_arquivo = $1 AND id_arquivo = $2", array($id_roadmap, $id_arquivo));
                            $query1 = "= ".$id_arquivo;
                            $query2 = "r.id_arquivo_unico";
                          }

                          $results_max_ids_arquivos = pg_num_rows($ids_arquivos);

                         /* $id_roadmap_table = get_max_id_roadmap();
                          if($id_roadmap_table == null)
                          	$id_roadmap_table = 1;*/

                          if ($results_max_ids_arquivos>0) {

                            while($result=pg_fetch_object($ids_arquivos)) {
                              //echo "<script>console.log(".$result->id_arquivo.");</script>";
                             
                              $search_roadmap1=get_data('SELECT * FROM roadmap WHERE arquivo_origem = ' . $result->id_arquivo . ' AND id_arquivo_unico = '. $result->id_arquivo);
                              $results_max = pg_num_rows($search_roadmap1);

                              if ($results_max == 0) {

                              	

                                $search_results=get_data('SELECT * FROM arquivos a INNER JOIN texto t ON t.id_texto = a.id_arquivo INNER JOIN ren r ON r.id_ren = t.id_texto INNER JOIN prospec p ON p.id_prospec = a.id_prospec_arquivo AND r.ordem_texto = t.ordem WHERE a.id_arquivo = '.$result->id_arquivo.' order by a.id_arquivo, r.ordem_texto');

                                  $results_max = pg_num_rows($search_results);
                                    if  ($results_max>0) {
                                    //Processo para coletar os acontecimentos do Roadmap
                                    
                                    while($result2=pg_fetch_object($search_results)) {

                                      //echo "<script>console.log('Debug Objects: " . $result->palavra . "' );</script>";

                                      $palavra = $result2->palavra;
                                      $palavra = str_replace(array("\r", "\n"), '', $palavra);
                                      $palavra = str_replace(array("'"), '\\\'', $palavra);
                                      $palavra = str_replace(array('"'), '\\\"', $palavra);

                                      if($palavra == "." || $palavra == "," || $palavra == ":")
                                        $section[info] = rtrim($section[info], " ");

                                      $section[info] .= $palavra . " ";               

                                      if($palavra == ".") {
                                      	$section[info] = str_replace(" % ", "% ", $section[info]);
                                        $section[id_arquivo] = $result2->id_arquivo;
                                        $section[arquivo_origem] = $result2->id_arquivo;
                                        $section[id_roadmap] = $id_roadmap;
                                        $section[assunto] = $result2->assunto_prospec;
                                        $section[nome_arquivo] = $result2->nome_arquivo;
                                        $section[ano_arquivo] = $result2->ano_arquivo;
                                        $section[info_original] = $section[info];
                                        $array_sections[$i_section] = $section;
                                        $assunto_roadmap = $result2->assunto_prospec;

                                        $section[date] = "";
                                        $section[info] = "";
                                        $section[has_date] = false;
                                        $section[has_temppred] = false;
                                        $section[is_prospec] = false;
                                        $i_section++;
                                      }

                                      $tag = $result2->tag;

                                      if($tag != "O" && $tag != "" && $tag != null) {

                                        if($tag == "DATE") {
                                          if($palavra != "today" && $palavra != "now") {
                                            $section[date] = $result2->palavra;
                                            $section[has_date] = true;
                                          }
                                        }
                                        if($tag == "U_TEMPPRED" || $tag == "B_TEMPPRED" || $tag == "M_TEMPPRED" || $tag == "E_TEMPPRED") {
                                          if($palavra != "today") {
                                            $section[temppred] = $result2->palavra;
                                            $section[has_temppred] = true;
                                          }
                                        }

                                        if($section[has_date] && $section[has_temppred]) {
                                          $section[is_prospec] = true;
                                        }
                                    
                                      }
                                    }
                                  }
                                  array_multisort(array_column($array_sections, 'date'), SORT_ASC, $array_sections);
                              }
                              else {
                                 //echo "<script>console.log(".$result->id_arquivo.");</script>";
                                 $search_roadmap2=get_data('SELECT * FROM roadmap r INNER JOIN prospec p ON p.id_prospec = r.id_prospec_roadmap INNER JOIN arquivos a ON a.id_arquivo = r.arquivo_origem WHERE a.id_arquivo = '.$result->id_arquivo.' AND id_arquivo_unico ='.$result->id_arquivo.' AND arquivo_origem != 0 order by tempo asc');

                                 while($result3=pg_fetch_object($search_roadmap2)) {
                                  $section[is_prospec] = true;
                                  $section[date] = $result3->tempo;
                                  $section[info] = $result3->prospeccao;
                                  $section[info_original] = $result3->prospeccao_original;
                                  $section[assunto] = $result3->assunto_prospec;
                                  $section[id_arquivo] = $result3->arquivo_origem;
                                  $section[arquivo_origem] = $result3->arquivo_origem;
                                  $section[id_roadmap] = $id_roadmap;
                                  $section[nome_arquivo] = $result3->nome_arquivo;
                                  $section[ano_arquivo] = $result3->ano_arquivo;
                                  $array_sections[$i_section] = $section;
                                  $assunto_roadmap = $result3->assunto_prospec;

                                  $section[date] = "";
                                      $section[info] = "";
                                      $section[has_date] = false;
                                      $section[has_temppred] = false;
                                      $section[is_prospec] = false;
                                      $i_section++;
                                 }
                              
                              }

                            }
                          }

                          if(isset($_GET["roadmap-completo"]))
                          	$query0 = "";
                          else
                          	$query0 = " AND id_arquivo_unico = ".$id_arquivo;

					$search_roadmap3=get_data('SELECT * FROM roadmap r WHERE id_prospec_roadmap = '.$id_roadmap.' AND arquivo_origem = 0'.$query0.' order by tempo asc');
                              
                              while($result3=pg_fetch_object($search_roadmap3)) {
                                  $section[is_prospec] = true;
                                  $section[date] = $result3->tempo;
                                  $section[info] = $result3->prospeccao;
                                  $section[info_original] = $result3->prospeccao_original;
                                  $section[assunto] = $result3->assunto;
                                  $section[id_arquivo] = $result3->id_arquivo_unico;
                                  $section[arquivo_origem] = 0;
                                  $section[id_roadmap] = $id_roadmap;
                                  $section[nome_arquivo] = $result3->nome_arquivo_adicionado;
                                  $section[ano_arquivo] = $result3->ano_arquivo_adicionado;
                                  $array_sections[$i_section] = $section;

                                  $section[date] = "";
                                      $section[info] = "";
                                      $section[has_date] = false;
                                      $section[has_temppred] = false;
                                      $section[is_prospec] = false;
                                      $i_section++;
                                 }
                        $number2 = get_data("SELECT nome_prospec FROM prospec WHERE id_prospec =".intval($id_roadmap));
                        $row1 = pg_fetch_array($number2);        
                        $nome_roadmap = $row1[0]; 

                         echo "
                          <div class='col-xl-12 col-lg-12' style='height: 77vh;'>
                            <div class='card shadow mb-4' style='height: 100%;'>
                              <div id='box_roadmap' class='card-header py-3'>

                                 <a href='#' title='Baixar relatório em CSV' style='float:right;' onclick='geraRelatorio();' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'>
                                 	<i class='fas fa-download fa-sm text-white-50'></i> Gerar .CSV
                                 </a>"; 

                                /*echo "<div style='float:right; margin-right:10px; margin-right:10px;border: transparent;border-radius: 2px;border-style: solid;'>
                                    <input type='checkbox' class='custom-control-input' id='edicaoRoadmap'>
                                    <label class='custom-control-label' for='edicaoRoadmap'>Habilitar Edição</label>
                                </div>";   */

                             echo "<h5 class='m-0 font-weight-bold text-primary'>TRM ".$nome_roadmap."</h5>
                             <p style='margin: 0px 0px -8px 0px;'><small class='text-muted'><b>Área:</b> ".$assunto_roadmap."</small></p>";

                             if($tipoCabecalho == "arquivo")
                             	$id_arquivo_adicionar = $id_arquivo;
                             else
                             	$id_arquivo_adicionar = 0;

                             echo "<a href='#' data-target='#modalAdicionarRoadmap' data-toggle='modal' data-id='adicionarRoadmap-".$id_roadmap."' data-cabecalho='".$tipoCabecalho."' data-arquivo='".$id_arquivo_adicionar."' data-assunto='".$assunto_roadmap."'>
                             		<div style='text-align: center; margin-top: -3.3vh; margin-left: 88px;'>
                             			<img id='imageAddProspec' src='img/add2.png' title='Adicionar prospecção manualmente' style='width: 20px; height: 20px; display: inline-block;'/>
                             		</div>
                             		</a>
                              </div>
                              <div id='box_info_roadmap' class='card-header' style='margin: 0; padding: 0; background-color: whitesmoke; border-radius: 0px 0px 0px 40px;'>";


                              if(isset($_GET["roadmap-completo"])) {
	                            echo "<p style='margin: 0px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b>Roadmap completo do TRM</b></small></p>
	                              	<a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$id_roadmap."' style='margin: 0px 20px 0px 0px; float: right;'><div style='text-align: center;'><p style='margin: 0px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b style='color: #6a8db3;'>Filtrar por arquivos</b></small></p></a>
	                              </div></div>";
	                          }
	                          else {
	                          	echo "<p style='margin: 0px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b>Roadmap do arquivo ".$section[nome_arquivo]."</b></small></p>
	                              	<a href='seeroadmap.php?roadmap-completo=".$id_roadmap."' style='margin: 0px 20px 0px 0px; float: right;'><div style='text-align: center;'><p style='margin: 0px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b style='color: #6a8db3;'>Ver Roadmap Completo do TRM</b></small></p></a>
	                              </div></div>";
	                          }

                              echo "<div class='container' style='background: white !important; height: 100%; overflow: auto; max-width:100%;'>";

                          echo "<ul class='timeline'>";
                          //echo "<li><div class='tldate'>2020</div></li>";

                          $i_prospec = 0;
                          $array_relatorio = [];

                   	

                         
                       if(isset($_GET["roadmap-completo"]))                          
                          set_data("DELETE FROM roadmap WHERE id_prospec_roadmap = ".$id_roadmap);
                       else 
                      	  set_data("DELETE FROM roadmap WHERE id_prospec_roadmap = ".$id_roadmap." AND id_arquivo_unico =".$id_arquivo);

                          

                          //Ordena o array através da data
        				  array_multisort(array_column($array_sections, 'date'), SORT_ASC, $array_sections);

                          $previous_date = 0;

                          for ($j = 0; $j < sizeof($array_sections); $j++) {                            
                            if($array_sections[$j][is_prospec]) {  
                              $array_relatorio[$i_prospec] = $array_sections[$j];
                              if($array_sections[$j][date] > $previous_date)
                              	echo "<li><div class='tldate'>".$array_sections[$j][date]."</div></li>";

                              if($side_left)
                                echo "<li>";
                              else
                                echo "<li class='timeline-inverted'>";
                              echo "<div class='tl-circ'></div>
                                      <div class='timeline-panel'>";

				                    /*if (file_exists("uploads/pdf/".$array_sections[$j][id_arquivo].".pdf")) 
                                      	echo "<a href='/uploads/pdf/".$array_sections[$j][id_arquivo].".pdf' download><div><img src='img/pdf_download3.png' style='width: 20px; height: 20px; float:right;'/></a>";
                                      else
                                      	echo "<a href='/relatorios/relatorio_".$id_roadmap.".txt' download><div><img src='img/txt_download2.png' style='width: 20px; height: 20px; float:right;'/></a>";*/
                                      	if($array_sections[$j][arquivo_origem] != 0) {	
	                                      if (file_exists("uploads/pdf/".$array_sections[$j][id_arquivo].".pdf")) 
	                                        echo "<a href='#' data-target='#modalAbrirPDF' data-toggle='modal' data-id='abrirpdf-".$array_sections[$j][id_arquivo]."' data-original='".$array_sections[$j][info_original]."'><div><img src='img/pdf_download3.png' title='Ver no arquivo' style='width: 20px; height: 20px; float:right;'/></a>";
	                                      else
	                                        echo "<a data-target='#modalAbrirPDF' data-toggle='modal' data-id='abrirpdf-".$array_sections[$j][id_arquivo]."' data-original='".$array_sections[$j][info_original]."'><div><img src='img/txt_download2.png' title='Ver no arquivo' style='width: 20px; height: 20px; float:right; cursor: pointer;'/></a>";
	                                  }
	                                   else {
	                                   	 echo "<div><img src='img/user9.png' title='Prospecção adicionada manualmente' style='width: 20px; height: 20px; float:right; opacity: 60%;'/>";
	                                  }

	                                  //Ver no texto
                                     /* if($array_sections[$j][id_arquivo] != 0) {	
	                                      if (file_exists("uploads/pdf/".$array_sections[$j][id_arquivo].".pdf")) 
	                                        echo "<a href='#' data-target='#modalVerNoTexto' data-toggle='modal' data-id='verNoTexto-".$array_sections[$j][id_arquivo]."'><div><img src='img/add.png' title='Ver arquivo original' style='width: 20px; height: 20px; float:right;'/></a>";
	                                      else
	                                        echo "<a data-target='#modalVerNoTexto' data-toggle='modal' data-id='verNoTexto-".$array_sections[$j][id_arquivo]."'><div><img src='img/add.png' title='Ver arquivo original' style='width: 20px; height: 20px; float:right; cursor: pointer;'/></a>";
	                                  }
	                                   else {
	                                   	 echo "<div><img src='img/user9.png' title='Prospecção adicionada manualmente' style='width: 20px; height: 20px; float:right; opacity: 60%;'/>";
	                                  }
*/
                                      
                                        echo "<div class='tl-heading'>
                                          <h4>".$array_sections[$j][date]."</h4>
                                          <p><small class='text-muted'><i class='glyphicon glyphicon-time'></i><b>Fonte:</b> ".$array_sections[$j][nome_arquivo]." (".$array_sections[$j][ano_arquivo].")</small></p>
                                        </div>
                                        <div class='tl-body'>
                                          <p>".$array_sections[$j][info]."</p>
                                        </div>
                                        <div class='divBotaoEditarRoadmap' style='visibility: hidden;'>
                                        <a href='#' data-target='#modalEditarRoadmap' data-toggle='modal' data-id='editarRoadmap-".$array_sections[$j][id_arquivo]."' data-indice='".$i_prospec."' data-date='".$array_sections[$j][date]."' data-info='".$array_sections[$j][info]."' data-cabecalho='".$tipoCabecalho."' data-prospec='".$id_roadmap."' ><div><img src='img/editar7.png' title='Editar prospecção' style='width: 20px; height: 20px; float:right; opacity: 50%;'/></a>
                                        <div>
                                      </div>
                                    </li>";
                              $side_left = !$side_left;                           
                              $i_prospec++;

                              //Adiciona na tabela ROADMAP

                              $set_on_roadmap = set_data("INSERT INTO roadmap (assunto, filtro, id_arquivo_unico, id_prospec_roadmap, id_roadmap, prospeccao, tem_filtro, arquivo_origem,  ordem,  tempo, nome_arquivo_adicionado, ano_arquivo_adicionado, prospeccao_original) VALUES ('".$array_sections[$j][assunto]."', null, ".$array_sections[$j][id_arquivo].", ".$id_roadmap.", ".$array_sections[$j][id_roadmap].", '".$array_sections[$j][info]."', false,".$array_sections[$j][arquivo_origem].", ".$i_prospec.",'".$array_sections[$j][date]."','".$array_sections[$j][nome_arquivo]."','".$array_sections[$j][ano_arquivo]."', '".$array_sections[$j][info_original]."');");
                            }
                            $previous_date = $array_sections[$j][date];
                          }


                  echo "</ul>
                      </div>
                      </div>
                    </div>";
                  }
                  else if(isset($_GET["roadmap"])) {
                  	 echo "<div class='card shadow mb-4'>
                      		<div class='card-header py-3'>
                        		<h6 class='m-0 font-weight-bold text-primary'>Selecione uma opção</h6>
                      		</div>
                     	   	<div class='card-body'>
				           	</div>

				           	<div class='row justify-content-center'>
						<div class='col-sm-6 col-md-3'>
							<div class='col-md-12 feature-box'>
								<img src='img/timeline6.png' style='width: 130px; height: 100px; display: inline-block;'/>
								<h4>Completo</h4>
								<p>Gerar roadmap de todos os arquivos do TRM.</p>
								<button class='btn btn-primary' style='margin:5px;' 
                            			onclick='redirect(\"seeroadmap.php?roadmap-completo=".$_GET["roadmap"]."\");'>Gerar roadmap</button>
								

							</div>
						</div> <!-- End Col -->
						<div class='col-sm-6 col-md-3'>
								<div class='col-md-12 feature-box'>
								<img src='img/files2.png' style='width: 100px; height: 100px; display: inline-block;'/>
								<h4>Individual</h4>
								<p>Gerar roadmap individual de um arquivo do TRM.</p>
								<a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$_GET["roadmap"]."'><button class='btn btn-primary' style='margin:5px;'>Visualizar arquivos</button></a>
							</div>
						</div> <!-- End Col -->	
						
	
					</div>
				               
		                   </div>";
                  }
                  else {
                    echo "<div class='card shadow mb-4'>
                      <div class='card-header py-3'>
                        <h6 class='m-0 font-weight-bold text-primary'>Selecione uma prospecção para gerar roadmap</h6>
                      </div>
                      <div class='card-body'>
                        <div class='table-responsive'>
                          <table class='table table-bordered' id='table-prospec' width='100%' cellspacing='0'>
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th style='width: 300px'>Nome</th>
                                <th>Tema</th>
                                <th>Ano</th>
                                <th>Status</th>
                                <th>Roadmap completo</th>
                                <th>Roadmap por arquivo</th>
                              </tr>
                            </thead>
                            <tfoot>
                            	<tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tema</th>
                                <th>Ano</th>
                                <th>Status</th>
                                <th>Roadmap completo</th>
                                <th>Roadmap por arquivo</th>
                              </tr>
                            </tfoot>
                            <tbody>";

                              $search_prospec=get_data("SELECT * FROM prospec WHERE usuario_prospec = '". $_SESSION['email'] ."'order by id_prospec");

                              $results_max = pg_num_rows($search_prospec);

                              if  ($results_max>0) {
                                  while($result=pg_fetch_object($search_prospec)) {
                                    echo "<tr>
                                          <td>".$result->id_prospec."</td>
                                          <td>".$result->nome_prospec."</td>
                                          <td>".$result->assunto_prospec."</td>
                                          <td>".$result->ano_prospec."</td>
                                          <td><div style='text-align: center;'>";
                                		  if($result->status_ren_prospec != "null")
                                  		  echo "<img src='img/".$result->status_ren_prospec.".png' title='".$result->status_ren_prospec."' style='width: 20px; height: 20px; display: inline-block;'/>";
                                		  echo "</div></td>
                                			</div></td>
                                          <td><a href='/seeroadmap.php?roadmap-completo=".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' title='Gerar roadmap completo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                          <td><a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$result->id_prospec."'><div style='text-align: center;'><img src='img/ver_arquivos.png' title='Visualizar arquivos' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                        </tr>";
                                  }
                              }

                            echo "
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>";
                  }

              ?> 
         
            
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

  <!-- Modal -->
  <div id="modalArquivosRoadmap" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Arquivos do Roadmap</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>       
        </div>
        <div class="modal-body">
          <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Selecione um arquivo para gerar roadmap</h6>
            </div>
            <div class="card-body">
              <div id="table-modal" class="table-responsive">
                
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>

    </div>
  </div>

  <div id="modalAbrirPDF" class="modal fade" role="dialog">
    <div id="content-pdf" class="modal-dialog modal-xl">
      <!-- Modal content-->
      

    </div>
  </div>

  <div id="modalVerNoTexto" class="modal fade" role="dialog">
    <div id="content-ver-no-texto" class="modal-dialog modal-xl">
      <!-- Modal content-->
      

    </div>
  </div>

  <div id="modalEditarRoadmap" class="modal fade" role="dialog">
    <div id="content-campo-roadmap" class="modal-dialog">
      <!-- Modal content-->
      

    </div>
  </div>

  <div id="modalAdicionarRoadmap" class="modal fade" role="dialog">
    <div id="content-campo-adicionar-roadmap" class="modal-dialog">
      <!-- Modal content-->
      

    </div>
  </div>

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
    var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
            data_id = $(this).data('id');
          }
          if (typeof $(this).data('indice') !== 'undefined') {
            data_indice_roadmap = $(this).data('indice');
            data_indice_roadmap++;
          }
          if (typeof $(this).data('date') !== 'undefined') {
            data_date_roadmap = $(this).data('date');
          }
          if (typeof $(this).data('info') !== 'undefined') {
            data_info_roadmap = $(this).data('info');
          }
          if (typeof $(this).data('cabecalho') !== 'undefined') {
            data_cabecalho = $(this).data('cabecalho');
          }
          if (typeof $(this).data('prospec') !== 'undefined') {
            data_prospec = $(this).data('prospec');
          }
          if (typeof $(this).data('arquivo') !== 'undefined') {
            data_idArquivoRoadmap = $(this).data('arquivo');
          }
          if (typeof $(this).data('assunto') !== 'undefined') {
            data_assunto = $(this).data('assunto');
          }
          if (typeof $(this).data('original') !== 'undefined') {
            data_original = $(this).data('original');
          }
          var data_txt =  data_id.toString();
          var data_id_prospec = data_txt.replace('abrirpdf-','');
          var data_id_verNoTexto = data_txt.replace('verNoTexto-','');
          var data_id_arquivo = data_txt.replace('editarRoadmap-','');
          var data_id_roadmap = data_txt.replace('adicionarRoadmap-','');
          var data_id_modalArquivos = data_txt.replace('modalArquivosRoadmap-','');
          //console.log(data_id);
          if(data_txt.indexOf('abrirpdf-') > -1) {
            $.ajax({
              url: "abrir-pdf.php",
              method: "POST",
              data: { "identificador": data_id_prospec,
                      "original": data_original },
              success: function(html) {
                $('#content-pdf').html(html);
                $('#modalAbrirPDF').modal('show');
              }
            })
          }
          else if(data_txt.indexOf('verNoTexto-') > -1) {
            $.ajax({
              url: "ver-no-texto.php",
              method: "POST",
              data: { "identificador": data_id_verNoTexto },
              success: function(html) {
                $('#content-ver-no-texto').html(html);
                $('#modalVerNoTexto').modal('show');
              }
            })
          }
          else if(data_txt.indexOf('editarRoadmap-') > -1) {
          	 $.ajax({
              url: "modal-editar-roadmap.php",
              method: "POST",
              data: { "identificador": data_id_arquivo, 
              		  "indice": data_indice_roadmap,
              		  "date": data_date_roadmap,
              		  "info": data_info_roadmap,
              		  "cabecalho": data_cabecalho,
              		  "prospec": data_prospec },
              success: function(html) {
                $('#content-campo-roadmap').html(html);
                $('#modalEditarRoadmap').modal('show');
              }
            })
          }
          else if(data_txt.indexOf('adicionarRoadmap-') > -1) {
          	 $.ajax({
              url: "modal-adicionar-roadmap.php",
              method: "POST",
              data: { "identificador": data_id_roadmap,
              		  "cabecalho": data_cabecalho,
              		  "idArquivoRoadmap": data_idArquivoRoadmap,
              		  "assunto": data_assunto },
              success: function(html) {
                $('#content-campo-adicionar-roadmap').html(html);
                $('#modalAdicionarRoadmap').modal('show');
              }
            })
          }
          else if(data_txt.indexOf('modalArquivosRoadmap-') > -1) {
            $.ajax({
              url: "table-arquivos-modal.php",
              method: "POST",
              data: { "identificador": data_id_modalArquivos },
              success: function(html) {
                $('#table-modal').html(html);
                $('#modalArquivosRoadmap').modal('show');
              }
            })
          }
          else{
          	
          }

        })
    });  

    $('.timeline-panel').hover(function(){
	    $(this).find('.divBotaoEditarRoadmap').css("visibility", "visible");
	},
	function(){
	    $(this).find('.divBotaoEditarRoadmap').css("visibility", "hidden");
	});


    $('.divButtonAddProspec').hover(function() {
	    $(this).find("img:last").fadeToggle();
	});


    


    function load(){
      document.getElementById("li_seerodmaps").classList.add('active');
    }

    $(document).ready(function() {
      $('#table-prospec').DataTable();
    });

    function goBack() {
      window.history.back();
    }

    function redirect(url) {
      console.log(url);
      window.location.href = url;
    }


  </script>

  <script type="text/javascript">

  	function geraRelatorio() {
    	var relatorio_arrayJS = <?php echo json_encode($array_relatorio); ?>;

  		var fileTitle = 'relatorio';
  		formatArray(relatorio_arrayJS);
  		exportCSVFile(headers, itemsFormatted, fileTitle);
  	}

  	function convertToCSV(objArray) {
	    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
	    var str = '';

	    for (var i = 0; i < array.length; i++) {
	        var line = '';
	        for (var index in array[i]) {
	            if (line != '') line += ';'

	            line += array[i][index];
	        }

	        str += line + '\r\n';
	    }
	    return str;
	}

	function exportCSVFile(headers, items, fileTitle) {
	    if (headers) {
	        items.unshift(headers);
	    }

	    // Convert Object to JSON
	    var jsonObject = JSON.stringify(items);

	    var csv = this.convertToCSV(jsonObject);

	    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

	    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
	    if (navigator.msSaveBlob) { // IE 10+
	        navigator.msSaveBlob(blob, exportedFilenmae);
	    } else {
	        var link = document.createElement("a");
	        if (link.download !== undefined) { // feature detection
	            // Browsers that support HTML5 download attribute
	            var url = URL.createObjectURL(blob);
	            link.setAttribute("href", url);
	            link.setAttribute("download", exportedFilenmae);
	            link.style.visibility = 'hidden';
	            document.body.appendChild(link);
	            link.click();
	            document.body.removeChild(link);
	        }
	    }
	}

	var headers = {
	    date: 'Data'.replace(/,/g, ''), // remove commas to avoid errors
	    event: "Acontecimento"
	};

	var itemsFormatted = [];

	function formatArray(array) {
		// format the data
		array.forEach((item) => {
		    itemsFormatted.push({
		        model: item.date,
		        cases: item.info //.replace(/,/g, '') // remove commas to avoid errors,
		    });
		});
	}

 </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>
</html>

<?php
  function get_max_id_roadmap() {   
    $number1 = get_data("select MAX(id_roadmap) from roadmap");
    $row = pg_fetch_array($number1);        
    $number2 = $row[0]; 
    $number = $number2 + 1;

        return $number;
  }
?>

<?php

  if(isset($_POST["salvarEdicaoRoadmap"])) {

  	$anoProspec = $_POST['anoProspec'];
  	$infoProspec = $_POST['infoProspec'];
  	$idRoadmap = $_POST['idRoadmap'];
  	$idArquivo = $_POST['idArquivo'];
  	$indiceRoadmap = $_POST['indiceRoadmap'];
  	$cabecalhoCompleto = $_POST['cabecalhoCompleto'];
  	$keyConsulta = $_POST['keyConsulta'];

    $update_on_roadmap = set_data("UPDATE roadmap SET tempo = $1, prospeccao = $2 where id_arquivo_unico = $3 AND ordem = $4 AND id_prospec_roadmap = $5", array($anoProspec, $infoProspec, $idArquivo, $indiceRoadmap, $idRoadmap));

    echo "<script>window.location.href = 'seeroadmap.php?".$cabecalhoCompleto."';</script>";

  }

  if(isset($_POST["deletarProspeccaoRoadmap"])) {

  	$anoProspec = $_POST['anoProspec'];
  	$infoProspec = $_POST['infoProspec'];
  	$idRoadmap = $_POST['idRoadmap'];
  	$idArquivo = $_POST['idArquivo'];
  	$indiceRoadmap = $_POST['indiceRoadmap'];
  	$cabecalhoCompleto = $_POST['cabecalhoCompleto'];
  	$keyConsulta = $_POST['keyConsulta'];

    $delete_on_roadmap = set_data("DELETE FROM roadmap where ".$keyConsulta." = $1 AND ordem = $2 AND id_prospec_roadmap = $3", array($idArquivo, $indiceRoadmap, $idRoadmap));

    echo "<script>window.location.href = 'seeroadmap.php?".$cabecalhoCompleto."';</script>";

  }

  if(isset($_POST["salvarAdicionarRoadmap"])) {

  	$anoProspec = $_POST['anoProspec'];
  	$infoProspec = $_POST['infoProspec'];
  	$idRoadmap = $_POST['idRoadmap'];
  	$idArquivo = $_POST['idArquivo'];
  	$cabecalhoCompleto = $_POST['cabecalhoCompleto'];
  	$keyConsulta = $_POST['keyConsulta'];
  	$assuntoAdicionar = $_POST['assuntoAdd'];
  	$nomeArquivo = $_POST['nomeArquivoAdicionado'];
  	$anoArquivo = $_POST['anoArquivoAdicionado'];

  	if($idArquivo == 0) { //ROADMAP-COMPLETO
  		//$consulta1 = "IS NULL";
  		$query_ordem = "select MAX(ordem) from roadmap where id_prospec_roadmap = ".$idRoadmap;
  		$query_id_roadmap = "select MAX(id_roadmap) from roadmap where id_prospec_roadmap = ".$idRoadmap;
  		$id_unico = null;
  	}
  	else { //ARQUIVO
  		//$consulta1 = "= ".$idArquivo." AND arquivo_origem = ".$idArquivo;
  		$query_ordem = "select MAX(ordem) from roadmap where id_prospec_roadmap = ".$idRoadmap." and id_arquivo_unico = ".$idArquivo;
  		$query_id_roadmap = "select MAX(id_roadmap) from roadmap where id_prospec_roadmap = ".$idRoadmap." and id_arquivo_unico = ".$idArquivo;
  		$id_unico = $idArquivo;
  	}

    $number1 = get_data($query_ordem);
    $row = pg_fetch_array($number1);        
    $number2 = $row[0]; 
    $indice = $number2 + 1;

    $number3 = get_data($query_id_roadmap);
    $row2 = pg_fetch_array($number3);        
    $number4 = $row2[0]; 
    $id_roadmap_table_adicionar = $number4;

    echo "<script>console.log('".$assuntoAdicionar."');</script>";
    echo "<script>console.log(".$idArquivo.");</script>";
    echo "<script>console.log(".$idRoadmap.");</script>";
    echo "<script>console.log(".$id_roadmap_table_adicionar.");</script>";
    echo "<script>console.log('".$infoProspec."');</script>";
    echo "<script>console.log('".$anoProspec."');</script>";
    echo "<script>console.log(".$indice.");</script>";
    echo "<script>console.log('".$nomeArquivo."');</script>";
    echo "<script>console.log('".$anoArquivo."');</script>";

    $set_on_roadmap = set_data("INSERT INTO roadmap (ano_arquivo_adicionado, arquivo_origem, assunto, filtro, id_arquivo_unico, id_prospec_roadmap, id_roadmap, nome_arquivo_adicionado, ordem, prospeccao, tem_filtro, tempo, prospeccao_original) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)", array($anoArquivo, '0', $assuntoAdicionar, 'null', $idArquivo, $idRoadmap, $id_roadmap_table_adicionar, $nomeArquivo, $indice, $infoProspec, 'false', $anoProspec, $infoProspec));

    echo "<script>window.location.href = 'seeroadmap.php?".$cabecalhoCompleto."';</script>";

  }

?>