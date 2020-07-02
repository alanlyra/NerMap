<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

  <?php 
      $id_arquivo = $_POST["identificador"];
      $nome_arquivo = $_POST["nomearquivo"];
      $ano_arquivo= $_POST["anoarquivo"];
      $conf_arquivo = $_POST["confarquivo"];
      $autores_arquivo = $_POST["autoresarquivo"];

      $number1 = get_data("SELECT id_prospec_arquivo FROM arquivos WHERE id_arquivo =".intval($id_arquivo));
      $row = pg_fetch_array($number1);        
      $id_prospec = $row[0]; 

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>".$LANG['92']."</h4>
              <button type='button' class='close' onclick='hideModalEdicaoArquivo();'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data'>
                
                  <div class='col-xl-12 col-lg-12'>
                  <h5>".$LANG['70'].":</h5>
                    <input type='text' id='nomeArquivo' name='nomeArquivo' placeholder='".$LANG['71']."' value='".$nome_arquivo."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>
                  </div>
                  </br>
                  <div class='col-xl-6 col-lg-7'>
                  <h5>".$LANG['72'].":</h5>
                    <input type='text' id='anoArquivo' name='anoArquivo' placeholder='".$LANG['72']."' value='".$ano_arquivo."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')' required>
                  </div>
                  </br>

                  <div class='col-xl-12 col-lg-12'>
                    <div id='divAdicionarAutirTitle' class='row'>
                      <div class='col-sm-8'><h5>".$LANG['74'].":</h5></div>
                      <div class='col-sm-4'>
                          <button id='adicionarAutorButton' type='button' class='btn btn-info add-new'><i class='fa fa-plus'></i> ".$LANG['75']."</button>
                      </div>
                    </div>

                    <div style='max-height:160px; overflow:auto;'>
                      <table id='tableAutoresEdicao' class='table table-bordered' style='border-collapse: collapse; border: none;'>
                        <tbody id='tbodyAutoresEdicao'>
                          <tr style='display:none;'>
                            <td></td>
                            <td></td>
                            <td>
                              <a id='adicionarAutorConfirm' class='add' title='Add'><img id='adicionarAutorConfirm2' src='img/add2.png' title='".$LANG['74']."' style='width: 20px; height: 20px; display: inline-block; opacity: 70%; cursor: pointer;'/></a>
                              <a class='edit' title='Edit'><img src='img/editar7.png' title='".$LANG['84']."' style='width: 18px; height: 18px; display: inline-block; opacity: 70%; cursor: pointer;'/></a>
                              <a class='delete' title='Delete'><img src='img/deletar2.png' title='".$LANG['83']."' style='width: 18px; height: 18px; display: inline-block; opacity: 70%; cursor: pointer;'/></a>
                            </td>
                          </tr>           
                        </tbody>
                      </table>
                      </div> 
                    </div>  

                  <input type='text' id='autoresEdicaoString' name='autoresEdicaoString' value='' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' style='display:none;'>

                  </br>

                  <div class='col-xl-12 col-lg-12'>
                    <div>
                      <div style='float:left'>
                        <h5>".$LANG['76'].":</h5>
                      </div>   
                      <div style='float:left; margin-top:-7px; margin-left:5px;'>
                        <div class='rating'>
                            <input type='radio' id='optioneditar5' name='confArquivo' value='5' required/><label for='optioneditar5' title='".$LANG['5000']."'></label>
                            <input type='radio' id='optioneditar4' name='confArquivo' value='4' /><label for='optioneditar4' title='".$LANG['4000']."'></label>
                            <input type='radio' id='optioneditar3' name='confArquivo' value='3' /><label for='optioneditar3' title='".$LANG['3000']."'></label>
                            <input type='radio' id='optioneditar2' name='confArquivo' value='2' /><label for='optioneditar2' title='".$LANG['2000']."'></label>
                            <input type='radio' id='optioneditar1' name='confArquivo' value='1' /><label for='optioneditar1' title='".$LANG['1000']."'></label>
                        </div>
                      </div> 
                    </div>
                  </div>
                  
                  </br>
                  </br>
                   

                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

               
             
                <div class='py-3' style='text-align: center;'>

                <a href='#' data-target='#modalConfirmarDeleteArquivo' data-toggle='modal' data-id='deleteprospec-".$id_prospec."' data-deletearquivo='".$id_arquivo."' style='display: inline-block; margin-right:3px;'><button class='btn btn-danger btn-icon-split' value='Remover' style='width: 8em; height: 2em; display: inline-block;'><i class='fas fa-trash fa-sm text-white-50'></i>     ".$LANG['101']."</button></a>
                  
                
                <input class='btn btn-primary btn-icon-split' type='submit' name='salvarEdicaoArquivo' value='".$LANG['103']."' style='width: 8em; height: 2em; display: inline-block;' />

                  </br>
                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' onclick='hideModalEdicaoArquivo();'>".$LANG['79']."</button>
            </div>
          </div>";

  ?>

