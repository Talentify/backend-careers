<?php

namespace Tests\Unit\Modules\Jobs\Show;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Show\Entities\Address;
use Recruitment\Modules\Jobs\Show\Entities\Job;
use Recruitment\Modules\Jobs\Show\Exceptions\GetAddressException;
use Recruitment\Modules\Jobs\Show\Exceptions\GetJobException;
use Recruitment\Modules\Jobs\Show\Exceptions\JobNotFoundException;
use Recruitment\Modules\Jobs\Show\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Show\Requests\Request;
use Recruitment\Modules\Jobs\Show\Responses\Response;
use Recruitment\Modules\Jobs\Show\Responses\Status;
use Recruitment\Modules\Jobs\Show\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Jobs\Show\Responses\Errors\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobById')
        ->willReturn(JobMock::getJob());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getJob(), $response->getJob());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGetJobExceptionResponse()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobById')
            ->willThrowException(new GetJobException());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGetJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGetAddressExceptionResponse()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobById')
            ->willThrowException(new GetAddressException());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGetJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testJobNotFoundExceptionResponse()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobById')
            ->willThrowException(new JobNotFoundException('Job not found.', 404));

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getJobNotFoundExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGenericExceptionResponse()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobById')
            ->willThrowException(new \Exception());

        $useCase = new UseCase($getJobGateway, $logInterface);

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
            1
        );
    }
}

Class AddressMock
{
    public static function getAddress()
    {
        return new Address(
            'rua',
            12,
            'city',
            'state',
            'country'
        );
    }
}

Class JobMock
{
    public static function getJob()
    {
        return new Job(
            1,
            'tittle',
            'description',
            'status',
            AddressMock::getAddress(),
            22000,
            'ENG,ARE'
        );
    }
}

Class ResponseMock
{
    public static function getSuccessResponse()
    {
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            JobMock::getJob()
        );
    }

    public static function getGetJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to get the job.'
        );
    }

    public static function getJobNotFoundExceptionResponse()
    {
        return new ResponseError(
            new Status(
                404,
                'Not Found'
            ),
            'Job not found.'
        );
    }

    public static function getGenericExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to get the job.'
        );
    }
}
