<?php
namespace Controlador;
use \Framework\DW3Sessao;
use \Modelo\Usuario;

class UsuarioControlador extends Controlador

{

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $usuarios = Usuario::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Usuario::contarTodos() / $limit);
        return compact('pagina', 'usuarios', 'ultimaPagina');
    }

   
    public function index()
    {
        
        $user =  DW3Sessao::get('usuario');
        $usuarioLogado = Usuario::buscarId($user);
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('usuarios/index.php', [
            'usuarioLogado' =>$usuarioLogado,
            'usuarios' => $paginacao['usuarios'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash'),
            
        ]);
    }

    public function criar()
    {
        $this->visao('usuarios/criar.php', [
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')]
        );
    }

    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $usuario = new Usuario($_POST['nome'],$_POST['numero'], $_POST['senha'], $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Usuário cadastrado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'usuarios/criar');

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php', [
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function atualizar($id)
    {
        $usuario = Usuario::buscarId($id);
        $usuario->setNome($_POST['nome']);
        $usuario->salvar();
        DW3Sessao::setFlash('mensagemFlash', 'Usuário atualizado com sucesso.');
        $this->redirecionar(URL_RAIZ . 'usuarios/criar',  [
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }
    public function editar($id)
    {       

        $usuario = Usuario::buscarId($id);
        $this->visao('usuarios/editar.php', [
            'usuario' => $usuario,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }


    public function destruir($id)
    {
        Usuario::destruir($id);
        DW3Sessao::setFlash('mensagemFlash', 'Seu perfil foi deletado com sucesso.');

        $this->redirecionar(URL_RAIZ . 'login/criar.php', [
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }
}
