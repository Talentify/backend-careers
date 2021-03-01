<?php

namespace Recruitment\Modules\Jobs\Delete;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Delete\Exceptions\DeleteAddressException;
use Recruitment\Modules\Jobs\Delete\Exceptions\DeleteJobException;
use Recruitment\Modules\Jobs\Delete\Gateways\DeleteJobGateway;
use Recruitment\Modules\Jobs\Delete\Requests\Request;
use Recruitment\Modules\Jobs\Delete\Responses\Errors\Response;
use Recruitment\Modules\Jobs\Delete\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Delete\Responses\Status;
use Recruitment\Modules\Jobs\Delete\Rules\DeleteJobRule;
use Recruitment\Modules\Jobs\Delete\Rulesets\Ruleset;

final class UseCase
{
    private $deleteJobGateway;
    private $logger;
    private $response;

    public function __construct(DeleteJobGateway $deleteJobGateway, LogInterface $logger)
    {
        $this->deleteJobGateway = $deleteJobGateway;
        $this->logger = $logger;
    }

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Jobs::Delete] Init Use Case.');
            $this->response = (new Ruleset(
                new DeleteJobRule(
                    $this->deleteJobGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Jobs::Delete] Finish Use Case.');
        } catch (DeleteJobException | DeleteAddressException $exception) {
            $this->logger->error(
                '[Jobs::Delete] An error occurred while trying to delete the job.',
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
                'An error occurred while trying to delete the job.'
            );
        } catch (\Exception | \Throwable $exception) {
            $this->logger->error(
                '[Jobs::Delete] An generic error occurred while trying to delete the job.',
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
                'An generic error occurred while trying to delete the job.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
