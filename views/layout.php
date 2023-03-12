<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/style.css">
    <script src="/resources/js/main.js" defer></script>

    <title>Utilidades Escolares - Himmlisch Studios</title>
</head>

<body>
    <?= $this->insert('components/header') ?>
    <main class="container">
        <?php $this->section('content') ?>
        <?php $this->stop() ?>
    </main>
    <?= isset($_SESSION['msg']) ? $this->insert('components/notice') : '' ?>
    <?= $this->insert('components/footer') ?>
    <?= app()->uri != '/' ? $this->insert('components/popup') : '' ?>
</body>

</html>