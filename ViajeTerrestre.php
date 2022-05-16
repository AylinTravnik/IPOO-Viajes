<?php
class ViajeTerrestre extends Viaje
{
    private $tipoAsiento;

    public function __construct(
        $codigo,
        $desti,
        $capacidad,
        $colPasajeros,
        $esResponsable,
        $esImporte,
        $esTramos,
        $nuevoTipoAsiento
    ) {
        parent::_construct($codigo, $desti, $capacidad, $colPasajeros, $esResponsable, $esImporte, $esTramos);
        $this->tipoAsiento = $nuevoTipoAsiento
    ;
    }
    public function getTipoAsiento()
    {
        return $this->tipoAsiento;
    }
    public function setTipoAsiento($nuevoTipoAsiento)
    {
        $this->tipoAsiento = $nuevoTipoAsiento;
    }

    public function venderPasaje($pasajero)
    {
        $hayLugar= parent::hayPasajeDisponible();
        $importePasaje;
    
        if ($hayLugar ==false) {
            $importePasaje= null;
        } else {
            $nuevoPasajero=parent::agregarPasajeroAcoleccion($pasajero);
            parent:: actualizadorDisponibilidad(); 
            if ($nuevoPasajero == true) {
                $cantPasajeros= parent::getCantPasajeros();
                $nuevaCantidad= $cantPasajeros +1;
                parent::setCantPasajeros($nuevaCantidad);
            }
            $valorOriginal=parent::getImporte();
            if ($this->getTipoAsiento()== "cama") {
                $importePasaje =$valorOriginal* $valorOriginal *(25/100);
            } else {
                $importePasaje= $valorOriginal;
            }
            if (parent::getTramo()== "ida y vuelta") {
                $importePasaje = $importePasaje*2;
            }
            
        }
        return $importePasaje;
    }



    public function __toString()
    {
        $cadena= parent::__toString();
        $cadena.= "\n El tipo de asiento es:\n ".$this->getTipoAsiento();
        return $cadena;
    }
}
