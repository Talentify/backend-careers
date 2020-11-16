<?php
declare(strict_types=1);

namespace App\Tests\Unit;

use App\Resource\VagaResource;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VagaTest extends TestCase
{
    /**
     * testa se o método create da resource retorna corretamente o sucesso
     */
    public function testCreateSuccess(): void
    {
        $entityManager= $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->exactly(1))
            ->method('persist')
            ->willReturn('true');

        $entityManager->expects($this->exactly(1))
            ->method('flush')
            ->willReturn(true);

        $arrayVazio = [];

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->expects($this->exactly(1))
            ->method('validate')
            ->willReturn($arrayVazio);

        $request = $this->createMock(Request::class);
        $request->expects($this->any())
            ->method('get')
            ->will($this->returnCallback(array($this, 'get')));

        $vagaResource = new VagaResource($entityManager, $validator);
        $response = $vagaResource->create($request);

        $this->assertTrue($response);
    }

    /**
     * testa se o método create da resource retorna corretamente o erro
     */
    public function testCreateError(): void
    {
        $entityManager= $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->exactly(0))
            ->method('persist')
            ->willReturn('true');

        $entityManager->expects($this->exactly(0))
            ->method('flush')
            ->willReturn(true);

        //aqui é a diferença de erros
        $arrayErros = [
            'erro: titulo invalido',
            'erro: descrição inválida',
        ];

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->expects($this->exactly(1))
            ->method('validate')
            ->willReturn($arrayErros);

        $request = $this->createMock(Request::class);
        $request->expects($this->any())
            ->method('get')
            ->will($this->returnCallback(array($this, 'get')));

        $vagaResource = new VagaResource($entityManager, $validator);
        $response = $vagaResource->create($request);

        $this->assertIsArray($response);
    }

    public function get($key)
    {
        switch($key)
        {
            case 'title':
                return 'teste de titulo';

            case 'description':
                return 'descrição teste';

            case 'workplace':
                return 'workplace teste';

            case 'salary':
                return 1000.00;
        }
    }
}