<?php
namespace Controlador;
use \Framework\DW3Sessao;
use \Modelo\Relatorio;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $this->visao('relatorios/index.php');
    }

}
