<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use http\Env\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioInsercao  implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $html =  $this->rederizaHtml('cursos/formulario.php', ['titulo'=> "Novo Curso"]);
        return new Response(200, [], $html);
        
    }
}