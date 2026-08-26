// EVENTOS SUBMIT
const formulario  = document.querySelector(".formulario")
formulario.addEventListener('submit',function (e) {
   // console.log(e);
   e.preventDefault();

   // VALIDAR INFORMACION
   const {nombre, email, mensaje } = datos;

   if (nombre === "" || email === "" || mensaje === "" ) {
      mostrarMensaje("Existen campos obligatorios(*) vacios")
      return // corta la ejecucion de l codigo
      } 
      mostrarMensaje2("Mensaje enviado con exito")





   // Mostrar mensaje en pantalla}
   function mostrarMensaje (mensaje) {
      const error = document.createElement('P');
      error.classList.add('error')
      error.textContent = mensaje

      formulario.appendChild(error)

      // desaparecer mensaje
   setTimeout(()=> {
      error.remove();
   }, 5000)
   }

   function mostrarMensaje2 (mensaje) {
      const mensajeOK = document.createElement('P');
      mensajeOK.classList.add('mensajeOK')
      mensajeOK.textContent = mensaje

      formulario.appendChild(mensajeOK)

      // desaparecer mensaje
   setTimeout(()=> {
      mensajeOK.remove();
   }, 5000)
   }







   // ENVIAR LA INFORMACION


   console.log("ENVIANDO FORMULARIO...")
})




// EVENTOS EN LOS INPUT Y TEXTAREA

const datos = {
    nombre : '',
    apellido : '',
    celular : '',
    email : '',
    mensaje : ''
}



const nombre = document.querySelector("#nombre");
const apellido = document.querySelector('#apellido');
const celular = document.querySelector('#celular');
const email = document.querySelector('#email');
const mensaje = document.querySelector('#mensaje');

nombre.addEventListener('input', leerDatos)
apellido.addEventListener('input', leerDatos)
celular.addEventListener('input', leerDatos)
email.addEventListener('input', leerDatos)
mensaje.addEventListener('input', leerDatos)


function leerDatos (e) {
    // console.log(e.target.value);

    datos[e.target.id] = e.target.value
    console.log(datos);
}




