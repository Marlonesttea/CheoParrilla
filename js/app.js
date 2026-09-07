// //querySelector

// //const prueba =document.querySelector("SPAN") // null o el primer elemento - selecciona etiquetas
// //const prueba =document.querySelector(".container") // seleccionar clase
// // const prueba =document.querySelector("#menu") // seleccionar id

// const prueba =document.querySelector(".grid-galeria img") // null o el primer elemento - selecciona etiquetas

// // console.log(prueba)

// const cambio = document.querySelector("H1")
// cambio.textContent = "Sabores que ilusionan" // cambiar texto
// cambio.classList.add("NuevaClase")

// // console.log(cambio)


// // querySelectorAll


// const all = document.querySelectorAll("A") // selecionar por etiquetas


// //  console.log(all)



//  const  pruebaAll = document.querySelectorAll( ".footer-content a")
//     // console.log(pruebaAll)

//     // console.log(pruebaAll[1])


// const nav2 = document.querySelectorAll("nav a");
// // console.log(nav2[2])
// nav2[2].textContent = "Google";
// nav2[2].href = "https://google.com/"


// // getElementById 
// const getid = document.getElementById("galeria")
// // console.log(getid)

// const getClass = document.getElementsByClassName("cards")
// // console.log(getClass)

// // CREAR HTML 

// // <a href="contacto.html">Contacto</a>

// // ETIQUETA
// const nuevoEnlace =document.createElement("A")

// // HREF
// nuevoEnlace.href ="https://upb.edu.co/"

// // TEXT
// nuevoEnlace.textContent = "Universidad"

// // CLASE
// nuevoEnlace.classList.add("upb")

// //agregar al documentos
// const navegacion = document.querySelector("nav")
// navegacion.appendChild(nuevoEnlace)

// // console.log(nuevoEnlace)


// // EVENTOS 
// // console.log(1);

// // window.addEventListener('load', function () {
// //     console.log(2);
// // })
// // window.addEventListener('load', imprir)

// // document.addEventListener('DOMContentLoaded', function(){
// //      console.log(3);
// // })
// // console.log(5);

// // function imprir () {
// //     console.log(4)
// // }


// SELECCIONAR ELEMENTOS Y ASOCIARLSO A EVENTOS
// const btnEnviar = document.querySelector(".btn-enviar")
// btnEnviar.addEventListener('click',  function (evento) {
//    console.log(evento);
// //    evento.preventDefault();

//    console.log("Enviando formulario...")
// })


const loader = document.querySelector('.loader-fondo');

document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navPanel = document.getElementById('nav-panel');

    if (!navToggle || !navPanel) return;

    const closeMenu = () => {
        navPanel.classList.remove('is-open');
        navToggle.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
        navPanel.setAttribute('aria-hidden', 'true');
    };

    navToggle.addEventListener('click', () => {
        const isOpen = navPanel.classList.toggle('is-open');
        navToggle.classList.toggle('is-open', isOpen);
        navToggle.setAttribute('aria-expanded', String(isOpen));
        navPanel.setAttribute('aria-hidden', String(!isOpen));
    });

    navPanel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.nav-toggle') && !event.target.closest('.nav-panel')) {
            closeMenu();
        }
    });
});

window.addEventListener('load', () => {
    console.log('Página cargada completamente');

    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 500);
    }
});
