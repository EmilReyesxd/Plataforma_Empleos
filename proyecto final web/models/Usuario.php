<?php
class Usuario {
    public $id;
    public $correo;
    public function __construct($id, $correo) {
        $this->id = $id;
        $this->correo = $correo;
    }
}
?>
