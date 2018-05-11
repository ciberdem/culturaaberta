<?php

class Projeto {
    
    public $id;
    public $idOscip;
    public $status;
    public $objetivo;
    public $descricao;
    public $orgao;
    public $origem;
    public $endereco;
    public $cep;
    public $cidade;
    public $uf;
    public $valorglob;
    public $valorrep;
    public $dtini;
    public $dtfim;
    public $fonte;
    public $path;
    
    public static function getRandom3($con){
        
        $sql = "select p.id, p.idoscip, o.nome, o.sigla, p.objetivo, p.descricao, p.pathimg, p.pathimg2 ".
               "from convproj p, oscip o ".
               "where p.idoscip = o.idoscip ".
               "and pathimg is not null and o.cnpj not in ('05977454000130', '06370226000160', '04906029000198') ".
               "order by rand() limit 3";
        $rs = mysqli_query($con, $sql);
        
        return $rs;
        
    }
	
	public static function getTotalProjetos($con, $txtbusca){
		
		$txtbusca = ($txtbusca!=null)?"and (o.nome like '%$txtbusca%' or p.objetivo like '%$txtbusca%' or p.descricao like '%$txtbusca%') ":"";
        
        $sql = "select count(*) as total ".
               "from convproj p, oscip o ".
               "where p.idoscip = o.idoscip $txtbusca";
		
		$rsbd = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($rsbd)){
			$rs = mysqli_fetch_assoc($rsbd);
			return $rs['total'];
		}else{
			return null;
		}
        
    }
	
	public static function getProjetos($con, $atvrand, $inicio, $total_reg, $txtbusca){
		
		$txtrand = ($atvrand==true)?"order by rand() ":"";
		
		$txtbusca = ($txtbusca!=null)?"and (o.nome like '%$txtbusca%' or p.objetivo like '%$txtbusca%' or p.descricao like '%$txtbusca%') ":"";
        
        $sql = "select distinct p.id, p.idoscip, idconv, o.nome, p.objetivo, p.tipo, ".
			   "p.descricao, p.pathimg, p.orgao, p.origem  ".
			   "from convproj p, oscip o  ".
			   "where p.idoscip = o.idoscip $txtbusca ".
			   "$txtrand".
			   "LIMIT $inicio, $total_reg";
		
        $rs = mysqli_query($con, $sql);
        
		if(mysqli_num_rows($rs)){
			return $rs;
		}else{
			return null;
		}
        
    }
	
	public static function getProjeto($con, $idprojeto){
        
        $sql = "select o.nome, o.idoscip, p.* ".
			   "from convproj p, oscip o  ".
			   "where p.idoscip = o.idoscip  ".
			   "and p.id = $idprojeto";

		$rsbd = mysqli_query($con, $sql);
		$rs = mysqli_fetch_assoc($rsbd);
		
		return $rs;
        
    }
	
	
	public static function getCronoProjeto($con, $idprojeto){
        
		$sql=	"SELECT c.* from convproj p, convcrono c ".
				"where p.id = $idprojeto ".
				"and p.idconv = c.idconv ".
				"order by c.idcrono";
		//echo $sql;
		$rsbd = mysqli_query($con, $sql);
		
		return $rsbd;
        
    }
	
	public static function montaParagrafo($texto){
		
		$arrtxt = explode(".", $texto);
		$txtres = "";
		$auxvar = "";
		
		foreach ($arrtxt as $txt){
			$auxvar .= $txt;
			
			if(strlen($auxvar) > 700){
				$txtres .= $auxvar. ".<p>";
				$auxvar = "";
			}
		}
		
		return $txtres;
	}
    
}

?>