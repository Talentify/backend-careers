<?php

namespace Tests\Unit\Modules\Jobs\Get;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Get\Collections\JobCollection;
use Recruitment\Modules\Jobs\Get\Entities\Address;
use Recruitment\Modules\Jobs\Get\Entities\Job;
use Recruitment\Modules\Jobs\Get\Exceptions\GetJobException;
use Recruitment\Modules\Jobs\Get\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Get\Requests\Request;
use Recruitment\Modules\Jobs\Get\Responses\Response;
use Recruitment\Modules\Jobs\Get\Responses\Status;
use Recruitment\Modules\Jobs\Get\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Jobs\Get\Responses\Errors\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobs')
        ->willReturn(JobCollectionMock::getJobCollection());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute();
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getJobCollection(), $response->getJobCollection());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testJobNotFoundExceptionResponse()
    {
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('getJobs')
            ->willThrowException(new GetJobException());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute();
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGetJobExceptionResponse();

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
            ->method('getJobs')
            ->willThrowException(new \Exception());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute();
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGenericExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
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

Class JobCollectionMock
{
    public static function getJobCollection()
    {
        $jobCollection = new JobCollection();
        $jobCollection->add(
            JobMock::getJob()
        );

        return $jobCollection;
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
            JobCollectionMock::getJobCollection()
        );
    }

    public static function getGetJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to get jobs.'
        );
    }

    public static function getGenericExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to get jobs.'
        );
    }
}
