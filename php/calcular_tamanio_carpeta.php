<?php
/**
 * Calcula el tamaño total de los archivos en un directorio.
 * 
 * @param string $directory La ruta del directorio a analizar.
 * @return int El tamaño total en bytes.
 */
function getDirectorySize($directory) {
    $size = 0;

    // Verifica si el directorio existe
    if (is_dir($directory)) {
        // Abre el directorio
        $files = scandir($directory);
        foreach ($files as $file) {
            // Ignora las entradas "." y ".."
            if ($file != "." && $file != "..") {
                $filePath = $directory . DIRECTORY_SEPARATOR . $file;

                // Si es un archivo, suma su tamaño
                if (is_file($filePath)) {
                    $size += filesize($filePath);
                }
                // Si es un directorio, calcula su tamaño recursivamente
                elseif (is_dir($filePath)) {
                    $size += getDirectorySize($filePath);
                }
            }
        }
    }
    return $size;
}

/**
 * Convierte el tamaño en bytes a un formato legible.
 * 
 * @param int $size Tamaño en bytes.
 * @return string Tamaño formateado.
 */
function formatSize($size) {
    $units = ["bytes", "KB", "MB", "GB", "TB"];
    $unitIndex = 0;

    while ($size >= 1024 && $unitIndex < count($units) - 1) {
        $size /= 1024;
        $unitIndex++;
    }

    return round($size, 2) . " " . $units[$unitIndex];
}

// Carpeta a analizar
$directory = "archivos";

// Calcula el tamaño total
$totalSize = getDirectorySize($directory);

// Muestra el resultado
echo "Used space: " . formatSize($totalSize);
?>