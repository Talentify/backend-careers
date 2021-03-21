<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VacancyController extends Controller
{
    private $url;
    private $details;

    public function __construct(){
        $this->url      = \route('apivacancies.index');
        $this->details  = [
            "title" => [
                'single' => 'Vaga',
                'plural' => 'Vagas'
            ],
            "route" => "vacancies",
            "view"  => "vacancy",
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
        return $this->myVacancies();
    }


    public function show($id)
    {
        $response = Http::get($this->url."/".$id);
        return view($this->details['view'].".show", ["data" => $response, "details" => $this->details]);
    }

    public function edit($id)
    {
        $response = Http::get($this->url."/".$id);
        if($response["id_recruiter"] == Auth::id()){
            return view($this->details['view'].".edit",  ['data' => $response, 'details' => $this->details]);
        }else{
            return $this->myVacancies();
        }
    }

    public function update(Request $request, $id)
    {
        $response = Http::get($this->url."/".$id);
        if($response["id_recruiter"] == Auth::id()){
            Http::put($this->url."/".$id, $request->all());
        }
        return $this->show($id);
    }

    public function destroy($id)
    {
        $response = Http::get($this->url."/".$id);
        if($response["id_recruiter"] == Auth::id()) {
            Http::delete($this->url . "/" . $id);
        }
        return $this->myVacancies();
    }

    public function myVacancies(){
        $response = Http::get(route('apimyvacancies', Auth::id()));
        return view($this->details['view'].'.index', ['datas' => $response->json(), 'details' => $this->details]);
    }

    public function welcome(){
        $response = Http::get($this->url);
        return view('home', ['datas' => $response->json(), 'details' => $this->details]);
    }

    public function seeVacancies(Request $request){

        $response = Http::post(route("filtervacancies"), $request->all());
        return view('home', ['datas' => $response->json(), 'details' => $this->details]);
    }
}
