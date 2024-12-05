<?php

require "src/conexao_db.php";
require "src/repository/ProdutoRepository.php";

$repo = new ProdutoRepository($pdo );

if(isset($_POST["tirar"])&& !empty($_POST["tirar"])){
    $produto_retirar = $_POST["tirar"];
    $repo -> excludeProduct($produto_retirar);
  }