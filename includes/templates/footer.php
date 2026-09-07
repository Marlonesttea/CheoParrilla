<!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-content">
            <div>
                <img src="img/logoc2.png" class="footer-logo" alt="logo3">
                <p>Hamburguesas artesanales y algo más...</p>
            </div>
            
            <div>
                <h4>Enlaces</h4>
                <a href="index.php">Inicio</a>
                <a href="menu.php">Menú</a>
                <a href="index.php#galeria">Galeria</a>
                <a href="contacto.php">Contacto</a>
            </div>

            <div>
                <h4>Contacto</h4>
                <p>Medellin, Colombia</p>
                <p>+57 323 438 2813</p>
                <p>Calle 58 #92A - 126</p>
            </div>

            <div>
                <h4>Redes sociales</h4>
                <div class="social-links">
                    <a href="https://www.instagram.com/cheo.parrilla/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.tiktok.com/@cheo.parilla" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                        <i class="fa-brands fa-tiktok" aria-hidden="true"></i>
                    </a>
                    <a href="https://wa.me/573234382813" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            
            <p><?php echo  date('Y')?> CheoParrilla - Todos los derechos reservados </p>
        </div>
    </footer>

<?php if(isset($scripts) && is_array($scripts)): ?>
<?php foreach($scripts as $script): ?>
<script src="<?php echo BASE_URL . "/js/$script.js"; ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>
