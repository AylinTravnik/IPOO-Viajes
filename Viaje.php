<?php   
class Viaje{
  
  
    private $codigoVuelo;
    private $destino;
    private $cantPasajeros;
    private $coleccion_pasajeros= [];

    //Clase constructora con valores
    public function __construct($codigo, $desti, $capacidad ){
        $this->codigoVuelo = $codigo;
        $this->destino = $desti;
        $this->cantPasajeros = $capacidad;
       
    }
    //Get`s de los atributos
    public function getCodigoVuelo(){
        return $this->codigoVuelo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantidadPasajeros(){
        return $this->cantPasajeros;
    }    
    public function getColeccionPasajeros(){
        return $this->coleccion_pasajeros;
    }
    //Set`s de los atributos
    public function setCodigoVuelo($nuevoCodigo){
         $this->codigoVuelo = $nuevoCodigo;
    }
    public function setDestino($nuevoDestino){
          $this->destino = $nuevoDestino;
    } 
    public function setCantidadPasajeros($nuevaCantidad){
         $this->cantPasajeros = $nuevaCantidad;
    }   
    public function setPasajero($pasajero){
        $this->coleccion_pasajeros[count($this->coleccion_pasajeros)] = $pasajero;
    }
    
    //Funcion de crea los Arrays associativos de los pasajeros
    public function populatePasajeros($nombre, $apellido, $dni) {  
        $pasajero=array(
           
             'nombre'=> $nombre,
             'apellido'=> $apellido,
             'dni'=> $dni
        );
        $this->setPasajero($pasajero);
    } 
    // permite modificar la informacion de un pasajero
    function modificarPasajero($DNIPasajero){
        if(count($this->coleccion_pasajeros)>0){
        $aux = "none";
        $arregloSalida = $this->coleccion_pasajeros;
        
        foreach ($arregloSalida as $key => $subArr)
        {
            if ($subArr["dni"] == $DNIPasajero)
            {
            $aux = $key;
            unset($arregloSalida[$key]);
            } 
        }
        if ($aux == "none"){
            echo "Ese pasajero no existe.\n ";
            return;
        }
        $nombrePasajero = readline("Ingrese Nombre del Pasajero: ");
        $apellidoPasajero = readline("Ingrese Apellido del pasajero: ");
        $dniPasajero= readline("Ingrese Dni del pasajero: ");
        $pasajero=array(
           
            'nombre'=> $nombrePasajero,
            'apellido'=> $apellidoPasajero,
            'dni'=> $dniPasajero
       );
        $this->coleccion_pasajeros[$aux] = $pasajero;
    }else{
        echo "No cargaste ningun pasajero en el viaje.\n ";
    }
   }
   
    //Funcion para volver legibles los arreglos de pasajero para los usuarios
   public function datosPasajeros(){
    $aux = "";
    $i=1;
    $arregloSalida = $this->coleccion_pasajeros;
    foreach ($arregloSalida as $key => $subArr)
    {
        $aux = $aux.$i.":\nNombre: ".$subArr["nombre"]."\nApellido: ".$subArr["apellido"]."\nDNI: ".$subArr["dni"].".\n";
        $i++;
    }
    return $aux;
   }

   //Funcion to string de la clase
   public function __toString()
   {
       return "Los datos del viaje son: \nCódigo: ".$this->getCodigoVuelo().", Destino: ".$this->getDestino().", Cantidad maxima de pasajeros: ".$this->getCantidadPasajeros().".\n".$this->datosPasajeros();
   }

}



?> 