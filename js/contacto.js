const formulario = document.querySelector(".contacto-form");

if (formulario) {
    formulario.addEventListener("submit", (event) => {
        event.preventDefault();

        const datos = new FormData(formulario);
        const telefono = formulario.dataset.whatsapp;
        const situacion = formulario.querySelector("#situacion");

        if (!telefono || !/^\d+$/.test(telefono)) {
            mostrarMensaje("No se pudo obtener el número de WhatsApp del restaurante.", "error");
            return;
        }

        const mensaje = [
            "Hola CheoParrilla, quiero comunicarme con ustedes.",
            `Nombre: ${datos.get("nombre")}`,
            `Teléfono: ${datos.get("celular")}`,
            `Situación: ${situacion.options[situacion.selectedIndex].text}`,
            `Mensaje: ${datos.get("mensaje")}`
        ].join("\n");

        const enlace = `https://wa.me/${telefono}?text=${encodeURIComponent(mensaje)}`;
        const ventana = window.open(enlace, "_blank");
        if (!ventana) {
            window.location.assign(enlace);
            return;
        }

        ventana.opener = null;
        mostrarMensaje("WhatsApp se abrió con tu mensaje listo. Presiona Enviar allí para compartirlo.", "mensajeOK");
    });
}

function mostrarMensaje(texto, clase) {
    const mensaje = document.createElement("p");
    mensaje.classList.add(clase);
    mensaje.setAttribute("role", clase === "error" ? "alert" : "status");
    mensaje.textContent = texto;
    formulario.appendChild(mensaje);

    window.setTimeout(() => mensaje.remove(), 5000);
}
