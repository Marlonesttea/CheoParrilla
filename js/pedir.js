(() => {
    'use strict';

    const container = document.querySelector('.card-container-pedir');
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
            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
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