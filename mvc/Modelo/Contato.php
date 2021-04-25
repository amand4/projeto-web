<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Contato extends Modelo
{
   ///SELECT u.id u_id, u.email FROM contatos c JOIN usuarios u ON (c.usuario2_id = u.id) buscar todos contatos

    const INSERIR = 'INSERT INTO contatos(usuario1_id,usuario2_id) VALUES (?, ?)';

    private $id;
    private $usuarioId1;
    private $usuarioId2;
    private $usuario1;
    private $usuario2;

    public function __construct(
        $usuarioId1,
        $usuarioId2,
        $usuario1 = null,
        $usuario2 = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId1 = $usuarioId1;
        $this->usuarioId2 = $usuarioId2;
        $this->usuario1 = $usuario1;
        $this->usuario2= $usuario2;

    }


    public function salvar()
    {
        $this->inserir();
    }
    public function getUsuario1()
    {
        return $this->usuario1;
    }
    public function getUsuario2()
    {
        return $this->usuario2;
    }
    public function getUsuario1Id()
    {
        return $this->usuarioId1;
    }
    public function getUsuario2Id()
    {
        return $this->usuarioId2;
    }



    public function getId()
    {
        return $this->id;
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId1, PDO::PARAM_INT);
        $comando->bindValue(2, $this->usuarioId2, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarContato($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Mensagem(
                $registro['usuario_id'],
                $registro['contato_id'],
                $registro['texto'],
                null,
                $registro['id']
            );
        }
        return $objeto;
    }
}
