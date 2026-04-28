<?php
session_start();

require_once 'php/conexion.php';

require_once 'php/header.php';
?>

<main class="content-wrapper">
    <section class="presentacion">
        <div class="texto-presentacion">
            <h1>Descubre SAMU STATS</h1>
            <p>La herramienta educativa líder para la gestión y consulta de la Liga de Fútbol Profesional. Un sistema diseñado para centralizar toda la información de equipos, jugadores y jornadas.</p>
            
            <div class="puntos-positivos">
                <div class="punto">
                    <h3>Acceso Total</h3>
                    <p>Consulta las plantillas completas de los 20 equipos de la liga.</p>
                </div>
                <div class="punto">
                    <h3>Simplicidad</h3>
                    <p>Interfaz intuitiva diseñada para encontrar datos en segundos.</p>
                </div>
                <div class="punto">
                    <h3>Sin esperas</h3>
                    <p>Información directa de la base de datos a tu pantalla.</p>
                </div>
            </div>
        </div>
        <div class="imagen-destacada">
            <img src="img/campnou2.jpg" alt="Estadio de fútbol">
        </div>
    </section>

    <section class="planes">
        <h2>Nuestros Planes</h2>
        <div class="tarjetas-planes">
            <div class="tarjeta">
                <h3>GRATIS</h3>
                <p class="price">0€</p>
                <p>Ideal para consultas rápidas de resultados y clasificación general.</p>
            </div>
            <div class="tarjeta destacado">
                <h3>ESTÁNDAR</h3>
                <p class="price">10€</p>
                <p>Acceso a las fichas detalladas de los 313 jugadores y estadísticas.</p>
            </div>
            <div class="tarjeta">
                <h3>PREMIUM</h3>
                <p class="price">15€</p>
                <p>Experiencia completa, reportes descargables y soporte prioritario.</p>
            </div>
        </div>
    </section>
</main>

<?php 
require_once 'php/footer.php'; 
?>