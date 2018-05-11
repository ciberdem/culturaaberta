<?php

class Oscip {
    
    public static function getTotalOscips($con, $txtbusca){
		
		$txtbusca = ($txtbusca!=null)?"where (a.nome like '%$txtbusca%' or a.texto like '%$txtbusca%') ":"";
		
		$sql = "SELECT count(*) as total FROM ".
			   "(SELECT o.idoscip, o.nome, o.logo, m.texto  ".
			   "FROM oscip o left join oscmeta m on o.idoscip = m.fkoscip  ".
			   "and tipo = 'OBJ') as a $txtbusca";
		
		//echo $sql."\n";
		
        $rsbd = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($rsbd)){
			$rs = mysqli_fetch_assoc($rsbd);
			return $rs['total'];
		}else{
			return null;
		}
        
    }
    
	public static function getOscips($con, $atvrand, $inicio, $total_reg, $txtbusca){
        
        $txtrand = ($atvrand==true)?"order by rand() ":"";
		
		$txtbusca = ($txtbusca!=null)?"where (a.nome like '%$txtbusca%' or a.texto like '%$txtbusca%') ":"";
		
		$sql = "SELECT * FROM ".
			   "(SELECT o.idoscip, o.nome, o.logo, m.texto  ".
			   "FROM oscip o left join oscmeta m on o.idoscip = m.fkoscip  ".
			   "and tipo = 'OBJ') as a ".
			   "$txtbusca".
			   "$txtrand".
			   "LIMIT $inicio, $total_reg";

        $rs = mysqli_query($con, $sql);
		
		//echo $sql;
		
		if(mysqli_num_rows($rs)){
			return $rs;
		}else{
			return null;
		}
        
    }
	
	public static function getOscip($con, $idoscip){
		
		$sql = "SELECT * FROM oscip  ". 
			   "where idoscip = $idoscip";
		
        $rsbd = mysqli_query($con, $sql);
		$rs = mysqli_fetch_assoc($rsbd);
		
		//echo $sql;
        
        return $rs;
        
    }
	
	public static function getOscipFacebook($con, $url){
		
		if($url != null && $url!=""){
			if(strpos($url, "facebook")==false){
				return null;
			}else{

				$arrUrl = explode(";", $url);

				foreach ($arrUrl as $urlaux){

					if(strpos($urlaux, "facebook")!=false){
						return $urlaux;
					}
				}
			}
		}
		
		return null;
        
    }	

	
	public static function getOscipHP($con, $url){
		
		$arrHP = "";
		
		if($url != null && $url!=""){

			$arrUrl = explode(";", $url);
			$i = 0;	
			foreach ($arrUrl as $urlaux){

				if(strpos($urlaux, "facebook")==false){
					$arrHP[$i] = $urlaux;
					$i++;
				}
			}
		}
		
		return $arrHP;
        
    }	
	
}

?>