<?php

namespace Tests\Unit\Modules\Recruiters\Create;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Recruiters\Create\Entities\Recruiter;
use Recruitment\Modules\Recruiters\Create\Exceptions\CpfAlreadyExistsException;
use Recruitment\Modules\Recruiters\Create\Exceptions\CreateRecruiterException;
use Recruitment\Modules\Recruiters\Create\Gateways\CreateRecruiterGateway;
use Recruitment\Modules\Recruiters\Create\Requests\Request;
use Recruitment\Modules\Recruiters\Create\Responses\Response;
use Recruitment\Modules\Recruiters\Create\Responses\Status;
use Recruitment\Modules\Recruiters\Create\UseCase;
use Tests\TestCase;
use Recruitment\Modules\Recruiters\Create\Responses\Erros\Response as ResponseError;

class UseCaseTest extends TestCase
{
    public function testSuccess()
    {
        $createRecruiterGateway = $this->createMock(CreateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createRecruiterGateway->expects($this->once())
            ->method('create')
            ->willReturn(RecruiterMock::getRecruiter());

        $useCase = new UseCase($createRecruiterGateway, $logInterface);

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
        $createRecruiterGateway = $this->createMock(CreateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createRecruiterGateway->expects($this->once())
            ->method('create')
            ->willThrowException(new CreateRecruiterException());

        $useCase = new UseCase($createRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getCreateRecruiterExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testCpfAlreadyExistsError()
    {
        $createRecruiterGateway = $this->createMock(CreateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createRecruiterGateway->expects($this->once())
            ->method('create')
            ->willThrowException(new CpfAlreadyExistsException());

        $useCase = new UseCase($createRecruiterGateway, $logInterface);

        $useCase->execute(RequestMock::getRequest());
        $response = $useCase->getResponse();
        $expectedResponse = ResponseMock::getCpfAlreadyExistsExceptionResponse();

        $this->assertEquals($expectedResponse, $response);
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getError(), $response->getError());
        $this->assertEquals($expectedResponse->getPresenter(), $response->getPresenter());
    }

    public function testGenericError()
    {
        $createRecruiterGateway = $this->createMock(CreateRecruiterGateway::class);
        $logInterface = $this->createMock(LogInterface::class);
        $createRecruiterGateway->expects($this->once())
            ->method('create')
            ->willThrowException(new \Exception());

        $useCase = new UseCase($createRecruiterGateway, $logInterface);

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
            'Recruiter Name',
            '25698523696',
            'password',
            'email@email.com',
            1
        );
    }
}

Class RequestMock
{
    public static function getRequest()
    {
        return new Request(
            'Recruiter Name',
            '25698523696',
            1,
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
            new Status(201, 'Created'),
            RecruiterMock::getRecruiter()
        );
    }

    public static function getCreateRecruiterExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An error occurred while trying to save the recruiter.'
        );
    }

    public static function getCpfAlreadyExistsExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                400,
                'Bad Request'
            ),
            'The cpf informed is already being used'
        );
    }

    public static function getGenericExceptionResponse(): ResponseError
    {
        return new ResponseError(
            new Status(
                500,
                'Internal Server Error'
            ),
            'An generic error occurred while trying to save the recruiter.'
        );
    }
}
