<?php
class Facturas
{
	private $Factura;
	private $Nombre;
	private $Descripcion;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}