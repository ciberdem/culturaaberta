<?php
 
 $idoscip = isset($_GET['id'])!=null?$_GET['id']:null;

 $con = Conexao::dbConnect();
 $rsOsc =  Oscip::getOscip($con, $idoscip);
 $rsObj =  Meta::getMeta($con, 'OBJ', $idoscip);
 $rsSrv =  Meta::getMeta($con, 'SRV', $idoscip);
 $rsMbo =  Meta::getMeta($con, 'MBO', $idoscip);
 $rsPua =  Meta::getMeta($con, 'PUA', $idoscip);
 $rsPrf =  Meta::getMeta($con, 'PRF', $idoscip);
 $rsEml =  Meta::getMeta($con, 'EML', $idoscip);
 $rsArrInfra = Meta::getArrMetaOscip($con, 'INF', $idoscip);
 $rsArrAju = Meta::getArrMetaOscip($con, 'AJU', $idoscip);
 $facebook = Oscip::getOscipFacebook($con, $rsOsc['url']);
 $arrHP = Oscip::getOscipHP($con, $rsOsc['url']);

 $logo = $rsOsc['logo']!=null?$rsOsc['logo']:"not_found.png";

 $missao = $rsObj!=null?$rsObj['texto']:"(Fonte não encontrada)";
 $missaoft = $rsObj!=null?$rsObj['fonte']:"(Fonte não encontrada)";
 $missaolnk = $rsObj!=null?$rsObj['fonte']:"#";
 $missaovis = $rsObj!=null?"":"style=\"display: none\""; 

 $srv = $rsSrv!=null?$rsSrv['texto']:"(Fonte não encontrada)";
 $srvft = $rsSrv!=null?$rsSrv['fonte']:"(Fonte não encontrada)";
 $srvlnk = $rsSrv!=null?$rsSrv['fonte']:"#";
 $srvvis = $rsSrv!=null?"":"style=\"display: none\""; 

 $mbo = $rsMbo!=null?$rsMbo['texto']:"(Fonte não encontrada)";
 $mboft = $rsMbo!=null?$rsMbo['fonte']:"(Fonte não encontrada)";
 $mbolnk = $rsMbo!=null?$rsMbo['fonte']:"#";
 $mbovis = $rsMbo!=null?"":"style=\"display: none\"";
 $mbo = str_replace("|", "<br>", $mbo);

 $pua = $rsPua!=null?$rsPua['texto']:"(Fonte não encontrada)";
 $puaft = $rsPua!=null?$rsPua['fonte']:"(Fonte não encontrada)";
 $pualnk = $rsPua!=null?$rsPua['fonte']:"#";
 $puavis = $rsPua!=null?"":"style=\"display: none\"";

 $prf = $rsPrf!=null?$rsPrf['texto']:"(Fonte não encontrada)";
 $prfft = $rsPrf!=null?$rsPrf['fonte']:"(Fonte não encontrada)";
 $prflnk = $rsPrf!=null?$rsPrf['fonte']:"#";
 $prfvis = $rsPrf!=null?"":"style=\"display: none\"";

 $eml = $rsEml!=null?$rsEml['texto']:"(Fonte não encontrada)";
 $eml = str_replace("|", "<br>", $eml); 

