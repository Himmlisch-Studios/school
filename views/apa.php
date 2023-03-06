<?php $this->layout('layout') ?>

<?php $this->section('content') ?>

<h1>Generador formato APA <span aria-hidden="true">📑</span></h1>
<form action="/apa/submit" method="POST">
    <?= csrf() ?>
    <label>
        <p>URL del sitio web:</p>
        <input type="text" class="u-full-width" name="url" id="url" autocomplete="url" placeholder="https://...">
    </label>
    <div class="row">
        <button class="six columns button-primary" type="submit">Subir</button>
        <div class="six columns">
            <label>
                <span>Adivinar datos</span>
                <input type="checkbox" name="guess" id="guess" checked>
            </label>
            <p><small>Tratará de adivinar los datos vacios de artículos mal formados</small></p>
        </div>
    </div>
</form>

<?php $this->append() ?>