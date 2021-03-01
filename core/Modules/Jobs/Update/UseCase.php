<?php

namespace Recruitment\Modules\Jobs\Update;

use Recruitment\Dependencies\LogInterface;
use Recruitment\Modules\Jobs\Update\Exceptions\JobNotFoundException;
use Recruitment\Modules\Jobs\Update\Exceptions\NotEditableJobException;
use Recruitment\Modules\Jobs\Update\Exceptions\UpdateAddressException;
use Recruitment\Modules\Jobs\Update\Exceptions\UpdateJobException;
use Recruitment\Modules\Jobs\Update\Gateways\GetJobGateway;
use Recruitment\Modules\Jobs\Update\Gateways\UpdateJobGateway;
use Recruitment\Modules\Jobs\Update\Requests\Request;
use Recruitment\Modules\Jobs\Update\Responses\Errors\Response;
use Recruitment\Modules\Jobs\Update\Responses\ResponseInterface;
use Recruitment\Modules\Jobs\Update\Responses\Status;
use Recruitment\Modules\Jobs\Update\Rules\CheckOwnerJobRule;
use Recruitment\Modules\Jobs\Update\Rules\UpdateJobRule;
use Recruitment\Modules\Jobs\Update\Rulesets\Ruleset;

final class UseCase
{
    private $updateJobGateway;
    private $getJobGateway;
    private $logger;
    private $response;

    public function __construct(
        UpdateJobGateway $updateJobGateway,
        GetJobGateway $getJobGateway,
        LogInterface $logger
    ) {
        $this->updateJobGateway = $updateJobGateway;
        $this->getJobGateway = $getJobGateway;
        $this->logger = $logger;
    }

    public function execute(Request $request)
    {
        try {
            $this->logger->info('[Jobs::Update] Init Use Case.');
            $this->response = (new Ruleset(
                new UpdateJobRule(
                    $this->updateJobGateway,
                    $request
                ),
                new CheckOwnerJobRule(
                    $this->getJobGateway,
                    $request
                )
            ))->apply();
            $this->logger->info('[Jobs::Update] Finish Use Case.');
        } catch (UpdateJobException | UpdateAddressException $exception) {
            $this->logger->error(
                '[Jobs::Update] An error occurred while trying to update the job.',
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
                'An error occurred while trying to update the job.'
            );
        } catch (NotEditableJobException $exception) {
            $this->logger->error(
                '[Jobs::Update] ' . $exception->getMessage(),
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
                $exception->getMessage()
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
                '[Jobs::Update] An generic error occurred while trying to update the job.',
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
                'An generic error occurred while trying to update the job.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
