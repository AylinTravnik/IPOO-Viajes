<?php
include 'Viaje.php';
include 'pasajero.php';
include 'ResponsableV.php';
include "ViajeAereo.php";
include "ViajeTerrestre.php";

$viaje = null;
$opcion = 1;

//DATOS PRE CARGADOS//
 /**********DATOS PRECARGADOS***************/
     $p1= new Pasajero("Luis", "Saenz", 40123123, 4465444);
    
     $p2= new Pasajero("Pepe", "Rodriguez", 30123123, 4465900);
    
     $p3= new Pasajero("Luna", "Perez", 20123123, 4465555);
    
     $p4= new Pasajero("Maria", "Saenz", 10123123, 4465444);
     //**********DATOS PRECARGADOS********** */
    $resp= new ResponsableV("Lucia", "Aguilar", 3453, 4325);
    
  
    

$viaje= new ViajeAereo("AA1234", "China", 23, [$p1, $p2, $p3, $p4], $resp, 350, "ida", 234, "Primera Clase", "Aerolineas Argentinas", 1);



//Menu principal
while ($opcion != 0) {
    $menu = "\033[1mMenú de opciones:\033[0m";
    echo "\033[4m$menu\033[0m";
    echo "
    \n
    0-Salir
    1-Cargar informacion de un viaje  
    2-Cargar un pasajero
    3-Modificar informacion viaje
    4-Modificar Pasajero
    5-Agregar Informacion Responsable
    6-Modificar Informacion Responsable
    7-Visualizar informacion del viaje
    8-Realizar Venta
    \n";
    $opcion = readline();
    switch ($opcion) {
        case 0: echo "Saliendo del test"; break;

        case 1: $viaje = crearViaje();break;

        case 2:  if ($viaje !== null) {
            $seAgrego=agregarPasajero($viaje);
            echo $seAgrego;
        } else {
            echo "No se cargó un viaje.\n";
        };break;

        case 3: if ($viaje !== null) {
            menuModificarViaje($viaje);
        } else {
            echo "No se cargó un viaje.\n";
        };break;

        case 4: if ($viaje !== null) {
            $DNIPasajero = readline("Ingrese el DNI del pasajero a modificar: ");
            $existe = $viaje->encontrarPasajero($DNIPasajero);

            if ($existe < 0) {
                echo "ERROR No se encontro pasajero con ese DNI.\n";
            } else {
                cambiarPasajero($existe, $viaje);
            }
            break;
        } else {
            echo "No se cargó un viaje.\n";
        };break;

        case 5:  if ($viaje !== null) {
            agregarResponsableV($viaje);
        } else {
            echo "No se cargó un viaje.\n";
        };break;

        case 6:  if ($viaje !== null) {
            menuModificarResponsable($viaje);
        } else {
            echo "No se cargó un viaje.\n";
        };break;

        case 7: if ($viaje !== null) {
            echo $viaje;
            $viaje->imprimirPasajeros();
        } else {
            echo "No se cargó un viaje.\n";
        };break;
        case 8: if ($viaje !== null) {
            if ($viaje->hayPasajesDisponible()) {
                $pasajero = ingresarPasajero();
                $costo=$viaje->venderPasaje($pasajero);
                echo $costo;
            };
        } else {
            echo "No se cargó un viaje.\n";
        };break;
    }
}

//Funcion Crear viaje, Crea un Objeto de la Clase viaje, con los datos entrados por el usuario
function crearViaje()
{
    $responsable= "";
    $pasajeros = [];
    $codigo= readline("Ingrese el codigo de vuelo: ");
    $destino = readline("Ingrese el destino: ");
    $capacidad = readline("Ingrese la capacidad del vuelo: ");
    $importe=0;
    $tramos =  readline("Ingrese si el viaje es ida, o ida y vuelta: ");
    $nuevoViaje = new Viaje($codigo, $destino, $capacidad, $pasajeros, $responsable, $importe, $tramos);
    echo "Se creo correctamente un nuevo viaje.\n ";
    return $nuevoViaje;
}

function ingresarPasajero()
{
    $nombrePasajero = readline("Ingrese Nombre del Pasajero: ");
    $apellidoPasajero = readline("Ingrese Apellido del pasajero: ");
    $dniPasajero= readline("Ingrese Dni del pasajero: ");
    $telefonoPasajero=readline("Ingrese el telefono del pasajero:");
    $nuevoPasajero= new Pasajero($nombrePasajero, $apellidoPasajero, $dniPasajero, $telefonoPasajero);
    return $nuevoPasajero;
}

