<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecruiterController extends Controller
{
    private $url;
    private $details;

    public function __construct(){
        $this->url      = \route('apirecruiters.index');
        $this->details  = [
            "title" => [
                'single' => 'Recrutador',
                'plural' => 'Recrutadores'
            ],
            "route" => "recruiters",
            "view"  => "recruiter",
        ];
    }

    public function index()
    {
        $response = Http::get($this->url);
        return view($this->details['view'].'.index', ['datas' => $response->json(), 'details' => $this->details]);
    }

    public function create()
    {
        $companies = Http::get(route('apicompanies.index'));
        return view($this->details['view'].".create", ['companies' => $companies->json(), 'details' => $this->details]);
    }

    public function store(Request $request)
    {
        $response = Http::post($this->url, $request->all());
        return $this->index();
    }


    public function show($id)
    {
        $companies = Http::get(route('apicompanies.index'));
        $response = Http::get($this->url."/".$id);
        return view($this->details['view'].".show", ["data" => $response, 'companies' => $companies->json(), "details" => $this->details]);
    }

    public function edit($id)
    {
        $companies = Http::get(route('apicompanies.index'));
        $response = Http::get($this->url."/".$id);
        return view($this->details['view'].".edit",  ['data' => $response, 'companies' => $companies->json(), 'details' => $this->details]);
    }

    public function update(Request $request, $id)
    {
        $response = Http::get($this->url."/".$id);
        if($response){
            $update = Http::put($this->url."/".$id, $request->all());
            return $this->show($id);
        }
    }

    public function destroy($id)
    {
        $response   = Http::delete($this->url."/".$id);
        return $this->index();
    }
}
