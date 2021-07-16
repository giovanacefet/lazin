<?php
class Form
{
  public function _construct()
  {
      Transaction::open();
  }
  public function controller() {
      try {
          $conexao = Transaction::get();
          $crud = new Crud();
          $voo = $crud->select("aeronave")
          if (!$voo["erro"]) {
              $form = new Template("view/form.html");
              $form ->set("aeronave", $voo["msg"]);
              $form ->set("trajeto", "");
              $form ->set("horario", "");
              $retorno["msg"] = $reg->saida();
          }
      } catch (\Throwable $th){
        //throw $sth;
      }
      return $retorno;
  }

  public function salvar() {
    if (isset($_POST["nome"]) && isset($_POST["trajeto"]) & isset($_POST["horario"])) {
        try {
            $conexao = Transaction::get();
            $crud = new Crud();
            $nome = $conexao->quote($_POST["nome"]);
            $voo = $conexao->quote($_POST["trajeto"]);
            $horario = $conexao->quote($_POST["horario"]);
            if (issets($_POST["id"]) && !empty($_POST["id"])) {
                $id = $conexao->quote($_POST["id"]);
                $retorno = $crud->update("voo, nome={$nome)", "trajeto={$trajeto}", "horario={$horario}", "id={$id}");
            } else {
                $retorno = $crud->insert("voo", "nome, trajeto, horario", "($nome),($trajeto),($horario)")
            }
        } catch (\Exception $e) {
            $retorno["msg"] = "Ocorreu um erro!".$e->getMessage();
            $retorno["erro"] = true;
            Transaction::rollback();
        }
    } else {
        $retorno["msg"] = "Preencha todos os campos!";
        $retorno["erro"] = True;
    }
    $status = new Template("view/msg.html");
    $status ->set("cor", ($retorno["erro"]) ? "danger" : "success");
    $status ->set("msg", ($retorno["msg"]);
    $retorno["msg"] = $status->saida();


    public function delete(){
        if(isset($_GET["id"])){
            try{
                $conexao = Transaction::get();
                $id = $conexao->quote($_GET["id"]);
                $crud = new Crud();
                $retorno = $crud->delete("voo", "id={$id}");
            }
        }
    }
    
    return $retorno;

  }
  public function __destruct(){
      Transaction::close();
  }
}