document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".admin-form");
    const input = document.getElementById("inputImagen");
    const preview = document.getElementById("previewImagen");

    // LIMPIAR URL
    if (window.location.search.includes("ok=1")) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // PREVIEW: al elegir una imagen nueva, se muestra de inmediato,
    // reemplazando la imagen actual del plato (sin necesidad de guardar).
    if (input && preview) {
        input.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.hidden = false;
            }
        });
    }

    // VALIDACIÓN FRONTEND (la imagen es opcional al editar: si no se
    // elige una nueva, se conserva la que ya tenía el plato)
    if (form) {
        form.addEventListener("submit", (e) => {
            let errores = false;
            limpiarErrores();

            const nombre = form.nombre.value.trim();
            const descripcion = form.descripcion.value.trim();
            const precio = form.precio.value;

            if (!nombre) {
                mostrarError("nombre", "Campo obligatorio");
                errores = true;
            }

            if (!descripcion) {
                mostrarError("descripcion", "Campo obligatorio");
                errores = true;
            }

            if (precio === "" || precio <= 0) {
                mostrarError("precio", "Precio inválido");
                errores = true;
            }

            if (errores) e.preventDefault();
        });
    }

    function mostrarError(inputName, mensaje) {
        const campo = document.querySelector(`[name="${inputName}"]`);
        const error = document.createElement("p");
        error.textContent = mensaje;
        error.classList.add("error");
        campo.insertAdjacentElement("afterend", error);
    }

    function limpiarErrores() {
        document.querySelectorAll(".error").forEach(e => e.remove());
    }

    // MENSAJE DESAPARECE
    const msg = document.getElementById("mensajeOk");
    if (msg) {
        setTimeout(() => msg.remove(), 3000);
    }
});
