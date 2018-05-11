<?php

 $total_reg = 4;

 $pagina=isset($_GET['pagina'])!=null?$_GET['pagina']:1;
 $txtbusca=isset($_GET['txtbusca'])!=null?$_GET['txtbusca']:"Busque pelo nome da OSCIP ou palavra chave";
 $txtbuscabd = ($txtbusca=="Busque pelo nome da OSCIP ou palavra chave" || $txtbusca=="")?null:$txtbusca;
 $inicio = $pagina - 1;
 $inicio = $inicio * $total_reg;
	 
 if(isset($_GET['pagina'])==""){
	 $atvrand = true;
 }else{
	 $atvrand = false;
 }

 $con = Conexao::dbConnect();
 $totaloscips =  Meta::getTotalArrMetaGeralOscip($con, "AJU", $txtbuscabd);
 $rsOscBD = Meta::getArrMetaGeralOscip($con, "AJU", $atvrand, $inicio, $total_reg, $txtbuscabd);
 $rsEdtBD = Meta::getArrMetaGeral($con, "EDT");	
 $rsMetBD = Meta::getArrMeta($con, "SIT");	

 $totalpaginas = ceil(($totaloscips / $total_reg));
 
 $anterior = ($pagina==1)?1:$pagina -1;
 $proxima = ($pagina==$totalpaginas)?$totalpaginas:$pagina +1;
			 
?> 
<script>
		function buscar(){
			if(form1.txtbusca.value == "Busque pelo nome da OSCIP ou palavra chave" || form1.txtbusca.value == ""){
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
			document.getElementById("postit2").style.display="none";
	  }	
</script>
<!-- BODY PARTICIPACAO -->
	<? if(isset($_GET['pagina']) == null) { ?>
		<div id="postit2">Veja como participar junto às OSCIPs mediante doações, voluntariado e oportunidades em geral. Também acompanhe os editais e demais veículos culturais.</div>
	<? } ?>		
		<table id="tbbody2" border="0">
			<tr>
				<td>
					<div id="titulo4">Editais e Participação</div>
					<div id="line1">&nbsp;</div>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td >
					<table border="0" width="600" >
						<form name="form1" method="get" action="particip.php">
			    		<input type="hidden" name="pagina" value="<?=$pagina?>">
						<tr>
							<td colspan="2"><div style="padding-left: 10px"><input id="txtsearch" name="txtbusca" value="<?=$txtbusca?>" onClick="this.value='';"><button id="btnsearch" onClick="buscar()" on onKeyDown="buscar()">BUSCAR</button></div><div>&nbsp;</div></td>
						</tr>
						</form>
						<?php
							
							if($rsOscBD != null){
			
								while ($rsOsc = mysqli_fetch_assoc($rsOscBD)) {

									$logoimg = $rsOsc['logo']!=null?$rsOsc['logo']:"not_found.png";
									$texto = $rsOsc['texto']!=null?$rsOsc['texto']:"(Objetivo não encontrado)";
						?>
			        	<tr>
				        	<td width="10%" style="padding-left: 10px">
				        		<img src="img/<?=$logoimg?>" width="120" border=1>
							</td>
				        	<td width="60%" style="padding-left: 10px">
								<div id="titulo5"><?=$rsOsc['nome']?></div>
								<div id="texto2"><?=Meta::montarLink($texto, "link1")?></div>
			    				<div><a href="<?=$rsOsc['fonte']?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a></div>
				    		</td>		
					    </tr>
					    <tr><td colspan="2"><div id="line3">&nbsp;</div></td></tr>
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
				<td width="40%" align="center">
					<table width="100%" border="0" cellpadding="2">
						<tr><td align="center"><div id="destaque" align="center">EDITAIS DE CULTURA</div></td></tr>
						<?php
							$cont = 1;
			
							while ($rsEdt = mysqli_fetch_assoc($rsEdtBD)) {
								
								$texto = $rsEdt['nome']!=null?$rsEdt['nome']." - ed".$rsEdt['idmeta']:$rsEdt['texto'];
						?>						
						<tr><td align="center"><a href="<?=$rsEdt['fonte']?>" target="_blank" id="link2">.: <?=$texto?> :.</a></td></tr>
						<?
							}
						?>		
						<tr><td align="center"><div id="destaque" align="center">PORTAIS DE CULTURA</div></td></tr>
						<tr><td align="center">
						<div>&nbsp;</div>
						<div>
						<?php

							while ($rsMet = mysqli_fetch_assoc($rsMetBD)) {
						?>		
							<a href="<?=$rsMet['fonte']?>" target="_blank"><img src="img/<?=$rsMet['imagem']?>" title="<?=$rsEdt['texto']?>" width="100" style="padding: 5px"></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<?	}?>
						</div></td></tr>
					</table>
				</td>
			</tr>		
		</table> 
<!-- END BODY OSCIPS -->