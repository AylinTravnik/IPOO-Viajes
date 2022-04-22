<?php
class ResponsableV{
    private $nombre;
    private $apellido;
    private $numeroLicencia;
    private $numeroEmpleado;
    
public function __construct($nombre,$apellido,$numeroLicencia,$numeroEmpleado)
{
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->numeroLicencia = $numeroLicencia;
    $this->numeroEmpleado = $numeroEmpleado;
} 
public function getNombre(){
    return $this->nombre;
}
public function getApellido(){
    return $this->apellido;
}
public function getNumeroLicencia(){
    return $this->numeroLicencia;
}
public function getNumeroEmpleado(){
    return $this->numeroEmpleado;
}
public function setNombre($nombre){
    $this->nombre = $nombre;
}
public function setApellido($apellido){
    $this->apellido = $apellido;
}
public function setNumeroLicencia($numeroLicencia){
    $this->numeroLicencia = $numeroLicencia;
}
public function setNumeroEmpleado($numeroEmpleado){
    $this->numeroEmpleado = $numeroEmpleado;
}

public function __toString()
   {
       return "Los datos del responsable son: \nNombre: ".$this->getNombre().", \nApellido: ".$this->getApellido().", Numero Empleado ".$this->getNumeroEmpleado().".\n y Numero de Licencia\n".$this->getNumeroLicencia();
   }

}