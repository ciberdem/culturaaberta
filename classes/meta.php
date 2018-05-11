<?php

class Meta {
	
	public static function getMeta($con, $tipo, $idoscip){
		
		$sql = "select * from oscmeta where tipo = '$tipo' ".
			   "and fkoscip = $idoscip LIMIT 1";
		
        $rsbd = mysqli_query($con, $sql);
		$rs = mysqli_fetch_assoc($rsbd);
        
        return $rs;
        
    }

	public static function getArrMetaPg($con, $tipo, $atvrand, $inicio, $total_reg, $txtbusca){
		
		$txtbusca = ($txtbusca!=null)?"and (m.titulo like '%$txtbusca%' or m.texto like '%$txtbusca%') ":"";
		$txtrand = ($atvrand==true)?"order by rand() ":"";
		
		$sql = "select * from oscmeta m ".
			   "where m.tipo = '$tipo' ".
				"$txtbusca $txtrand".
			   "LIMIT $inicio, $total_reg";
		
        $rs = mysqli_query($con, $sql);
        
        return $rs;
    }
	
	public static function getTotalArrMetaFiltro($con, $tipo, $txtbusca){
		
		$txtbusca = ($txtbusca!=null)?"and (m.titulo like '%$txtbusca%' or m.texto like '%$txtbusca%') ":"";
		
		$sql = "select count(*) as total from oscmeta m ".
			   "where m.tipo = '$tipo' $txtbusca";
		
		
        $rsbd = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($rsbd)){
			$rs = mysqli_fetch_assoc($rsbd);
			return $rs['total'];
		}else{
			return null;
		}
    }
	
	
	public static function getArrMeta($con, $tipo){
		
		$sql = "select * from oscmeta m ".
			   "where m.tipo = '$tipo' order by rand()";
		
        $rs = mysqli_query($con, $sql);
        
        return $rs;
    }
	
	public static function getTotalArrMeta($con, $tipo){
		
		$sql = "select count(*) as total from oscmeta m ".
			   "where m.tipo = '$tipo' order by rand()";
		
        $rsbd = mysqli_query($con, $sql);
		$rs = mysqli_fetch_assoc($rsbd);
        
        return $rs['total'];
    }
	
	public static function getArrMetaGeral($con, $tipo){
		
		$sql = "select o.nome, o.idoscip, o.logo, m.* from ".
			   "oscmeta m left join oscip o on ".
			   "m.fkoscip = o.idoscip ".
			   "where m.tipo = '$tipo' order by rand()";
		
        $rs = mysqli_query($con, $sql);
        
        return $rs;
    }	

	public static function getTotalArrMetaGeralOscip($con, $tipo, $txtbusca){
		
		$txtbusca = ($txtbusca!=null)?"and (o.nome like '%$txtbusca%' or m.texto like '%$txtbusca%' or m.titulo like '%$txtbusca%') ":"";
		
		$sql = "select count(*) as total ". 
			   "from oscmeta m, oscip o ".
			   "where m.tipo = '$tipo' ".
			   "and m.fkoscip = o.idoscip $txtbusca";
		
        $rsbd = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($rsbd)){
			$rs = mysqli_fetch_assoc($rsbd);
			return $rs['total'];
		}else{
			return null;
		}
    }
	
	public static function getArrMetaGeralOscip($con, $tipo, $atvrand, $inicio, $total_reg, $txtbusca){
		
		$txtrand = ($atvrand==true)?"order by rand() ":"";
		$txtbusca = ($txtbusca!=null)?"and (o.nome like '%$txtbusca%' or m.texto like '%$txtbusca%' or m.titulo like '%$txtbusca%') ":"";
		
		$sql = "select o.idoscip, o.nome, o.logo, m.titulo, m.texto, m.fonte ". 
			   "from oscmeta m, oscip o ".
			   "where m.tipo = '$tipo' ".
			   "and m.fkoscip = o.idoscip $txtbusca ".
			   "$txtrand".
			   "LIMIT $inicio, $total_reg";
		
        $rs = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($rs)){
			return $rs;
		}else{
			return null;
		}
    }
	
	public static function getArrMetaOscip($con, $tipo, $idoscip){
		
		$sql = "select * from oscmeta where tipo = '$tipo' ". 
			   "and fkoscip = $idoscip";
		
        $rsbd = mysqli_query($con, $sql);
		
		return $rsbd;
        
    }
	
	
	public static function montarLink($texto, $cls)
	{
		if (!is_string($texto))
			return $texto;

		$er = "/(http(s)?:\/\/(www|.*?\/)?((\.|\/)?[a-zA-Z0-9&%_?=-]+)+)/i";
		preg_match_all($er, $texto, $match);

		foreach ($match[0] as $link)
		{
			//$link = strtolower($link);
			$link_len = strlen($link);

			//troca "&" por "&", tornando o link válido pela W3C
			$web_link = str_replace("&", "&", $link);

			$texto = str_ireplace($link, "<a href=\"" . $web_link . "\" id=\"$cls\" target=\"_blank\" title=\"". $web_link . "\" rel=\"nofollow\">". (($link_len > 60) ? substr($web_link, 0, 25) . "..." . substr($web_link, -15) : $web_link) . "</a>", $texto);

		}

		return $texto;
	}
	
}
	
?>	