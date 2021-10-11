<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao  implements RequestHandlerInterface
{
use RenderizadorDeHtmlTrait, FlashMessageTrait;

    private \Doctrine\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository $reporsitorioCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->reporsitorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );
        $resposta = new Response(302, ['Location' => '/listar-curso']);
        if(is_null($id) || $id === false){
            $this->defineMensagem('danger','ID do curso não existe');
            return $resposta;
        }
        $curso = $this->reporsitorioCursos->find($id);

        $html= $this->rederizaHtml('cursos/formulario.php',
        ['curso'=> $curso,
         'titulo'=> "Alterar Curso - " . $curso->getDescricao()
        ]);

        return new Response(200, [], $html);

    }
}