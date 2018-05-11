<?php

class Conexao {
    
    static $connection;
    
    public function Conexao (){
        
    }
    
    public static function dbConnect(){
		
        $connection = mysqli_connect('<servidor>',"<usuario>","<senha>", "<banco>") or die("Erro na conexão com o banco");
         
        // If connection was not successful, handle the error
        if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return mysqli_connect_error();
        }
		
		$connection->set_charset("utf8");
        
        return $connection;
    }
    
}

?>