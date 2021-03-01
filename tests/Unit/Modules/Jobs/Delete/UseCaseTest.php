<?php

namespace Tests\Unit\Modules\Jobs\Delete;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Delete\Exceptions\DeleteAddressException;
use Recruitment\Modules\Jobs\Delete\Exceptions\DeleteJobException;
use Recruitment\Modules\Jobs\Delete\Gateways\DeleteJobGateway;
use Recruitment\Modules\Jobs\Delete\Requests\Request;
use Recruitment\Modules\Jobs\Delete\Responses\Response;
use Recruitment\Modules\Jobs\Delete\Responses\Status;
use Recruitment\Modules\Jobs\Delete\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Jobs\Delete\Responses\Errors\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $getJobGateway = $this->createMock(DeleteJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('delete');

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testDeleteJobExceptionResponse()
    {
        $getJobGateway = $this->createMock(DeleteJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('delete')
            ->willThrowException(new DeleteJobException());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getDeleteJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testDeleteAddressExceptionResponse()
    {
        $getJobGateway = $this->createMock(DeleteJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('delete')
            ->willThrowException(new DeleteAddressException());

        $useCase = new UseCase($getJobGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getDeleteJobExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGenericExceptionResponse()
    {
        $getJobGateway = $this->createMock(DeleteJobGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getJobGateway->expects($this->once())
            ->method('delete')
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


Class ResponseMock
{
    public static function getSuccessResponse()
    {
        return new Response(
            new Status(
                200,
                'Ok'
            ),
            'Job successfully deleted.'
        );
    }

    public static function getDeleteJobExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to delete the job.'
        );
    }

    public static function getGenericExceptionResponse()
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to delete the job.'
        );
    }
}
