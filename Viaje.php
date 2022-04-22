<?php   
class Viaje{
  
  
    private $codigoVuelo;
    private $destino;
    private $cantPasajeros;
    private $coleccion_pasajeros= []; //es un arreglo de Objetos Pasajero
    private $responsable; //es un Objeto Responsable V

    //Clase constructora con valores
    public function __construct($codigo, $desti, $capacidad,$colPasajeros,$responsable ){
        $this->codigoVuelo = $codigo;
        $this->destino = $desti;
        $this->cantPasajeros = $capacidad;
        $this->coleccion_pasajeros = $colPasajeros;
        $this->responsable=$responsable;

       
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
    public function getResponsable(){
        return $this->responsable;
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
    public function setColeccionPasajeros($nuevaColeccion){
        $this->coleccion_pasajeros = $nuevaColeccion;
   } 
     public function setResponsable($nuevoResponsable){
         $this->responsable= $nuevoResponsable;
     }


   public function agregarPasajeroAColeccion($unPasajero){ //recibe por parametro el new pasajero creado en testViaje
   
    $array_pasajeros = $this->getColeccionPasajeros(); //Trae la coleccion de pasajeros
     $largo=count($array_pasajeros);   //cuenta el largo de la coleccion de pasajeros
    $i=0; 
    $encontro=false;
    $dniPasajero=$unPasajero->getDNI(); //selecciona SOLO el dni del pasajero
         if(is_numeric($dniPasajero)){ //confirme que DNI es un numero
             //Revisamos que no quiera ingresar un DNI que ya existe
            while($i<$largo && !$encontro){
                $pasajero = $array_pasajeros[$i];//vamos revisando pasajero por pasajero aumentando la posicion ($i)
                if($pasajero->getDNI()==$dniPasajero){ //comparo el DNI del pasajero nuevo (por parametro), con los existentes en el arreglo
                   $encontro=true; 
                }
                $i++;
            }
            if($encontro){
                echo "ERROR, DNI duplicado.\n";} //si ya esta, echo error
            else{    //si NO esta
                $coleccion=$this->getColeccionPasajeros(); //trae a la coleccion pasajeros
                array_push($coleccion,$unPasajero); //agregar el Pasajero
               $this->setColeccionPasajeros($coleccion);// Set la coleccion con el pasajero nuevo
            }
        }
    
  }


   public function cambiarPasajero($dni){  //iba viaje en parametro?
    $esCorrecto=false; $encontro=false;
    $op=1; $posicion=-1; $i=0;
    $array_pasajeros = $this->getColeccionPasajeros();
    $largo=count($array_pasajeros);
    
    // if($largo>0){ //confirma que arreglo existe. Es Mayor a 0
    //     while(!$esCorrecto){  //Mientras que $esCorrecto= false, sigue este bucle.
    //         $dni = readline("Ingrese el DNI para modificar el pasajero");
    //         if(is_numeric($dni)){ //confirma que usuario ingreso un NUMERO 
    //             $esCorrecto=true; //si ingreso un numero sale del bucle y va al siguiente
    //         }else{
    //             echo "ERROR: Debe ingresar un numero\n"; //si el usuario ingreso el dato mal, lo pide otra VEZ
    //         }
    //     }
        
        //Encuentro la posicion del Pasajero
        while($i<$largo && !$encontro){  //mientras que $i sea Menor que Tamaño arreglo Y $encontro= false
              $pasajero = $array_pasajeros[$i]; //pasajero = EL OBJETO PASAJERO en posicion $i del array.
            if($pasajero->getDNI()==$dni){ //SI el N de documento de $Pasajero es Igual a $dni que puso usuario
               $encontro=true; 
               $posicion=$i; //guardamos la posicion!!! LA USAMOS DESPUES.
            }
            $i++;//Si NO es igual, $i+1 y de nuevo el bucle
        }
        if($encontro){ //Si lo encontro
            
                while($op != 0){
                    $esCorrecto=false;
                    echo  
                     "Ingrese que desea modificar del pasajero
                      0- Salir
                      1- Nombre del pasajero
                      2- Apellido del pasajero
                      3- Telefono\n";

                $op = readline(); //lee que pone usuario
                switch($op){
                    case 1 : 
                        $nombrePasajero=readline("Ingrese nuevo Nombre");//guardamos en $nombrePasajero el Nuevo nombre

                        $pasajero=$array_pasajeros[$posicion]; //pasajero es el Objeto del array en $posicion ($i)
                        $pasajero->setNombre($nombrePasajero); //Usamos Set con el nuevo nombre
                        $array_pasajeros[$posicion] = $pasajero;//seteamos el nuevopasajero en el arreglo
                        $this->setColeccionPasajeros($array_pasajeros);//seteamos el arreglo modificado 
                        break;
                    case 2 : 
                        $apellidoPasajero=readline("Ingrese nuevo Apellido");
                        $pasajero = $array_pasajeros[$posicion];
                        $pasajero->setApellido($apellidoPasajero);
                        $array_pasajeros[$posicion]=$pasajero;

                        $this->setColeccionPasajeros($array_pasajeros);
                        break;
                    case 3 : 
                        $apellidoPasajero=readline("Ingrese nuevo telefono");
                        $pasajero = $array_pasajeros[$posicion];
                        $pasajero->setTelefono($apellidoPasajero);
                        $array_pasajeros[$posicion]=$pasajero;

                        $this->setColecccionPasajeros($array_pasajeros);
                        break;
                        
                       
                    default: echo"ERROR Opcion incorrecta. Ingrese 0-1-2-3.\n"; break; //solo permite que usuario ingrese opcion valida
                   }
                }
            }
            else
                echo "ERROR No se encontro pasajero con ese DNI.\n";
        
      
}

//Funcion modificar vuelo, Un menu, permite Modificar individualmente el Codigo de vuelo, destino y la cantidad maxima de pasajeros.
function modificarVuelo(){
    $opcion = 1;
    while($opcion != 0){
        echo "
        \n
        0-Salir 
        1-Modificar Codigo de vuelo 
        2-Modificar Destino
        3-Modificar Cantidad Maxima Pasajeros
        \n";
        $opcion = readline();
        echo "\n";
        switch($opcion){
            case 0 : echo "Saliendo del test"; break;
            case 1 : $cambiarCodigo = readline("Ingrese el nuevo codigo de vuelo: ");
                     $this->setCodigoVuelo($cambiarCodigo); break;
            case 2 : $cambiarDestino = readline("Ingrese el nuevo destino de vuelo: ");
                     $this->setDestino($cambiarDestino); break;
            case 3 :  $cambiarCantidad = readline("Ingrese la nueva cantidad maxima de pasajeros: ");
                     $this->setCantidadPasajeros($cambiarCantidad); break;
                    }
    }                
}

public function modificarResponsable(){
    $responsable=$this->getResponsable();
    echo  
                     "Ingrese que desea modificar del Responsable
                      0- Salir
                      1- Nombre del Responsable
                      2- Apellido del Responsable
                      3- Numero Licencia
                      4- Numero Empleado\n";

                $op = readline(); //lee que pone usuario
                switch($op){
                    case 1 : 
                        $nombreResponsable=readline("Ingrese nuevo Nombre");//guardamos en $nombrePasajero el Nuevo nombre
                        $responsable->setNombre($nombreResponsable); //Usamos Set con el nuevo nombre
                         break;
                    case 2 : 
                        $apellidoResponsable=readline("Ingrese nuevo Apellido");//guardamos en $nombrePasajero el Nuevo nombre
                        $responsable->setApellido($apellidoResponsable); //Usamos Set con el nuevo nombre
                         break;
                    case 3 : 
                        $numeroLicencia=readline("Ingrese nuevo Numero de Licencia");//guardamos en $nombrePasajero el Nuevo nombre
                        $responsable->setNumeroLicencia($numeroLicencia); //Usamos Set con el nuevo nombre
                         break;
                    case 4 :  
                        $numeroEmpleado=readline("Ingrese nuevo Numero de Empleado");//guardamos en $nombrePasajero el Nuevo nombre
                        $responsable->setNumeroEmpleado($numeroEmpleado); //Usamos Set con el nuevo nombre
                         break;   
                        
                       
                    default: echo"ERROR Opcion incorrecta. Ingrese 0-1-2-3-4.\n"; break;
}
}
public function imprimirPasajeros(){
 $listaPasajeros=$this->getColeccionPasajeros();
 $largo= count($listaPasajeros);
 for($i=0; $i<$largo; $i++){
   $pasajero=$listaPasajeros[$i];
   echo $pasajero;


 }


}





public function __toString()
   {
       return "Los datos viaje son: \nCodigo: ".$this->getCodigoVuelo().",\n Destino: ".$this->getDestino().", \nCantidad maxima de Pasajeros: ".$this->getCantidadPasajeros().
       "\nResponsable:\n".$this->getResponsable();//"\nPasajeros:\n".$this->getColeccionPasajeros();
   }

} 