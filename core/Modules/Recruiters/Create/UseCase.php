<?php

namespace Recruitment\Modules\Recruiters\Create;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Recruiters\Create\Exceptions\CpfAlreadyExistsException;
use Recruitment\Modules\Recruiters\Create\Exceptions\CreateRecruiterException;
use Recruitment\Modules\Recruiters\Create\Gateways\CreateRecruiterGateway;
use Recruitment\Modules\Recruiters\Create\Requests\Request;
use Recruitment\Modules\Recruiters\Create\Responses\Erros\Response;
use Recruitment\Modules\Recruiters\Create\Responses\ResponseInterface;
use Recruitment\Modules\Recruiters\Create\Responses\Status;
use Recruitment\Modules\Recruiters\Create\Rules\CreateRecruiterRule;
use Recruitment\Modules\Recruiters\Create\Rulesets\Ruleset;

final class UseCase
{
    private $createRecruiterGateway;
    private $logger;
    private $response;

    public function __construct(CreateRecruiterGateway $createRecruiterGateway, LogInterface $logger)
    {
        $this->createRecruiterGateway = $createRecruiterGateway;
        $this->logger = $logger;
    }

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Recruiters::Create] Init Use Case.');
            $this->response = (new Ruleset(
                new CreateRecruiterRule(
                    $this->createRecruiterGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Recruiters::Create] Finish Use Case.');
        } catch (CreateRecruiterException $exception) {
            $this->logger->error(
                '[Recruiters::Create] An error occurred while trying to save the recruiter.',
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
                'An error occurred while trying to save the recruiter.'
            );
        } catch (CpfAlreadyExistsException $exception) {
            $this->logger->error(
                '[Recruiters::Create] The cpf informed is already being used.',
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
            $this->response = new Response(
                new Status(
                    400,
                    'Bad Request'
                ),
                'The cpf informed is already being used'
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Recruiters::Create] An generic error occurred while trying to save the recruiter.',
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
                'An generic error occurred while trying to save the recruiter.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
