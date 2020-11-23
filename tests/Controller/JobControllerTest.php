<?php
namespace App\Tests\Controller;

use App\DataFixtures\UserFixture;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpFoundation\Response;

class JobControllerTest extends WebTestCase
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

    public function testReadWithoutResults(): void
    {
        $this->kernelBrowser->request('GET', '/job');
        $response = $this->kernelBrowser->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    /**
     * @return array
     */
    public function validCreateProvider(): array
    {
        $completeData = [
            'title' => 'title',
            'description' => 'description',
            'status' => true,
            'workplace' => [
                'address' => 'address',
                'city' => 'city',
                'state' => 'state',
                'country' => 'country'
            ],
            'salary' => 100.1
        ];
        return [
            'complete job' => [json_encode($completeData)],
            'without workplace' => [json_encode(array_merge($completeData, ['workplace' => null]))],
            'without salary' => [json_encode(array_merge($completeData, ['salary' => null]))]
        ];
    }

    /**
     * @param string $data
     *
     * @dataProvider validCreateProvider
     */
    public function testCreate(string $data): void
    {
        $this->kernelBrowser->request('POST', '/job', [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X-AUTH-TOKEN' => UserFixture::TOKEN
        ], $data);
        $response = $this->kernelBrowser->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->kernelBrowser->request('GET', '/job');
        $response = $this->kernelBrowser->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @param string $data
     *
     * @dataProvider validCreateProvider
     */
    public function testUnauthorizedCreate(string $data): void
    {
        $this->kernelBrowser->request('POST', '/job', [], [], ['CONTENT_TYPE' => 'application/json'], $data);
        $response = $this->kernelBrowser->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}