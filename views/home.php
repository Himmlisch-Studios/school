<?php $this->layout('layout') ?>

<?php $this->section('content') ?>

<h1>Herramientas para estudiantes <span aria-hidden="true">👨🏻‍🏫</span></h1>
<p>Herramientas desarrolladas en la y para la universidad, hechas <a href="#section-opensource">código abierto</a> para todos los que las necesiten.</p>

<section id="section-table" aria-labelledby="section-table-title">
    <h2 id="section-table-title">Tabla de Contenido</h2>
    <ul>
        <li>
            <strong>Redacción</strong>
            <ul>
                <li>
                    <a href="/apa">Generador de formato APA</a>
                </li>
            </ul>
        </li>
        <li>
            <strong>Probabilidad y Estadística</strong>
            <ul>
                <li>
                    <a class="disabled" href="/frecuencias#no-agrupadas">Calculadora tabla de frecuencias no agrupadas</a>
                </li>
                <li>
                    <a class="disabled" href="/frecuencias#agrupadas">Calculadora tabla de frecuencias agrupadas</a>
                </li>
            </ul>
        </li>
        <li>
            <strong>Métodos numéricos</strong>
            <ul>
                <li>
                    <a class="disabled" href="/biseccion">Calculadora Método de Bisección</a>
                </li>
                <li>
                    <a class="disabled" href="/gauss">Calculadora Método de Gauss-Seidel</a>
                </li>
                <li>
                    <a class="disabled" href="/lin">Calculadora Método de Lin Bairstow</a>
                </li>
            </ul>
        </li>
    </ul>
</section>

<hr>

<section id="section-about" aria-labelledby="section-about-title">
    <h2 id="section-about-title">Acerca de</h2>
    <p>Sitio de herramientas escolares gratis y de código libre para universitarios, con calculadoras y generadores de utilidades comunes para las carreras relacionadas a las ciencias y tecnologías.</p>
    <p>
        Fue diseñado como repositiorio central para los diversos programas desarrollados para la universidad, por <a href="https://luanhimmlisch.github.io" target="_blank" rel="author">Luan Himmlisch</a>, usando PHP.
        También sirve como sencillo ejemplo de cómo implementar un rudimentario patrón MVC, desde cero.
    </p>
</section>

<section id="section-opensource" aria-labelledby="section-opensource-title">
    <h2 id="section-opensource-title">Open-Source</h2>
    <p>
        El Software <i>Open-Source</i> o Código Abierto, es Software no <i>privativo</i>. Software que su núcleo está compartido al público para poder estudiar, auditar, modificar y utilizar bajo alguna licencia.
    </p>
    <p>El Software Open-Source tiene ventajas de ser:</p>
    <ul>
        <li><b>Más seguro</b>: Pues cualquiera puede auditar el código y asegurarse que el Software no actua de maneras no deseadas y/o maliciosas.</li>
        <li><b>Más soportado:</b> Todo buen samaritano puede editar el código y extender o mejorar el soporte para cualquier dispositivo, que de otro modo sería abandonado.</li>
        <li><b>Más personalizable</b>: De igual manera, al poder cambiar el código, se puede personalizar al gusto de los usuarios, hasta llegar al punto de poder crear una aplicación totalmente nueva.</li>
    </ul>
    <p>El código de este sitio existe bajo la <b>licencia del MIT</b>, que permite su uso, modificación y distribución comercial sin ninguna condición más que la preservación de la licencia misma en el trabajo original.</p>
    <p>Puedes encontrar el código fuente en su <a href="https://github.com/Himmlisch-Studios/school" rel="external">repositiorio de Github</a>.</p>
</section>

<hr>

<section id="section-himmlisch" aria-labelledby="section-himmlisch-title">
    <h2 id="section-himmlisch-title" style="display: none;">Himmlisch Studios</h2>
    <div class="himmlisch">
        <a href="https://web.himmlisch.com.mx" title="Ir a Himmlisch Studio">
            <img src="https://camo.githubusercontent.com/e0cf7da3ce95377e64fa9fef7654a7918f69f88ac1a6fd8394bddc0466fe3f71/68747470733a2f2f68696d6d6c697363682e636f6d2e6d782f757365722f7468656d65732f68696d6d6c697363682d73747564696f732f696d616765732f6c6f676f2e737667" alt="Logo de Himmlisch Studio">
        </a>
    </div>
    <br><br>
    <p>
        Himmlisch Studios es una compañia multidisciplinaria de soluciones digitales.
        Ofrece desarrollo web, desarrollo de aplicaciones, desarrollo de videojuegos, diseño gráfico y planeación de estrategias para tu empresa u organización.
    </p>
</section>

<?php $this->append() ?>