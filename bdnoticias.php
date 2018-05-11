<?php


 $total_reg = 5;

 $pagina=isset($_GET['pagina'])!=null?$_GET['pagina']:1;
 $txtbusca=isset($_GET['txtbusca'])!=null?$_GET['txtbusca']:"Busque pelo título/descrição da notícia ou pela OSCIP";
 $txtbuscabd = ($txtbusca=="Busque pelo título/descrição da notícia ou pela OSCIP" || $txtbusca=="")?null:$txtbusca;
 $inicio = $pagina - 1;
 $inicio = $inicio * $total_reg;
	 
 if(isset($_GET['pagina'])==""){
	 $atvrand = true;
 }else{
	 $atvrand = false;
 }

 $con = Conexao::dbConnect();
 $totalnoticias =  Noticia::getTotalNoticias($con, $txtbuscabd);
 $rsNotBD = Noticia::getNoticias($con, $atvrand, $inicio, $total_reg, $txtbuscabd);

 $totalpaginas = ceil(($totalnoticias / $total_reg));
 
 $anterior = ($pagina==1)?1:$pagina -1;
 $proxima = ($pagina==$totalpaginas)?$totalpaginas:$pagina +1;
			 
?>
<script>
		function buscar(){
			if(form1.txtbusca.value == "Busque pelo título/descrição da notícia ou pela OSCIP" || form1.txtbusca.value == ""){
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
<!-- BODY NOTICIAS -->
<? if(isset($_GET['pagina']) == null) { ?>
	<div id="postit">Acompanhe as últimas notícias e demais informações culturais disponibilizada pelas OSCIPs.</div>
<? } ?>		
		<table id="tbbody2" border="0">
			<tr>
				<td>
					<div id="titulo4">Notícias</div>
					<div id="line1">&nbsp;</div>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<table border="0" width="900" >
						<form name="form1" method="get" action="noticias.php">
			    		<input type="hidden" name="pagina" value="<?=$pagina?>">
						<tr>
							<td colspan="2"><div style="padding-left: 10px"><input id="txtsearch" name="txtbusca"  onClick="this.value='';" value="<?=$txtbusca?>"><button id="btnsearch" onClick="buscar()" on onKeyDown="buscar()">BUSCAR</button></div><div>&nbsp;</div></td>
						</tr>
						</form>
						<?php
							
							if($rsNotBD != null){
								while ($rsNot = mysqli_fetch_assoc($rsNotBD)) {

									$imagem = $rsNot['imagem']!=null?$rsNot['imagem']:"not_found.png";
									$texto = $rsNot['texto']!=null?substr($rsNot['texto'], 0, 350)."(...)":"(Texto não encontrado)";

									$data = strftime('%d de %B de %Y', strtotime($rsNot['data']));
						?>
			        	<tr>
				        	<td valign="top" width="10%" align="right" style="vertical-align: middle;padding: 2px">
				        		<img src="img/<?=$imagem?>" width="170" height="110">
							</td>
				        	<td width="70%">
				        		<div id="titulo3"><?=$data?></div>
				        		<div id="titulo2"><?=$rsNot['titulo']?></div>
								<div id="texto3"><?=$rsNot['nome']?></div>
								<div id="texto1"><?=$texto?></div>
								<div id="texto1"><a href="./noticiadetalhe.php?id=<?=$rsNot['idmeta']?>" id="link2">+ Veja Mais</a></div>
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
			</tr>		
		</table> 
<!-- FIM BODY NOTICIAS -->