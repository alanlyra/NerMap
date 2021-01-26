<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
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

         
            <h1 class="h3 mb-2 text-gray-800"><?php echo $LANG['113']; ?></h1>
        

          <!-- Content Row -->

              <?php 

                if(isset($_GET["arquivo"]) || isset($_GET["roadmap-completo"])) {

                  echo "<div id='main-content' style='height: 79.2vh;'>";
               
                  $tipoCabecalho = "";
                  $nome_arquivo = "";

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

                    $number7 = get_data("SELECT nome_arquivo FROM arquivos WHERE id_arquivo =".intval($id_arquivo));
                    $row7 = pg_fetch_array($number7);        
                    $nome_arquivo = $row7[0];
                  }                      

                  $number2 = get_data("SELECT nome_prospec FROM prospec WHERE id_prospec =".intval($id_roadmap));
                  $row1 = pg_fetch_array($number2);        
                  $nome_roadmap = $row1[0];
                  
                  $number5 = get_data("SELECT ano_prospec FROM prospec WHERE id_prospec =".intval($id_roadmap));
                  $row5 = pg_fetch_array($number5);        
                  $ano_limite_roadmap = $row5[0]; 

                  $search_grupos=get_data("SELECT * FROM grupos WHERE id_prospec_grupos = " . intval($id_roadmap) . " AND id_user_grupos = ". $_SESSION['id']. "AND accepted = 'true'");
                  $results_max_grupos = pg_num_rows($search_grupos);

                  if($results_max_grupos > 0) {

                    $side_left = true;
                    $section = array(
                        date => "",
                        temppred => "",
                        duration => "",
                        info => "",
                        info_original => "",
                        assunto => "",
                        section => "",
                        id_section => "",
                        ordem => "",
                        id_arquivo => "",
                        id_roadmap => "",
                        arquivo_origem => "",
                        autores => "",
                        confiabilidade => "",
                        nome_arquivo => "",
                        ano_arquivo => "",
                        nome_trm => $nome_roadmap,
                        ano_limite_trm => $ano_limite_roadmap,
                        is_prospec => false,
                        has_date => false,
                        has_temppred => false,
                        has_duration => false,
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
                                  $regex_reference_tipo1 = '/-LSB-\s*(.*?)\s*-RSB-/';
                                  $regex_reference_tipo2 = '/-LRB-\s*(.*?)\s*-RRB-/';
                                  $section[info] = preg_replace($regex_reference_tipo1, '', $section[info]);
                                  $section[info] = preg_replace($regex_reference_tipo2, '', $section[info]);
                                  $section[info] = str_replace(" % ", "% ", $section[info]);
                                  //$section[info] = htmlspecialchars($section[info], ENT_QUOTES, 'UTF-8');
                                  $section[id_arquivo] = $result2->id_arquivo;
                                  $section[arquivo_origem] = $result2->id_arquivo;
                                  $section[id_roadmap] = $id_roadmap;
                                  $section[assunto] = $result2->assunto_prospec;
                                  $section[nome_arquivo] = $result2->nome_arquivo;
                                  $section[ano_arquivo] = $result2->ano_arquivo;
                                  $section[autores] = $result2->autores;
                                  $section[confiabilidade] = $result2->conf_arquivo;
                                  $section[info_original] = $section[info];
                                  $array_sections[$i_section] = $section;
                                  $assunto_roadmap = $result2->assunto_prospec;

                                  $section[date] = "";
                                  $section[duration] = "";
                                  $section[info] = "";
                                  $section[has_date] = false;
                                  $section[has_temppred] = false;
                                  $section[has_duration] = false;
                                  $section[is_prospec] = false;
                                  $i_section++;
                                }

                                $tag = $result2->tag;

                                if($tag != "O" && $tag != "" && $tag != null) {

                                  if($tag == "DATE") {
                                    if($palavra != "today" && $palavra != "now" && $palavra != "right" && $palavra != "last" && $palavra != "past" && $palavra != "the" && $palavra != "future") {
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

                                  if($tag == "DURATION") {
                                    if($palavra != "today") {
                                      $section[duration] .= $result2->palavra . " ";
                                      $section[has_duration] = true;
                                    }
                                  }

                                  if($section[has_temppred]) {
                                    if($section[has_date] && preg_match('~[0-9]+~', $section[date])) {
                                      $section[is_prospec] = true;
                                    }
                                    else {
                                      if($section[has_duration]) {
                                        if(preg_match('~[0-9]+~', $section[duration])) {
                                          preg_match('/(\d+)/', $section[duration], $matches);
                                          $number_date = $result2->ano_arquivo + intval($matches[0]);
                                          
                                        }
                                        else {
                                          if(strpos($section[duration], 'one') !== false)
                                            $number_date = 1;
                                          elseif(strpos($section[duration], 'two') !== false)
                                            $number_date = 2;
                                          elseif(strpos($section[duration], 'three') !== false)
                                            $number_date = 3;
                                          elseif(strpos($section[duration], 'four') !== false)
                                            $number_date = 4;
                                          elseif(strpos($section[duration], 'five') !== false)
                                            $number_date = 5;
                                          elseif(strpos($section[duration], 'six') !== false)
                                            $number_date = 6;
                                          elseif(strpos($section[duration], 'seven') !== false)
                                            $number_date = 7;
                                          elseif(strpos($section[duration], 'eight') !== false)
                                            $number_date = 8;
                                          elseif(strpos($section[duration], 'nine') !== false)
                                            $number_date = 9;
                                          elseif(strpos($section[duration], 'ten') !== false)
                                            $number_date = 10;
                                          elseif(strpos($section[duration], 'fifty') !== false)
                                            $number_date = 50;
                                          elseif(strpos($section[duration], 'half century') !== false)
                                            $number_date = 50;
                                          elseif(strpos($section[duration], 'hundred') !== false)
                                            $number_date = 100;
                                          else {
                                            if(strpos($section[duration], 'next') !== false)
                                              $number_date = 1;
                                          }
                                        }
                                        if(strpos($section[duration], 'year') !== false || strpos($section[duration], 'years') !== false)
                                            $section[date] = $result2->ano_arquivo + $number_date;
                                        elseif(strpos($section[duration], 'decade') !== false || strpos($section[duration], 'decades') !== false)
                                            $section[date] = $result2->ano_arquivo + ($number_date * 10);
                                        
                                        $section[is_prospec] = true;
                                      }
                                      else {
                                        if(strpos($section[date], 'year') !== false) {
                                          $section[date] = $result2->ano_arquivo + 1;
                                          $section[is_prospec] = true;
                                        }
                                        if(strpos($section[date], 'decade') !== false) {
                                          $section[date] = $result2->ano_arquivo + 10;
                                          $section[is_prospec] = true;
                                        }
                                      }
                                    }
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
                            $section[autores] = $result3->autores_prospeccao;
                            $section[confiabilidade] = $result3->conf_arquivo;
                            $array_sections[$i_section] = $section;
                            $assunto_roadmap = $result3->assunto_prospec;

                            $section[date] = "";
                            $section[info] = "";
                            $section[duration] = "";
                            $section[has_date] = false;
                            $section[has_temppred] = false;
                            $section[has_duration] = false;
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
                        $section[autores] = $result3->autores_prospeccao;
                        $section[confiabilidade] = $result3->conf_prospeccao;
                        $array_sections[$i_section] = $section;

                        $section[date] = "";
                        $section[info] = "";
                        $section[duration] = "";
                        $section[has_date] = false;
                        $section[has_temppred] = false;
                        $section[has_duration] = false;
                        $section[is_prospec] = false;
                        $i_section++;
                      }

                    echo "<div class='card shadow mb-4' style='height: 100%;'>
                    <div id='box_roadmap' class='card-header py-3' style='padding-top: 0.7rem !important; padding-bottom: 0.7rem !important;'>
                    <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' style='float:right;' data-target='#modalGeraRelatorio' data-toggle='modal' data-id='gerarelatorio-".$id_roadmap."'>                         		
                      <i class='fas fa-download fa-sm text-white-50'></i> ".$LANG['130']."
                    </a>";

                      /* echo "<a href='#' title='Baixar relatório em CSV' style='float:right;' onclick='geraRelatorio();' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'>
                      <i class='fas fa-download fa-sm text-white-50'></i> Gerar .CSV
                      </a>";  */

                    /*echo "<div style='float:right; margin-right:10px; margin-right:10px;border: transparent;border-radius: 2px;border-style: solid;'>
                        <input type='checkbox' class='custom-control-input' id='edicaoRoadmap'>
                        <label class='custom-control-label' for='edicaoRoadmap'>Habilitar Edição</label>
                    </div>";   */

                    echo "<h5 class='m-0 font-weight-bold text-primary' style='float:left;'>TRM ".$nome_roadmap."</h5>";

                    //Verifica se só tem o proprio dono como participante para nao exibir
                   /*  
                    $search_users=get_data("SELECT * FROM grupos WHERE id_prospec_grupos = ".$id_roadmap." AND id_user_convite IS NOT NULL");   

                    $results_max_users = pg_num_rows($search_users);

                    if  ($results_max_users>0) */
                      echo "<a href='#' data-target='#modalUsuariosParticipantes' data-toggle='modal' data-id='participantes-".$id_roadmap."' style='display: inline-block; margin-left:10px; margin-top:2px; float:left;'><div style='text-align: center;'><img src='img/shared5.png' title='".$LANG['127']."' style='width: 18px; height: 18px; display: inline-block; opacity:70%;'/></div></a>";
                    
                    //Traduz a area
                    $assunto_multilang = "";
                    if($assunto_roadmap == "Work")
                      $assunto_multilang = $LANG['20'];
                    if($assunto_roadmap == "Education")
                      $assunto_multilang = $LANG['17'];
                    if($assunto_roadmap == "Medicine")
                      $assunto_multilang = $LANG['18'];
                    if($assunto_roadmap == "Transport")
                      $assunto_multilang = $LANG['19'];  

                    echo "</br>
                    <p style='margin: 0px 0px -8px 0px; padding-top: 5px; float:left;'><small class='text-muted'><b>".$LANG['4'].":</b> ".$assunto_multilang."</small></p>";

                    echo "<div id='dot_separator' style='margin: 0; float: left;'><p style='margin: 5px 0px 0px 10px; padding: 0; float: left;'><small class='text-muted'><b>·</b></small></p></div>";

                    echo "<p id='box_conf_media_roadmap' style='margin: 0px 0px -8px 10px; padding-top: 5px; float:left;'></p>";

                    //echo "<p id='box_conf_media_roadmap' style='margin: 0px 0px -8px 10px; padding-top: 5px; float:left;'><small class='text-muted'><b> Confiabilidade média do roadmap: </b></small><img id='conf_media_roadmap' src='img/conf_10_bw.png' title='Confiabilidade média: 10' style='width: 20px; height: 20px; margin-right:10px; margin-top: -5px; margin-left: 3px;'/></p>";


                    if($tipoCabecalho == "arquivo")
                    $id_arquivo_adicionar = $id_arquivo;
                    else
                    $id_arquivo_adicionar = 0;

                    /* echo "<div style='text-align: center; margin-top: -0.2vh;'>
                          <a href='#' data-target='#modalAdicionarRoadmap' data-toggle='modal' data-id='adicionarRoadmap-".$id_roadmap."' data-cabecalho='".$tipoCabecalho."' data-arquivo='".$id_arquivo_adicionar."' data-assunto='".$assunto_roadmap."' style='margin-left: -160px;'>
                            <img id='imageAddProspec' src='img/add2.png' title='".$LANG['129']."' style='width: 20px; height: 20px; display: inline-block;'/>
                          </a> 
                          </div> */
                    
                   echo "</div>
                   <div style='text-align: center; margin-top: -0.2vh; height:0px;'>
                    <a href='#' data-target='#modalAdicionarRoadmap' data-toggle='modal' data-id='adicionarRoadmap-".$id_roadmap."' data-cabecalho='".$tipoCabecalho."' data-arquivo='".$id_arquivo_adicionar."' data-assunto='".$assunto_roadmap."' style='display:inline-block; margin-top: -30px; margin-left: -17.5px;'>
                      <img id='imageAddProspec' src='img/add2.png' title='".$LANG['129']."' style='width: 20px; height: 20px; display: inline-block;'/>
                    </a> 
                    </div>
                    <div id='box_info_roadmap' class='card-header' style='height: 3vh; margin: 0; padding: 0; background-color: whitesmoke; border-radius: 0px 0px 0px 40px;'>";

                  
                    if(isset($_GET["roadmap-completo"])) {
                      echo "<p style='margin: 3px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b>".$LANG['131']."</b></small></p>
                          <a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$id_roadmap."' style='margin: 0px 20px 0px 0px; float: right;'><div style='text-align: center;'><p style='margin: 3px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b style='color: #6a8db3;'>".$LANG['133']."</b></small></div></p></a>
                        </div>";
                    }
                    else {
                      echo "<p style='margin: 3px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b>".$LANG['132']." ".$section[nome_arquivo]."</b></small></p>
                          <a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$id_roadmap."' style='margin: 0px 20px 0px 0px; float: right;'><div style='text-align: center;'><p style='margin: 3px 0px 0px 6px; padding: 0; float: left;'><small class='text-muted'><b style='color: #6a8db3;'>".$LANG['133']."</b></small></div></p></a>
                          <div href='' style='margin: 0; float: right;'><p style='margin: 3px 0px 0px 20px; padding: 0; float: left;'><small class='text-muted'><b style='color: #6a8db3;'>·</b></small></p></div>
                          <a href='roadmaps.php?roadmap-completo=".$id_roadmap."' style='margin: 0; float: right;'><div style='text-align: center;'><p style='margin: 3px -14px 0px 0px; padding: 0; float: left;'><small class='text-muted'><b style='color: #6a8db3;'>".$LANG['137']."</b></small></p></div></a>
                        </div>";
                    }

                    echo "<div id='container-roadmap' class='container' style='background: white url(img/fundoSistema2.png); height: 100%; overflow: auto; max-width:100%;'>";

                    echo "<ul class='timeline'>";
                    //echo "<li><div class='tldate'>2020</div></li>";

                    $i_prospec = 0;
                    $array_relatorio = [];
                    $array_relatorio_filtered = [];                      
                          
                    if(isset($_GET["roadmap-completo"]))                          
                      set_data("DELETE FROM roadmap WHERE id_prospec_roadmap = ".$id_roadmap);
                    else 
                      set_data("DELETE FROM roadmap WHERE id_prospec_roadmap = ".$id_roadmap." AND id_arquivo_unico =".$id_arquivo);
                            
                    //Ordena o array através da data
                    array_multisort(array_column($array_sections, 'date'), SORT_ASC, $array_sections);

                    $previous_date = 0;
                    $id_filtered = 0;

                    for ($j = 0; $j < sizeof($array_sections); $j++) {                            
                      if($array_sections[$j][is_prospec]) {  
                        $array_relatorio[$i_prospec] = $array_sections[$j];
                        if($array_sections[$j][date] > $array_sections[$j][ano_arquivo] && $array_sections[$j][date] <= $ano_limite_roadmap) {
                          
                          $array_relatorio_filtered[$id_filtered] = $array_sections[$j];

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
                                    echo "<a href='#' data-target='#modalAbrirPDF' data-toggle='modal' data-id='abrirpdf-".$array_sections[$j][id_arquivo]."' data-original='".$array_sections[$j][info_original]."' data-tipoarquivo='pdf'><div><img src='img/search_on_pdf1.png' title='".$LANG['135']."' style='width: 28px; height: 20px; float:right; margin-right: -9px;'/></a>";
                                  else
                                    echo "<a data-target='#modalAbrirPDF' data-toggle='modal' data-id='abrirpdf-".$array_sections[$j][id_arquivo]."' data-original='".$array_sections[$j][info_original]."' data-tipoarquivo='txt'><div><img src='img/search_on_txt1.png' title='".$LANG['135']."' style='width: 28px; height: 20px; float:right; cursor: pointer; margin-right: -9px;'/></a>";
                                }
                                else {
                                  echo "<div><img src='img/user9.png' title='".$LANG['138']."' style='width: 20px; height: 20px; float:right; opacity: 60%;'/>";
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
                                } */

                                //echo "<img src='img/conf_stars_".$array_sections[$j][confiabilidade]."_bw.png' title='".$LANG['134'].": ".$array_sections[$j][confiabilidade]."' style='height: 20px; float:right; margin-right:10px;'/>";
                                $rate = $array_sections[$j][confiabilidade] * 1000;
                                    echo "<div class='tl-heading'>
                                      <h4>".$array_sections[$j][date]."</h4>
                                      <p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>".$array_sections[$j][autores]." <b>".$array_sections[$j][nome_arquivo]."</b> (".$array_sections[$j][ano_arquivo].").</small></p>
                                    </div>
                                    <div class='tl-body'>
                                      <p>".$array_sections[$j][info]."</p>
                                    </div>
                                    <div class='divBotaoEditarRoadmap' style='visibility: hidden;'>
                                    <p><small class='text-muted' style='float:left;'>".$LANG['134'].":</small><img src='img/conf_stars_".$array_sections[$j][confiabilidade]."_bw.png' title='".$LANG[$rate]."' style='height: 13px; float:left; margin-left: 5px; margin-top: 1.3px;'/></p>
                                    <a href='#' data-target='#modalEditarRoadmap' data-toggle='modal' data-id='editarRoadmap-".$array_sections[$j][id_arquivo]."' data-indice='".$i_prospec."' data-date='".$array_sections[$j][date]."' data-info='".$array_sections[$j][info]."' data-cabecalho='".$tipoCabecalho."' data-prospec='".$id_roadmap."' ><div><img src='img/editar7.png' title='".$LANG['136']."' style='width: 20px; height: 20px; float:right; opacity: 50%;'/></a>
                                    <div>
                                  </div>
                                </li>";
                          $side_left = !$side_left;
                          $id_filtered++;
                        }                           
                        $i_prospec++;

                        //Adiciona na tabela ROADMAP

                        $set_on_roadmap = set_data("INSERT INTO roadmap (assunto, filtro, id_arquivo_unico, id_prospec_roadmap, id_roadmap, prospeccao, tem_filtro, arquivo_origem,  ordem,  tempo, nome_arquivo_adicionado, ano_arquivo_adicionado, prospeccao_original, autores_prospeccao, conf_prospeccao) VALUES ('".$array_sections[$j][assunto]."', null, ".$array_sections[$j][id_arquivo].", ".$id_roadmap.", ".$array_sections[$j][id_roadmap].", '".$array_sections[$j][info]."', false,".$array_sections[$j][arquivo_origem].", ".$i_prospec.",'".$array_sections[$j][date]."','".$array_sections[$j][nome_arquivo]."','".$array_sections[$j][ano_arquivo]."', '".$array_sections[$j][info_original]."', '".$array_sections[$j][autores]."', ".$array_sections[$j][confiabilidade].");");
                      }
                      $previous_date = $array_sections[$j][date];
                    }

                    echo "<script>console.log(".json_encode($array_relatorio_filtered).");</script>"; 
                    if(sizeof($array_relatorio_filtered) <= 0) {
                      if(isset($_GET["roadmap-completo"]))
                        echo "<script>document.getElementById('container-roadmap').innerHTML = '<div class=\'container4\'><p class=\'text-muted\'> Sem prospecções para este TRM </p></div>';</script>";  
                      else 
                        echo "<script>document.getElementById('container-roadmap').innerHTML = '<div class=\'container4\'><p class=\'text-muted\'> Sem prospecções para este arquivo do TRM </p></div>';</script>";  
                    }
                    
                    // Adiciona ou atualiza a API referente ao TRM (completo)
                    if(isset($_GET["roadmap-completo"])) {
                      $delete_on_api = set_data("DELETE FROM api WHERE id_prospec_api = $1", array($id_roadmap));
                      $set_on_api = set_data("INSERT INTO api (id_prospec_api, json_api) VALUES (".$id_roadmap.", '".json_encode($array_relatorio_filtered)."');");
                    }
                    else {
                      $array_tmp = [];
                      $index_tmp = 0;

                      $number2 = get_data("SELECT json_api FROM api WHERE id_prospec_api =".intval($id_roadmap));
                      $row1 = pg_fetch_array($number2);        
                      $json_completo = $row1[0];

                      //echo "<script>console.log(".$json_completo.");</script>";        

                      $json_decode_completo = json_decode($json_completo);
                      //echo "<script>console.log(".sizeof($json_decode_completo).");</script>";

                      foreach ($json_decode_completo as $value) {
                        if($value->id_arquivo != $id_arquivo) {
                          $array_tmp[$index_tmp] = $value;
                          $index_tmp++;
                        }
                      }

                      //echo "<script>console.log(".json_encode($array_tmp).");</script>"; 
                      
                      $index_new_array = sizeof($array_tmp);

                      for ($w = 0; $w < sizeof($array_relatorio_filtered); $w++) {  
                        $array_tmp[$index_new_array] = $array_relatorio_filtered[$w];
                        $index_new_array++;
                      }

                      array_multisort(array_column($array_tmp, 'date'), SORT_ASC, $array_tmp);

                      //echo "<script>console.log(".json_encode($array_tmp).");</script>"; 

                      $delete_on_api = set_data("DELETE FROM api WHERE id_prospec_api = $1", array($id_roadmap));
                      $set_on_api = set_data("INSERT INTO api (id_prospec_api, json_api) VALUES (".$id_roadmap.", '".json_encode($array_tmp)."');");
                      
                                          
                    }

                    echo "</ul>
                        </div>
                        </div>
                      </div>";
                  }
                  else {
                    $search_grupos2=get_data("SELECT * FROM grupos WHERE id_prospec_grupos = " . intval($id_roadmap) . " AND id_user_grupos = ". $_SESSION['id']. "AND accepted = 'false' AND id_user_convite IS NOT NULL");
                    $results_max_grupos2 = pg_num_rows($search_grupos2);

                    if($results_max_grupos2 > 0)
                      echo "<script>$('#main-content').html('".$LANG['122']."');</script>";
                    else
                      echo "<script>$('#main-content').html('".$LANG['123']."');</script>";

                    echo "</div>";
                  }
                  
                }
                else if(isset($_GET["roadmap"])) {
                  echo "<div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                          <h6 class='m-0 font-weight-bold text-primary'>".$LANG['114']."</h6>
                        </div>
                        <div class='card-body'>
                  </div>

                  <div class='row justify-content-center'>
                    <div class='col-sm-6 col-md-3'>
                      <div class='col-md-12 feature-box'>
                        <img src='img/timeline6.png' style='width: 130px; height: 100px; display: inline-block;'/>
                        <h4>".$LANG['115']."</h4>
                        <p style='height: 3rem;'>".$LANG['117']."</p>
                        <button class='btn btn-primary' style='margin:5px;' onclick='redirect(\"roadmaps.php?roadmap-completo=".$_GET["roadmap"]."\");'>".$LANG['118']."</button>
                      </div>
                      </div> <!-- End Col -->
                      <div class='col-sm-6 col-md-3'>
                          <div class='col-md-12 feature-box'>
                          <img src='img/files2.png' style='width: 100px; height: 100px; display: inline-block;'/>
                          <h4>".$LANG['116']."</h4>
                          <p style='height: 3rem;'>".$LANG['119']."</p>
                          <a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$_GET["roadmap"]."'><button class='btn btn-primary' style='margin:5px;'>".$LANG['57']."</button></a>
                        </div>
                      </div> <!-- End Col -->	
                    </div> 
                  </div>";
                }
                else {
                  echo "<div class='card shadow mb-4'>
                  <div class='card-header py-3'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$LANG['121']."</h6>
                  </div>
                  <div class='card-body'>
                    <div class='table-responsive'>
                      <table class='table table-bordered' id='table-prospec' width='100%' cellspacing='0'>
                        <thead>
                          <tr>
                            <th></th>
                            <th style='width: 300px'>".$LANG['3']."</th>
                            <th>".$LANG['4']."</th>
                            <th>".$LANG['51']."</th>
                            <th>".$LANG['53']."</th>
                            <th>".$LANG['124']."</th>
                            <th>".$LANG['125']."</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>".$LANG['3']."</th>
                            <th>".$LANG['4']."</th>
                            <th>".$LANG['51']."</th>
                            <th>".$LANG['53']."</th>
                            <th>".$LANG['124']."</th>
                            <th>".$LANG['125']."</th>
                          </tr>
                        </tfoot>
                        <tbody>";

                        $search_prospec=get_data("SELECT * FROM prospec p INNER JOIN grupos g on g.id_prospec_grupos = p.id_prospec WHERE g.accepted = 'true' AND g.id_user_grupos =  '". $_SESSION['id'] ."' order by p.id_prospec");

                          $results_max = pg_num_rows($search_prospec);

                          if  ($results_max>0) {
                            while($result=pg_fetch_object($search_prospec)) {

                              //Traduz a area
                              $assunto_multilang = "";
                              if($result->assunto_prospec == "Work")
                                $assunto_multilang = $LANG['20'];
                              if($result->assunto_prospec == "Education")
                                $assunto_multilang = $LANG['17'];
                              if($result->assunto_prospec == "Medicine")
                                $assunto_multilang = $LANG['18'];
                              if($result->assunto_prospec == "Transport")
                                $assunto_multilang = $LANG['19'];  

                              $status_ren_msg = "";
                              if($result->status_ren_prospec == "CONCLUIDO")
                                $status_ren_msg = $LANG['199'];
                              if($result->status_ren_prospec == "PROCESSANDO")
                                $status_ren_msg = $LANG['200'];
                              if($result->status_ren_prospec == "ERROR")
                                $status_ren_msg = $LANG['201'];  

                              echo "<tr>
                                    <td style='text-align: center;' width='30px;'>
                                    <div style='text-align: center;'>";
                                      if($result->usuario_prospec == $result->id_user_grupos)
                                        echo "<img src='img/manager2.png' title='".$LANG['63']."' style='width: 22px; height: 20px; display: inline-block; opacity:60%;'/>";
                                      else
                                        echo "<img src='img/shared5.png' title='".$LANG['64']."' style='width: 20px; height: 20px; display: inline-block; opacity:70%;'/>";
                                    echo "</div>
                                    </td>
                                    <td>".$result->nome_prospec."</td>
                                    <td>".$assunto_multilang."</td>
                                    <td>".$result->ano_prospec."</td>
                                    <td><div style='text-align: center;'>";
                                if($result->status_ren_prospec != "null" && $result->status_ren_prospec != "")
                                  echo "<img src='img/".$result->status_ren_prospec.".png' title='".$status_ren_msg."' style='width: 20px; height: 20px; display: inline-block;'/>";
                                echo "</div></td>
                                </div></td>
                                    <td><a href='/roadmaps.php?roadmap-completo=".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' title='".$LANG['126']."' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                    <td><a href='#' data-target='#modalArquivosRoadmap' data-toggle='modal' data-id='modalArquivosRoadmap-".$result->id_prospec."'><div style='text-align: center;'><img src='img/ver_arquivos.png' title='".$LANG['57']."' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
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
          <h4 class="modal-title"><?php echo $LANG['86']; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>       
        </div>
        <div class="modal-body">
          <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['120']; ?></h6>
            </div>
            <div class="card-body">
              <div id="table-modal" class="table-responsive">
                
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $LANG['79']; ?></button>
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
    <div id="content-campo-adicionar-roadmap" class="modal-dialog modal-lg">
      <!-- Modal content-->
      

    </div>
  </div>

  <div id="modalGeraRelatorio" class="modal fade" role="dialog">
    <div id="content-gera-relatorio" class="modal-dialog modal-ll">
      <!-- Modal content-->
      

    </div>
  </div>

  <!-- Modal de Usuários-->
  <div id="modalUsuariosParticipantes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-ll">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $LANG['139']; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>       
        </div>
        <div class="modal-body">
          <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['140']; ?></h6>
            </div>
            <div class="card-body">
              <div id="table-modal-usuarios-participantes" class="table-responsive">
                
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $LANG['79']; ?></button>
        </div>
      </div>

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
          <button class="btn btn-danger" type="button" data-dismiss="modal">Voltar</button>
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
          if (typeof $(this).data('tipoarquivo') !== 'undefined') {
            data_tipoarquivo = $(this).data('tipoarquivo');
          }
          var data_txt =  data_id.toString();
          var data_id_prospec = data_txt.replace('abrirpdf-','');
          var data_id_verNoTexto = data_txt.replace('verNoTexto-','');
          var data_id_arquivo = data_txt.replace('editarRoadmap-','');
          var data_id_roadmap = data_txt.replace('adicionarRoadmap-','');
          var data_id_modalArquivos = data_txt.replace('modalArquivosRoadmap-','');
          var data_id_gerarelatorio = data_txt.replace('gerarelatorio-','');
          var data_id_participantes = data_txt.replace('participantes-','');
          //console.log(data_id);
          if(data_txt.indexOf('abrirpdf-') > -1) {
            $.ajax({
              url: "abrir-pdf.php",
              method: "POST",
              data: { "identificador": data_id_prospec,
                      "original": data_original,
                      "tipoarquivo": data_tipoarquivo },
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
          else if(data_txt.indexOf('gerarelatorio-') > -1) {
          	 $.ajax({
              url: "modal-gera-relatorio.php",
              method: "POST",
              data: { "identificador": data_id_gerarelatorio},
              success: function(html) {
                $('#content-gera-relatorio').html(html);
                $('#modalGeraRelatorio').modal('show');
              }
            })
          }
          else if(data_txt.indexOf('participantes-') > -1) {
          	$.ajax({
	            url: "modal-usuarios-participantes.php",
	            method: "POST",
	            data: { "identificador": data_id_participantes},
	            success: function(html) {
	              $('#table-modal-usuarios-participantes').html(html);
	              $('#modalUsuariosParticipantes').modal('show');
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
      $('#table-prospec').DataTable({                  
        "bDestroy": true,
          "bAutoWidth": true,  
          "bFilter": true,
          "bSort": true, 
          "aaSorting": [[0]],         
          "aoColumns": [
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
          ]   
      });
    });

    function goBack() {
      window.history.back();
    }

    function redirect(url) {
      //console.log(url);
      window.location.href = url;
    }


  </script>

  <script type="text/javascript">

    var relatorio_arrayJS_Global = <?php echo json_encode($array_relatorio_filtered); ?>;

    if(relatorio_arrayJS_Global !== null && relatorio_arrayJS_Global.length > 0) {
      var total_conf = 0;
      for (var i = 0; i < relatorio_arrayJS_Global.length; i++) {
        total_conf += parseInt(relatorio_arrayJS_Global[i]["confiabilidade"]);
      }
    
      var media_conf_roadmap = total_conf / relatorio_arrayJS_Global.length;
      media_conf_roadmap = media_conf_roadmap.toFixed(2);

      //console.log(media_conf_roadmap);

      var conf_media = "";
      if(media_conf_roadmap > 4.9)
        conf_media = "conf_stars_5_bw.png";
      if(media_conf_roadmap >= 4.1 && media_conf_roadmap <= 4.9)
        conf_media = "conf_stars_4.5_bw.png";
      if(media_conf_roadmap >= 3.9 && media_conf_roadmap <= 4.1)
      conf_media = "conf_stars_4_bw.png";
      if(media_conf_roadmap >= 3.1 && media_conf_roadmap <= 3.9)
        conf_media = "conf_stars_3.5_bw.png";
      if(media_conf_roadmap >= 2.9 && media_conf_roadmap < 3.1)
        conf_media = "conf_stars_3_bw.png";
      if(media_conf_roadmap >= 2.1 && media_conf_roadmap < 2.9)
        conf_media = "conf_stars_2.5_bw.png"; 
      if(media_conf_roadmap >= 1.9 && media_conf_roadmap < 2.1)
      conf_media = "conf_stars_2_bw.png"; 
      if(media_conf_roadmap >= 1.1 && media_conf_roadmap < 1.9)
        conf_media = "conf_stars_1.5_bw.png"; 
      if(media_conf_roadmap >= 0.9 && media_conf_roadmap < 1.1)
      conf_media = "conf_stars_1_bw.png"; 
      if(media_conf_roadmap < 0.9)
        conf_media = "conf_stars_0.5_bw.png"; 

      document.getElementById("box_conf_media_roadmap").innerHTML = "<small class='text-muted'><b> <?php echo $LANG['76']; ?>: </b></small><img id='conf_media_roadmap' src='img/" + conf_media + "' title='<?php echo $LANG['128']; ?>: " + media_conf_roadmap + "' style='height: 15px; margin-right:10px; margin-top: -4px; margin-left: 3px;'/>";
    }
    else {
      document.getElementById("dot_separator").style.visibility = "hidden";
    }
    
  	function geraRelatorioCSV() {
      
      var relatorio_arrayJS = <?php echo json_encode($array_relatorio_filtered); ?>;

  		formatArray(relatorio_arrayJS);
  		exportCSVFile(headers, itemsFormatted, getNomeArquivoRelatorio());
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
	    date: "<?php echo $LANG['72']; ?>".replace(/,/g, ''), // remove commas to avoid errors
	    event: "<?php echo $LANG['207']; ?>"
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
  
  function getFormattedTime() {
    var today = new Date();
    var y = today.getFullYear();
    // JavaScript months are 0-based.
    var m = today.getMonth() + 1;
    var d = today.getDate();
    var h = today.getHours();
    var mi = today.getMinutes();
    var s = today.getSeconds();
    return y + "-" + m + "-" + d + "-" + h + "-" + mi + "-" + s;
}

  function geraRelatorioJSON() {
    var relatorio_arrayJS = <?php echo json_encode($array_relatorio_filtered); ?>;
    
    var a = document.createElement('a');
    var blob = new Blob([JSON.stringify(relatorio_arrayJS)], {'type':'application\/json'});
    a.href = window.URL.createObjectURL(blob);
    a.download = getNomeArquivoRelatorio() + '.json';
    a.click();
  };

  function  geraRelatorioTXT() {
    var relatorio_arrayJS = <?php echo json_encode($array_relatorio_filtered); ?>;
    var filename = getNomeArquivoRelatorio() + ".txt";
    var text = "";

    for (var i = 0; i < relatorio_arrayJS.length; i++) {
      text += "[" + relatorio_arrayJS[i].date + "] " + relatorio_arrayJS[i].info;
      text += '\r\n\r\n';
	  }

    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
  }

  function  geraRelatorioDOC() {
    var relatorio_arrayJS = <?php echo json_encode($array_relatorio_filtered); ?>;
    var tipoCabecalhoJS = "<?php echo $tipoCabecalho; ?>";
    var filename = getNomeArquivoRelatorio() + ".doc";
    var text = "";

    if(tipoCabecalhoJS.indexOf("roadmap-completo") > -1)
        var tipo = "Roadmap Completo";
      else
        var tipo = "Roadmap do Arquivo: " + relatorio_arrayJS[0].nome_arquivo;

    text += relatorio_arrayJS[0].nome_trm;
    text += '\r\n\r\n';
    text += tipo;
    text += '\r\n\r\n';

    for (var i = 0; i < relatorio_arrayJS.length; i++) {
      text += "[" + relatorio_arrayJS[i].date + "] " + relatorio_arrayJS[i].info;
      text += '\r\n\r\n';
	  }

    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
  }

  function geraRelatorioPDF() {
    var relatorio_arrayJS = <?php echo json_encode($array_relatorio_filtered); ?>;
    var tipoCabecalhoJS = "<?php echo $tipoCabecalho; ?>";
    var text = "";

    for (var i = 0; i < relatorio_arrayJS.length; i++) {
      text += "[" + relatorio_arrayJS[i].date + "] " + relatorio_arrayJS[i].info;
      text += '\n\n';
	  }

    var doc = new jsPDF('p', 'in', 'letter'),
    sizes = [12, 16, 20],
    fonts = [['Times', 'Roman'], ['Helvetica', ''], ['Times', 'Italic']],
    font, size, lines,
    margin = 0.5, // inches on a 8.5 x 11 inch sheet.
    verticalOffset = margin,
    data = text;

    if (fonts.hasOwnProperty(0)) {
      font = fonts[0];
      size = sizes[0];

      if(tipoCabecalhoJS.indexOf("roadmap-completo") > -1)
        var tipo = "<?php echo $LANG['205']; ?>";
      else
        var tipo = "<?php echo $LANG['206']; ?>" + ": " + relatorio_arrayJS[0].nome_arquivo;

      doc.text(0.5, verticalOffset + size / 72,  "TRM: " + relatorio_arrayJS[0].nome_trm);

      doc.text(0.5, 1 + size / 72,  tipo);

      lines = doc.setFont(font[0], font[1])
            .setFontSize(size)
            .splitTextToSize(data, 7.5);
      
      var pageHeight = doc.internal.pageSize.height;
      
      var space = 1.5;
      for (var j = 0; j < lines.length; j++) {
        if(space >= pageHeight-0.5) {
          doc.addPage();
          space = 0.5;
        }
        doc.text(0.5, space + size / 72, lines[j]);
        space += 0.2;  
      }

    }
    filename = getNomeArquivoRelatorio();
    doc.save(filename + '.pdf');
  }

  function visualizarAPI() {
    var tipoCabecalhoJS = "<?php echo $tipoCabecalho; ?>";

    if(tipoCabecalhoJS.indexOf("roadmap-completo") > -1) {
      var idRoadmap = "<?php echo $id_roadmap; ?>";
      window.open("api.php?" + tipoCabecalhoJS + "=" + idRoadmap);
    }
    else {
      var idArquivo = "<?php echo $id_arquivo; ?>";
      window.open("api.php?" + tipoCabecalhoJS + "=" + idArquivo);
    }
    
  }

  function geraRelatorioPDFTimeline() {

    var pdf = new jsPDF('p', 'pt', 'a4');
    pdf.addHTML(document.getElementById("container-roadmap"), function() {

        filename = getNomeArquivoRelatorio();
        pdf.save(filename + '.pdf');
    });
  }

  function getNomeArquivoRelatorio() {
    var nome_trmJS = "<?php echo $nome_roadmap; ?>";
    var tipoCabecalhoJS = "<?php echo $tipoCabecalho; ?>";
    var nome_arquivoJS = "<?php echo $nome_arquivo; ?>";

    if(tipoCabecalhoJS.indexOf("roadmap-completo") > -1)
        var fileTitle = "<?php echo $LANG['203']; ?>" + " " + nome_trmJS + " ("+ "<?php echo $LANG['115']; ?>" +") - " + getFormattedTime();
      else
        var fileTitle = "<?php echo $LANG['203']; ?>" + " " + nome_trmJS + " (" + "<?php echo $LANG['204']; ?>" + " " + nome_arquivoJS + ") - " + getFormattedTime();

    return fileTitle;    
  }

 </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Page level plugins -->
  <script>
    var dt_mostrar = "<?php echo $LANG['189']; ?>";
    var dt_resultados = "<?php echo $LANG['190']; ?>";
    var dt_de = "<?php echo $LANG['191']; ?>";
    var dt_ate = "<?php echo $LANG['192']; ?>";
    var dt_filtrado = "<?php echo $LANG['193']; ?>";
    var dt_totais = "<?php echo $LANG['194']; ?>";
    var dt_pesquisar = "<?php echo $LANG['195']; ?>";
    var dt_anterior = "<?php echo $LANG['196']; ?>";
    var dt_proximo = "<?php echo $LANG['197']; ?>";
    var dt_mostrando = "<?php echo $LANG['198']; ?>";
    var dt_sem_dados = "<?php echo $LANG['202']; ?>";
    var dt_no_records = "<?php echo $LANG['208']; ?>";
  </script>
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

  	$anoProspec = htmlspecialchars($_POST['anoProspec'], ENT_QUOTES, 'UTF-8');
  	$infoProspec = htmlspecialchars($_POST['infoProspec'], ENT_QUOTES, 'UTF-8');
  	$idRoadmap = $_POST['idRoadmap'];
  	$idArquivo = $_POST['idArquivo'];
  	$indiceRoadmap = $_POST['indiceRoadmap'];
  	$cabecalhoCompleto = $_POST['cabecalhoCompleto'];
  	$keyConsulta = $_POST['keyConsulta'];

    $update_on_roadmap = set_data("UPDATE roadmap SET tempo = $1, prospeccao = $2 where id_arquivo_unico = $3 AND ordem = $4 AND id_prospec_roadmap = $5", array($anoProspec, $infoProspec, $idArquivo, $indiceRoadmap, $idRoadmap));

    echo "<script>window.location.href = 'roadmaps.php?".$cabecalhoCompleto."';</script>";

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

    echo "<script>window.location.href = 'roadmaps.php?".$cabecalhoCompleto."';</script>";

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
    $autores = $_POST['autoresStringAdd'];
    $conf_value = $_POST['rate'];

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

   /*  echo "<script>console.log('".$assuntoAdicionar."');</script>";
    echo "<script>console.log(".$idArquivo.");</script>";
    echo "<script>console.log(".$idRoadmap.");</script>";
    echo "<script>console.log(".$id_roadmap_table_adicionar.");</script>";
    echo "<script>console.log('".$infoProspec."');</script>";
    echo "<script>console.log('".$anoProspec."');</script>";
    echo "<script>console.log(".$indice.");</script>";
    echo "<script>console.log('".$nomeArquivo."');</script>";
    echo "<script>console.log('".$anoArquivo."');</script>"; */

    $set_on_roadmap = set_data("INSERT INTO roadmap (ano_arquivo_adicionado, arquivo_origem, assunto, filtro, id_arquivo_unico, id_prospec_roadmap, id_roadmap, nome_arquivo_adicionado, ordem, prospeccao, tem_filtro, tempo, prospeccao_original, autores_prospeccao, conf_prospeccao) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15)", array($anoArquivo, '0', $assuntoAdicionar, 'null', $idArquivo, $idRoadmap, $id_roadmap_table_adicionar, $nomeArquivo, $indice, $infoProspec, 'false', $anoProspec, $infoProspec, $autores, $conf_value));

    echo "<script>window.location.href = 'roadmaps.php?".$cabecalhoCompleto."';</script>";

  }

?>