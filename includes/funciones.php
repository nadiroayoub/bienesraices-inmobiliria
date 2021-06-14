<?php

require 'app.php';

function incluirTemplates(string $nombre, bool $inicio = false) {

    include TEMPLATE_URL . "/${nombre}.php";
}
?>