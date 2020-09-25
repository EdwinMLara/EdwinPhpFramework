<?php
    class Service implements RepositoryCrud{
        public $typeService;
        public $consulta;
        

        function __construct($className){
            $this->typeService = $className;
            $this->consulta = new Consulta();
        }

        public function create($arguments){
            $typeClass = ucfirst($this->typeService);
            $object = new $typeClass($arguments);
            return $this->consulta->insertByTable($this->typeService,$object);
        }

        public function getAll(){
            $all = array();
            $typeClass = ucfirst($this->typeService);
            $arrayArgumentsArray = $this->consulta->findAllByTable($this->typeService);
            foreach($arrayArgumentsArray as $argumets){
                $object = new $typeClass($argumets);
                array_push($all,$object);
            }
            return $all;
        }

        public function update($arguments,$id){
            $typeClass = ucfirst($this->typeService);
        }

        public function delete($id){
            return $this->consulta->deleteByTable($this->typeService,$id);
        }

        

    }
?>