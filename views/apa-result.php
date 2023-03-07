<?php $this->layout('layout') ?>

<?php $this->section('content') ?>

<h1>Resultado APA</h1>
<p style="display: <?= boolval($this->expires) ? 'block' : 'none' ?>"><small><i>Versión guardada. Expira en <time><?= Carbon\Carbon::createFromTimestamp($this->expires)->diffInRealMinutes() ?></time> minutos</i></small></p>
<blockquote class="apa-cite" id="apa"></blockquote>
<form action="#" id="apa-result">
    <label>
        <strong>Título</strong>
        <input type="text" class="u-full-width" name="title" id="title" value="<?= html_entity_decode($this->title) ?>">
    </label>
    <fieldset>
        <legend>Autor</legend>
        <div class="row">
            <label class="six columns">
                <strong>Nombres</strong>
                <input type="text" class="u-full-width" name="names" id="names" value="<?= html_entity_decode($this->names) ?>">
            </label>
            <label class="six columns">
                <strong>Apellido</strong>
                <input type="text" class="u-full-width" name="surnmae" id="surname" value="<?= html_entity_decode($this->surname) ?>">
            </label>
        </div>
    </fieldset>
    <label>
        <strong>Fecha</strong>
        <input type="text" class="u-full-width" name="date" id="date" value="<?= html_entity_decode($this->date) ?>">
    </label>
    <label>
        <strong>Lugar</strong>
        <input type="text" class="u-full-width" name="place" id="place" value="<?= html_entity_decode($this->place) ?>">
    </label>
    <label>
        <strong>Publicador</strong>
        <input type="text" class="u-full-width" name="publisher" id="publisher" value="<?= html_entity_decode($this->publisher) ?>">
    </label>
    <label>
        <strong>Sitio web</strong>
        <input type="text" class="u-full-width" name="url" id="url" value="<?= $this->url ?>">
    </label>
    <button type="submit" class="button-primary">Actualizar</button>
</form>

<script>
    window.addEventListener('load', () => {
        const apa = document.getElementById('apa');
        const names = document.getElementById('names');
        const surname = document.getElementById('surname');
        const date = document.getElementById('date');
        const title = document.getElementById('title');
        const place = document.getElementById('place');
        const publisher = document.getElementById('publisher');
        const url = document.getElementById('url');
        const update = () => {
            const data = [
                [
                    [
                        surname.value,
                        `${names.value.split(' ').map((v) => (v[0]) ? `${v[0]}.` : '')[0]}`
                    ].filter((v) => v).join(', '),
                    date.value.trim() ? `(${date.value.trim()})` : '',
                ].join(' ').trim(),
                title.value ? `<i>${title.value}</i>` : '',
                place.value,
                publisher.value,
                `<a href="${url.value}" target="_blank">${url.value}</a>`
            ].filter((v) => v);

            apa.innerHTML = data.join('. ');
        };


        document.getElementById('apa-result').addEventListener('submit', (e) => {
            e.preventDefault();
            update();
        });
        update();

    });
</script>

<?php $this->append() ?>