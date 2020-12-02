<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\OpportunityService;
use App\Http\Requests\Opportunity\CreateOpportunityRequest;

class OpportunityController extends Controller
{
    /**
     * @var OpportunityService
     */
    private $opportunityService;

    /**
     * @param OpportunityService $opportunityService
     */
    public function __construct(OpportunityService $opportunityService)
    {
        $this->opportunityService = $opportunityService;
    }

    /**
     * Return all opportunities
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $opportunities = $this->opportunityService->all();

        return $this->apiResponse(
            __('controllers/opportunity.all_opportunities_sucessfully_returned'),
            $opportunities
        );
    }

    /**
     * Store a new Opportunity
     *
     * @param  CreateOpportunityRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateOpportunityRequest $request): JsonResponse
    {
        $opportunity = $this->opportunityService->create($request->all());

        if (!is_null($opportunity)) {
            return $this->apiResponse(
                __('controllers/opportunity.opportunity_created_successfully'),
                $opportunity
            );
        }

        return $this->apiResponse(__('controllers/opportunity.failed_to_create_opportunity'));
    }
}
