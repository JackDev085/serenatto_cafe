<?php

class ProdutoRepository{
  private PDO $pdo;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  public function opcoesCafe(): array{
    $sql1 ="select * from produtos where tipo='café' order by preco;";
    $statement = $this->pdo->query($sql1);
    $arr= $statement -> fetchAll(PDO::FETCH_ASSOC);

    $dados_cafe = array_map(function($produto){
        return new Produto($produto["id"],$produto["tipo"],$produto["descricao"],$produto["nome"],$produto["preco"],$produto["imagem"]);
    }, $arr);

    return $dados_cafe;
  }

  public function opcoesAlmoco(): array{
    $sql2 ="select * from produtos where tipo='almoço' order by preco";
    $statement2 = $this->pdo->query($sql2);
    $arr2= $statement2 -> fetchAll(PDO::FETCH_ASSOC);

    $dados_almoco = array_map(function($produto){
      return new Produto($produto["id"],$produto["tipo"],$produto["descricao"],$produto["nome"],$produto["preco"],$produto["imagem"]);
    }, $arr2);
    return $dados_almoco;
  }

  public function getAllProdutos(): array{
    $sql ="select * from produtos";
    $statement = $this->pdo->query($sql);
    $arr= $statement -> fetchAll(PDO::FETCH_ASSOC);

    $result_query = array_map(function($produto){
      return new Produto($produto["id"],$produto["tipo"],$produto["descricao"],$produto["nome"],$produto["preco"],$produto["imagem"]);
    }, $arr);
    return $result_query;
  }

  public function excludeProduct(int $id): string{
    $sql = "delete from produtos where id = ?";
    $statement = $this -> pdo -> prepare( $sql);
    $statement -> bindParam(1,$id)
    return "sucess";
  }


  
}
