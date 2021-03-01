<?php

namespace Recruitment\Modules\Jobs\Create;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Create\Exceptions\CreateAddressException;
use Recruitment\Modules\Jobs\Create\Exceptions\CreateJobException;
use Recruitment\Modules\Jobs\Create\Gateways\CreateJobGateway;
use Recruitment\Modules\Jobs\Create\Requests\Request;
use Recruitment\Modules\Jobs\Create\Responses\Erros\Response;
use Recruitment\Modules\Jobs\Create\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Create\Responses\Status;
use Recruitment\Modules\Jobs\Create\Rules\CreateJobRule;
use Recruitment\Modules\Jobs\Create\Rulesets\Ruleset;

final class UseCase
{
    private $createJobGateway;
    private $logger;
    private $response;

    public function __construct(CreateJobGateway $createJobGateway, LogInterface $logger)
    {
        $this->createJobGateway = $createJobGateway;
        $this->logger = $logger;
    }

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Jobs::Create] Init Use Case.');
            $this->response = (new Ruleset(
                new CreateJobRule(
                    $this->createJobGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Jobs::Create] Finish Use Case.');
        } catch (CreateJobException | CreateAddressException $exception) {
            $this->logger->error(
                '[Jobs::Create] An error occurred while trying to save the job.',
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
                'An error occurred while trying to save the job.'
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Jobs::Create] An generic error occurred while trying to save the job.',
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
                'An generic error occurred while trying to save the job.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
