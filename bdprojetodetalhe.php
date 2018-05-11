<?php
 
 $idprojeto = isset($_GET['id'])!=null?$_GET['id']:null;

 $con = Conexao::dbConnect();
 $rs =  Projeto::getProjeto($con, $idprojeto);
 $rsCronoBD =  Projeto::getCronoProjeto($con, $idprojeto);

 $rsPua =  Meta::getMeta($con, 'PUA', $rs['idoscip']);
 $pua = $rsPua!=null?$rsPua['texto']:"(Fonte não encontrada)";
 $puaft = $rsPua!=null?$rsPua['fonte']:"(Fonte não encontrada)";
 $pualnk = $rsPua!=null?$rsPua['fonte']:"#";
 
 $rsPrf =  Meta::getMeta($con, 'PRF', $rs['idoscip']);
 $prf = $rsPrf!=null?$rsPrf['texto']:"(Fonte não encontrada)";
 $prfft = $rsPrf!=null?$rsPrf['fonte']:"(Fonte não encontrada)";
 $prflnk = $rsPrf!=null?$rsPrf['fonte']:"#";

 $rsMbo =  Meta::getMeta($con, 'MBO', $rs['idoscip']);
 $mbo = $rsMbo!=null?$rsMbo['texto']:"(Fonte não encontrada)";
 $mboft = $rsMbo!=null?$rsMbo['fonte']:"(Fonte não encontrada)";
 $mbolnk = $rsMbo!=null?$rsMbo['fonte']:"#";

 $mod = $rs['tipo']=="C"?"Convênio":"Projeto";	
 $dtini = $rs['dtini']!=null?$rs['dtini']:"(Fonte não encontrada)";
 $dtfim = $rs['dtfim']!=null?$rs['dtfim']:"(Fonte não encontrada)";
 $orgao = $rs['orgao']!=null?$rs['orgao']:"(Fonte não encontrada)";
 $end = $rs['endereco']!=null?$rs['endereco']:"(Fonte não encontrada)";
 $origem = $rs['origem']!=null?$rs['origem']:"(Fonte não encontrada)";
 $valorglob = $rs['valorglob']!=null && is_numeric($rs['valorglob'])?"R$ ".number_format($rs['valorglob'], 2, ',', '.'):"(Fonte não encontrada)";
 $valorep = $rs['valorep']!=null && is_numeric($rs['valorep'])?"R$ ".number_format($rs['valorep'], 2, ',', '.'):"(Fonte não encontrada)";
 $opendiv = (mysqli_num_rows($rsCronoBD)>0)?true:false;
 
 $posedital = strpos($rs['fonte'], 'pdf');

 $edital = "";
 if ($posedital === false) {
	$edital = "(Fonte não encontrada)";
 }else{
	$edital =  "<a href=".$rs['fonte']." target=black id=link1>(Veja aqui)</a>";
 }
	
 $objetivo = $rs['objetivo'];
 $objetivo = ($objetivo!=null)?$objetivo:"(Título não encontrado)";

?>
<!-- BODY PROJETO DETALHE -->
	<table id="tbbody2">
		<tr>
			<td width="60%">
				<div id="titulo6"><a href="./projetos.php" id="titulo4">Projetos</a> > <?=$objetivo?></div>
				<div id="line1">&nbsp;</div>
			</td>
		</tr>
		<tr valign="top">
			<td width="60%">
				<table id="tbprojeto" border=1 width="100%">
				<tr>
					<td colspan="2"><?=$rs['nome']?></td>
				</tr>
<?
			    if($rs['pathimg']!=null){		
?>					
				<tr>
					<td colspan="2" align="center"><img src="img/<?=$rs['pathimg']?>" id="imgdestaque"></div> </td>
				</tr>					
<?
				}
