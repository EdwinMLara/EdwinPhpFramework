<?php
    interface RepositoryCrud{
        public function create($obj);
        public function getAll();
        public function update($obj,$id);
        public function delete($id);
        public function getbyField($field,$value);
    }
?>