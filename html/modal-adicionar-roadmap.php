<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

  <?php 
      $id_roadmap = $_POST["identificador"];
      $cabecalho = $_POST["cabecalho"];
      $id_arquivo = $_POST["idArquivoRoadmap"];
      $assuntoAdd = $_POST["assunto"];

      if($cabecalho == "arquivo") {
        $param = $id_arquivo;
        $keyConsulta = "id_arquivo_unico";
      }
      else {
        $param = $id_roadmap;
        $keyConsulta = "arquivo_origem";
      }

      $cabecalhoCompleto = $cabecalho."=".$param;

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>".$LANG['143']."</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<form action='roadmaps.php?".$cabecalho."=".$param."' method='post' multipart='' enctype='multipart/form-data'>
                
                  <div class='row'>
                    <div class='col-xl-6 col-lg-6'>
                      <div class='col-xl-6 col-lg-7'>
                        <h5>".$LANG['21'].":</h5>
                          <input type='text' id='anoProspec' name='anoProspec' value='' placeholder='".$LANG['147']."...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')' required />
                      </div>
                      </br>
                      <div class='col-xl-12 col-lg-12'>
                        <h5>".$LANG['144'].":</h5>
                          <textarea rows='9' type='text' id='infoProspec' name='infoProspec' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required></textarea>
                      </div>
                      </br>
                    </div>

                    <div class='col-xl-6 col-lg-6'>
                      <div class='col-xl-12 col-lg-12'>
                        <h5>".$LANG['145'].":</h5>
                          <input type='text' id='nomeArquivoAdicionado' name='nomeArquivoAdicionado' value='' placeholder='".$LANG['146']."...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required />
                        </div>
                      </br>
                      <div class='col-xl-6 col-lg-6'>
                        <h5>".$LANG['72'].":</h5>
                          <input type='text' id='anoArquivoAdicionado' name='anoArquivoAdicionado' value='' placeholder='".$LANG['73']."...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required />
                        </div>
                      </br>
                      <div class='col-xl-12 col-lg-12'>
                        <div class='row'>
                          <div class='col-sm-8'><h5>".$LANG['74'].":</h5></div>
                          <div class='col-sm-4'>
                              <button type='button' class='btn btn-info add-new'><i class='fa fa-plus'></i> ".$LANG['75']."</button>
                          </div>
                        </div>
                        
                        <div style='max-height:160px; overflow:auto;'>
                          <table id='tableAutores' class='table table-bordered' style='border-collapse: collapse; border: none;'>
                            <tbody>
                              <tr style='display:none;'>
                                <td></td>
                                <td></td>
                                <td>
                                  <a class='add' title='Add'><img src='img/add2.png' title='".$LANG['75']."' style='width: 20px; height: 20px; display: inline-block; opacity: 70%; cursor: pointer;'/></a>
                                  <a class='edit' title='Edit'><img src='img/editar7.png' title='".$LANG['84']."' style='width: 18px; height: 18px; display: inline-block; opacity: 70%; cursor: pointer;'/></a>
                                  <a class='delete' title='Delete'><img src='img/deletar2.png' title='".$LANG['83']."' style='width: 18px; height: 18px; display: inline-block; opacity: 70%; cursor: pointer;'/></a>
                                </td>
                              </tr>           
                            </tbody>
                          </table>
                        </div>
                      </div>  

                      <input type='text' id='autoresStringAdd' name='autoresStringAdd' value='' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' style='display:none;'>
                    
                      </br>

                      <div class='col-xl-12 col-lg-12'>
                    <div>
                      <div style='float:left'>
                        <h5>".$LANG['76'].":</h5>
                      </div>   
                      <div style='float:left; margin-top:-7px; margin-left:5px;'>
                        <div class='rating'>
                            <input type='radio' id='optionadicionar5' name='rate' value='5' required/><label for='optionadicionar5' title='".$LANG['5000']."'></label>
                            <input type='radio' id='optionadicionar4' name='rate' value='4' /><label for='optionadicionar4' title='".$LANG['4000']."'></label>
                            <input type='radio' id='optionadicionar3' name='rate' value='3' /><label for='optionadicionar3' title='".$LANG['3000']."'></label>
                            <input type='radio' id='optionadicionar2' name='rate' value='2' /><label for='optionadicionar2' title='".$LANG['2000']."'></label>
                            <input type='radio' id='optionadicionar1' name='rate' value='1' /><label for='optionadicionar1' title='".$LANG['1000']."'></label>
                        </div>
                      </div> 
                    </div>
                  </div>
                  
                 
                      </div>
                    
                    

                    <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_roadmap."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                    <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                    <input type='text' id='cabecalhoCompleto' name='cabecalhoCompleto' class='form-control bg-light border-0 small' value='".$cabecalhoCompleto."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                    <input type='text' id='keyConsulta' name='keyConsulta' class='form-control bg-light border-0 small' value='".$keyConsulta."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                    <input type='text' id='assuntoAdd' name='assuntoAdd' class='form-control bg-light border-0 small' value='".$assuntoAdd."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                
                    <div class='py-3' style='width: 100%; text-align: center;'>
                      <div style='display: inline-block;'>
                        <input class='btn btn-primary btn-icon-split' type='submit' name='salvarAdicionarRoadmap' value='".$LANG['78']."' style='width: 8em; height: 2em; display: inline-block;' />
                      </div>
                    </div>
                </div>
                
                </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>".$LANG['79']."</button>
            </div>
          </div>";

  ?>

<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#tableAutores td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("#tableAutores tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="<?php echo $LANG['82']; ?>..." style="width: 100%; font-size: 1rem;"></td>' +
            '<td><input type="text" class="form-control" name="nome" id="nome" placeholder="<?php echo $LANG['3']; ?>..." style="width: 100%; font-size: 1rem;"></td>' +
			'<td style="width: 5rem;">' + actions + '</td>' +
        '</tr>';
    	$("#tableAutores").append(row);		
		$("#tableAutores tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
        if (this.id.indexOf("sobrenome") > -1) 
				  $(this).parent("td").html($(this).val());
        else
          $(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});

function getAutoresToString(){
  var autores = "";
  x = document.getElementById("tableAutores").rows.length;

  for(i=1;i<x;i++){
    var tr = document.getElementById("tableAutores").getElementsByTagName("tr")[i];
    
    for(j=0;j<2;j++){
      var td = tr.getElementsByTagName("td")[j];
      if (td.innerHTML.indexOf("<") == -1 && td.innerHTML !== "") {
        if(j==0)
          autores += td.innerHTML + ", "; //Sobrenome
        else
          autores += td.innerHTML + "; "; //Nome
      }    
    }
  }
  //console.log(autores);
  return autores;
}

$("#tableAutores").bind("DOMSubtreeModified", function() {
  document.getElementById("autoresStringAdd").value = getAutoresToString();
});

</script>

 






