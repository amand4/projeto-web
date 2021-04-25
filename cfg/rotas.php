<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/inicial' => [
        'GET' => '\Controlador\LoginControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
        'GET' => '\Controlador\UsuarioControlador#index',

    ],
    '/usuarios/?' => [
        'PATCH' => '\Controlador\UsuarioControlador#atualizar',
       'DELETE' => '\Controlador\UsuarioControlador#destruir',

    ],
    '/usuarios/?/editar' => [
        'GET' => '\Controlador\UsuarioControlador#editar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/contatos' => [
        'GET' => '\Controlador\ContatoControlador#index',
    ],
    '/mensagens' => [
        'GET' => '\Controlador\MensagemControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar',

    ],
    '/mensagens/?' => [
        'DELETE' => '\Controlador\MensagemControlador#destruir',
        'POST' => '\Controlador\MensagemControlador#armazenar',
        'GET' => '\Controlador\MensagemControlador#mostrar',

    ],
    '/relatorios' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],
    '/contatos/?/?' => [
        'POST' => '\Controlador\ContatoControlador#armazenar',
    ],



];
