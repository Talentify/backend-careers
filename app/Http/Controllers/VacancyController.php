<?php

namespace App\Http\Controllers;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use DB;

class VacancyController extends Controller
{
    public function __construct(Vacancy $vacancy, Request $request){
        $this->vacancy = $vacancy;
        $this->request = $request;
    }
    public function index(){
        $data = DB::table('vacancy_tb')
        ->join('users', 'vacancy_tb.recruiter_id', '=', 'users.id')
        ->select(   'vacancy_tb.title',
                    'vacancy_tb.description',
                    'vacancy_tb.status',
                    'vacancy_tb.address',
                    'vacancy_tb.salary',
                    'vacancy_tb.company',
                    'users.name as recruiter_name')
        ->where('vacancy_tb.status', '=', 1)
        ->get();
        return response()->json($data);
    }

    public function store(Request $request){

        $this->validate($request, $this->vacancy->rules());

        $dataForm = $request->all();

        $user = auth()->user();

        $this->vacancy->title = $dataForm['title'];
        $this->vacancy->description = $dataForm['description'];
        $this->vacancy->status = $dataForm['status'];
        $this->vacancy->address = $dataForm['address'];
        $this->vacancy->salary = $dataForm['salary'];
        $this->vacancy->company = $dataForm['company'];
        $this->vacancy->recruiter_id = $user['id'];
        $this->vacancy->save();

        return response()->json($this->vacancy, 201);
    }

    public function show(Request $request){

        $dataForm = $request->all();
        
        $data = $this->vacancy::where('status', '=', 1);

        if ($request->has('title')) {
            $data->where('title', 'like', '%' . $dataForm['title'] . '%');
        }
        if ($request->has('address')) {
            $data->where('address', 'like', '%' . $dataForm['address'] . '%');
        }
        if ($request->has('salary')) {
            $data->where('salary', 'like', '%' . $dataForm['salary'] . '%');
        }
        if ($request->has('company')) {
            $data->where('company', 'like', '%' . $dataForm['company'] . '%');
        }
        
        return response()->json($data->get());
    }
    
    public function update(Request $request, $id){

        if(!$data = $this->vacancy->find($id)){
            return response()->json(['error' => 'Nenhuma vaga foi encontrada'], 404);
        }

        $user = auth()->user();

        $data = $this->vacancy->find($id);
        $user_vacancy = $data['recruiter_id'];

        if($user['id'] == $user_vacancy){
            $this->validate($request, $this->vacancy->rules());

            $dataForm = $request->all();

            $this->vacancy->title = $dataForm['title'];
            $this->vacancy->description = $dataForm['description'];
            $this->vacancy->status = $dataForm['status'];
            $this->vacancy->address = $dataForm['address'];
            $this->vacancy->salary = $dataForm['salary'];
            $this->vacancy->company = $dataForm['company'];
            $this->vacancy->recruiter_id = $user['id'];
            $this->vacancy->where('id', $id)->update($dataForm);

            return response()->json($this->vacancy, 201);
        }else{
            return response()->json(['error' => 'O recrutador logado nao eh o mesmo que criou a vaga'], 401);
        }
            
    }
}
