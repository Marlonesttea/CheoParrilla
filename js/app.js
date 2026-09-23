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
    const quickMenu = document.querySelector('.gooey-menu');
    const quickMenuToggle = quickMenu?.querySelector('.gooey-menu__toggle');
    const quickMenuItems = quickMenu?.querySelectorAll('.gooey-menu__item');

    if (quickMenu && quickMenuToggle && quickMenuItems?.length) {
        const distance = parseFloat(getComputedStyle(quickMenu).getPropertyValue('--gooey-menu-distance'));
        const itemCount = quickMenuItems.length;
        const startAngle = -Math.PI / 2;
        const endAngle = -Math.PI;
        const angleStep = itemCount > 1 ? (endAngle - startAngle) / (itemCount - 1) : 0;

        quickMenuItems.forEach((item, index) => {
            const angle = startAngle + (angleStep * index);
            item.style.setProperty('--gooey-menu-x', `${Math.cos(angle) * distance}px`);
            item.style.setProperty('--gooey-menu-y', `${Math.sin(angle) * distance}px`);
        });

        quickMenuToggle.addEventListener('click', () => {
            const isOpen = quickMenu.classList.toggle('is-open');
            quickMenuToggle.setAttribute('aria-expanded', String(isOpen));
            quickMenuToggle.setAttribute('aria-label', isOpen ? 'Cerrar acciones rápidas' : 'Abrir acciones rápidas');
        });
    }

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

document.addEventListener('DOMContentLoaded', () => {
    const menuCards = document.querySelectorAll('.uiv-card');

    if (!menuCards.length) return;

    const productModal = document.createElement('div');
    productModal.className = 'producto-modal';
    productModal.setAttribute('aria-hidden', 'true');
    productModal.innerHTML = `
        <div class="producto-modal__panel" role="dialog" aria-modal="true" aria-labelledby="producto-modal-title">
            <button class="producto-modal__close" type="button" aria-label="Cerrar información del producto">&times;</button>
            <div class="producto-modal__image" role="img" aria-label="Imagen del producto"></div>
            <div class="producto-modal__content">
                <p class="producto-modal__category"></p>
                <h2 id="producto-modal-title"></h2>
                <p class="producto-modal__description"></p>
                <p class="producto-modal__price"></p>
            </div>
        </div>
    `;
    document.body.appendChild(productModal);

    const modalImage = productModal.querySelector('.producto-modal__image');
    const modalCategory = productModal.querySelector('.producto-modal__category');
    const modalTitle = productModal.querySelector('#producto-modal-title');
    const modalDescription = productModal.querySelector('.producto-modal__description');
    const modalPrice = productModal.querySelector('.producto-modal__price');
    const closeButton = productModal.querySelector('.producto-modal__close');

    const getCardCategory = (card) => {
        let element = card.previousElementSibling;

        while (element) {
            if (element.classList.contains('barra')) {
                return element.querySelector('h2')?.textContent.trim() || 'Especialidad de la casa';
            }

            element = element.previousElementSibling;
        }

        return 'Especialidad de la casa';
    };

    const closeProductModal = () => {
        productModal.classList.remove('is-open');
        productModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('producto-modal-open');
    };

    menuCards.forEach((card) => {
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        card.setAttribute('aria-label', 'Ver información de ' + card.querySelector('#uiv-cardbottomtitle').textContent.trim());

        const openProductModal = () => {
            const imageElement = card.querySelector('#uiv-cardtop');
            const sectionTitle = getCardCategory(card);
            const title = card.querySelector('#uiv-cardbottomtitle').textContent.trim();
            const price = card.querySelector('#uiv-cardbottomprice').textContent.trim();
            const description = card.dataset.description?.trim() || `${title}, preparado al estilo de Cheo Parrilla con ingredientes seleccionados y el sabor de nuestra cocina.`;
            const backgroundImage = getComputedStyle(imageElement).backgroundImage;

            modalImage.style.backgroundImage = backgroundImage;
            modalImage.setAttribute('aria-label', `Imagen ampliada de ${title}`);
            modalCategory.textContent = sectionTitle;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalPrice.textContent = price;
            productModal.classList.add('is-open');
            productModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('producto-modal-open');
            closeButton.focus();
        };

        card.addEventListener('click', openProductModal);
        card.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openProductModal();
            }
        });
    });

    closeButton.addEventListener('click', closeProductModal);
    productModal.addEventListener('click', (event) => {
        if (event.target === productModal) closeProductModal();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeProductModal();
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
