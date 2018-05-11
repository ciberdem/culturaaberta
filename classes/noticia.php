<?php

class Noticia {
    
    public static function getRandom3($con){
        
        $sql = "select o.idoscip, o.nome, m.imagem, m.texto, m.idmeta, m.data, m.titulo, m.texto from oscmeta m, oscip o ".
			   "where m.fkoscip = o.idoscip ".
			   "and m.tipo = 'NOT' ".
			   "order by rand() ".
			   "limit 3  ";
               
        $rs = mysqli_query($con, $sql);
        
        return $rs;
        
    }
	
	public static function getTotalNoticias($con, $txtbusca){
		
		$txtbusca = ($txtbusca!=null)?"and (o.nome like '%$txtbusca%' or m.titulo like '%$txtbusca%' or m.texto like '%$txtbusca%') ":"";
    	
		$sql = "select count(*) as total from oscmeta m, oscip o ".
			   "where m.fkoscip = o.idoscip ".
			   "and m.tipo = 'NOT' $txtbusca";
		
		$rsbd = mysqli_query($con, $sql);
		$rs = mysqli_fetch_assoc($rsbd);
        
        return $rs['total'];
	}
	
	public static function getNoticias($con, $atvrand, $inicio, $total_reg, $txtbusca){
		
		$txtrand = ($atvrand==true)?"order by rand() ":"";
		$txtbusca = ($txtbusca!=null)?"and (o.nome like '%$txtbusca%' or m.titulo like '%$txtbusca%' or m.texto like '%$txtbusca%') ":"";
        
        $sql = "select o.idoscip, o.nome, m.texto, m.idmeta, m.data, m.titulo, m.texto, m.imagem from oscmeta m, oscip o ".
			   "where m.fkoscip = o.idoscip ".
			   "and m.tipo = 'NOT' $txtbusca ".
			   "$txtrand".
			   "LIMIT $inicio, $total_reg";
               
        $rs = mysqli_query($con, $sql);
        
		if(mysqli_num_rows($rs)){
			return $rs;
		}else{
			return null;
		}
        
    }
	
	public static function getNoticia($con, $idnot){
        
        $sql = "select o.idoscip, o.nome, m.fonte, m.texto, m.idmeta, m.data, m.titulo, ".
		       "m.texto, m.imagem from oscmeta m, oscip o ".
			   "where m.fkoscip = o.idoscip ".
			   "and idmeta = $idnot";
               
        $rsbd = mysqli_query($con, $sql);
		$rs = mysqli_fetch_assoc($rsbd);
        
        return $rs;
        
    }
    
}

?>