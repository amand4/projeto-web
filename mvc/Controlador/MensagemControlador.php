<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;
use \Modelo\Usuario;
use \Modelo\Contato;

class MensagemControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 8;
        $offset = ($pagina - 1) * $limit;
        $mensagens = Mensagem::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Mensagem::contarTodos() / $limit);
        return compact('pagina', 'mensagens', 'ultimaPagina');
    }

    public function index()
    {

        $user =  DW3Sessao::get('usuario');
        $usuarioLogado = Usuario::buscarId($user);
        /// busco contato para eu por      

        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('mensagens/index.php', [
            'mensagens' => $paginacao['mensagens'],
            'usuarioLogado' =>$usuarioLogado, 
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }
    public function mostrar($id)
    {        

      ///  $contato= Usuario::buscarId($id);
      //  $user =  DW3Sessao::get('usuario');
      //  $usuarioLogado = Usuario::buscarId($user);
        /// busco contato para eu por      

        $this->verificarLogado();
      //  $mensagens = Mensagem::buscarTodos($user, $id);
        $this->visao('mensagens/index.php');
    }
    
    public function armazenar($contatoId)
    {
        $this->verificarLogado();

        $mensagem = new Mensagem(
            DW3Sessao::get('usuario'),
            $contatoId,
            $_POST['texto']
        );
        if ($mensagem->isValido()) {
            $mensagem->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem cadastrada.');
            $this->redirecionar(URL_RAIZ . 'mensagens/criar');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => $paginacao['mensagens'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $mensagem = Mensagem::buscarId($id);
        if ($mensagem->getUsuarioId() == $this->getUsuario()) {
            Mensagem::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Voc?? n??o pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'mensagens');
    }
}
