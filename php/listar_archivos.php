<?php
// Directorio que deseas explorar
$directory = "archivos";

// Verifica si el directorio existe
if (is_dir($directory)) {
    // Abre el directorio
    if ($handle = opendir($directory)) {
        echo "<style>
                ul { list-style-type: none; padding: 0; margin: 0; }
                li { margin: 5px 0; }
              </style>";
        echo "<ul>";
        // Lee los archivos y directorios dentro del directorio
        while (($file = readdir($handle)) !== false) {
            // Ignora las entradas "." y ".."
            if ($file != "." && $file != "..") {
                echo "<li><a href='$directory/$file' target='_blank'>$file</a></li>";
            }
        }
        echo "</ul>";
        closedir($handle);
    } else {
        echo "No se pudo abrir el directorio.";
    }
} else {
    echo "El directorio no existe.";
}
?>