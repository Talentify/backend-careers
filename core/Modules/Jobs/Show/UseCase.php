<?php

namespace Recruitment\Modules\Jobs\Show;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Show\Exceptions\GetAddressException;
use Recruitment\Modules\Jobs\Show\Exceptions\GetJobException;
use Recruitment\Modules\Jobs\Show\Exceptions\JobNotFoundException;
use Recruitment\Modules\Jobs\Show\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Show\Requests\Request;
use Recruitment\Modules\Jobs\Show\Responses\Errors\Response;
use Recruitment\Modules\Jobs\Show\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Show\Responses\Status;
use Recruitment\Modules\Jobs\Show\Rules\GetJobRule;
use Recruitment\Modules\Jobs\Show\Rulesets\Ruleset;

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

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Jobs::Show] Init Use Case.');
            $this->response = (new Ruleset(
                new GetJobRule(
                    $this->getJobGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Jobs::Show] Finish Use Case.');
        } catch (GetJobException | GetAddressException $exception) {
            $this->logger->error(
                '[Jobs::Show] An error occurred while trying to get the job.',
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
                'An error occurred while trying to get the job.'
            );
        } catch (JobNotFoundException $exception) {
            $this->logger->error(
                '[Jobs::Update] Job not found',
                [
                    'exception' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]
            );
            $this->response = new Response(
                new Status(
                    404,
                    'Not Found'
                ),
                $exception->getMessage()
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Jobs::Show] An generic error occurred while trying to get the job.',
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
                'An generic error occurred while trying to get the job.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
