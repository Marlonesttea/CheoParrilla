/* ============================================================
   CONFIRMAR.JS  -  Validacion en el navegador del paso 2.
   ------------------------------------------------------------
   IMPORTANTE para la sustentacion: estas mismas reglas estan
   repetidas en confirmar.php. Aqui sirven para avisarle rapido
   al cliente; alla sirven para que el dato sea correcto de
   verdad, porque el JavaScript se puede desactivar.
   ============================================================ */

(function () {
    'use strict';

    var form = document.querySelector('.rsv-form');
    if (!form) { return; }

    var nombre   = document.getElementById('nombre');
    var telefono = document.getElementById('telefono');

    // El celular solo acepta numeros mientras se escribe.
    telefono.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
        quitarError(this);
    });

    nombre.addEventListener('input', function () { quitarError(this); });

    form.addEventListener('submit', function (e) {
        var hayError = false;

        if (nombre.value.trim().length < 3) {
            marcarError(nombre, 'El nombre debe tener al menos 3 letras.');
            hayError = true;
        }

        if (!/^3\d{9}$/.test(telefono.value.trim())) {
            marcarError(telefono, 'El celular debe tener 10 dígitos y empezar por 3.');
            hayError = true;
        }

        if (hayError) { e.preventDefault(); }
    });


    function marcarError(campo, texto) {
        quitarError(campo);
        campo.classList.add('rsv-campo-malo');
        var p = document.createElement('p');
        p.className = 'rsv-error rsv-error-js';
        p.textContent = texto;
        campo.insertAdjacentElement('afterend', p);
    }

    function quitarError(campo) {
        campo.classList.remove('rsv-campo-malo');
        var siguiente = campo.nextElementSibling;
        if (siguiente && siguiente.classList.contains('rsv-error-js')) {
            siguiente.remove();
        }
    }

})();
