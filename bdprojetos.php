<?php


 $total_reg = 5;

 $pagina=isset($_GET['pagina'])!=null?$_GET['pagina']:1;
 $txtbusca=isset($_GET['txtbusca'])!=null?$_GET['txtbusca']:"Busque pelo nome, descrição do projeto ou OSCIP";
 $txtbuscabd = ($txtbusca=="Busque pelo nome, descrição do projeto ou OSCIP" || $txtbusca=="")?null:$txtbusca;
 $inicio = $pagina - 1;
 $inicio = $inicio * $total_reg;
	 
 if(isset($_GET['pagina'])==""){
	 $atvrand = true;
 }else{
	 $atvrand = false;
 }

 $con = Conexao::dbConnect();
 $totalprojetos =  Projeto::getTotalProjetos($con, $txtbuscabd);
 $rsPrjBD = Projeto::getProjetos($con, $atvrand, $inicio, $total_reg, $txtbuscabd);

 $totalpaginas = ceil(($totalprojetos / $total_reg));
 
 $anterior = ($pagina==1)?1:$pagina -1;
 $proxima = ($pagina==$totalpaginas)?$totalpaginas:$pagina +1;

?>
<script>
function buscar(){
	if(form1.txtbusca.value == "Busque pelo nome, descrição do projeto ou OSCIP" || form1.txtbusca.value == ""){
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
<!-- BODY PROJETOS -->
<? if(isset($_GET['pagina']) == null) { ?>
	<div id="postit">Aqui se encontra os projetos e convênios das OSCIPs em andamento. Clique no projeto desejado para saber mais.</div>
<? } ?>			
<table id="tbbody2" border="0">
	<tr>
		<td>
			<div id="titulo4">Projetos e Convênios</div>
			<div id="line1">&nbsp;</div>
		</td>
	</tr>
	<tr valign="top">
		<td>
			<table border="0" width="900" >
			    <form name="form1" method="get" action="projetos.php">
			    <input type="hidden" name="pagina" value="<?=$pagina?>">
				<tr>
					<td colspan="2"><div style="padding-left: 12px"><input id="txtsearch" name="txtbusca"  onClick="this.value='';" value="<?=$txtbusca?>"><button id="btnsearch" onClick="buscar()" on onKeyDown="buscar()">BUSCAR</button></div><div>&nbsp;</div></td>
				</tr>
				</form>
				<?php
					if($rsPrjBD != null){	
						
						while ($rs = mysqli_fetch_assoc($rsPrjBD)) {

							$titulo = $rs['objetivo']!=null?$rs['objetivo']:"(Título não encontrado)";
							$imagem = $rs['pathimg']!=null?$rs['pathimg']:"not_found.png";
							$orgao = $rs['orgao']!=null?$rs['orgao']:"(Órgão patrocinador não encontrado)";
							$texto = $rs['descricao']!=null?substr($rs['descricao'], 0, 350)."(...)":"(Texto não encontrado)";

				?>											
				<tr>
					<td valign="top" width="10%" align="right" style="vertical-align: middle;padding: 2px">
						<img src="img/<?=$imagem?>" width="170" height="110">
					</td>
					<td width="60%">
						<div id="titulo5"><?=$titulo?></div>
						<div id="texto2"><?=$rs['nome']?></div>
						<div id="texto3"><?=$orgao?></div>
						<div id="texto2"><?=$texto?></div>
						<div id="texto1"><a href="./projetodetalhe.php?id=<?=$rs['id']?>" id="link2">+ Veja Mais</a></div>
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
<!-- FIM BODY PROJETOS -->		