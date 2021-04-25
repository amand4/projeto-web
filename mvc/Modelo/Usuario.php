<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
   // const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';

    const BUSCAR_POR_NOME = 'SELECT * FROM usuarios WHERE nome = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(nome,numero,senha) VALUES (?, ?, ?)';
    const ATUALIZAR = 'UPDATE usuarios SET nome = ? WHERE id = ?';
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const DELETAR = 'DELETE FROM usuarios WHERE id = ?';
    const BUSCAR_TODOS = 'SELECT * FROM usuarios WHERE id != 1 ORDER BY id LIMIT ? OFFSET ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM usuarios';

 
    private $id;
    private $nome;
    private $numero;
    private $senha;
    private $senhaPlana;
    private $foto;
    private $admin;


    public function __construct(
        $nome,
        $numero,
        $senha,
        $foto = null,
        $id = null,
        $admin = false

    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->numero = $numero;
        $this->foto = $foto;
        $this->senhaPlana = $senha;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
        $this->admin = $admin;

    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }
    public function isAdmin()
    {
        return $this->admin;
    }


    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    protected function verificarErros()
    {
        if (strlen($this->nome) < 3) {
            $this->setErroMensagem('Nome', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->numero) < 6) {
            $this->setErroMensagem('numero', 'Deve ter no mínimo 6 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }
        if (DW3ImagemUpload::existeUpload($this->foto)
            && !DW3ImagemUpload::isValida($this->foto)) {
            $this->setErroMensagem('foto', 'Deve ser de no máximo 500 KB.');
        }
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->numero, PDO::PARAM_INT);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }
    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }
    public static function buscarNome($nome)
    {
        var_dump($nome);

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_NOME);
        $comando->bindValue(1, $nome, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['numero'],
                '',
                null,
                $registro['id'],
                $registro['admin']

            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    
    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Usuario(
            $registro['nome'],     
            $registro['numero'],     
            '',
            null,
            $registro['id'],
            $registro['admin']

        );
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Usuario(
                $registro['nome'],
                $registro['numero'],     
                '',
                null,
                $registro['id'],
                $registro['admin']

            );            
        }
      
        return $objetos;
    }


}
