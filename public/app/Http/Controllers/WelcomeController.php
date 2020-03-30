<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opportunities;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Spatie\Searchable\Search;

class WelcomeController extends Controller
{
    static $searchResults;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $searchResults = $this->paginate((new Search())
            ->registerModel(Opportunities::class, ['title', 'description', 'status', 'workplace', 'salary'])
            ->search('active'));

        return view('welcome', compact('searchResults'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $searchResults = $this->paginate((new Search())
            ->registerModel(Opportunities::class, ['title', 'description', 'status', 'workplace', 'salary'])
            ->perform($request->input('query')));

        return view('welcome', compact('searchResults'));
    }

    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 24, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $totalCount = count($items);
        $pageItems= $items->forPage($page, $perPage);
        $paginator = new LengthAwarePaginator($pageItems, $totalCount, $perPage, $page);

        return $paginator;
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
