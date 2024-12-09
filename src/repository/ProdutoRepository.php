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

  public function excludeProduct(int $id){
    $sql = "delete from produtos where id = ?";
    $statement = $this -> pdo -> prepare( $sql);
    $statement -> bindParam(1,$id);
    $statement -> execute();
  }

  public function salvar(Produto $produto){
    $sql = "insert into produtos (tipo,nome,descricao,preco,imagem) values (?,?,?,?,?)";
    $statement = $this -> pdo -> prepare( $sql);
    $statement -> bindValue(1,$produto->getTipo());
    $statement -> bindValue(2,$produto->getNome());
    $statement -> bindValue(3,$produto->getDescricao());
    $statement -> bindValue(4,$produto->getPreco());
    $statement -> bindValue(5,$produto->getImagem());
    $statement -> execute();
  }










  public function formarObjeto($product){
    $produto = new Produto(
      $product["id"],
      $product["tipo"],
      $product["descricao"],
      $product["nome"],
      $product["preco"],
      $product["imagem"]
    );
    return $produto;
  }
  public function buscaUm(int $id){
    $sql = "SELECT * FROM produtos where id =?";
    $statement = $this -> pdo -> prepare( $sql );
    $statement -> bindParam(1,$id);
    $statement -> execute();
    $product = $statement -> fetch(PDO::FETCH_ASSOC);
    $produto = $this -> formarObjeto($product);
    return $produto;
  }
  private function atualizarFoto(Produto $produto)
    {
        $sql = "UPDATE produtos SET imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getImagem());
        $statement->bindValue(2, $produto->getId());
        $statement->execute();
    }

  public function updateOne($produto){
    $sql = "update produtos set tipo=?, nome=?,descricao=?,preco=?,where id=?";
    $statement = $this -> pdo ->prepare($sql);
    $statement -> bindValue(1,$produto->getTipo());
    $statement -> bindValue(2,$produto->getNome());
    $statement -> bindValue(3,$produto->getDescricao());
    $statement -> bindValue(4,$produto->getPrecoFormatado());
    $statement -> bindValue(5, $produto->getId());
    if($produto->getImagem() !== 'logo-serenatto.png'){
            
      $this->atualizarFoto($produto);
  }
    $statement -> execute();
    return $statement;


  } 
  
}