function agregarPasajero($viaje)
{
    $nombrePasajero = readline("Ingrese Nombre del Pasajero: ");
    $apellidoPasajero = readline("Ingrese Apellido del pasajero: ");
    $dniPasajero= readline("Ingrese Dni del pasajero: ");
    $telefonoPasajero=readline("Ingrese el telefono del pasajero:");
    $nuevoPasajero= new Pasajero($nombrePasajero, $apellidoPasajero, $dniPasajero, $telefonoPasajero);
    $resultado=$viaje->agregarPasajeroAColeccion($nuevoPasajero);
    echo $resultado;
}
function cambiarPasajero($esElPasajero, $viaje)
{
    $op=-1;
    while ($op != 0) {
        $esCorrecto=false;
        echo
             "Ingrese que desea modificar del pasajero
              0- Salir
              1- Nombre del pasajero
              2- Apellido del pasajero
              3- Telefono\n";

        $op = readline();
        switch ($op) {
            case 1 :
                $datoIngresado=readline("Ingrese nuevo Nombre");//guardamos en $nombrePasajero el Nuevo nombre
                
              
                break;
            case 2 :
                $datoIngresado=readline("Ingrese nuevo Apellido");
              
                break;
            case 3 :
                $datoIngresado=readline("Ingrese nuevo telefono");
              
                break;
                
               
            default: echo"ERROR Opcion incorrecta. Ingrese 0-1-2-3.\n"; break; //solo permite que usuario ingrese opcion valida
           }
        $viaje->modificarPasajero($esElPasajero, $op, $datoIngresado);
    }
}
function agregarResponsableV($viaje)
{
    $nombreResponsable = readline("Ingrese Nombre del Responsable: ");
    $apellidoResponsable = readline("Ingrese Apellido del Responsable: ");
    $numeroLicencia= readline("Ingrese numero de licencia del responsable: ");
    $numeroEmpleado=readline("Ingrese el numero de Empleado del responsable:");
    $nuevoResponsable= new ResponsableV($nombreResponsable, $apellidoResponsable, $numeroLicencia, $numeroEmpleado);
    $viaje->setResponsable($nuevoResponsable);
}
function menuModificarResponsable($viaje)
{
    echo
                 "Ingrese que desea modificar del Responsable
                  0- Salir
                  1- Nombre del Responsable
                  2- Apellido del Responsable
                  3- Numero Licencia
                  4- Numero Empleado\n";

    $op = readline(); //lee que pone usuario
    switch ($op) {
                case 1 :
                    $datoIngresado=readline("Ingrese nuevo Nombre");//guardamos en $nombrePasajero el Nuevo nombre
                    $viaje->modificarResponsable($op, $datoIngresado);
                 
    break;
    case 2 :
                    $datoIngresado=readline("Ingrese nuevo Apellido");//guardamos en $nombrePasajero el Nuevo nombre
                    $viaje->modificarResponsable($op, $datoIngresado);

    break;
    case 3 :
                    $datoIngresado=readline("Ingrese nuevo Numero de Licencia");//guardamos en $nombrePasajero el Nuevo nombre
                    $viaje->modificarResponsable($op, $datoIngresado);

    break;
    case 4 :
                    $datoIngresado=readline("Ingrese nuevo Numero de Empleado");//guardamos en $nombrePasajero el Nuevo nombre
                    $viaje->modificarResponsable($op, $datoIngresado);

    break;
                    
                   
    default: echo"ERROR Opcion incorrecta. Ingrese 0-1-2-3-4.\n";
    break;

   
}
}

function menuModificarViaje($viaje)
{
    {
        $opcion = -1;
        while ($opcion != 0) {
            echo "
        \n
        0-Salir 
        1-Modificar Codigo de vuelo 
        2-Modificar Destino
        3-Modificar Cantidad Maxima Pasajeros
        \n";
            $opcion = readline();
            echo "\n";
            switch ($opcion) {
            case 0: echo "Saliendo del test"; break;
            case 1: $datoIngresado = readline("Ingrese el nuevo codigo de vuelo: ");
                $viaje->modificarViaje($opcion, $datoIngresado);
                  break;
            case 2: $datoIngresado = readline("Ingrese el nuevo destino de vuelo: ");
                $viaje->modificarViaje($opcion, $datoIngresado);
                  break;
            case 3:  $datoIngresado = readline("Ingrese la nueva cantidad maxima de pasajeros: ");
                 break;
                 $viaje->modificarViaje($opcion, $datoIngresado);
    }
        }
        }
}


