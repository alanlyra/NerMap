<!DOCTYPE html>
<html lang="en">

<?php

  $id_arquivo = $_POST["id-arquivo"];

  $num_textos = 1;

  popen("bash /home/alan/NerMap/html/process_input.sh " . $id_arquivo . " " . $num_textos, "r");

?>
