<?php
    include("../includes/head.php");
    include("../includes/conectar.php");
    $conexion = conectar();

    // Obtener la lista de usuarios disponibles
    $sql_usuarios = "SELECT id, nombres FROM usuarios";
    $resultado_usuarios = mysqli_query($conexion, $sql_usuarios) or die("Error al obtener la lista de usuarios.");

    // Verificar si el usuario ya está asociado a otra empresa
    function usuarioAsociado($conexion, $id_usuario) {
        $sql_verificar = "SELECT * FROM empresas WHERE id_usuario = '$id_usuario'";
        $resultado_verificar = mysqli_query($conexion, $sql_verificar);
        return mysqli_num_rows($resultado_verificar) > 0;
    }

    // Procesar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $razon_social = $_POST['razon_social'];
        $ruc = $_POST['ruc'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $id_usuario = $_POST['id'];

        // Verificar si el usuario ya está asociado a otra empresa
        if(usuarioAsociado($conexion, $id_usuario)) {
            // Mostrar alerta si el usuario ya está asociado a otra empresa
            echo "<script>alert('Error: Este usuario ya está asociado a otra empresa.');</script>";
        } else {
            // Insertar los datos en la tabla 'empresas'
            $sql_insertar = "INSERT INTO empresas (razon_social, ruc, direccion, telefono, correo, id_usuario) 
                            VALUES ('$razon_social', '$ruc', '$direccion', '$telefono', '$correo', '$id_usuario')";

            mysqli_query($conexion, $sql_insertar) or die("Error al guardar la empresa.");

            header("Location: listar_empresas.php");
            exit; // Terminar la ejecución del script después de redireccionar
        }
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid px-6">
    <!-- Inicio de la zona central del sistema -->
    <div class="card  shadow-lg rounded-3 p-4">
        <h2 class="text-center text-primary">Crear una Empresas Nuevas</h2>

        <form method="POST" class=" p-4 bg-light rounded">

            <div class="mb-3">
                <label for="razon_social" class="form-label"><strong>Razón Social</strong></label>
                <input type="text" class="form-control" name="razon_social" required>
            </div>

            <div class="mb-3">
                <label for="ruc" class="form-label"><strong>RUC</strong></label>
                <input type="text" class="form-control" name="ruc" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label"><strong>Dirección</strong></label>
                <input type="text" class="form-control" name="direccion" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label"><strong>Teléfono</strong></label>
                <input type="text" class="form-control" name="telefono" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label"><strong>Correo</strong></label>
                <input type="email" class="form-control" name="correo" required>
            </div>

            <div class="mb-3">
                <label for="id_usuario" class="form-label"><strong>Usuario</strong></label>
                <select name="id" class="form-select" required>
                    <option value="">Seleccione un usuario</option>
                    <?php while ($row = mysqli_fetch_assoc($resultado_usuarios)) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombres']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn-left btn-success rounded shadow-xl  rounded-3 p-3 ">Registrar Empresa</button>
        </form>
    </div>
    <!-- Fin  de la zona central del sistema -->
</div>

<!-- /.container-fluid --> 

<?php
    include("../includes/foot.php");
?>
