<?php

 $total_reg = 6;

 $pagina=isset($_GET['pagina'])!=null?$_GET['pagina']:1;
 $txtbusca=isset($_GET['txtbusca'])!=null?$_GET['txtbusca']:"Busque pelo nome da OSCIP";
 $txtbuscabd = ($txtbusca=="Busque pelo nome da OSCIP" || $txtbusca=="")?null:$txtbusca;
 $inicio = $pagina - 1;
 $inicio = $inicio * $total_reg;
	 
 if(isset($_GET['pagina'])==""){
	 $atvrand = true;
 }else{
	 $atvrand = false;
 }
 
 $con = Conexao::dbConnect();
 $totaloscips =  Oscip::getTotalOscips($con, $txtbuscabd);
 $rsOscBD = Oscip::getOscips($con, $atvrand, $inicio, $total_reg, $txtbuscabd);

 //echo $totaloscips;

 $totalpaginas = ceil(($totaloscips / $total_reg));
 
 $anterior = ($pagina==1)?1:$pagina -1;
 $proxima = ($pagina==$totalpaginas)?$totalpaginas:$pagina +1;
			 
?> 
<!-- BODY OSCIPS --> 
	    <script>
				function buscar(){
					if(form1.txtbusca.value == "Busque pelo nome da OSCIP" || form1.txtbusca.value == ""){
						form1.txtbusca.value= "";
					}
					
					form1.pagina.value = 1;
					form1.submit();
				}
			
			   function paginacao (pag){
					form1.pagina.value = pag;
					form1.submit();
			   }
			function byepost (){
				document.getElementById("postit").style.display="none";
			}
				
		</script>
	    <? if(isset($_GET['pagina']) == null) { ?>
	    	<div id="postit">Aqui se encontra a relação das OSCIPs de Cultura do RJ. Clique na OSCIP desejada para saber mais sobre a instituição.</div>
	    <? } ?>	
		<table id="tbbody2" border="0">
			<tr>
				<td>
					<div id="titulo4">Conheça as OSCIPs</div>
					<div id="line1">&nbsp;</div>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<table border="0" width="800" >
					    <form name="form1" method="get" action="oscips.php">
						<tr>
							<td colspan="2"><div style="padding-left: 10px"><input id="txtsearch" name="txtbusca" value="<?=$txtbusca?>" onClick="this.value='';"><button id="btnsearch" onClick="buscar()" on onKeyDown="buscar()">BUSCAR</button></div><div>&nbsp;</div></td>
							<input type="hidden" name="pagina" value="<?=$pagina?>">
						</form>	
						</tr>
						<?php
							$cont = 1;
							
							if($rsOscBD != null){												   
								while ($rsOsc = mysqli_fetch_assoc($rsOscBD)) {

									$logoimg = $rsOsc['logo']!=null?$rsOsc['logo']:"not_found.png";
									$texto = $rsOsc['texto']!=null?$rsOsc['texto']:"(Objetivo não encontrado)";
						?>
			        	<tr>
				        	<td valign="top" width="10%" align="center">
				        		<img src="img/<?=$logoimg?>" width="120" border=1>
							</td>
				        	<td width="60%">
								<div id="titulo5"><?=$rsOsc['nome']?></div>
								<div id="texto2"><?=$texto?></div>
								<div id="texto1"><a href="./oscipdetalhe.php?id=<?=$rsOsc['idoscip']?>" id="link2">+ Veja Mais</a></div>
				    		</td>		
					    </tr>
					    <tr><td colspan="2"><div id="line3">&nbsp;</div></td></tr>
					    <?php
								} //end while
							}else{
								echo "<tr><td colspan=2 id=texto1>Não foram encontrados resultados para a busca.</td></tr><tr><td>&nbsp;</td></tr>";
							} 
						?>		
						
					</table>
					<div align="center">
						<a href="#" onClick="paginacao(<?=$anterior?>);" id="link1" style="padding-right:0px">< Anterior</a>
						<span id="texto1">| Página <?=$pagina?> de <?=$totalpaginas?> |</span>
						<a href="#" onClick="paginacao(<?=$proxima?>);" id="link1" style="padding-right:0px">Próxima ></a>
					</div>
					<div>
						&nbsp;
					</div>
				</td>
			</tr>		
		</table> 
<!-- END BODY OSCIPS -->