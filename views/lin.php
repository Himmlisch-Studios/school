<?php $this->layout('layout') ?>

<?php $this->section('content') ?>

<h1>Calculadora Método Lin Bairstow <span aria-hidden="true">🧮</span></h1>
<form action="/lin/submit" method="POST">
    <?= csrf() ?>
    <label>
        <p>Ecuación:</p>
        <input type="text" class="u-full-width" name="equation" id="equation" autocomplete="equation" maxlength="50" placeholder="5x^4+4x^3+3x^2+2x+1" pattern="<?= \App\Services\LinService::REGEX ?>">
    </label>
    <div class="row">
        <div class="six columns">
            <button class="button-primary u-full-width" type="submit">Calcular</button>
        </div>
        <label class="six columns" aria-label="Tolerancia">
            <input type="text" class="u-full-width" name="tolerance" id="tolerance" autocomplete="tolerance" maxlength="50" placeholder="Tolerancia: 0.001">
        </label>
    </div>
</form>

<?php $this->append() ?>