<?php
class Registrar
{
  public function _construct()
  {
      Transaction::open();
  }
  public function controller() {
    $reg = new Template("view/registro.html");
    $retorno["msg"] = $reg->saida();
    return $retorno;
  }

  public function _construct()
  {
      Transaction::open();
  }
  public function salvar() {
    if (isset($_POST["trajeto"]) && isset($_POST["aeronave"]) & isset($_POST["horario"])) {
        try {
            $conexao = Transaction::get();
            $crud = new Crud();
            $trajeto = $conexao->quote($_POST["trajeto"]);
            $aeronave = $conexao->quote($_POST["aeronave]);
            $horario = $conexao->quote($_POST["horario"]);
            $retorno = $crud->insert("trajeto", "aeronave", "horario", "{$trajeto}", "{$aeronave}", "{$horario}");
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
    return $retorno;

  }
  public function __destruct(){
      Transaction::close();
  }
}