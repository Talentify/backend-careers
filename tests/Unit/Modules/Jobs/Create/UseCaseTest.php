<?php

namespace Tests\Unit\Modules\Jobs\Create;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Create\Entities\Address;
use Recruitment\Modules\Jobs\Create\Entities\Job;
use Recruitment\Modules\Jobs\Create\Exceptions\CreateAddressException;
use Recruitment\Modules\Jobs\Create\Exceptions\CreateJobException;
use Recruitment\Modules\Jobs\Create\Gateways\CreateJobGateway;
use Recruitment\Modules\Jobs\Create\Requests\Request;
use Recruitment\Modules\Jobs\Create\Responses\Response;
use Recruitment\Modules\Jobs\Create\Responses\Status;
use Recruitment\Modules\Jobs\Create\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Jobs\Create\Responses\Erros\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $createJobGateway = $this->createMock(CreateJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createJobGateway->expects($this->once())
            ->method('create')
            ->willReturn(JobMock::getJob());

        $useCase = new UseCase($createJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getJob(), $response->getJob());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testCreateJobExceptionResponse()
    {
        $createJobGateway = $this->createMock(CreateJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createJobGateway->expects($this->once())
            ->method('create')
            ->willThrowException(new CreateJobException());

        $useCase = new UseCase($createJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getCreateJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testCreateAddressExceptionResponse()
    {
        $createJobGateway = $this->createMock(CreateJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createJobGateway->expects($this->once())
            ->method('create')
            ->willThrowException(new CreateAddressException());

        $useCase = new UseCase($createJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getCreateJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGenericExceptionResponse()
    {
        $createJobGateway = $this->createMock(CreateJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createJobGateway->expects($this->once())
            ->method('create')
            ->willThrowException(new \Exception());

        $useCase = new UseCase($createJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGenericExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }
}

Class RequestMock
{
    public static function getRequest()
    {
        return new Request(
            JobMock::getJob()
        );
    }
}

Class AddressMock
{
    public static function getAddress()
    {
        return (new Address(
            'rua',
            12,
            'city',
            'state',
            'country'
        ))->setJobId(1);
    }
}

Class JobMock
{
    public static function getJob()
    {
        return new Job(
            'tittle',
            'description',
            'status',
            AddressMock::getAddress(),
            22000,
            'ENG,ARE',
            1
        );
    }
}

Class ResponseMock
{
    public static function getSuccessResponse()
    {
        return new Response(
            new Status(
                201,
                'Created'
            ),
            JobMock::getJob()
        );
    }

    public static function getCreateJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to save the job.'
        );
    }

    public static function getGenericExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to save the job.'
        );
    }
}
