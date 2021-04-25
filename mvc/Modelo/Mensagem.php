<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Mensagem extends Modelo
{
    //SELECT m.texto, m.id m_id, u.id u_id, u.email FROM mensagens m JOIN usuarios u WHERE (m.usuario_id = 2) OR m.destinatario_id = 4 ORDER BY m.id

    const BUSCAR_TODOS = 'SELECT * FROM mensagens WHERE usuario_id = ? OR destinatario_id = ?  ORDER BY id';
    const BUSCAR_ID = 'SELECT * FROM mensagens WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO mensagens(usuario_id,destinatario_id, texto) VALUES (?, ?, ?)';
    const DELETAR = 'DELETE FROM mensagens WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM mensagens';
    private $id;
    private $usuarioId;
    private $contatoId;
    private $texto;
    private $usuario;

    public function __construct(
        $usuarioId,
        $contatoId,
        $texto,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->contatoId = $contatoId;
        $this->texto = $texto;
        $this->usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getContato()
    {
        return $this->contato;
    }
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }
    public function getContatoId()
    {
        return $this->contadoId;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);

        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->contatoId, PDO::PARAM_INT);
        $comando->bindValue(3, $this->texto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();

        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Mensagem(
                $registro['usuario_id'],
                $registro['destinatario_id'],
                $registro['texto'],
                null,
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function buscarTodos($id1, $id2)
    {

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $id1, PDO::PARAM_INT);
        $comando->bindValue(2, $id2, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {

            $objetos[] = new Mensagem(
                $registro['usuario_id'],
                $registro['destinatario_id'],
                $registro['texto'],
                $registro['id']

            );
        }
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}
