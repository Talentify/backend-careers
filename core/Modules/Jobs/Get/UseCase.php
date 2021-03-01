<?php

namespace Recruitment\Modules\Jobs\Get;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Get\Exceptions\GetJobException;
use Recruitment\Modules\Jobs\Get\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Get\Responses\Errors\Response;
use Recruitment\Modules\Jobs\Get\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Get\Responses\Status;
use Recruitment\Modules\Jobs\Get\Rules\GetJobRule;
use Recruitment\Modules\Jobs\Get\Rulesets\Ruleset;

final class UseCase
{
    private $getJobGateway;
    private $logger;
    private $response;

    public function __construct(GetJobGateway $getJobGateway, LogInterface $logger)
    {
        $this->getJobGateway = $getJobGateway;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            $this->logger->info('[Jobs::Get] Init Use Case.');
            $this->response = (new Ruleset(
                new GetJobRule(
                    $this->getJobGateway
                )
            ))->apply();
            $this->logger->info('[Jobs::Get] Finish Use Case.');
        } catch (GetJobException $exception) {
            $this->logger->error(
                '[Jobs::Get] An error occurred while trying to get jobs.',
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
                'An error occurred while trying to get jobs.'
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Jobs::Get] An generic error occurred while trying to get jobs.',
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
                'An generic error occurred while trying to get jobs.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
