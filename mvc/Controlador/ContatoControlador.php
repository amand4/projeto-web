<?php
namespace Controlador;
use \Framework\DW3Sessao;
use \Modelo\Contato;

class ContatoControlador extends Controlador
{
    public function index()
    {
        $this->visao('contatos/index.php');
    }

    public function armazenar($usuarioId1, $usuarioId2)
    {

        $this->verificarLogado();
        $contato = new Contato(
            $usuarioId1,
            $usuarioId2
        );
        $contato->salvar();
        DW3Sessao::setFlash('mensagem', 'Contato Adicionado com sucesso.');
        $this->redirecionar(URL_RAIZ . 'usuarios');

    }

}
