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
        	                       <td><div style='text-align: center;'>";
                                if($result->status_ren_prospec != "null")
                                  echo "<img src='img/".$result->status_ren_prospec.".png' style='width: 20px; height: 20px; display: inline-block;'/>";
                                echo "</div></td>
                                <td><a href='#' data-target='#myModal' data-toggle='modal' data-id='".$result->id_prospec."'><div style='text-align: center;'><img src='img/file_add.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                               
                                <td><a href='#' data-target='#modalArquivos' data-toggle='modal' data-id='arquivos-".$result->id_prospec."'><div style='text-align: center;'><img src='img/ver_arquivos.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>

                                <td><a href='/seeroadmap.php?roadmap=".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                <td>
                                <form action='prospeccoes.php?roadmap=".$result->id_prospec."' method='post' multipart='' enctype='multipart/form-data' style='text-align: center;'>
                                <button style='border: 0; background: transparent' type='submit' name='deleteProspec' value=''> <img src='/img/deletar2.png' width='20px' height='20px'/></button >
                                </form>
                                </td>
      	                      </tr>";
      		                	}
      						  }
      						}
      						
              	?>