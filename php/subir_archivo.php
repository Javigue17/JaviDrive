<?php
// Verificar si se ha enviado el archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    // Datos del archivo
    $archivo = $_FILES['archivo'];
    $nombreArchivo = $archivo['name'];
    $tmpArchivo = $archivo['tmp_name'];
    $errorArchivo = $archivo['error'];
    $tamanioArchivo = $archivo['size'];
    
    // Ruta de la carpeta donde se guardará el archivo
    $carpetaDestino = '../archivos/';
    
    // Comprobamos si hay errores en la carga
    if ($errorArchivo !== UPLOAD_ERR_OK) {
        echo "Error al cargar el archivo.";
        exit;
    }

    // Verificamos que el archivo no sea demasiado grande (por ejemplo, máximo 2MB)
    if ($tamanioArchivo > 1000 * 1024 * 1024) {  // 2MB en bytes
        echo "El archivo es demasiado grande. Máximo 100MB.";
        exit;
    }

    // Verificamos la extensión del archivo (por ejemplo, solo permitir imágenes)
    $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif','pdf','avi','mp4','mp3','wav'];

    //if (!in_array(strtolower($ext), $extensionesPermitidas)) {
    //    echo "El archivo no tiene una extensión permitida.";
    //    exit;
    //}

    // Generar un nombre único para evitar sobreescritura de archivos con el mismo nombre
    //$nombreNuevo = uniqid() . '.' . $ext;

     $nombreNuevo = $nombreArchivo;

    // Mover el archivo a la carpeta destino
    if (move_uploaded_file($tmpArchivo, $carpetaDestino . $nombreNuevo)) {
        echo "Archivo subido con éxito: " . $nombreNuevo;
    } else {
        echo "Error al mover el archivo al directorio de destino.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}
?>