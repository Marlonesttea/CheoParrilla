(() => {
    'use strict';

    const container = document.querySelector('.card-container-pedir');
    if (container) {
        const categories = [...container.querySelectorAll('.categoria-pedir')];
        const panelHeadingTemplate = container.querySelector('.categoria-pedir-panel-heading-template');
        const categoryImages = {
            asadoPedir: 'carnes-menu.png',
            hamburPedir: 'hamburguesa-menu.png',
            combohambPedir: 'combos-menu.png',
            salchiPedir: 'salchipapas-menu.png',
            perrosperrasPedir: 'perros-menu.png',
            otrosPedir: 'otros-menu.png',
            bebidasPedir: 'bebidas-menu.png',
            licoresPedir: 'licores-menu.png'
        };
        const productImages = {
            'Coca-Cola': 'CocaCola.jpeg',
            'Coca-Cola Zero': 'Zero.jpeg',
            Premio: 'Premio.png',
            Quatro: 'Quatro.png',
            Sprite: 'Sprite.png',
            'Jugo en leche': 'JugoLeche.jpeg',
            'Limonada natural': 'Limonada.png',
            'Limonada Hierbabuena': 'Hierbabuena.jpeg',
            'Ron 8 años': 'Ron8años.png',
            'Guaro Tapa roja': 'TapaRoja.png',
            Buchanans: 'Buchanans.png',
            'Old Parr': 'OldParr.png',
            Corona: 'Corona.jpeg',
            '3 Cordilleras': '3Cordilleras.png',
            Heineken: 'Heineken.jpeg',
            'Club Colombia': 'ClubColombia.png',
            Aguila: 'Aguila.png',
            'Aguila Light': 'Light.png',
            Pilsen: 'Pilsen.png'
        };
        const productDescriptions = {
            asadoPedir: {
                'Chuzo de Pollo': 'Pollo asado, papas a la francesa, arepa con queso y ensalada.',
                'Chuzo de cerdo': 'Cerdo asado, papas a la francesa, arepa con queso y ensalada.',
                'Carne de Cerdo': 'Carne de cerdo asada, papas a la francesa, arepa con queso y ensalada.',
                'Carne de Res': 'Carne de res asada, papas a la francesa, arepa con queso y ensalada.',
                Chuleta: 'Chuleta de cerdo, papas a la francesa, arepa con queso y ensalada.',
                Costichic: 'Costilla, papas a la francesa, arepa con queso y ensalada.',
                Pechuga: 'Pechuga de pollo, papas a la francesa, arepa con queso y ensalada.',
                'Carne de Res envinada': 'Carne de res con vino, papas a la francesa, arepa con queso y ensalada.',
                'Pechuga Gratinada': 'Pechuga de pollo con queso gratinado, papas a la francesa, arepa y ensalada.',
                'Punta de Anca': 'Punta de anca asada, papas a la francesa, arepa con queso y ensalada.',
                Churrasco: 'Churrasco de res, papas a la francesa, arepa con queso y ensalada.',
                'Picada para 2 personas': 'Papas, chorizo, salchicha, carnes, queso y variedad de acompañamientos.'
            },
            hamburPedir: {
                Sencilla: 'Carne, queso, lechuga, ensalada y salsas.',
                Especial: 'Carne, queso, tocineta, vegetales y salsas.',
                'Doble Carne': 'Carne, doble porción de carne, queso, vegetales y salsas.',
                'Ropa Vieja': 'Hamburguesa de excelente calidad, preparada con ingredientes seleccionados.',
                'Pollo con Champiñones': 'Carne, pollo, champiñones, queso y salsas.',
                Hawaiana: 'Carne, queso, piña, tocineta y salsas.',
                'Pollo Maicito': 'Carne, queso, pollo, maicitos y salsas.',
                Quesuda: 'Carne, queso, vegetales, salsas y extra de queso.',
                Mexicana: 'Carne, queso, pico de gallo, guacamole y salsas.',
                Mixta: 'Carne, pollo, queso, vegetales y salsas.',
                Jumbo: 'Hamburguesa grande con carne y variedad de ingredientes.',
                ChuzoBurguer: 'Hamburguesa con carne asada, queso, vegetales y salsas.',
                Paisa: 'Carne, huevo, papa ripio, chicharrón, queso y salsas.',
                Carnaval: 'Carne, queso, vegetales, salsas y variedad de ingredientes.'
            },
            combohambPedir: {
                'Combo Hamburguesas': 'Hamburguesa sencilla, papas a la francesa y bebida.',
                'Combo Alitas: Combo 1': 'Alitas de pollo con acompañamientos.',
                'Combo Alitas: Combo 2': 'Alitas de pollo con acompañamientos.',
                'Combo Alitas: Combo 3': 'Alitas de pollo con acompañamientos.'
            },
            salchiPedir: {
                Sencilla: 'Papas, salchicha, queso y salsas.',
                Especial: 'Papas, salchicha, queso, ingredientes especiales y salsas.',
                Desgranada: 'Papas, salchicha, mucho queso y maicitos.',
                'Con pollo': 'Papas, salchicha, pollo, queso y salsas.',
                'Con carne': 'Papas, salchicha, carne, queso y salsas.',
                Paisa: 'Papas, salchicha, huevo, arepa, papa ripio y chorizo.'
            },
            perrosperrasPedir: {
                'Perro Sencillo': 'Salchicha, ensalada, queso, papa ripio y salsas.',
                'Perro Especial': 'Salchicha, queso, tocineta, papa ripio y salsas.',
                'Perro Doble Cañon': 'Doble salchicha, queso, ensalada, papa ripio y salsas.',
                'Perro Hawaiano': 'Salchicha, piña, queso, ensalada y papa ripio.',
                'Perro con carne': 'Salchicha, carne, queso, ensalada y papa ripio.',
                'Perro pollo y maicitos': 'Salchicha, pollo, maicitos, queso y papa ripio.',
                'Perro mexicano': 'Salchicha, pico de gallo, guacamole, queso y papa ripio.',
                'Perro quesudo': 'Salchicha, mucho queso, ensalada, papa ripio y salsas.',
                'Perro pollo con champiñones': 'Salchicha, pollo, champiñones, queso y papa ripio.',
                Chuzoperro: 'Salchicha, carne asada, queso, ensalada y papa ripio.',
                'Perro Jumbo de 40cm': 'Perro caliente de 40 cm con salchicha y variedad de ingredientes.',
                'Perra Especial': 'Tocineta, queso, ensalada, papa ripio y salsas.',
                'Perra Fufa': 'Tocineta y variedad de ingredientes, queso, papa ripio y salsas.',
                'Perra pollo y maicitos': 'Tocineta, pollo, maicitos, queso y papa ripio.',
                'Perra Quesuda': 'Tocineta, mucho queso, papa ripio, ensalada y salsas.',
                'Perra pollo con champiñones': 'Tocineta, pollo, champiñones, queso y papa ripio.',
                'Perra grilla': 'Tocineta, mucha papa ripio, queso, ensalada y salsas.'
            },
            otrosPedir: {
                'Arepa Burguer': 'Hamburguesa con carne y arepas en lugar de pan.',
                Burrito: 'Arroz, pollo, carne, fríjoles, maicitos, lechuga y queso.',
                Patacón: 'Patacón con carne desmechada, queso y variedad de ingredientes.',
                'Ceviche de Chicharrón': 'Ceviche preparado con chicharrón y acompañamientos.'
            },
            bebidasPedir: {
                'Coca-Cola': 'Gaseosa de sabor clásico y refrescante.',
                'Coca-Cola Zero': 'Gaseosa Coca-Cola sin azúcar.',
                Agua: 'Agua refrescante.',
                Premio: 'Gaseosa colombiana dulce y refrescante.',
                Quatro: 'Gaseosa de sabor cítrico.',
                Sprite: 'Gaseosa de sabor cítrico y refrescante.',
                'Jugo en agua': 'Naranja natural preparada en agua. Maracuyá natural preparada en agua. Mango natural preparado en agua. Fresa natural preparada en agua. Sandía natural preparada en agua.',
                'Jugo en leche': 'Jugos de naranja, maracuyá, mango, fresa o sandía preparados en leche.',
                'Limonada natural': 'Limonada refrescante preparada con limón y agua.',
                'Limonada Hierbabuena': 'Limonada con limón y hierbabuena.',
                'Soda de Fresa': 'Agua carbonatada con sabor a fresa y vaso michelado.',
                'Soda de Cereza': 'Agua carbonatada con sabor a cereza.',
                'Soda de Mango': 'Agua carbonatada con sabor a mango.',
                'Soda de Maracuyá': 'Agua carbonatada con sabor a maracuyá.',
                'Soda de Sandía': 'Agua carbonatada con sabor a sandía.'
            },
            licoresPedir: {
                'Copa de Vino': 'Copa de vino para acompañar tus comidas.',
                'Botella de Vino': 'Vino ideal para compartir.',
                'Ron 8 años': 'Ron añejado de sabor suave.',
                'Guaro Tapa roja': 'Aguardiente colombiano de sabor tradicional.',
                Buchanans: 'Whisky suave y elegante.',
                'Old Parr': 'Whisky de sabor equilibrado.',
                'Tequila 1800': 'Tequila mexicano de sabor característico.',
                Corona: 'Cerveza mexicana refrescante.',
                '3 Cordilleras': 'Cerveza colombiana artesanal.',
                Heineken: 'Cerveza refrescante de sabor equilibrado.',
                'Club Colombia': 'Cerveza colombiana de sabor equilibrado.',
                Aguila: 'Cerveza colombiana refrescante.',
                'Aguila Light': 'Cerveza colombiana ligera y refrescante.',
                Pilsen: 'Cerveza colombiana de sabor tradicional.'
            }
        };
        const categoryNav = document.createElement('div');
        categoryNav.className = 'categorias-pedir-nav';
        categoryNav.setAttribute('aria-label', 'Categorías del menú');
        const categoryPanels = document.createElement('div');
        categoryPanels.className = 'categorias-pedir-paneles';

        categories.forEach((category) => {
            const bar = category.querySelector('.barra-pedir');
            if (!bar) return;

            const categoryCards = [];
            let sibling = category.nextElementSibling;
            while (sibling && !sibling.classList.contains('categoria-pedir')) {
                const nextSibling = sibling.nextElementSibling;
                if (sibling.classList.contains('card-pedir')) categoryCards.push(sibling);
                sibling = nextSibling;
            }

            const panel = document.createElement('div');
            panel.className = 'categoria-pedir-panel';
            panel.id = `${category.id}-productos`;
            panel.hidden = true;

            if (panelHeadingTemplate) {
                const panelHeading = panelHeadingTemplate.content.cloneNode(true);
                panelHeading.querySelector('h2').textContent = bar.querySelector('h2')?.textContent.trim() || '';
                panel.append(panelHeading);
            }

            categoryCards.forEach((card) => {
                const productName = card.querySelector('.card-text-pedir h2')?.textContent.trim();
                const productDescription = productDescriptions[category.id]?.[productName];
                const descriptionElement = card.querySelector('.card-text-pedir p');
                if (productDescription && descriptionElement) descriptionElement.textContent = productDescription;

                const productImage = productImages[productName];
                const imageContainer = card.querySelector('.imagen-cartica');

                if (productImage && imageContainer) {
                    const image = document.createElement('img');
                    image.className = 'imagen-cartica-img';
                    image.src = new URL(`../imgFinal/${productImage}`, document.currentScript.src).href;
                    image.alt = productName;
                    image.loading = 'lazy';
                    imageContainer.replaceChildren(image);
                }

                panel.append(card);
            });

            const imageName = categoryImages[category.id];
            if (imageName) {
                const image = document.createElement('img');
                image.className = 'barra-pedir-imagen';
                image.src = new URL(`../img/${imageName}`, document.currentScript.src).href;
                image.alt = '';
                image.loading = 'lazy';
                bar.prepend(image);
            }

            bar.setAttribute('role', 'button');
            bar.setAttribute('tabindex', '0');
            bar.setAttribute('aria-expanded', 'false');
            bar.setAttribute('aria-controls', panel.id);

            const toggleCards = () => {
                const expanded = bar.getAttribute('aria-expanded') !== 'true';
                bar.setAttribute('aria-expanded', String(expanded));
                panel.hidden = !expanded;
            };

            bar.addEventListener('click', toggleCards);
            bar.addEventListener('keydown', (event) => {
                if (event.key !== 'Enter' && event.key !== ' ') return;
                event.preventDefault();
                toggleCards();
            });

            categoryNav.append(category);
            categoryPanels.append(panel);
        });

        container.replaceChildren(categoryNav, categoryPanels);
    }

    const storageKey = 'cheoparrilla-carrito-v1';
    const cards = [...(container?.querySelectorAll('.card-pedir') || [])].map((element, index) => {
        const title = element.querySelector('.card-text-pedir h2');
        const price = element.querySelector('.card-price-pedir p');
        const priceValue = Number(price?.textContent.replace(/[^\d]/g, ''));

        if (!title || !price || !Number.isFinite(priceValue)) return null;

        return {
            id: String(index),
            element,
            name: title.textContent.trim(),
            price: priceValue,
            actions: element.querySelector('.card-price-pedir')
        };
    }).filter(Boolean);

    const productsById = new Map(cards.map((product) => [product.id, product]));
    const cart = new Map();
    const legacyCart = new Map();
    try {
        const saved = JSON.parse(localStorage.getItem(storageKey) || '{}');
        Object.entries(saved).forEach(([id, savedProduct]) => {
            const currentProduct = productsById.get(id);
            const quantity = Number(typeof savedProduct === 'object' ? savedProduct.quantity : savedProduct);
            if (!Number.isInteger(quantity) || quantity <= 0) return;

            if (currentProduct) {
                cart.set(id, { ...currentProduct, quantity });
                return;
            }

            if (typeof savedProduct !== 'object') {
                legacyCart.set(id, quantity);
                return;
            }

            if (savedProduct && typeof savedProduct === 'object' && savedProduct.name) {
                cart.set(id, {
                    id,
                    name: String(savedProduct.name),
                    price: Math.max(0, Number(savedProduct.price) || 0),
                    quantity
                });
            }
        });
    } catch {
        localStorage.removeItem(storageKey);
    }

    document.body.insertAdjacentHTML('beforeend', `
        ${container ? `<button class="carrito-pedir-launcher" type="button" aria-expanded="false" aria-label="Abrir carrito, 0 productos">
            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
            <span>Tu carrito</span>
            <span class="carrito-pedir-count" aria-live="polite">0</span>
        </button>` : ''}
        <div class="carrito-pedir-backdrop" hidden>
            <aside class="carrito-pedir-panel" role="dialog" aria-modal="true" aria-labelledby="carrito-pedir-title">
                <header class="carrito-pedir-header">
                    <div>
                        <p class="carrito-pedir-eyebrow">CHEO PARRILLA</p>
                        <h2 id="carrito-pedir-title">Tu carrito <span class="carrito-pedir-total-items">(0)</span></h2>
                    </div>
                    <button class="carrito-pedir-close" type="button" aria-label="Cerrar carrito">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </header>
                <div class="carrito-pedir-list" aria-live="polite"></div>
                <footer class="carrito-pedir-footer">
                    <div class="carrito-pedir-subtotal">
                        <span>Subtotal</span>
                        <strong>$0</strong>
                    </div>
                    <p class="carrito-pedir-note">El envío y la disponibilidad se confirman por WhatsApp.</p>
                    <button class="carrito-pedir-checkout" type="button" disabled>
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        <span>Continuar por WhatsApp</span>
                    </button>
                </footer>
            </aside>
        </div>
    `);

    const launcher = document.querySelector('.carrito-pedir-launcher');
    const triggers = [...document.querySelectorAll('.nav-cart-trigger')];
    const backdrop = document.querySelector('.carrito-pedir-backdrop');
    const closeButton = document.querySelector('.carrito-pedir-close');
    const list = document.querySelector('.carrito-pedir-list');
    const countBadge = document.querySelector('.carrito-pedir-count');
    const itemCount = document.querySelector('.carrito-pedir-total-items');
    const subtotalElement = document.querySelector('.carrito-pedir-subtotal strong');
    const checkoutButton = document.querySelector('.carrito-pedir-checkout');
    const getQuantity = (productId) => cart.get(productId)?.quantity || 0;

    const formatMoney = (amount) => '$' + new Intl.NumberFormat('es-CO', {
        maximumFractionDigits: 0
    }).format(amount);

    const makeButton = (label, action, id, className, iconClass) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = className;
        button.dataset.cartAction = action;
        button.dataset.productId = id;
        button.setAttribute('aria-label', label);

        if (iconClass) {
            const icon = document.createElement('i');
            icon.className = iconClass;
            icon.setAttribute('aria-hidden', 'true');
            button.append(icon);
        } else {
            button.textContent = '+';
        }

        return button;
    };

    function renderCardActions() {
        cards.forEach((product) => {
            if (!product.actions) return;
            const quantity = getQuantity(product.id);
            const previous = product.actions.querySelector('.card-button-pedir, .pedir-controles');
            if (!previous) return;

            if (quantity === 0) {
                const addButton = makeButton(
                    `Agregar ${product.name} al carrito`,
                    'add',
                    product.id,
                    'card-button-pedir',
                    ''
                );
                previous.replaceWith(addButton);
                return;
            }

            const controls = document.createElement('div');
            controls.className = 'pedir-controles';
            controls.setAttribute('role', 'group');
            controls.setAttribute('aria-label', `Cantidad de ${product.name}`);
            controls.append(
                makeButton(`Quitar ${product.name} del carrito`, 'remove', product.id, 'pedir-control pedir-control--remove', 'fa-solid fa-trash'),
                Object.assign(document.createElement('span'), { className: 'pedir-control__quantity', textContent: String(quantity) }),
                makeButton(`Agregar otro ${product.name}`, 'increment', product.id, 'pedir-control', '')
            );
            previous.replaceWith(controls);
        });
    }

    function renderCart() {
        const totalQuantity = [...cart.values()].reduce((sum, product) => sum + product.quantity, 0)
            + [...legacyCart.values()].reduce((sum, quantity) => sum + quantity, 0);
        const subtotal = [...cart.values()].reduce((sum, product) => sum + product.price * product.quantity, 0);

        if (countBadge) countBadge.textContent = String(totalQuantity);
        document.querySelectorAll('.nav-cart-trigger__count').forEach((badge) => {
            badge.textContent = String(totalQuantity);
        });
        triggers.forEach((trigger) => {
            trigger.setAttribute('aria-label', `Abrir carrito, ${totalQuantity} productos`);
        });
        itemCount.textContent = `(${totalQuantity})`;
        if (launcher) launcher.setAttribute('aria-label', `Abrir carrito, ${totalQuantity} productos`);
        subtotalElement.textContent = formatMoney(subtotal);
        checkoutButton.disabled = totalQuantity === 0;
        list.replaceChildren();

        if (totalQuantity === 0) {
            const empty = document.createElement('div');
            empty.className = 'carrito-pedir-empty';
            empty.innerHTML = '<i class="fa-solid fa-bag-shopping" aria-hidden="true"></i><p>Tu carrito está vacío</p>';
            list.append(empty);
        } else if (cart.size === 0 && legacyCart.size > 0) {
            const notice = document.createElement('div');
            notice.className = 'carrito-pedir-empty';
            notice.innerHTML = '<i class="fa-solid fa-bag-shopping" aria-hidden="true"></i><p>Abre Pedir Ahora para recuperar los artículos guardados.</p>';
            list.append(notice);
        } else {
            cart.forEach((product) => {
                const quantity = product.quantity;
                const row = document.createElement('article');
                row.className = 'carrito-pedir-item';

                const details = document.createElement('div');
                details.className = 'carrito-pedir-item__details';
                const name = document.createElement('h3');
                name.textContent = product.name;
                const unitPrice = document.createElement('p');
                unitPrice.textContent = product.price > 0 ? `${formatMoney(product.price)} c/u` : 'Precio por confirmar';
                details.append(name, unitPrice);

                const controls = document.createElement('div');
                controls.className = 'carrito-pedir-item__controls';
                controls.append(
                    makeButton(`Quitar ${product.name} del carrito`, 'remove', product.id, 'carrito-pedir-icon-button', 'fa-solid fa-trash'),
                    Object.assign(document.createElement('span'), { className: 'carrito-pedir-item__quantity', textContent: String(quantity) }),
                    makeButton(`Agregar otro ${product.name}`, 'increment', product.id, 'carrito-pedir-icon-button', 'fa-solid fa-plus')
                );

                const lineTotal = document.createElement('strong');
                lineTotal.className = 'carrito-pedir-item__total';
                lineTotal.textContent = product.price > 0 ? formatMoney(product.price * quantity) : 'Por confirmar';
                row.append(details, controls, lineTotal);
                list.append(row);
            });
        }

        renderCardActions();
        try {
            const saved = Object.fromEntries([...cart].map(([id, product]) => [id, {
                name: product.name,
                price: product.price,
                quantity: product.quantity
            }]));
            if (legacyCart.size === 0) localStorage.setItem(storageKey, JSON.stringify(saved));
        } catch {
            // El carrito sigue funcionando durante esta sesión si el almacenamiento está bloqueado.
        }
    }

    function openCart() {
        backdrop.hidden = false;
        requestAnimationFrame(() => backdrop.classList.add('is-visible'));
        document.body.classList.add('carrito-pedir-open');
        triggers.forEach((trigger) => trigger.setAttribute('aria-expanded', 'true'));
        if (launcher) launcher.setAttribute('aria-expanded', 'true');
        closeButton.focus();
    }

    function closeCart() {
        backdrop.classList.remove('is-visible');
        backdrop.hidden = true;
        document.body.classList.remove('carrito-pedir-open');
        triggers.forEach((trigger) => trigger.setAttribute('aria-expanded', 'false'));
        if (launcher) launcher.setAttribute('aria-expanded', 'false');
        (launcher || triggers[0])?.focus();
    }

    if (container) {
        container.addEventListener('click', (event) => {
            const button = event.target.closest('[data-cart-action]');
            if (!button) return;

            const { cartAction, productId } = button.dataset;
            const product = productsById.get(productId);
            if (!product) return;
            const current = getQuantity(productId);

            if (cartAction === 'add' || cartAction === 'increment') {
                cart.set(productId, { ...product, quantity: current + 1 });
            }
            if (cartAction === 'remove') cart.delete(productId);

            renderCart();
            if (cartAction === 'add') openCart();
        });
    }

    list.addEventListener('click', (event) => {
        const button = event.target.closest('[data-cart-action]');
        if (!button) return;

        const { cartAction, productId } = button.dataset;
        const product = cart.get(productId);
        if (!product) return;
        const current = product.quantity;
        if (cartAction === 'increment') cart.set(productId, { ...product, quantity: current + 1 });
        if (cartAction === 'remove') cart.delete(productId);
        renderCart();
    });

    triggers.forEach((trigger) => trigger.addEventListener('click', openCart));
    launcher?.addEventListener('click', openCart);
    closeButton.addEventListener('click', closeCart);
    backdrop.addEventListener('click', (event) => {
        if (event.target === backdrop) closeCart();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !backdrop.hidden) closeCart();
    });

    checkoutButton.addEventListener('click', () => {
        if (cart.size === 0) return;

        const selectedProducts = [...cart.values()];
        const hasUnpricedItems = selectedProducts.some((product) => product.price === 0);
        const lines = selectedProducts
            .map((product) => {
                const priceDetails = product.price > 0
                    ? formatMoney(product.price * product.quantity)
                    : 'precio por confirmar';
                return `- ${product.quantity} x ${product.name}: ${priceDetails}`;
            });
        const subtotal = selectedProducts.reduce((sum, product) => sum + product.price * product.quantity, 0);
        const totalLabel = hasUnpricedItems
            ? `Subtotal de productos con precio: ${formatMoney(subtotal)}\nHay productos con precio por confirmar.`
            : `Total: ${formatMoney(subtotal)}`;
        const message = `Hola, quiero hacer este pedido:\n\n${lines.join('\n')}\n\n${totalLabel}`;
        window.open(`https://wa.me/573234382813?text=${encodeURIComponent(message)}`, '_blank', 'noopener,noreferrer');
    });

    renderCart();
})();