?>					
				<tr>
				<td colspan="2" height="1000" id="dtprinc">
					<!-- TAB DE INFORMACOES DO PROJETO -->
				   <div class="tabs">
					   <div class="tab">
						   <input type="radio" id="tab-1" name="tab-group-1" checked>
						   <label for="tab-1">Dados gerais</label>
						   <div class="content">
							   <table border="0">
									<tr>
										<td width="20%" id="texto1"><b>Modalidade: <img src="img/info5.png" width="15" height="15" title="Via projeto (iniciativa da própria instituição) ou via Convênio (patrocinado com alguma entidade do setor público)."></b></td>
										<td width="90%" id="titulo1"><?=$mod?></td>							   		
									</tr>
									<tr>
										<td id="texto1"><b>Status: <img src="img/info5.png" width="15" height="15" title="Situação do projeto/convênio."></b></td>
										<td id="texto1"><?=$rs['status']?></td>							   		
									</tr>

									<tr>
										<td id="texto1"><b>Data início: <img src="img/info5.png" width="15" height="15" title="Data do início previsto para o projeto/convênio."></b></td>
										<td id="texto1"><?=$dtini?></td>
									</tr>
									<tr>
										<td id="texto1"><b>Data fim: <img src="img/info5.png" width="15" height="15" title="Data de finalização prevista para o projeto/convênio."></b></td>
										<td id="texto1"><?=$dtfim?></td>
									</tr>
									
									<tr>
										<td id="texto1" align="left"><b>Cronograma das atividades: <img src="img/info5.png" width="15" height="15" title="LEI OSCIP (Art. 10 § 1o / (Art. 10 § 2o II) - Cronograma contendo atividades do projeto, com prazos iniciais e finais de execução."></b></td>
										<td id="texto1">
										<?
											if($opendiv){
												echo "<a href=\"#openModal\" id=link1>(Clique aqui para detalhes)</a>";
											}else{
												echo "(Fonte não encontrada)";
											}
										?>	
										</td>
									</tr>
									
									<tr>	
										<td id="texto1"><b>Objetivo: <img src="img/info5.png" width="15" height="15" title="Objeto/descrição do projeto/convênio realizado."></b></td>
										<td id="texto1"><?=Meta::montarLink($rs['descricao'], "texto1")?></a>
										</td>
									</tr>
									
									<tr>	
										<td id="texto1"><b>Fonte: <img src="img/info5.png" width="15" height="15" title="Fonte de onde os dados foram coletados."></b></td>
										<td id="texto1">
										<? if($rs["tipo"] == "P") { ?>
											<a href="<?=$rs["fonte"]?>" id="link1" target="_blank">Site de projetos da OSCIP</a>
										<? }else{ ?>
											<a href="http://portal.convenios.gov.br/download-de-dados" id="link1" target="_blank">SISCONV - Portal de Convênios</a>
										<? } ?>
										</a>
										</td>
									</tr>
									
							   </table>
						   </div> 
					   </div>

					   <div class="tab">
						   <input type="radio" id="tab-2" name="tab-group-1">
						   <label for="tab-2">Financeiro e Contábil</label>
						   <div class="content">
							   <table>
									<tr>
										<td id="texto1"><b>Órgão Patrocinador: <img src="img/info5.png" width="15" height="15" title="Órgão patrocinador do projeto/convênio."></b></td>
										<td id="texto1"><?=$orgao?></td>							   		
									</tr>  
									<tr>
										<td id="texto1"><b>Origem do Recurso: <img src="img/info5.png" width="15" height="15" title="Tipo do incentivo (PPP - Parceria público privada, lei federal/estadual/municipal)."></b></td>
										<td id="texto1"><?=$origem?></td>
									</tr>
									<tr>
										<td id="texto1"><b>Previsão de Receita: <img src="img/info5.png" width="15" height="15" title="LAI (Art. 8o / § 1o / III), LEI OSCIP (Art. 10 § 2o IV) - Ordem de grandeza das receitas previstas na execução do projeto/convênio."></b></td>
										<td id="texto1"><?=$valorglob?></td>
									</tr>
									<tr>
										<td id="texto1"><b>Previsão de Despesa: <img src="img/info5.png" width="15" height="15" title="LAI (Art. 8o / § 1o / III), LEI OSCIP (Art. 10 § 2o IV) - Ordem de grandeza das despesas previstas na execução do projeto/convênio."></b></td>
										<td id="texto1"><?=$valorep?></td>
									</tr>
									<tr>
										<td id="texto1"><b>Critério de Avaliação: <img src="img/info5.png" width="15" height="15" title="LAI (Art. 7o VII a) / LEI OSCIP (Art. 10 § 2o III) - Formas de avaliar quantitativamente se o convênio atendeu às metas estabelecidas."></b></td>
										<td id="texto1">(Fonte não encontrada)</td>
									</tr>	
									<tr>
										<td id="texto1"><b>% Distribuição dos recursos: <img src="img/info5.png" width="15" height="15" title="Demonstrativos determinando a distribuição dos recursos entre as pessoas físicas e jurídicas participantes do projeto. "></b></td>
										<td id="texto1">(Fonte não encontrada)</td>
									</tr>	
						        
						        	<tr>
										<td id="texto1"><b>Demonstração de Origem de Aplicação de Recurso: <img src="img/info5.png" width="15" height="15" title="LEI OSCIP (Art. 15B VI) - Tipo do incentivo Relatório contábil Relatório contábil (de acordo com a CFC 1409/2012) que demonstram financiamentos e investimentos realizados pela instituição para execução do projeto."></b></td>
										<td id="texto1">(Fonte não encontrada)</td>
									</tr>
							        
									<tr>
										<td id="texto1"><b>Extrato Demonstrativo de Execução: <img src="img/info5.png" width="17" height="17" title="LEI OSCIP (Art. 15B II) - Relatório contábil (de acordo com a CFC 1409/2012 ) comprovando a execução das atividades do projeto."></b></td>
										<td id="texto1">(Fonte não encontrada)</td>
									</tr>
									<tr>
										<td id="texto1"><b>Demostração de déficit/superávit: <img src="img/info5.png" width="17" height="17" title="LAI (Art. 7o VII b) - Relatório contábil (de acordo com a CFC 1409/2012 ) comprovando se o custo da execução do projeto está acima ou abaixo do planejado."></b></td>
										<td id="texto1">(Fonte não encontrada)</td>
									</tr>								  								

							   </table>
						   </div> 
					   </div>

						<div class="tab">
						   <input type="radio" id="tab-3" name="tab-group-1">
						   <label for="tab-3">Participação</label>
						   <div class="content">	
							<table>
								<tr>
									<td id="texto1"><b>Membros participantes: <img src="img/info5.png" width="15" height="15" title="Equipe participante do projeto (nome, cargo e dados para contato)."></b></td>
									<td id="texto1">(Fonte não encontrada)</td>
								</tr>
								<tr>
									<td id="texto1"><b>Nível de satisfação: <img src="img/info5.png" width="15" height="15" title="Dados quantitativos determinando a satisfação do público ou cliente após execução do projeto. (Ex: percentual dos muitos satisfeitos, pouco satisfeitos, não satisfeitos, etc)."></b></td>
									<td id="texto1">(Fonte não encontrada)</a></td>
								</tr>
								<tr>
									<td id="texto1"><b>Público Alvo: <img src="img/info5.png" width="15" height="15" title="Determinação do público alvo proposto pelo projeto (Ex: teatro para público infanto-juvenil, adulto, etc)."></b></td>
									<td id="texto1"><?=$pua?></td>
								</tr>
								<tr>
									<td id="texto1"><b>Perfil(is) das atividades: <img src="img/info5.png" width="15" height="15" title="Perfil e/ou requisitos necessários que o membro da equipe precisa possuir para participar do projeto."></b></td>
									<td id="texto1"><?=$prf?></a></td>
								</tr>								
								<tr>
									<td id="texto1"><b>Edital: <img src="img/info5.png" width="15" height="15" title="Edital que referenciou a oportunidade de projeto/convênio para o cidadão interessado."></b></td>
									<td id="texto1"><?=$edital?></td>
								</tr>
							</table>	
							</div>
						</div>
				</div>

				<!-- FIM DA DIV -->

				</td></tr>

				</table>
			</td>
		</tr>		
	</table>  
<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<?
		if($opendiv){
			echo "<table border=0 cellspacing=10>";
			echo "<tr id=titulo3><td align=center>Dt início</td><td align=center>Dt fim</td><td>Atividade</td><td align=center>Valor (R$)</td></tr>";
			while ($rsCr = mysqli_fetch_assoc($rsCronoBD)) {
				
				$valor = is_numeric($rsCr['valor'])?number_format($rsCr['valor'], 2, ',', '.'):"(Vazio)";
				
				echo "<tr><td id=texto4>".$rsCr['dtinicio']."</td>".
					 "<td id=texto4>".$rsCr['dtfim']."</td>".
					 "<td id=texto4>".$rsCr['descricao']."</td>".
					 "<td id=texto4>".$valor."</td>".
					 "</tr>";
			}
			echo "</table>";
		}
		?>
	</div>
</div>
<!-- FIM BODY PROJETO DETALHE -->