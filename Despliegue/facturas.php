<?php
require_once 'facturas.entidad.php';
require_once 'facturas.model.php';

// Logica
$alm = new Facturas();
$model = new FacturasModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('DNI',              $_REQUEST['DNI']);
			$alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Direccion',            $_REQUEST['Direccion']);
			$alm->__SET('Telefono', $_REQUEST['Telefono']);

			$model->Actualizar($alm);
			header('Location: index.php');
			break;

		case 'registrar':
			$alm->__SET('DNI',          $_REQUEST['DNI']);
			$alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Direccion',            $_REQUEST['Direccion']);
			$alm->__SET('Telefono', $_REQUEST['Telefono']);
			
			$model->Registrar($alm);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['DNI']);
			header('Location: index.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['DNI']);
			break;
	}
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Facturas</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">
		<h1>Facturas</h1>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Factura</th>
                            <th style="text-align:left;">Cliente</th>
                            <th style="text-align:left;">Artículo</th>
                            
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Factura'); ?></td>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><?php echo $r->__GET('Descripcion'); ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </table>                   
            </div>
        </div>
		
    </body>
</html>
