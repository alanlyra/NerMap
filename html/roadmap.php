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
            <h1 class="h3 mb-0 text-gray-800"><?php echo $LANG['1']; ?></h1>
          </div>

          <!-- Content Row -->

         

          <div class="row justify-content-center">

            <!-- Project Card Example -->
            <div class="col-xl-4 col-lg-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['2']; ?></h6>
                </div>
                <div id="messageCampos" style="display: none;" class="alert alert-warning ">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                  </button>    <strong>Atenção!</strong> Todos os campos devem ser preenchidos.
                </div>
                

                <form action="roadmap.php" method="post" multipart="" enctype="multipart/form-data" style="text-align: center; max-height: 370px;">
                <div class="col-md-11 feature-box" style="text-align: left; display:inline-block; margin-top:1.4rem;">
                <div class="row justify-content-center">
                  <div class="col-xl-12 col-lg-12" style="margin-top:2.5vh;">
                   <h5><?php echo $LANG['3']; ?>:</h5>
                    <input type="text" id="nomeRoadmap" name="nomeRoadmap" class="form-control bg-light border-0 small" placeholder="<?php echo $LANG['22']; ?>..." aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                  
                  </div>
                  </br>
                  <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6">
                      <h5><?php echo $LANG['4']; ?>:</h5>
                      <select type="text" id="temaRoadmap" name="temaRoadmap" class="form-control" style="cursor: pointer;" required>
                        <option value="" disabled selected><?php echo $LANG['16']; ?>...</option>
                        <option value="Education"><?php echo $LANG['17']; ?></option>
                        <option value="Medicine"><?php echo $LANG['18']; ?></option>
                        <option value="Transport"><?php echo $LANG['19']; ?></option>
                        <option value="Work"><?php echo $LANG['20']; ?></option>
                      </select>
                    </div>
                    </br>
                    <div class="col-xl-6 col-lg-6">
                    <h5><?php echo $LANG['6']; ?>:</h5>
                      <input type="text" id="anoRoadmap" name="anoRoadmap" class="form-control bg-light border-0 small" placeholder="<?php echo $LANG['21']; ?>..." aria-label="Search" aria-describedby="basic-addon2" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                    </div>
                  </div>
                  </br>
                  <div class="py-3" style="text-align: center;">
                    <input class="btn btn-primary btn-icon-split" type="submit" name="criaTRM" value="<?php echo $LANG['5']; ?>" style="width: 8em; height: 2em; display: inline-block; margin-top: 5px;" />
                  </div>   
                </div>
                </div>
                              
                </form>
              </div>

              <div class="col-xl-5 col-lg-5">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['7']; ?></h6>
                  </div>
                  <div class="row justify-content-center divWorkplace">
                    <div class="col-sm-5 col-md-5">
                      <div class="col-md-12 feature-box">
                      <img src="img/files2.png" style="width: 100px; height: 100px; display: inline-block;"/>
                        <h4><?php echo $LANG['9']; ?></h4>
                        <p style="height: 3rem;"><?php echo $LANG['10']; ?></p>
                        <a href="prospeccoes.php"><button class="btn btn-primary" style="margin:5px;"><?php echo $LANG['12']; ?></button></a>
                      </div>
                    </div> <!-- End Col -->
                    <div class="col-sm-5 col-md-5">
                      <div class="col-md-12 feature-box">
                      <img src="img/timeline6.png" style="width: 130px; height: 100px; display: inline-block;"/>
                        <h4><?php echo $LANG['8']; ?></h4>
                        <p style="height: 3rem;"><?php echo $LANG['11']; ?></p>
                        <a href="seeroadmap.php"><button class="btn btn-primary" style="margin:5px;"><?php echo $LANG['12']; ?></button></a>
                      </div>
                  </div> <!-- End Col -->	
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['13']; ?></h6>
                  </div>
                  <div class="row justify-content-center divWorkplace">
                    <div class="col-sm-9 col-md-9">
                      <div class="col-md-12 feature-box">
                      <img class="img-profile rounded-circle" src="<?php echo $_SESSION['photo']?>" style="width: 100px; height: 100px; display: inline-block;"/>                   
                        <h4><?php echo $LANG['14']; ?></h4>
                        <p style="height: 3rem;"><?php echo $LANG['15']; ?></p>
                        <a href="config-usuario.php"><button class="btn btn-primary" style="margin:5px;"><?php echo $LANG['12']; ?></button></a>
                      </div>
                    </div> <!-- End Col -->
                </div>
              </div>
                
                </div>
          </div>
          <div class="row">
            <div class="col-xl-9 col-lg-9">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['23']; ?></h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header"><?php echo $LANG['31']; ?>:</div>
                        <a class="dropdown-item" href="#" onclick="analiseUserData();"><?php echo $LANG['32']; ?></a>
                        <a class="dropdown-item" href="#" onclick="analiseGlobalData();"><?php echo $LANG['33']; ?></a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body" style="padding: 1rem 1rem 0 1rem; min-height: 225px;">
                    <div class="divAnalise">

                    <div class="row">

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="card border-left-primary feature-box-simple py-2" style="height: 75px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $LANG['24']; ?></div>
                                <div id="num-trms" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-archive fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card border-left-primary feature-box-simple py-2" style="height: 75px; margin-top:20px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $LANG['25']; ?></div>
                                <div id="num-arquivos" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300" style="margin-right: 5px;"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="card border-left-primary feature-box-simple py-2" style="height: 75px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $LANG['26']; ?></div>
                                <div id="num-roadmaps" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-map-signs fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card border-left-primary feature-box-simple py-2" style="height: 75px; margin-top:20px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $LANG['27']; ?></div>
                                <div id="num-prospeccoes" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $LANG['28']; ?>:</div>
                        <div style="padding: 0.5rem !important;">                        
                          <canvas id="temasChart"></canvas>
                         
                        </div>
                      </div>

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $LANG['29']; ?>:</div>
                        <div style="padding: 0.5rem !important;">                         
                          <canvas id="anosChart"></canvas>
                        </div>
                      </div>

                    </div>


                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-3">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['30']; ?></h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header"><?php echo $LANG['12']; ?>:</div>
                        <a class="dropdown-item" href="#">Dissertação</a>
                        <a class="dropdown-item" href="#">PESC</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body" style="max-height: 208px; overflow: auto; min-height: 225px;">
                    <div class="divMetodologia">
                    <p><?php echo $LANG['34']; ?></p>
                    </div>
                    <div class="mt-4 text-center small">
                      <span class="mr-2">
                        <span class="nermap_font_copyright"><a href="http://www.cos.ufrj.br/" class="nermap_font_copyright">PESC</a></span>
                      </span>
                      <span class="mr-2">
                        <span> · </span>
                      </span>
                      <span class="mr-2">
                        <span class="nermap_font_copyright"><a href="http://www.coppe.ufrj.br/" class="nermap_font_copyright">COPPE</a></span>
                      </span>
                      <span class="mr-2">
                        <span> · </span>
                      </span>
                      <span class="mr-2">
                        <span class="nermap_font_copyright"><a href="http://www.ufrj.br/" class="nermap_font_copyright">UFRJ</a></span>
                      </span>
                    </div>
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
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $LANG['168']; ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo $LANG['169']; ?></div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $LANG['106']; ?></button>
          <a class="btn btn-primary" href="login.php?action=logout"><?php echo $LANG['112']; ?></a>
        </div>
      </div>
    </div>
  </div>

  <?php

    //Coleta informações do usuário do banco para a área de análise
    $number6 = get_data("SELECT id_prospec_grupos FROM grupos where id_user_grupos = ".$_SESSION["id"]." AND accepted = true");

    $results_max6 = pg_num_rows($number6);
    $num_trms_user = $results_max6;
    $num_arquivos_user = 0;
    $num_roadmaps_user = 0;
    $num_prospeccoes_user = 0;
    $array_temas_user = [];
    $array_anos_prospeccoes_user = [];

    if  ($results_max6>0) {
      while($result6=pg_fetch_object($number6)) {
        $number5 = get_data("SELECT num_textos_prospec FROM prospec where id_prospec = ".$result6->id_prospec_grupos);
        $row5 = pg_fetch_array($number5);        
        $numero_arquivos_user_tmp = $row5[0];
        $num_arquivos_user += $numero_arquivos_user_tmp;

        $number7 = get_data("SELECT COUNT(*) FROM roadmap where id_prospec_roadmap = ".$result6->id_prospec_grupos);
        $row7 = pg_fetch_array($number7);        
        $num_prospeccoes_user_tmp = $row7[0];
        $num_prospeccoes_user += $num_prospeccoes_user_tmp;

        $number8 = get_data("SELECT assunto_prospec FROM prospec where id_prospec = ".$result6->id_prospec_grupos);
        $row8 = pg_fetch_array($number8);        
        $tema_prospec_tmp = $row8[0];

        $number9 = get_data("SELECT tempo FROM roadmap where id_prospec_roadmap = ".$result6->id_prospec_grupos." AND tempo >= ano_arquivo_adicionado");
        while($result9=pg_fetch_object($number9)) {  
          array_push($array_anos_prospeccoes_user, $result9->tempo);
        }     

        array_push($array_temas_user, $tema_prospec_tmp);    
      }
    }

    $num_roadmaps_user = $num_trms_user + $num_arquivos_user;

    //Coleta informações globais do banco para a área de análise
    $number6 = get_data("SELECT id_prospec FROM prospec");

    $results_max6 = pg_num_rows($number6);
    $num_trms_global = $results_max6;
    $num_arquivos_global = 0;
    $num_roadmaps_global = 0;
    $num_prospeccoes_global = 0;
    $array_temas_global = [];
    $array_anos_prospeccoes_global = [];

    if  ($results_max6>0) {
      while($result6=pg_fetch_object($number6)) {
        $number5 = get_data("SELECT num_textos_prospec FROM prospec where id_prospec = ".$result6->id_prospec);
        $row5 = pg_fetch_array($number5);        
        $numero_arquivos_global_tmp = $row5[0];
        $num_arquivos_global += $numero_arquivos_global_tmp;

        $number7 = get_data("SELECT COUNT(*) FROM roadmap where id_prospec_roadmap = ".$result6->id_prospec);
        $row7 = pg_fetch_array($number7);        
        $num_prospeccoes_global_tmp = $row7[0];
        $num_prospeccoes_global += $num_prospeccoes_global_tmp;

        $number8 = get_data("SELECT assunto_prospec FROM prospec where id_prospec = ".$result6->id_prospec);
        $row8 = pg_fetch_array($number8);        
        $tema_prospec_global_tmp = $row8[0];

        $number9 = get_data("SELECT tempo FROM roadmap where id_prospec_roadmap = ".$result6->id_prospec." AND tempo >= ano_arquivo_adicionado");
        while($result9=pg_fetch_object($number9)) {  
          array_push($array_anos_prospeccoes_global, $result9->tempo);
        }     

        array_push($array_temas_global, $tema_prospec_global_tmp);    
      }
    }

    $num_roadmaps_global = $num_trms_global + $num_arquivos_global;

  ?>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function load(){
      document.getElementById("li_roadmap").classList.add('active');
    }

    var colorsChartDefault= ["#5a5c69", "#ce7d78", "#ea9e70", "#63b598", "#a48a9e", "#648177", "#c9a941" ,"#0d5ac1" ,
                            "#00bdd5" ,"#9e6d71" ,"#14a9ad" ,"#4ca2f9" ,"#6a8db3" ,"#d298e2" ,"#6119d0",
                            "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
                            "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
                            "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
                            "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#c6e1e8" ,"#2f1179" ,
                            "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#ffdbe1", "#4b5bdc", "#0cd36d",
                            "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
                            "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
                            "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
                            "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
                            "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#1c0365", "#41d158",
                            "#fb21a3", "#51aed9", "#21538e", "#807fb", "#5bb32d", "#89d534", "#d36647",
                            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
                            "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647",
                            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
                            "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7",
                            "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
                            "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
                            "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
                            "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
                            "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
                            "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
                            "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
                            "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
                            "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
                            "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
                            "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
                            "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
                            "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
                            "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
                            "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
                            "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
                            "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
                            "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
                            "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
                            "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
                            "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];

    //Pass users informations to JS
    var arrayTemasUserJS = <?php echo json_encode($array_temas_user); ?>;
    var uniqs_arrayTemasUserJS = arrayTemasUserJS.reduce((acc, val) => {
      acc[val] = acc[val] === undefined ? 1 : acc[val] += 1;
      return acc;
    }, {});

    var arrayAnosProspeccoesUserJS = <?php echo json_encode($array_anos_prospeccoes_user); ?>;
    var uniqs_arrayAnosProspeccoesUserJS = arrayAnosProspeccoesUserJS.reduce((acc, val) => {
      acc[val] = acc[val] === undefined ? 1 : acc[val] += 1;
      return acc;
    }, {});

    var labelsChartTemasUser = [];
    var dataChartTemasUser = [];
    var colorsChartTemasUser = [];

    var i_tmp_temas = 0;
    for (const [key, value] of Object.entries(uniqs_arrayTemasUserJS)) {
      labelsChartTemasUser.push(key);
      dataChartTemasUser.push(value);
      colorsChartTemasUser.push(colorsChartDefault[i_tmp_temas]);
      i_tmp_temas++;
    }

    var labelsChartAnosProspeccoesUser = [];
    var dataChartAnosProspeccoesUser = [];
    var colorsChartAnosProspeccoesUser = [];

    //Limita aos 10 primeiros anos com mais ocorrências
    uniqs_arrayAnosProspeccoesUserJS = Object.assign(
        ...Object
            .entries(uniqs_arrayAnosProspeccoesUserJS)
            .sort(({ 1: a }, { 1: b }) => b - a)
            .slice(0, 10) //Limite
            .map(([k, v]) => ({ [k]: v }))
    );

    var i_tmp_anos = 0;
    for (const [key, value] of Object.entries(uniqs_arrayAnosProspeccoesUserJS)) {
      labelsChartAnosProspeccoesUser.push(key);
      dataChartAnosProspeccoesUser.push(value);
      colorsChartAnosProspeccoesUser.push(colorsChartDefault[i_tmp_anos]);
      i_tmp_anos++;
    }

    //Pass global informations to JS
    var arrayTemasGlobalJS = <?php echo json_encode($array_temas_global); ?>;
    var uniqs_arrayTemasGlobalJS = arrayTemasGlobalJS.reduce((acc, val) => {
      acc[val] = acc[val] === undefined ? 1 : acc[val] += 1;
      return acc;
    }, {});

    var arrayAnosProspeccoesGlobalJS = <?php echo json_encode($array_anos_prospeccoes_global); ?>;
    var uniqs_arrayAnosProspeccoesGlobalJS = arrayAnosProspeccoesGlobalJS.reduce((acc, val) => {
      acc[val] = acc[val] === undefined ? 1 : acc[val] += 1;
      return acc;
    }, {});

    var labelsChartTemasGlobal = [];
    var dataChartTemasGlobal = [];
    var colorsChartTemasGlobal = [];

    //Limita aos 10 primeiros anos com mais ocorrências
    uniqs_arrayAnosProspeccoesGlobalJS = Object.assign(
        ...Object
            .entries(uniqs_arrayAnosProspeccoesGlobalJS)
            .sort(({ 1: a }, { 1: b }) => b - a)
            .slice(0, 10) //Limite
            .map(([k, v]) => ({ [k]: v }))
    );

    var i_tmp_temas = 0;
    for (const [key, value] of Object.entries(uniqs_arrayTemasGlobalJS)) {
      labelsChartTemasGlobal.push(key);
      dataChartTemasGlobal.push(value);
      colorsChartTemasGlobal.push(colorsChartDefault[i_tmp_temas]);
      i_tmp_temas++;
    }

    var labelsChartAnosProspeccoesGlobal = [];
    var dataChartAnosProspeccoesGlobal = [];
    var colorsChartAnosProspeccoesGlobal = [];

    var i_tmp_anos = 0;
    for (const [key, value] of Object.entries(uniqs_arrayAnosProspeccoesGlobalJS)) {
      labelsChartAnosProspeccoesGlobal.push(key);
      dataChartAnosProspeccoesGlobal.push(value);
      colorsChartAnosProspeccoesGlobal.push(colorsChartDefault[i_tmp_anos]);
      i_tmp_anos++;
    }

    var temasChart = null;
    var anosChart = null;

    function drawPieCharts(labelTemas, dataTemas, colorsTemas, labelAnos, dataAnos, colorsAnos) {
      var ctx = document.getElementById("temasChart");
      temasChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: labelTemas,
          datasets: [{
            data: dataTemas,
            backgroundColor: colorsTemas,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "#5a5c69",
            //bodyFontColor: "#858796",
            //borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
          },
          legend: {
            display: true,
            responsive: true,
            position: 'left',
            labels: {
                fontColor: '#5a5c69'
            }
          },
          cutoutPercentage: 0,
        },
      });

      var ctx = document.getElementById("anosChart");
      anosChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labelAnos,
          datasets: [{
            data: dataAnos,
            backgroundColor: colorsAnos,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "#5a5c69",
            //bodyFontColor: "#858796",
            //borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
          },
          legend: {
            display: false
          },
          cutoutPercentage: 0,
        },
      });
    }  

    var numTRMsUserJS = "<?php echo $num_trms_user; ?>";
    var numArquivosUserJS = "<?php echo $num_arquivos_user; ?>";
    var numRoadmapsUserJS = "<?php echo $num_roadmaps_user; ?>";
    var numProspeccoesUserJS = "<?php echo $num_prospeccoes_user; ?>";

    var numTRMsGlobalJS = "<?php echo $num_trms_global; ?>";
    var numArquivosGlobalJS = "<?php echo $num_arquivos_global; ?>";
    var numRoadmapsGlobalJS = "<?php echo $num_roadmaps_global; ?>";
    var numProspeccoesGlobalJS = "<?php echo $num_prospeccoes_global; ?>";

    function analiseUserData(){
      if(temasChart != null && anosChart != null) {
        temasChart.destroy();
        anosChart.destroy();
      }
      

      if(numTRMsUserJS == 1) document.getElementById("num-trms").innerHTML = numTRMsUserJS + " <?php echo $LANG['24'];?>";
      else document.getElementById("num-trms").innerHTML = numTRMsUserJS + " <?php echo $LANG['24'];?>";

      if(numArquivosUserJS == 1) document.getElementById("num-arquivos").innerHTML = numArquivosUserJS + " <?php echo $LANG['25'];?>";
      else document.getElementById("num-arquivos").innerHTML = numArquivosUserJS + " <?php echo $LANG['25'];?>";

      if(numRoadmapsUserJS == 1) document.getElementById("num-roadmaps").innerHTML = numRoadmapsUserJS + " <?php echo $LANG['26'];?>";
      else document.getElementById("num-roadmaps").innerHTML = numRoadmapsUserJS + " <?php echo $LANG['26'];?>";

      if(numProspeccoesUserJS == 1) document.getElementById("num-prospeccoes").innerHTML = numProspeccoesUserJS + " <?php echo $LANG['27'];?>";
      else document.getElementById("num-prospeccoes").innerHTML = numProspeccoesUserJS + " <?php echo $LANG['27'];?>";

      drawPieCharts(labelsChartTemasUser, dataChartTemasUser, colorsChartTemasUser, labelsChartAnosProspeccoesUser, dataChartAnosProspeccoesUser, colorsChartAnosProspeccoesUser);
      
    }

    function analiseGlobalData(){
      if(temasChart != null && anosChart != null) {
        temasChart.destroy();
        anosChart.destroy();
      }

      if(numTRMsGlobalJS == 1) document.getElementById("num-trms").innerHTML = numTRMsGlobalJS + " <?php echo $LANG['24'];?>";
      else document.getElementById("num-trms").innerHTML = numTRMsGlobalJS + " <?php echo $LANG['24'];?>";

      if(numArquivosGlobalJS == 1) document.getElementById("num-arquivos").innerHTML = numArquivosGlobalJS + " <?php echo $LANG['25'];?>";
      else document.getElementById("num-arquivos").innerHTML = numArquivosGlobalJS + " <?php echo $LANG['25'];?>";

      if(numRoadmapsGlobalJS == 1) document.getElementById("num-roadmaps").innerHTML = numRoadmapsGlobalJS + " <?php echo $LANG['26'];?>";
      else document.getElementById("num-roadmaps").innerHTML = numRoadmapsGlobalJS + " <?php echo $LANG['26'];?>";

      if(numProspeccoesGlobalJS == 1) document.getElementById("num-prospeccoes").innerHTML = numProspeccoesGlobalJS + " <?php echo $LANG['27'];?>";
      else document.getElementById("num-prospeccoes").innerHTML = numProspeccoesGlobalJS + " <?php echo $LANG['27'];?>";

      drawPieCharts(labelsChartTemasGlobal, dataChartTemasGlobal, colorsChartTemasGlobal, labelsChartAnosProspeccoesGlobal, dataChartAnosProspeccoesGlobal, colorsChartAnosProspeccoesGlobal);

    }

    analiseUserData();
    document.getElementById("temasChart").style.width = "170px";
    document.getElementById("temasChart").style.height = "140px";
    document.getElementById("anosChart").style.width = "170px";
    document.getElementById("anosChart").style.height = "140px";

  </script>

