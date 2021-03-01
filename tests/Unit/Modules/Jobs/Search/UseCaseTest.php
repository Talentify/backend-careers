<?php

namespace Tests\Unit\Modules\Jobs\Search;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Search\Collections\JobCollection;
use Recruitment\Modules\Jobs\Search\Entities\Address;
use Recruitment\Modules\Jobs\Search\Entities\Job;
use Recruitment\Modules\Jobs\Search\Exceptions\FindJobException;
use Recruitment\Modules\Jobs\Search\Gateways\FindJobGateway;
use Recruitment\Modules\Jobs\Search\Requests\Request;
use Recruitment\Modules\Jobs\Search\Responses\Response;
use Recruitment\Modules\Jobs\Search\Responses\Status;
use Recruitment\Modules\Jobs\Search\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Jobs\Search\Responses\Errors\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $getJobGateway = $this->createMock(FindJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('findJob')
        ->willReturn(JobCollectionMock::getJobCollection());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getJobCollection(), $response->getJobCollection());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testFindJobExceptionResponse()
    {
        $getJobGateway = $this->createMock(FindJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('findJob')
            ->willThrowException(new FindJobException());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getFindJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGenericExceptionResponse()
    {
        $getJobGateway = $this->createMock(FindJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('findJob')
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
            'ENG',
            'city',
            'state',
            'country',
            2000,
            6000,
            'company'
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

    public static function getFindJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to search the job.'
        );
    }

    public static function getGenericExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to search the job.'
        );
    }
}
