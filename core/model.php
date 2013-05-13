<?php
/**
 * Objet Model
 * Permet les int�ractions avec la base de donn�e
 * */
class Model{
    
    public $table;
    public $id;
    
    /**
     * Lit une ligne dans la base de donn�e par rapport � l'ID de l'objet
     * @param $fields Liste des champs � r�cup�rer
     * */
    public function read($fields=null){
        if($fields==null){            $fields = "*";        }
        $sql = "SELECT $fields FROM ".$this->table." WHERE id=".$this->id ;
        $req = mysql_query($sql) or die(mysql_error()."<br/> => ".mysql_query());
        $data = mysql_fetch_assoc($req);
        foreach($data as $k=>$v){
            $this->$k = $v;
        }
    }
    
    /**
     * Sauvegarde les donn�e pass� en param�tre dans la base de donn�e
     * @param $data Donn�e � sauvegarder
     * */
    public function save($data){
        if(isset($data["id"]) && !empty($data["id"])){
            $sql = "UPDATE ".$this->table." SET ";
            foreach($data as $k=>$v){
                if($k!="id"){
                    $sql .= "$k='$v',";
                }
            }
            $sql = substr($sql,0,-1);
            $sql .= "WHERE id=".$data["id"];
        }
        else{
            $sql = "INSERT INTO ".$this->table."(";
            unset($data["id"]);
            foreach($data as $k=>$v){
                    $sql .= "$k,";
            }
            $sql = substr($sql,0,-1);
            $sql .=") VALUES (";
            foreach($data as $v){
                    $sql .= "'$v',";
            }
            $sql = substr($sql,0,-1);
            $sql .= ")";
        }
        mysql_query($sql) or die(mysql_error()."<br/> => ".mysql_query());
        if(!isset($data["id"])){
            $this->id=mysql_insert_id();
        }
        else{
            $this->id = $data["id"];
        }
    }
    
    /**
     * Permet de r�cup�rer plusieurs ligne dans la BDD
     * @param $data conditions de r�cup�rations
     * */
    public function find($data=array()){
            $conditions = "1=1";
            $fields = "*";
            $limit = "";
            $order = "id DESC";
            extract($data);
            if(isset($data["limit"])){ $limit = "LIMIT ".$data["limit"]; }
            $sql = "SELECT $fields FROM ".$this->table." WHERE $conditions ORDER BY $order $limit";
            $req = mysql_query($sql) or die(mysql_error()."<br/> => ".$sql);
            $d = array();
            while($data = mysql_fetch_assoc($req)){
                $d[] = $data;
            }
            return $d;
    }
    
    /**
     * Permet de supprimer une ligne dans la base de donn�e
     * @param $id ID de la ligne � supprimer
     * */
    public function del($id=null){
        if($id==null){ $id = $this->id; }
        $sql = "DELETE FROM ".$this->table." WHERE id=$id";
        mysql_query($sql) or die(mysql_error()."<br/> => ".mysql_query());
    }
    
    /**
     * Permet de faire une requ�te complexe
     * @param $sql Requ�te a effectu�
     * */
        public function query($sql){
            $req = mysql_query($sql) or die(mysql_error()."<br/> => ".$sql);
            $d = array();
            while($data = mysql_fetch_assoc($req)){
                $d[] = $data;
            }
            return $d; 
        }
    
    /**
     * Permet de charger un model
     * @param $name Nom du model � charger
     * */
    static function load($name){
        require("$name.php");
        return new $name();
    }
    
    
}
?>