</body>
</html>


<?php
	//echo '<pre>';

  if(isset($_POST["criaTRM"])) {

  	$nome = htmlspecialchars($_POST['nomeRoadmap'], ENT_QUOTES, 'UTF-8');
  	$tema = htmlspecialchars($_POST['temaRoadmap'], ENT_QUOTES, 'UTF-8');
  	$ano = htmlspecialchars($_POST['anoRoadmap'], ENT_QUOTES, 'UTF-8');


  	if(!$nome == "" && !$tema == "" && !$ano == "") {   	
    	  $id_prospec = get_max_id_prospec();
        db_prospec($id_prospec, $nome, $tema, $ano);
  	}
  	else{
      echo "<script> document.getElementById('messageCampos').style.display = 'block'; </script>";
  		//echo "<script>console.log( 'Deu ruim!' );</script>";
  	}

  }

	function get_max_id_prospec() {   
		$number1 = get_data("select MAX(id_prospec) from prospec");
		$row = pg_fetch_array($number1);				
		$number2 = $row[0];	
		$number = $number2 + 1;
    return $number;
  }

  //TODO: REMOVER INSERÇÃO DE STATUS E CONFIABILIDADE
	function db_prospec($id_prospec_db, $nome_db, $tema_db, $ano_db) {   
        $save_on_prospec = set_data("INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec, conf_prospec, usuario_prospec) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_prospec_db, $nome_db, $tema_db, $ano_db, 0, 'null', 10, $_SESSION['id']));
        db_grupos($id_prospec_db);
        //echo "<script>window.location.href = 'success.php?action=trm-adicionado';</script>";
        echo "<script>window.location.href = 'prospeccoes.php';</script>";
    }

  function db_grupos($id_prospec_db) {   
    $save_on_grupos = set_data("INSERT INTO grupos (id_prospec_grupos, id_user_grupos, accepted) VALUES ($1, $2, $3)", array($id_prospec_db, $_SESSION['id'], true));
  }
  
?>



 
