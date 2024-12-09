<?php

require "src/conexao_db.php";
require "src/repository/ProdutoRepository.php";

$repo = new ProdutoRepository($pdo );
$repo -> excludeProduct($_POST["tirar"]);
header("Location:admin.php");