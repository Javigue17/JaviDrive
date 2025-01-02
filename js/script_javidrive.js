const formulario = document.getElementById("formulario");
const barraProgreso = document.getElementById("barra-de-progreso");
const progreso = document.getElementById("progreso");
const porcentajeTexto = document.getElementById("porcentaje");

formulario.addEventListener("submit", function (e) {
    e.preventDefault(); // Evitar el envío normal del formulario

    const formData = new FormData(formulario);

    // Crear una solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", formulario.action, true);

    // Actualizar la barra de progreso a medida que se sube el archivo
    xhr.upload.addEventListener("progress", function (e) {
        if (e.lengthComputable) {
            const porcentaje = (e.loaded / e.total) * 100;
            progreso.style.width = porcentaje + "%";
            //progreso.textContent = Math.round(porcentaje) + "%";
            porcentajeTexto.textContent = Math.round(porcentaje) + "%"; // Actualizar el porcentaje fuera de la barra
        }
    });
    // Enviar la solicitud
    xhr.send(formData);
});