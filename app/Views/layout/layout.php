<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RÚAIN Zlínského kraje</title>
    <?= $this->include('layout/assets'); ?>
</head>

<body>
    <?= $this->include('layout/navbar'); ?>
    <div class="container">
        <?= $this->renderSection('content'); ?>
    </div>
</body>

</html>