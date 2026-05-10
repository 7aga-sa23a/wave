<?php
require __DIR__ . '/../src/core/config.php';
require __DIR__ . '/../src/core/connect.php';
require __DIR__ . '/../src/templates/index.php';

/*
(href=")([A-z-]+.php")
$1<?= TEMPLATES_URL ?>/$2
<?= TEMPLATES_URL ?>

(href=").*(/.+.css")
$1<?= CSS_URL ?>$2
<?= CSS_URL ?>

(src=").*(/.+.js")
$1<?= JS_URL ?>$2
<?= JS_URL ?>

(src=").*components(/.+.js")
$1<?= COMPONENTS_URL ?>$2
<?= COMPONENTS_URL ?>
*/