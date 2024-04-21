<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Consultar las empresas registradas con el nombre de usuario en lugar del ID
$sql_empresas = "SELECT empresas.*, usuarios.nombres AS nombre_usuario 
                 FROM empresas 
                 INNER JOIN usuarios ON empresas.id_usuario = usuarios.id";
$resultado_empresas = mysqli_query($conexion, $sql_empresas) or die("Error al obtener la lista de empresas.");
?>

<div class="container-fluid">
    <h1>Listado de Empresas</h1>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>RUC</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo Electrónico</th>
                            <th>Usuario Encargado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($empresa = mysqli_fetch_assoc($resultado_empresas)) { ?>
                            <tr>
                                <td><?php echo $empresa['razon_social']; ?></td>
                                <td><?php echo $empresa['ruc']; ?></td>
                                <td><?php echo $empresa['direccion']; ?></td>
                                <td><?php echo $empresa['telefono']; ?></td>
                                <td><?php echo $empresa['correo']; ?></td>
                                <td><?php echo $empresa['nombre_usuario']; ?></td>
                                <td>
                                <div class="d-inline-block me-2">
                                    <a href="actualizar_empresa.php?id=<?php echo $empresa['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                </div>
                                <div class="d-inline-block">
                                    <form method="POST" action="eliminar_empresa.php" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta empresa?');">
                                        <input type="hidden" name="id_empresa" value="<?php echo $empresa['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/foot.php"); ?>
