<?php
class ViajeAereo extends Viaje
{
    private $numeroVuelo;
    private $catAsiento;
    private $nombreAerolinea;
    private $cantEscalas;
    
    public function __construct($codigo, $desti, $capacidad, $colPasajeros, $esResponsable, $esImporte, $esTramos, $nuevoNumeroVuelo, $esCatAsiento, $esNombreAerolinea, $esCantEscalas)
    {
        parent::__construct($codigo, $desti, $capacidad, $colPasajeros, $esResponsable, $esImporte, $esTramos);
        $this->numeroVuelo = $nuevoNumeroVuelo;
        $this->catAsiento = $esCatAsiento;
        $this->nombreAerolinea = $esNombreAerolinea;
        $this->cantEscalas = $esCantEscalas;
    }
    public function getNumeroVuelo()
    {
        return $this->numeroVuelo;
    }
    public function getCatAsiento()
    {
        return $this->catAsiento;
    }
    public function getNombreAerolinea()
    {
        return $this->nombreAerolinea;
    }
    public function getCantEscalas()
    {
        return $this->cantEscalas;
    }

    //sets de los atributos
    public function setNumeroVuelo($nuevoNumeroVuelo)
    {
        $this->numeroVuelo = $nuevoNumeroVuelo;
    }
    public function setCatAsiento($nuevaCatAsiento)
    {
        $this->catAsiento = $nuevaCatAsiento;
    }
    public function setNombreAerolinea($nuevoNombreAerolinea)
    {
        $this->nombreAerolinea = $nuevoNombreAerolinea;
    }
    public function setCantEscalas($nuevaCantEscalas)
    {
        $this->cantEscalas = $nuevaCantEscalas;
    }


    //Recibe un pasajero, lo agrega a la Cantidad de pasajeros, A
    public function venderPasaje($pasajero)
    {
        $importePasaje= 0;

        parent::agregarPasajeroAcoleccion($pasajero);

         parent:: actualizadorDisponibilidad(); 
        

        $valorOriginal=parent::getImporte();

        if ($this->getCatAsiento() =="Primera Clase" && $this->getCantEscalas() == 0) {
            $importePasaje = $valorOriginal +$valorOriginal * (40/100);
        } elseif ($this->getCatAsiento() =="Primera Clase" && $this->getCantEscalas() >0) {
            $importePasaje = $valorOriginal +$valorOriginal*(60/100);
        } else {
            $importePasaje = parent::getImporte();
        }
        if (parent::getTramos() == "ida y vuelta") {
            $importePasaje = $importePasaje*2;
        }
     
 

        return $importePasaje;
    }
   
 
    





    public function __toString()
    {
        $cadena= parent::__toString();
        $cadena.= " \nEl Numero de vuelo es:\n ".$this->getNumeroVuelo()."\n La Categoria de Asiento es:\n ".$this->getCatAsiento().
    "\n El Nombre de la aerolinea es:\n ".$this->getNombreAerolinea(). "\n La Cantidad de Escalas es:\n ".$this->getCantEscalas();
        return $cadena;
    }
}
