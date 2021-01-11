<?php
require_once("ConexionBaseDatos.php");
class Consulta extends ConexionBaseDatos{
    function __construct(){
        parent::__construct();
    }

    public function tableExists($table){
        $table_exists = $this->con->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$this->deleteEspecialCharacters($table).'"');
        if($table_exists){
            if($table_exists->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }
    }

    public function findByQuery($query){
        $results = $this->con->query($query);
        return $this->loopQuery($results);
    }

    public function insertByTable($table,$obj){
        if($this->tableExists($table,$obj)){
            $query = "INSERT INTO ".$this->deleteEspecialCharacters($table);
            $query_properties = "(";
            $query_values = "(";
            foreach($obj as $property => $value){
                if(strcmp($value,'autoincrement') == 0) continue;
                $query_properties .=$property.",";
                $query_values .= "'".$value."',";
            }
            $query_properties = substr($query_properties, 0, -1);
            $query_values = substr($query_values, 0, -1);
            $query = $query.$query_properties.") VALUES ".$query_values.")";
            $this->con->query($query);
            
            return ($this->con->affected_rows() === 1) ? true : false;
        }
    }

    public function findAllByTable($table){
        if($this->tableExists($table)){
            $query =  "SELECT * FROM ".$this->deleteEspecialCharacters($table);
            return $this->findByquery($query);
        }
    }

    public function updateByTable($table,$obj,$id){
        $query = "UPDATE ".$this->deleteEspecialCharacters($table)." SET ";
        $where = "WHERE ";
        $con = 0;
        foreach($obj as $property => $value){
            if($con == 0){
                $where .= $property." = ".$id;
            }
            $query .= $property." = ".$value." ,";
        }
        $query = substr($query, 0, -1);
        $query .= $query.$where;
        $this->con->query($query);
        
        return ($this->con->affected_rows() === 1) ? true : false;
    }

    public function deleteByTable($table,$id){
        if($this->tableExists($table)){
            $query = "DELETE FROM ".$this->deleteEspecialCharacters($table);
            $query .= " WHERE id=". $this->deleteEspecialCharacters($id);
            $query .= " LIMIT 1";
            $this->con->query($query);
            
            return ($this->con->affected_rows() === 1) ? true : false;
        }
    }

    public function findByFieldTable($table,$field,$value){
        if($this->tableExists($table)){
            $query = "SELECT * FROM ".$this->deleteEspecialCharacters($table);
            $query .= " WHERE ".$this->deleteEspecialCharacters($field)." = '".$this->deleteEspecialCharacters($value)."'";
            
            $results = $this->con->query($query);
            return $this->loopQuery($results);
        }
    }
}
?>