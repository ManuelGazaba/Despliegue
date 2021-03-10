<?php
require_once 'clientes.entidad.php';
require_once 'clientes.model.php';

// Logica
$alm = new Cliente();
$model = new ClientesModel();

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
		<title>EXAMEN CRUD 2DAW</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->DNI > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="DNI" value="<?php echo $alm->__GET('DNI'); ?>" />
                    
                    <table style="width:500px;">
						<tr>
                            <th style="text-align:left;">DNI</th>
                            <td><input type="text" name="DNI" value="<?php echo $alm->__GET('DNI'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                        <tr>
                            <th style="text-align:left;">Direccion</th>
                            <td><input type="text" name="Direccion" value="<?php echo $alm->__GET('Direccion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Telefono</th>
                            <td><input type="text" name="Telefono" value="<?php echo $alm->__GET('Telefono'); ?>" style="width:100%;" /></td>
                        </tr>
						
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Direccion</th>
                            <th style="text-align:left;">Telefono</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><?php echo $r->__GET('Direccion'); ?></td>
                            <td><?php echo $r->__GET('Telefono'); ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->DNI; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->DNI; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>                   
            </div>
        </div>
		<div>
			<form action="facturas.php">
				<button type="submit" class="pure-button pure-button-primary">Facturas</button>
			<form>
		</div>
    </body>
</html>