<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_empresa'])) {
    // Obtener el ID de la empresa a eliminar
    $id_empresa = $_POST['id_empresa'];

    // Eliminar la empresa de la tabla 'empresas'
    $sql_eliminar = "DELETE FROM empresas WHERE id = '$id_empresa'";

    if (mysqli_query($conexion, $sql_eliminar)) {
        // Redireccionar a la página de listado de empresas con un mensaje de éxito
        header("Location: listar_empresas.php?mensaje=Empresa eliminada correctamente");
        exit;
    } else {
        // Si hay un error en la consulta SQL, mostrar un mensaje de error
        echo "Error al eliminar la empresa: " . mysqli_error($conexion);
    }
}
?>
