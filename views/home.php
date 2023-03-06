<?php $this->layout('layout') ?>

<?php $this->section('content') ?>

<section>
    <h1>Herramientas para estudiantes</h1>
    <p>Herramientas desarrolladas para y en la universidad, hechas <a href="https://github.com/Himmlisch-Studios/school" target="_blank">código abierto</a> para todos los que las necesiten.</p>
</section>

<section>
    <h2>Tabla de Contenido</h2>
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
                    <a href="/frecuencias#no-agrupadas">Calculadora tabla de frecuencias no agrupadas</a>
                </li>
                <li>
                    <a href="/frecuencias#agrupadas">Calculadora tabla de frecuencias agrupadas</a>
                </li>
            </ul>
        </li>
        <li>
            <strong>Métodos numéricos</strong>
            <ul>
                <li>
                    <a href="/biseccion">Calculadora Método de Bisección</a>
                </li>
                <li>
                    <a href="/gauss">Calculadora Método de Gauss-Seidel</a>
                </li>
                <li>
                    <a href="/lin">Calculadora Método de Lin Bairstow</a>
                </li>
            </ul>
        </li>
    </ul>
</section>

<?php $this->append() ?>