(() => {
    'use strict';
    const scriptUrl = document.currentScript?.src || new URL('js/pedir.js', document.baseURI).href;

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
                panel.append(card);
            });

            const imageName = categoryImages[category.id];
            if (imageName) {
                const image = document.createElement('img');
                image.className = 'barra-pedir-imagen';
                image.src = new URL(`../img/${imageName}`, scriptUrl).href;
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

                if (expanded) {
                    panel.querySelector('.categoria-pedir-panel-heading')?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
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

        const requestedCategoryId = window.location.hash.slice(1);
        const requestedCategory = categories.find((category) => category.id === requestedCategoryId);
        const requestedBar = requestedCategory?.querySelector('.barra-pedir');
        const requestedPanelId = requestedBar?.getAttribute('aria-controls');
        const requestedPanel = requestedPanelId ? document.getElementById(requestedPanelId) : null;

        if (requestedBar && requestedPanel) {
            requestedBar.setAttribute('aria-expanded', 'true');
            requestedPanel.hidden = false;
            requestAnimationFrame(() => {
                requestedPanel.querySelector('.categoria-pedir-panel-heading')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        }
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
            description: element.querySelector('.card-text-pedir p')?.textContent.trim() || '',
            image: element.querySelector('.imagen-cartica-img')?.src || '',
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
            const savedObject = savedProduct && typeof savedProduct === 'object' ? savedProduct : null;
            const productId = String(savedObject?.productId || id);
            const currentProduct = productsById.get(productId);
            const quantity = Number(savedObject ? savedObject.quantity : savedProduct);
            if (!Number.isInteger(quantity) || quantity <= 0) return;

            if (currentProduct) {
                const lineId = String(savedObject?.lineId || id);
                cart.set(lineId, {
                    ...currentProduct,
                    lineId,
                    instructions: String(savedObject?.instructions || ''),
                    quantity
                });
                return;
            }

            if (!savedObject) {
                legacyCart.set(id, quantity);
                return;
            }

            if (savedObject.name) {
                cart.set(id, {
                    id: productId,
                    lineId: id,
                    name: String(savedObject.name),
                    price: Math.max(0, Number(savedObject.price) || 0),
                    instructions: String(savedObject.instructions || ''),
                    quantity
                });
            }
        });
    } catch {
        localStorage.removeItem(storageKey);
    }

    document.body.insertAdjacentHTML('beforeend', `
        ${container ? `<div class="carrito-pedir-widget">
            <div class="carrito-pedir-launcher-subtotal" aria-live="polite">
                <span>Subtotal</span>
                <strong>$0</strong>
            </div>
            <button class="carrito-pedir-launcher" type="button" aria-expanded="false" aria-label="Abrir carrito, 0 productos">
                <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                <span>Tu carrito</span>
                <span class="carrito-pedir-count" aria-live="polite">0</span>
            </button>
        </div>` : ''}
        ${container ? `<div class="pedido-producto-backdrop" hidden aria-hidden="true">
            <section class="pedido-producto-panel" role="dialog" aria-modal="true" aria-labelledby="pedido-producto-title">
                <button class="pedido-producto-close" type="button" aria-label="Cerrar detalles del producto">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
                <div class="pedido-producto-image-wrap">
                    <img class="pedido-producto-image" alt="" hidden>
                </div>
                <div class="pedido-producto-content">
                    <div class="pedido-producto-details">
                        <h2 id="pedido-producto-title"></h2>
                        <p class="pedido-producto-description"></p>
                        <label for="pedido-producto-instrucciones">Instrucciones especiales</label>
                        <textarea id="pedido-producto-instrucciones" maxlength="300" placeholder="Incluye una nota"></textarea>
                    </div>
                    <footer class="pedido-producto-footer">
                        <div class="pedido-producto-quantity" role="group" aria-label="Cantidad">
                            <button type="button" data-modal-quantity="decrease" aria-label="Disminuir cantidad">−</button>
                            <input class="pedido-producto-quantity-input" type="number" min="1" max="99" value="1" inputmode="numeric" aria-label="Cantidad">
                            <button type="button" data-modal-quantity="increase" aria-label="Aumentar cantidad">+</button>
                        </div>
                        <button class="pedido-producto-add" type="button">
                            <span>Agregar</span>
                            <strong></strong>
                        </button>
                    </footer>
                </div>
            </section>
        </div>` : ''}
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
                    <fieldset class="carrito-pedir-delivery">
                        <legend>¿Dónde recibirás el pedido?</legend>
                        <label>
                            <input type="radio" name="carrito-modalidad" value="recoger" required>
                            <span>Pasaré a recogerlo al punto físico</span>
                        </label>
                        <label>
                            <input type="radio" name="carrito-modalidad" value="domicilio" required>
                            <span>A domicilio</span>
                        </label>
                    </fieldset>
                    <div class="carrito-pedir-delivery-address" hidden>
                        <label for="carrito-pedir-direccion">Dirección</label>
                        <input id="carrito-pedir-direccion" name="direccion" type="text" maxlength="200" autocomplete="street-address" placeholder="Calle, carrera, número..." disabled required>
                        <label for="carrito-pedir-referencia">Punto de referencia</label>
                        <input id="carrito-pedir-referencia" name="referencia" type="text" maxlength="200" placeholder="Barrio, local o lugar cercano..." disabled required>
                    </div>
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
    const launcherSubtotal = document.querySelector('.carrito-pedir-launcher-subtotal strong');
    const checkoutButton = document.querySelector('.carrito-pedir-checkout');
    const deliveryOptions = [...document.querySelectorAll('input[name="carrito-modalidad"]')];
    const deliveryAddress = document.querySelector('.carrito-pedir-delivery-address');
    const addressInput = document.querySelector('#carrito-pedir-direccion');
    const referenceInput = document.querySelector('#carrito-pedir-referencia');
    const productBackdrop = document.querySelector('.pedido-producto-backdrop');
    const productModalTitle = document.querySelector('#pedido-producto-title');
    const productModalDescription = document.querySelector('.pedido-producto-description');
    const productModalImage = document.querySelector('.pedido-producto-image');
    const productModalInstructions = document.querySelector('#pedido-producto-instrucciones');
    const productModalQuantity = document.querySelector('.pedido-producto-quantity-input');
    const productModalAdd = document.querySelector('.pedido-producto-add');
    const productModalClose = document.querySelector('.pedido-producto-close');
    let selectedProduct = null;
    let productModalTrigger = null;
    const getQuantity = (productId) => [...cart.values()]
        .filter((product) => product.id === productId)
        .reduce((total, product) => total + product.quantity, 0);

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

    function openProductModal(product, trigger) {
        if (!productBackdrop) return;
        selectedProduct = product;
        productModalTrigger = trigger;
        productModalTitle.textContent = product.name;
        productModalDescription.textContent = product.description;
        productModalDescription.hidden = !product.description;
        productModalInstructions.value = '';
        productModalQuantity.value = '1';
        updateProductModalPrice();
        productModalImage.src = product.image;
        productModalImage.alt = product.name;
        productModalImage.hidden = !product.image;
        productBackdrop.hidden = false;
        productBackdrop.setAttribute('aria-hidden', 'false');
        requestAnimationFrame(() => productBackdrop.classList.add('is-visible'));
        document.body.classList.add('pedido-producto-open');
        productModalInstructions.focus();
    }

    function updateProductModalPrice() {
        if (!selectedProduct) return;
        const quantity = Math.min(99, Math.max(1, Number.parseInt(productModalQuantity.value, 10) || 1));
        productModalAdd.querySelector('strong').textContent = formatMoney(selectedProduct.price * quantity);
    }

    function closeProductModal() {
        if (!productBackdrop || productBackdrop.hidden) return;
        productBackdrop.classList.remove('is-visible');
        productBackdrop.hidden = true;
        productBackdrop.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('pedido-producto-open');
        productModalTrigger?.focus();
        productModalTrigger = null;
        selectedProduct = null;
    }

    function addProductLine(product, quantity, instructions = '') {
        const existing = [...cart.entries()].find(([, cartProduct]) =>
            cartProduct.id === product.id && cartProduct.instructions === instructions
        );

        if (existing) {
            const [lineId, cartProduct] = existing;
            cart.set(lineId, { ...cartProduct, quantity: cartProduct.quantity + quantity });
        } else {
            const lineId = `${product.id}::${Date.now()}::${Math.random().toString(36).slice(2, 8)}`;
            cart.set(lineId, {
                ...product,
                lineId,
                quantity,
                instructions
            });
        }

        renderCart();
    }

    function addProductToCart() {
        if (!selectedProduct) return;
        const quantity = Math.min(99, Math.max(1, Number.parseInt(productModalQuantity.value, 10) || 1));
        const instructions = productModalInstructions.value.trim();
        addProductLine(selectedProduct, quantity, instructions);
        closeProductModal();
    }

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
        if (launcherSubtotal) launcherSubtotal.textContent = formatMoney(subtotal);
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
                if (product.instructions) {
                    const instruction = document.createElement('p');
                    instruction.className = 'carrito-pedir-item__instruction';
                    instruction.textContent = `Nota: ${product.instructions}`;
                    details.append(instruction);
                }

                const controls = document.createElement('div');
                controls.className = 'carrito-pedir-item__controls';
                controls.append(
                    makeButton(`Quitar ${product.name} del carrito`, 'remove-line', product.lineId, 'carrito-pedir-icon-button', 'fa-solid fa-trash'),
                    Object.assign(document.createElement('span'), { className: 'carrito-pedir-item__quantity', textContent: String(quantity) }),
                    makeButton(`Agregar otro ${product.name}`, 'increment-line', product.lineId, 'carrito-pedir-icon-button', 'fa-solid fa-plus')
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
            const saved = Object.fromEntries([...cart].map(([lineId, product]) => [lineId, {
                productId: product.id,
                name: product.name,
                price: product.price,
                quantity: product.quantity,
                instructions: product.instructions || ''
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

            const card = button.closest('.card-pedir');
            const product = productsById.get(button.dataset.productId)
                || cards.find((item) => item.element === card);
            if (!product) return;

            if (button.dataset.cartAction === 'note') {
                openProductModal(product, button);
                return;
            }
            if (button.dataset.cartAction === 'add' || button.dataset.cartAction === 'increment') {
                addProductLine(product, 1);
                return;
            }
            if (button.dataset.cartAction === 'remove') {
                [...cart.entries()].forEach(([lineId, item]) => {
                    if (item.id === product.id) cart.delete(lineId);
                });
                renderCart();
            }
        });
    }

    list.addEventListener('click', (event) => {
        const button = event.target.closest('[data-cart-action]');
        if (!button) return;

        const { cartAction, productId } = button.dataset;
        const product = cart.get(productId);
        if (!product) return;
        if (cartAction === 'increment-line') cart.set(productId, { ...product, quantity: product.quantity + 1 });
        if (cartAction === 'remove-line') cart.delete(productId);
        renderCart();
    });

    productBackdrop?.addEventListener('click', (event) => {
        if (event.target === productBackdrop) closeProductModal();
        const quantityButton = event.target.closest('[data-modal-quantity]');
        if (!quantityButton) return;
        const current = Number.parseInt(productModalQuantity.value, 10) || 1;
        const adjustment = quantityButton.dataset.modalQuantity === 'increase' ? 1 : -1;
        productModalQuantity.value = String(Math.min(99, Math.max(1, current + adjustment)));
        updateProductModalPrice();
    });
    productModalQuantity?.addEventListener('change', () => {
        const quantity = Number.parseInt(productModalQuantity.value, 10) || 1;
        productModalQuantity.value = String(Math.min(99, Math.max(1, quantity)));
        updateProductModalPrice();
    });
    productModalAdd?.addEventListener('click', addProductToCart);
    productModalClose?.addEventListener('click', closeProductModal);

    triggers.forEach((trigger) => trigger.addEventListener('click', openCart));
    launcher?.addEventListener('click', openCart);
    closeButton.addEventListener('click', closeCart);
    backdrop.addEventListener('click', (event) => {
        if (event.target === backdrop) closeCart();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && productBackdrop && !productBackdrop.hidden) closeProductModal();
        if (event.key === 'Escape' && !backdrop.hidden) closeCart();
    });

    deliveryOptions.forEach((option) => option.addEventListener('change', () => {
        const needsDeliveryAddress = option.value === 'domicilio' && option.checked;
        deliveryAddress.hidden = !needsDeliveryAddress;
        addressInput.disabled = !needsDeliveryAddress;
        referenceInput.disabled = !needsDeliveryAddress;
        if (needsDeliveryAddress) addressInput.focus();
    }));

    checkoutButton.addEventListener('click', () => {
        if (cart.size === 0) return;

        const selectedDelivery = deliveryOptions.find((option) => option.checked);
        if (!selectedDelivery) {
            deliveryOptions[0].setCustomValidity('Selecciona dónde recibirás el pedido.');
            deliveryOptions[0].reportValidity();
            deliveryOptions[0].setCustomValidity('');
            return;
        }
        if (selectedDelivery.value === 'domicilio' && (!addressInput.value.trim() || !referenceInput.value.trim())) {
            if (!addressInput.value.trim()) {
                addressInput.setCustomValidity('Escribe la dirección de entrega.');
                addressInput.reportValidity();
                addressInput.setCustomValidity('');
            } else {
                referenceInput.setCustomValidity('Escribe un punto de referencia.');
                referenceInput.reportValidity();
                referenceInput.setCustomValidity('');
            }
            return;
        }

        const selectedProducts = [...cart.values()];
        const hasUnpricedItems = selectedProducts.some((product) => product.price === 0);
        const lines = selectedProducts
            .map((product) => {
                const priceDetails = product.price > 0
                    ? formatMoney(product.price * product.quantity)
                    : 'precio por confirmar';
                const instruction = product.instructions
                    ? `\n  *Instrucción para este producto:* ${product.instructions}`
                    : '';
                return `- *${product.quantity} x ${product.name}* - ${priceDetails}${instruction}`;
            });
        const subtotal = selectedProducts.reduce((sum, product) => sum + product.price * product.quantity, 0);
        const totalLabel = hasUnpricedItems
            ? `*Subtotal de productos con precio:* ${formatMoney(subtotal)}\n*Hay productos con precio por confirmar.*`
            : `*Total: ${formatMoney(subtotal)}*`;
        const deliveryDetails = selectedDelivery.value === 'domicilio'
            ? `*ENTREGA A DOMICILIO*\n*Dirección:* ${addressInput.value.trim()}\n*Punto de referencia:* ${referenceInput.value.trim()}`
            : `*MODALIDAD:* Pasaré a recogerlo al punto físico`;
        const message = `*Hola, quiero hacer este pedido:*\n\n*PRODUCTOS*\n${lines.join('\n\n')}\n\n${deliveryDetails}\n\n${totalLabel}`;
        window.open(`https://wa.me/573234382813?text=${encodeURIComponent(message)}`, '_blank', 'noopener,noreferrer');
    });

    renderCart();
})();