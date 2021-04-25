<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/criar.php');
    }
    public function index()
    {
        $this->visao('inicial/index.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarNome($_POST['nome']);

        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
           // $this->redirecionar(URL_RAIZ . 'mensagens');
           if ($usuario->isAdmin()) {
            $this->redirecionar(URL_RAIZ . 'mensagens/areaAdmin');
            } else {
                $this->redirecionar(URL_RAIZ . 'mensagens/criar');
            }
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
