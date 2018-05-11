<?php
	
	$idnot = isset($_GET['id'])!=null?$_GET['id']:null;

	if($idnot == null){
		header("location:noticias.php");
	}

    $con = Conexao::dbConnect();
	$rs =  Noticia::getNoticia($con, $idnot);

	$imagem = $rs['imagem']!=null?$rs['imagem']:"not_found.png";
    $data = strtoupper(strftime('%d/%m', strtotime($rs['data'])));

?>
	<!-- BODY NOTICIA DETALHE -->
		<table id="tbbody2" border="0" style="padding: -10px">
			<tr>
				<td>
					<div id="titulo6"><a href="./noticias.php" id="titulo4">Notícias</a> > <?=$rs['titulo']?></div>
					<div id="line1">&nbsp;</div>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<table border="0" width="900" cellpadding="0" cellspacing="0">
						<tr>
				        	<td  id="titulo2" colspan="2">
				        		<?=$data?> - <?=$rs['nome']?>
				    		</td>		
					    </tr>					    
						<tr>
							<td align="center" colspan="2"><img src="img/<?=$imagem?>" width="500"></td>
						</tr>
						<tr>
				        	<td colspan="2" style="padding: 10px">
								<div id="texto1"><?=$rs['texto']?></div>
				    		</td>		
					    </tr>
					    <tr><td colspan="2" style="padding: 10px"><a href="<?=$rs['fonte']?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20"> </div></td></tr>
					</table>
					<div>
						&nbsp;
					</div>
				</td>
			</tr>		
		</table> 
<!-- FIM BODY NOTICIA DETALHE -->