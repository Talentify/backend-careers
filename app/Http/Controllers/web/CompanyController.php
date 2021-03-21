<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    private $url;
    private $details;

    public function __construct(){
        $this->url      = \route('apicompanies.index');
        $this->details  = [
            "title" => [
              'single' => 'Company',
              'plural' => 'Empresas'
            ],
            "route" => "companies",
            "view"  => "company",
        ];
    }

    public function index()
    {
        $response = Http::get($this->url);
        return view($this->details['view'].'.index', ['datas' => $response->json(), 'details' => $this->details]);
    }

    public function create()
    {
        return view($this->details['view'].".create", ['details' => $this->details]);
    }

    public function store(Request $request)
    {

        $response = Http::post($this->url, $request->all());
        return $this->index();
    }


    public function show($id)
    {
        $response = Http::get($this->url."/".$id);
        return view($this->details['view'].".show", ["data" => $response, "details" => $this->details]);
    }

    public function edit($id)
    {
        $response = Http::get($this->url."/".$id);
        return view($this->details['view'].".edit",  ['data' => $response, 'details' => $this->details]);
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
