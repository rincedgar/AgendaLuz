<?php

/**
 * Description of Dependencias
 *
 * @author Edgar Rincon
 */
class Dependencias {
    protected $id;
    protected $descripcion;
   
    function __construct($id,$desc) {
        $this->id=$id;
        $this->descripcion=$desc;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
}

?>
