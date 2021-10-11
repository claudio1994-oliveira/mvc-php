<?php

use Alura\Cursos\Controller\{CursoEmJason,
    CursoEmXml,
    Exclusao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Logout,
    Persistencia,
    RealizarLogin};

return array(
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Logout::class,
    '/buscarCursosEmJson' => CursoEmJason::class,
    '/buscarCursosEmXml'=> CursoEmXml::class
);

