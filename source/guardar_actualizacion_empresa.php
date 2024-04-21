<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_empresa = $_POST['id_empresa'];
    $razon_social = $_POST['razon_social'];
    $ruc = $_POST['ruc'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $id_usuario = $_POST['id_usuario'];

    // Actualizar los datos en la tabla 'empresas'
    $sql_actualizar = "UPDATE empresas 
                       SET razon_social = '$razon_social', 
                           ruc = '$ruc', 
                           direccion = '$direccion', 
                           telefono = '$telefono', 
                           correo = '$correo', 
                           id_usuario = '$id_usuario' 
                       WHERE id = '$id_empresa'";

    if (mysqli_query($conexion, $sql_actualizar)) {
        // Redireccionar a la página de listado de empresas con un mensaje de éxito
        header("Location: listar_empresas.php?mensaje=Empresa actualizada correctamente");
        exit;
    } else {
        // Si hay un error en la consulta SQL, mostrar un mensaje de error
        echo "Error al actualizar la empresa: " . mysqli_error($conexion);
    }
}
?>
