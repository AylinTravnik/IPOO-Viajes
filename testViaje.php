
<?php
//ENTREGA Nº 1: VIAJES
//ALUMNOS: TRAVNIK ARMITANO, VALERIA AYLIN, FI3522
//         ZUCCATO, STEFANO, FI3517

include 'Viaje.php'; 

$viaje = null;
$opcion = 1;
//Menu principal
while($opcion != 0){
    $menu = "\033[1mMenú de opciones:\033[0m";
    echo "\033[4m$menu\033[0m";
    echo "
    \n
    0-Salir
    1-Cargar informacion de un viaje  
    2-Cargar un pasajero
    3-Modificar informacion viaje
    4-Modificar Pasajero
    5-Visualizar informacion del viaje
    \n";
    $opcion = readline();
    switch($opcion){
        case 0 : echo "Saliendo del test"; break;
        case 1 : $viaje = crearViaje();break;
        case 2 :  if ($viaje !== null) {agregarPasajero($viaje);} else {echo "No se cargó un viaje.\n";};break;
        case 3 : if ($viaje !== null) {modificarVuelo($viaje);} else {echo "No se cargó un viaje.\n";};break;
        case 4 : if ($viaje !== null) {$DNIPasajero = readline("Ingrese el DNI del pasajero a modificar: ");
            $viaje->modificarPasajero($DNIPasajero);break;} else {echo "No se cargó un viaje.\n";};break;
            
        case 5: if ($viaje !== null) {echo $viaje;} else {echo "No se cargó un viaje.\n";};break;
    }
}

//Funcion modificar vuelo, Un menu, permite Modificar individualmente el Codigo de vuelo, destino y la cantidad maxima de pasajeros.
function modificarVuelo($viaje){
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
                     $viaje->setCodigoVuelo($cambiarCodigo); break;
            case 2 : $cambiarDestino = readline("Ingrese el nuevo destino de vuelo: ");
                     $viaje->setDestino($cambiarDestino); break;
            case 3 :  $cambiarCantidad = readline("Ingrese la nueva cantidad maxima de pasajeros: ");
                     $viaje->setCantidadPasajeros($cambiarCantidad); break;
                    }
    }                
}
//Funcion Crear Viaje, Crea un Objeto de la Clase Viaje, con los datos entrados por el usuario
function crearViaje(){
  $pasajeros = [];
  $codigo= readline("Ingrese el codigo de vuelo: ");
  $destino = readline("Ingrese el destino: ");
  $capacidad = readline("Ingrese la capacidad del vuelo: ");
  $nuevoViaje = new Viaje($codigo, $destino, $capacidad, $pasajeros);
  echo "Se creo correctamente un nuevo viaje.\n ";
  return $nuevoViaje;
}

//Permite agregar nuevos pasajeros al viaje, Controla que no se supere el maximo permitido
function agregarPasajero($nuevoViaje){
    $nuevoViaje;
    if (count($nuevoViaje->getColeccionPasajeros())+1<=$nuevoViaje->getCantidadPasajeros()){
   $nombrePasajero = readline("Ingrese Nombre del Pasajero: ");
   $apellidoPasajero = readline("Ingrese Apellido del pasajero: ");
   $dniPasajero= readline("Ingrese Dni del pasajero: ");
    return $nuevoViaje->populatePasajeros($nombrePasajero, $apellidoPasajero, $dniPasajero);
} else {
    echo "El vuelo está lleno.\n";
}
}
       
?>       
