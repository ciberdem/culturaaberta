<?php

 $total_reg = 5;

 $pagina=isset($_GET['pagina'])!=null?$_GET['pagina']:1;
 $txtbusca=isset($_GET['txtbusca'])!=null?$_GET['txtbusca']:"Busque pelo título ou descrição dos dados";
 $txtbuscabd = ($txtbusca=="Busque pelo título ou descrição dos dados" || $txtbusca=="")?null:$txtbusca;
 $inicio = $pagina - 1;
 $inicio = $inicio * $total_reg;
	 
 if(isset($_GET['pagina'])==""){
	 $atvrand = true;
 }else{
	 $atvrand = false;
 }

 $con = Conexao::dbConnect();
 $totalmeta = Meta::getTotalArrMetaFiltro($con, 'OPD', $txtbuscabd);
 $rsBD = Meta::getArrMetaPg($con, 'OPD', $atvrand, $inicio, $total_reg, $txtbuscabd);

 $totalpaginas = ceil(($totalmeta / $total_reg));
 
 $anterior = ($pagina==1)?1:$pagina -1;
 $proxima = ($pagina==$totalpaginas)?$totalpaginas:$pagina +1;
			 
?> 
<script>
		function buscar(){
			if(form1.txtbusca.value == "Busque pelo título ou descrição dos dados" || form1.txtbusca.value == ""){
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
<!-- BODY OSCIPS -->
<? if(isset($_GET['pagina']) == null) { ?>
	<div id="postit">Informações das OSCIPs, projetos, editais e sites de cultura estão disponíveis para download em formato aberto.</div>
<? } ?>		
		<table id="tbbody2" border="0">
			<tr>
				<td>
					<div id="titulo4">Dados Abertos</div>
					<div id="line1">&nbsp;</div>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<table border="0" width="800" >
						<form name="form1" method="get" action="dados.php">
			    		<input type="hidden" name="pagina" value="<?=$pagina?>">
						<tr>
							<td colspan="2"><div style="padding-left: 10px"><input id="txtsearch" name="txtbusca" onClick="this.value='';" value="<?=$txtbusca?>"><button id="btnsearch" onClick="buscar()" on onKeyDown="buscar()">BUSCAR</button></div><div>&nbsp;</div></td>
						</tr>
						</form>
						<?php
							
							if($rsBD != null){
								while ($rs = mysqli_fetch_assoc($rsBD)) {

									$data = strftime('%d/%m/%Y', strtotime($rs['data']));
						?>
			        	<tr>
				        	<td style="padding-left: 10px">
								<div id="titulo5"><?=$rs['titulo']?></div>
								<div id="texto2"><?=$rs['texto']?></div>
								<div id="texto3">Última atualização: <?=$data?></div>
								<div style="padding: 5px">
									<a href="./dados/<?=$rs['imagem'].".csv"?>" target="_blank" id="btncsv" >CSV</a>&nbsp;
									<a href="./dados/<?=$rs['imagem'].".xml"?>" target="_blank" id="btnxml">XML</a>&nbsp;
									<a href="./dados/<?=$rs['imagem'].".json"?>" target="_blank" id="btnjson">JSON</a>&nbsp;
									<a href="./dados/<?=$rs['imagem'].".html"?>" target="_blank" id="btnpdf">HTML</a>
			    				</div>
				    		</td>		
					    </tr>
					    <tr><td colspan="2" style="padding-left: 10px"><div id="line3">&nbsp;</div></td></tr>
					    <?php
								}
								
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