<div id="modalEditarArquivo" class="modal fade" role="dialog" style="top: 1vh;">
    <div id="edicao-arquivo" class="modal-dialog">
      <!-- Modal content-->
      
    </div>
  </div>

  <script>

    function hideModalEdicaoArquivo() {
      $('#modalEditarArquivo').modal('hide');
    }

    var conf_arquivo_JS = "<?php echo $conf_arquivo; ?>";
     document.getElementById("optioneditar"+conf_arquivo_JS).click()
      //document.getElementById("divOption-"+conf_arquivo_JS).click();

    var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
          	data_id = $(this).data('id');
          }      

          if (typeof $(this).data('deletearquivo') !== 'undefined') {
            data_deletearquivo = $(this).data('deletearquivo');
          }

          var data_txt =  data_id.toString();
          var data_id_deleteprospec = data_txt.replace('deleteprospec-','');
          
          if (data_txt.indexOf('deleteprospec-') > -1) {
            $.ajax({
              url: "modal-confirma-delete-arquivo.php",
              method: "POST",
              data: { "identificador": data_id_deleteprospec,
                      "arquivo": data_deletearquivo},
              success: function(html) {
                $('#delete-arquivo').html(html);
                $('#modalConfirmarDeleteArquivo').modal('show');
              }
            })
          } 
        })
    });

  </script>

<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#tableAutoresEdicao td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("#tableAutoresEdicao tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="sobrenomeEdit" id="sobrenomeEdit" placeholder="<?php echo $LANG['82']; ?>..." style="width: 100%; font-size: 1rem;"></td>' +
            '<td><input type="text" class="form-control" name="nomeEdit" id="nomeEdit" placeholder="<?php echo $LANG['3']; ?>..." style="width: 100%; font-size: 1rem;"></td>' +
			'<td style="width: 5rem;">' + actions + '</td>' +
        '</tr>';
    	$("#tableAutoresEdicao").append(row);		
		$("#tableAutoresEdicao tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
        if (this.id.indexOf("sobrenomeEdit") > -1) 
				  $(this).parent("td").html($(this).val());
        else
          $(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
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
  x = document.getElementById("tableAutoresEdicao").rows.length;

  for(i=1;i<x;i++){
    var tr = document.getElementById("tableAutoresEdicao").getElementsByTagName("tr")[i];
    
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

  $("#tableAutoresEdicao").bind("DOMSubtreeModified", function() {
    document.getElementById("autoresEdicaoString").value = getAutoresToString();
  });

  $(document).ready(function() {

    var autoresJS = "<?php echo $autores_arquivo; ?>";

    pieces_autoresJS = autoresJS.split(";");

    for(i=0; i<pieces_autoresJS.length; i++) {

      sn = pieces_autoresJS[i].split(",");
      if(sn[0] != " " && sn[1] != " " && sn[0] != "" && sn[1] != "") {
        addRow(sn[0].trim(), sn[1].trim());
      }  
    }
    
  });

  function addRow(sobrenome, nome){
    window.setTimeout(function() {
      document.getElementById("adicionarAutorButton").click();
      document.getElementById("sobrenomeEdit").value = sobrenome;
      document.getElementById("nomeEdit").value = nome;
      $('#tbodyAutoresEdicao').find('a.add:last').trigger('click');
    }, 5);

  }


</script>






