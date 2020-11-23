<?php

namespace App\Tests\Controller;

use App\DataFixtures\UserFixture;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthControllerTest extends WebTestCase
{
    /**
     * @var KernelBrowser
     */
    private KernelBrowser $kernelBrowser;

    public function setUp(): void
    {
        $this->kernelBrowser = $this->createClient();
        $application = new Application($this->kernelBrowser->getKernel());
        $application->setAutoExit(false);
        $application->run(new StringInput('doctrine:database:drop --force --quiet'));
        $application->run(new StringInput('doctrine:database:create --quiet'));
        $application->run(new StringInput('doctrine:migrations:migrate --no-interaction --quiet'));
        $application->run(new StringInput('doctrine:fixtures:load --no-interaction --quiet'));
    }

    public function testGetCredentials(): void
    {
        $this->kernelBrowser->request(
            'POST',
            '/auth/credentials',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => UserFixture::USERNAME,
                'password' => UserFixture::PASSWORD
            ])
        );
        $response = $this->kernelBrowser->getResponse();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('username', $data);
        $this->assertArrayHasKey('token', $data);
        $this->kernelBrowser->request(
            'GET',
            '/auth/logged',
            [],
            [],
            ['HTTP_X-AUTH-TOKEN' => $data['token']]
        );
        $response = $this->kernelBrowser->getResponse();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $dataLogged = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('username', $dataLogged);
        $this->assertArrayHasKey('token', $dataLogged);
        $this->assertEquals($data['token'], $dataLogged['token']);
    }
}