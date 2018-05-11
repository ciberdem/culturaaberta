<?php

 $con = Conexao::dbConnect();
 $rsPrjBD = Projeto::getRandom3($con);
 $rsNotBD = Noticia::getRandom3($con);

?> 
<table id="tbbody2" border="0" cellpadding="1" cellspacing="0">
<tr>
	<td width="60%">
		<a href="./sobre.php" id="link1"><img src="img/cliqueaqui2.png" width="350" height="25"></a>
	</td>
	<td width="40%"><div id="destaque" align="center">DESTAQUE</div></td>
</tr>
<tr valign="top">
	<td width="60%">
		<div id="titulo1">Conheça os Projetos e Convênios</div>
		<div id="line1">&nbsp;</div>
		<!-- SLIDER DE PROJETOS DO SITE EM DESTAQUE -->
		<ul class="slides">
		<?php
			$cont = 1;
			
			while ($rsPrj = mysqli_fetch_assoc($rsPrjBD)) {
				
			if($cont == 1){
				$imgidx1 = "img-3";
				$imgidx2 = "img-2";
			}else if($cont == 2){
				$imgidx1 = "img-1";
				$imgidx2 = "img-3";				
			}else if($cont == 3){
				$imgidx1 = "img-2";
				$imgidx2 = "img-1";		
			}	
			
			$texto = $rsPrj['descricao']!=null?substr($rsPrj['descricao'], 0, 400)."(...)":"(Texto não encontrado)";
				
			$imagem = ($rsPrj['pathimg2']!=null)?$rsPrj['pathimg2']:$rsPrj['pathimg'];	
		?>	
			<!-- SLIDE<?=$cont?> -->
			<input type="radio" name="radio-btn" id="img-<?=$cont?>" checked />
			<li class="slide-container">
				<div class="slide">
					<a href="./projetodetalhe.php?id=<?=$rsPrj['id']?>">
						<img src="img/<?=$imagem?>" />
						<h2><?=$rsPrj['sigla']?>: <?=$rsPrj['objetivo']?></h2>	
						
					</a>
					<div id="texto3" style="padding-top: 10px; padding-left: 3px"> <?=$texto?></div>
				</div>
				<div class="nav">
					<label for="<?=$imgidx1?>" class="prev">&#x2039;</label>
					<label for="<?=$imgidx2?>" class="next">&#x203a;</label>
				</div>
			</li>
		<?php
				$cont++; 
			}
		?>
			<!-- DOTS PARA NAVEGAÇÃO -->
			<li class="nav-dots">
			  <label for="img-1" class="nav-dot" id="img-dot-1"></label>
			  <label for="img-2" class="nav-dot" id="img-dot-2"></label>
			  <label for="img-3" class="nav-dot" id="img-dot-3"></label>
			</li>
		</ul>   
		
	</td>
	<td>
		
		<!-- NOTICIAS EM DESTAQUE -->
		<?php
			$cont = 1;
			
			while ($rsNot = mysqli_fetch_assoc($rsNotBD)) {
				
				$data = strftime('%d de %B de %Y', strtotime($rsNot['data']));
				$imagem = $rsNot['imagem']!=null?$rsNot['imagem']:"not_found.png";
				
		?>
				
		<div id="titulo3"><?=$data?> <img src="img/<?=$imagem?>" style="float:right; padding: 10px;padding-right: 20px" width="100" height="70"></div>
		<div id="divfonte"><?=$rsNot['nome']?></div>
		<div id="texto2"><b><?=$rsNot['titulo']?></b></div>
		<div id="texto2"><?=substr($rsNot['texto'],0,170)?> (...) </div>
		<div id="link2"><a href="./noticiadetalhe.php?id=<?=$rsNot['idmeta']?>" id="link2"> + Leia mais</a></div>
		<div id="line2">&nbsp;</div>
		
		<?
			}
		?>
		
		<!-- FIM NOTICIAS EM DESTAQUE -->
		
	</td>
</tr>		
</table> 