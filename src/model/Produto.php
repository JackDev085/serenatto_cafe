<?php 

class Produto{

  private ?int $id;
  private string $tipo;
  private string $descricao;
  private string $nome;
  private float $preco;
  private string $imagem;

  public function __construct(?int $id,string $tipo, string $descricao, string $nome, float $preco, string $imagem ="logo-serenatto.png"){
    $this->id = $id;
    $this->tipo = $tipo;
    $this->descricao = $descricao;
    $this->nome = $nome;
    $this->preco = $preco;
    $this->imagem = $imagem;
  }

  public function getId(): int{
    return $this->id;
  }
  public function setImagem($imagem){
    $this->imagem = $imagem;
  }
  public function getTipo(): string{
    return $this->tipo;
  }

  public function getDescricao(): string{
      return $this->descricao;
  }
  public function getNome(): string{
    return $this->nome;
  }
  public function getPreco(): string{
    return $this->preco;
  }
  public function getPrecoFormatado(): string{
    return (float)number_format($this-> preco,2);

  }

  public function getImagemDiretorio():string{
    return "img/".$this->imagem;
  }
  public function getImagem(): string{
    return $this->imagem;
  }

  


}