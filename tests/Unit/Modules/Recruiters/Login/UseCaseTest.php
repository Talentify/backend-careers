<?php

namespace Tests\Unit\Modules\Recruiters\Login;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Recruiters\Login\Entities\Recruiter;
use Recruitment\Modules\Recruiters\Login\Exceptions\CredentialsNotFoundException;
use Recruitment\Modules\Recruiters\Login\Exceptions\GetRecruiterCredentialsException;
use Recruitment\Modules\Recruiters\Login\Exceptions\UnauthorizedException;
use Recruitment\Modules\Recruiters\Login\Gateways\GetRecruiterCredentialsGateway;
use Recruitment\Modules\Recruiters\Login\Gateways\UpdateRecruiterGateway;
use Recruitment\Modules\Recruiters\Login\Requests\Request;
use Recruitment\Modules\Recruiters\Login\Responses\Response;
use Recruitment\Modules\Recruiters\Login\Responses\Status;
use Recruitment\Modules\Recruiters\Login\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Recruiters\Login\Responses\Errors\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $getRecruiterCredentialsGateway = $this->createMock(GetRecruiterCredentialsGateway::class);
        $updateRecruiterGateway = $this->createMock(UpdateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getRecruiterCredentialsGateway->expects($this->once())
            ->method('checkCredentials');

        $useCase = new UseCase($getRecruiterCredentialsGateway, $updateRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getSuccessResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getRecruiter(), $response->getRecruiter());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testCreateRecruiterError()
    {
        $getRecruiterCredentialsGateway = $this->createMock(GetRecruiterCredentialsGateway::class);
        $updateRecruiterGateway = $this->createMock(UpdateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getRecruiterCredentialsGateway->expects($this->once())
            ->method('checkCredentials')
            ->willThrowException(new GetRecruiterCredentialsException());

        $useCase = new UseCase($getRecruiterCredentialsGateway, $updateRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGetRecruiterCredentialsExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testCpfAlreadyExistsError()
    {
        $getRecruiterCredentialsGateway = $this->createMock(GetRecruiterCredentialsGateway::class);
        $updateRecruiterGateway = $this->createMock(UpdateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getRecruiterCredentialsGateway->expects($this->once())
            ->method('checkCredentials')
            ->willThrowException(new CredentialsNotFoundException('Email or password not found', 404));

        $useCase = new UseCase($getRecruiterCredentialsGateway, $updateRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getCredentialsNotFoundExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testUnauthorizedError()
    {
        $getRecruiterCredentialsGateway = $this->createMock(GetRecruiterCredentialsGateway::class);
        $updateRecruiterGateway = $this->createMock(UpdateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getRecruiterCredentialsGateway->expects($this->once())
            ->method('checkCredentials')
            ->willThrowException(new UnauthorizedException('Email or password is invalid.', 400));

        $useCase = new UseCase($getRecruiterCredentialsGateway, $updateRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getUnauthorizedExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGenericError()
    {
        $getRecruiterCredentialsGateway = $this->createMock(GetRecruiterCredentialsGateway::class);
        $updateRecruiterGateway = $this->createMock(UpdateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $getRecruiterCredentialsGateway->expects($this->once())
            ->method('checkCredentials')
            ->willThrowException(new \Exception());

        $useCase = new UseCase($getRecruiterCredentialsGateway, $updateRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getGenericExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }
}

Class RecruiterMock
{
    public static function getRecruiter()
    {
        return new Recruiter(
            'email@email.com',
            md5('email@email.com' . date('h-i-s Y-m-d'))
        );
    }
}

Class RequestMock
{
    public static function getRequest()
    {
        return new Request(
            'email@email.com',
            'password'
        );
    }
}

class ResponseMock
{
    public static function getSuccessResponse(): Response
    {
        return new Response(
            new Status(200, 'Ok'),
            RecruiterMock::getRecruiter()
        );
    }

    public static function getGetRecruiterCredentialsExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying login.'
        );
    }

    public static function getCredentialsNotFoundExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                404,
                'Not found'
            ),
            'Email or password not found'
        );
    }

    public static function getUnauthorizedExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                400,
                'Internal Server Error'
            ),
            'Email or password is invalid.'
        );
    }

    public static function getGenericExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying login.'
        );
    }
}
