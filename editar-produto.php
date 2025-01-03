<?php

require "src/conexao_db.php";
require "src/model/Produto.php";
require "src/repository/ProdutoRepository.php";

$repository = new ProdutoRepository($pdo);

if (isset($_POST["editar"])&& !empty($_POST["editar"])){
  $produto_edicao = new Produto(
  $_POST["id"],
  $_POST["tipo"],
  $_POST["descricao"],
  $_POST["nome"],
  $_POST["preco"],
  $_POST["imagem"]
);
if($_FILES['imagem']['error'] == UPLOAD_ERR_OK){
  $produto-> setImagem(uniqid().$_FILES["imagem"]["name"]);
  move_uploaded_file($_FILES["imagem"]["tmp_name"],$produto->getImagemDiretorio());
}
$produto = $repository->updateOne($produto_edicao);
header("Location:admin.php");
}else{
  $product = $repository->buscaUm($_GET["id"]);
}




?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Editar Produto</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Editar Produto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form" enctype="multipart/form-data">
    <form action="#" method="post">
      <input type="text" id="id" name="id" value="<?php echo $product->getId()?>" hidden>
      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" value="<?php echo $product->getNome()?>" placeholder="Digite o nome do produto" required>

      <div class="container-radio">
        <div>
            <label for="cafe">Café</label>
            <input type="radio" id="cafe" name="tipo" value="Café" <?php echo $product-> getTipo()=="Café"? "checked":""?>>
        </div>
        <div>
            <label for="almoco">Almoço</label>
            <input type="radio" id="almoco" name="tipo" value="Almoço" <?php echo $product-> getTipo()=="Almoço"? "checked":""?>>
        </div>
    </div>

      <label for="descricao">Descrição</label>
      <input type="text" id="descricao" value="<?php echo $product ->getDescricao()?>" name="descricao" placeholder="Digite uma descrição" required>

      <label for="preco">Preço</label>
      <input type="text" id="preco" value="<?php echo number_format($product-> getPreco(),2)?>" name="preco" placeholder="Digite uma descrição" required>

      <label for="imagem">Envie uma imagem do produto</label>
      <input type="file" name="imagem" accept="image/*" value="<?php echo $product -> getImagem()?>" id="imagem" placeholder="Envie uma imagem">

      <input type="submit" name="editar" class="botao-cadastrar"  value="Editar produto"/>
    </form>

  </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>