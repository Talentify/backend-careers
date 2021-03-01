<?php

namespace Recruitment\Modules\Jobs\Search;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Search\Exceptions\FindJobException;
use Recruitment\Modules\Jobs\Search\Gateways\FindJobGateway;
use Recruitment\Modules\Jobs\Search\Requests\Request;
use Recruitment\Modules\Jobs\Search\Responses\Errors\Response;
use Recruitment\Modules\Jobs\Search\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Search\Responses\Status;
use Recruitment\Modules\Jobs\Search\Rules\FindJobRule;
use Recruitment\Modules\Jobs\Search\Rulesets\Ruleset;

final class UseCase
{
    private $getJobGateway;
    private $logger;
    private $response;

    public function __construct(FindJobGateway $getJobGateway, LogInterface $logger)
    {
        $this->getJobGateway = $getJobGateway;
        $this->logger = $logger;
    }

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Jobs::Search] Init Use Case.');
            $this->response = (new Ruleset(
                new FindJobRule(
                    $this->getJobGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Jobs::Search] Finish Use Case.');
        } catch (FindJobException $exception) {
            $this->logger->error(
                '[Jobs::Search] An error occurred while trying to search the job.',
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
                'An error occurred while trying to search the job.'
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Jobs::Search] An generic error occurred while trying to search the job.',
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
                'An generic error occurred while trying to search the job.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
