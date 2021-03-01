<?php

namespace Tests\Unit\Modules\Jobs\Update;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Update\Entities\Address;
use Recruitment\Modules\Jobs\Update\Entities\Job;
use Recruitment\Modules\Jobs\Update\Exceptions\JobNotFoundException;
use Recruitment\Modules\Jobs\Update\Exceptions\NotEditableJobException;
use Recruitment\Modules\Jobs\Update\Exceptions\UpdateAddressException;
use Recruitment\Modules\Jobs\Update\Exceptions\UpdateJobException;
use Recruitment\Modules\Jobs\Update\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Update\Gateways\UpdateJobGateway;
use Recruitment\Modules\Jobs\Update\Requests\Request;
use Recruitment\Modules\Jobs\Update\Responses\Response;
use Recruitment\Modules\Jobs\Update\Responses\Status;
use Recruitment\Modules\Jobs\Update\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Jobs\Update\Responses\Errors\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $updateJobGateway = $this->createMock(UpdateJobGateway::class);
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);

        $getJobGateway->expects($this->once())
            ->method('getRecruiterIdJobById')
            ->willReturn(1);

        $updateJobGateway->expects($this->once())
            ->method('update')
            ->willReturn(JobMock::getJob());

        $useCase = new UseCase($updateJobGateway, $getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getJob(), $response->getJob());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testUpdateJobExceptionResponse()
    {
        $updateJobGateway = $this->createMock(UpdateJobGateway::class);
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);

        $getJobGateway->expects($this->once())
            ->method('getRecruiterIdJobById')
            ->willReturn(1);

        $updateJobGateway->expects($this->once())
            ->method('update')
            ->willThrowException(new UpdateJobException());

        $useCase = new UseCase($updateJobGateway, $getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getUpdateJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testUpdateAddressExceptionResponse()
    {
        $updateJobGateway = $this->createMock(UpdateJobGateway::class);
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);

        $getJobGateway->expects($this->once())
            ->method('getRecruiterIdJobById')
            ->willReturn(1);

        $updateJobGateway->expects($this->once())
            ->method('update')
            ->willThrowException(new UpdateAddressException());

        $useCase = new UseCase($updateJobGateway, $getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getUpdateJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testNotEditableJobExceptionResponse()
    {
        $updateJobGateway = $this->createMock(UpdateJobGateway::class);
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);

        $getJobGateway->expects($this->once())
            ->method('getRecruiterIdJobById')
            ->willThrowException(new NotEditableJobException(
                'This job cannot be edited because it belongs to another recruiter',
                400
            ));

        $updateJobGateway->expects($this->never())
            ->method('update');

        $useCase = new UseCase($updateJobGateway, $getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getNotEditableJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testJobNotFoundExceptionResponse()
    {
        $updateJobGateway = $this->createMock(UpdateJobGateway::class);
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);

        $getJobGateway->expects($this->once())
            ->method('getRecruiterIdJobById')
            ->willThrowException(new JobNotFoundException('Job not found.', 404));

        $updateJobGateway->expects($this->never())
            ->method('update');

        $useCase = new UseCase($updateJobGateway, $getJobGateway, $logInterface);

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
        $updateJobGateway = $this->createMock(UpdateJobGateway::class);
        $getJobGateway = $this->createMock(GetJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);

        $getJobGateway->expects($this->once())
            ->method('getRecruiterIdJobById')
            ->willThrowException(new \Exception());

        $updateJobGateway->expects($this->never())
            ->method('update');

        $useCase = new UseCase($updateJobGateway, $getJobGateway, $logInterface);

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
                200,
                'Ok'
            ),
            JobMock::getJob()
        );
    }

    public static function getUpdateJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to update the job.'
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

    public static function getNotEditableJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                400,
                'Bad Request'
            ),
            'This job cannot be edited because it belongs to another recruiter'
        );
    }

    public static function getGenericExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to update the job.'
        );
    }
}
