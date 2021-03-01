<?php

namespace Recruitment\Modules\Recruiters\Login;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Recruiters\Login\Exceptions\CredentialsNotFoundException;
use Recruitment\Modules\Recruiters\Login\Exceptions\unauthorizedException;
use Recruitment\Modules\Recruiters\Login\Exceptions\GetRecruiterCredentialsException;
use Recruitment\Modules\Recruiters\Login\Gateways\GetRecruiterCredentialsGateway;
use Recruitment\Modules\Recruiters\Login\Gateways\UpdateRecruiterGateway;
use Recruitment\Modules\Recruiters\Login\Requests\Request;
use Recruitment\Modules\Recruiters\Login\Responses\Errors\Response;
use Recruitment\Modules\Recruiters\Login\Responses\ResponseInterface;
use Recruitment\Modules\Recruiters\Login\Responses\Status;
use Recruitment\Modules\Recruiters\Login\Rules\CheckCredentialsRule;
use Recruitment\Modules\Recruiters\Login\Rules\CreateLoginTokenRule;
use Recruitment\Modules\Recruiters\Login\Rulesets\Ruleset;

final class UseCase
{
    private $getRecruiterCredentialsGateway;
    private $updateRecruiterGateway;
    private $logger;
    private $response;

    public function __construct(
        GetRecruiterCredentialsGateway $getRecruiterCredentialsGateway,
        UpdateRecruiterGateway $updateRecruiterGateway,
        LogInterface $logger
    ) {
        $this->getRecruiterCredentialsGateway = $getRecruiterCredentialsGateway;
        $this->updateRecruiterGateway = $updateRecruiterGateway;
        $this->logger = $logger;
    }

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Recruiters::Login] Init Use Case.');
            $this->response = (new Ruleset(
                new CheckCredentialsRule(
                    $this->getRecruiterCredentialsGateway,
                    $request
                ),
                new CreateLoginTokenRule(
                    $this->updateRecruiterGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Recruiters::Login] Finish Use Case.');
        } catch (GetRecruiterCredentialsException $exception) {
            $this->logger->error(
                '[Recruiters::Login] An error occurred while trying login.',
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
            $this->response = new Response(
                new Status(
                    500,
                    'Internal Server Error'
                ),
                'An error occurred while trying login.'
            );
        } catch (CredentialsNotFoundException $exception) {
            $this->logger->error(
                '[Recruiters::Login] Credentials not found.',
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
            $this->response = new Response(
                new Status(
                    404,
                    'Not found'
                ),
                $exception->getMessage()
            );
        } catch (UnauthorizedException $exception) {
            $this->logger->error(
                '[Recruiters::Login] Invalid credentials.',
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
            $this->response = new Response(
                new Status(
                    400,
                    'Internal Server Error'
                ),
                $exception->getMessage()
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Recruiters::Login] An generic error occurred while trying login.',
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
            $this->response = new Response(
                new Status(
                    500,
                    'Internal Server Error'
                ),
                'An generic error occurred while trying login.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
