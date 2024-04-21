<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Obtener la lista de usuarios disponibles y el usuario asociado a la empresa
$id_empresa = $_GET['id'];
$sql_usuarios = "SELECT id, nombres FROM usuarios WHERE id NOT IN (SELECT id_usuario FROM empresas WHERE id != '$id_empresa')";
$sql_empresa = "SELECT * FROM empresas WHERE id = '$id_empresa'";
$resultado_usuarios = mysqli_query($conexion, $sql_usuarios) or die("Error al obtener la lista de usuarios.");
$resultado_empresa = mysqli_query($conexion, $sql_empresa);
$empresa = mysqli_fetch_assoc($resultado_empresa);
?>

<div class="container-fluid">
    <h1>Editar Empresa</h1>
    <form method="POST" action="guardar_actualizacion_empresa.php">
        <input type="hidden" name="id_empresa" value="<?php echo $empresa['id']; ?>">
        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" class="form-control" name="razon_social" value="<?php echo $empresa['razon_social']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="ruc" class="form-label">RUC</label>
            <input type="text" class="form-control" name="ruc" value="<?php echo $empresa['ruc']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" value="<?php echo $empresa['direccion']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" value="<?php echo $empresa['telefono']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="correo" value="<?php echo $empresa['correo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario Asociado</label>
            <select name="id_usuario" class="form-select" required>
                <?php if (mysqli_num_rows($resultado_usuarios) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado_usuarios)) { ?>
                        <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $empresa['id_usuario']) echo 'selected'; ?>><?php echo $row['nombres']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <option value="" disabled>No hay usuarios disponibles para seleccionar</option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<?php include("../includes/foot.php"); ?>