?>
<!-- BODY OSCIP DETALHE -->
		<table id="tbbody2" border="0">
			<tr>
				<td>
					<div id="titulo6"><a href="./oscips.php" id="titulo4">Oscips</a> > <?=$rsOsc['nome']?></div>
					<div id="line1">&nbsp;</div>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<table id="tboscobody" border="0">
						<tr valign="top">
				        	<td rowspan="2" width="60%">
				        	<div id="titulo5">Objetivo e Missão </div>
				        	<div id="line3"></div>
    						<div id="texto1"><?=$missao?> </div>
	    					<div <?=$missaovis?>><a href="<?=$missaolnk?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
	    					<div>&nbsp;</div>
		    				
		    				<div id="titulo5">Serviços Prestados</div>
		    				<div id="line3"></div>
		    				<div id="texto1"><?=$srv?></div>
		    				<div <?=$srvvis?>><a href="<?=$srvlnk?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
		    				<div>&nbsp;</div>
			    			
			    			<div id="titulo5">Membros</div>
			    			<div id="line3"></div>
		    				<div id="texto1"><?=$mbo?></div>
		    				<div <?=$mbovis?>><a href="<?=$mbolnk?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
		    				<div>&nbsp;</div>
		    				
		    				<div id="titulo5">Público Alvo</div>
		    				<div id="line3"></div>
		    				<div id="texto1"><?=$pua?></div>
		    				<div <?=$puavis?>><a href="<?=$pualnk?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
		    				<div>&nbsp;</div>
		    				
				    		<div id="titulo5">Perfil</div>
				    		<div id="line3"></div>
		    				<div id="texto1"><?=$prf?></div>
		    				<div <?=$prfvis?>><a href="<?=$prflnk?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
		    				<div>&nbsp;</div>
		    				
		    				<div id="titulo5">Infra Estrutura</div>
		    				<div id="line3"></div>
							<?php
	
								$encontrouInfra = false;
							    $i=0;
								while ($rsInfra = mysqli_fetch_assoc($rsArrInfra)) {
									
									$encontrouInfra = true;
									$imagem = $rsInfra['imagem']!=null?$rsInfra['imagem']:"not_found.png";
									$texto = $rsInfra['texto']!=null?$rsInfra['texto']:"(Texto não encontrado)";
									
							?>
								<div id="texto1"><img src="img/<?=$imagem?>" style="float:right;padding: 10px" width="200" height="100"><b><?=$rsInfra['titulo']?></b> - <?=$texto?>
								</div>
								<div><a href="<?=$rsInfra['fonte']?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
								<div>&nbsp;</div>
<?
								 if($i >= 1){
?>								 
								<div>&nbsp;</div>
								<div>&nbsp;</div>
								<div>&nbsp;</div>
								<div>&nbsp;</div>

<?
								  }
									$i++;
								}
								
								
								if(!$encontrouInfra){
									echo "<div id=\"texto1\">(Fonte não encontrada)</div>&nbsp;";
								}
							?>	
		    				<div id="titulo5">Como Ajudar</div>
				    		<div id="line3"></div>

							<?php
	
								$encontrouAju = false;
								while ($rsAju = mysqli_fetch_assoc($rsArrAju)) {
									
									$encontrouAju = true;
									$imagem = $rsAju['imagem']!=null?$rsAju['imagem']:"not_found.png";
									$texto = $rsAju['texto']!=null?$rsAju['texto']:"(Texto não encontrado)";
									
							?>
								<div id="texto1"><b><?=$rsAju['titulo']?></b> - <?=Meta::montarLink($texto, "link1")?>
								</div>
								<div><a href="<?=$rsAju['fonte']?>" target="_blank" id="link2"><img src="img/icon_fonte4.png" alt="Fonte" width="20" height="20" style="padding-top: 5px;"></a> </div>
								<div>&nbsp;</div>
		    				<?
								}
						
								if(!$encontrouAju){
									echo "<div id=\"texto1\">(Fonte não encontrada)</div>&nbsp;";
								}
							?>		    		
		    				
		    				<div id="titulo5">Relatório Anual de Execução de Atividades (Contábil)
	    				    <img src="img/int2.png" width="15" height="15" title="LEI OSCIP (Art. 15B I) - Relatório contábil (de acordo com a CFC 1409/2012 ) apresentando comparativo entre as metas propostas e os resultados alcançados, assinado pelo representante legal da entidade conveniada.">
	    				    </div>
				    		<div id="line3"></div>
		    				<div id="texto1">(Fonte não encontrada)</div>
		    				<div>&nbsp;</div> 						
		    				
		    				<!--  COLUNA DE DADOS DA DIREITA -->
				    		</td>
				    		
					    	<td width="40%">
					    		<table id="tblogoosc" border="0" width="300">
					    			<tr>
										<td>Logo:</td>
				    					<td >
					    					<div ><img src="img/<?=$logo?>" border=1 width="200"  ></div>
					    				</td>
					    			</tr>
					    			<tr><td>CNPJ:</td><td><?=$rsOsc['cnpj']?></td></tr>
					    			<tr><td>Qualificação:</td><td><?=$rsOsc['dataQualif']?></td></tr>
					    			<tr><td>Endereço:</td><td><?=$rsOsc['endereco']?></td></tr>
					    			<tr><td>Telefones:</td><td><?=$rsOsc['telefone']?></td></tr>
					    			<tr><td>Email(s):</td><td><?=$eml?></td></tr>
					    			<tr><td>Referências externas:</td><td>
					    			<? foreach($arrHP as $hp) { ?>
					    				<a href="<?=$hp?>" target="_blank" id="link2"><img src="img/icon_homepage.png"  width="20" height="20" alt="Homepage" /> </a>
					    			<?
										}	
									?>
									<? if($facebook!=null) {?>
										<a href="<?=$facebook?>" target="_blank" id="link2"><img src="img/icon_facebook.png" width="20" height="20" alt="Facebook" /></a>
										
									<? } ?>	
										
									</td></tr>
					    		</table>
					    	</td>
					    </tr>
					    <tr>
					    	<td>&nbsp;</td>
					    </tr>
					</table>
				</td>
			</tr>		
		</table> 
<!-- FIM BODY OSCIP DETALHE -->