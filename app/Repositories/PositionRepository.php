<?php


namespace App\Repositories;


use App\Models\Position;
use App\Repositories\Contracts\PositionRepositoryInterface;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    public function model()
    {
        return Position::class;
    }

    public function searchOpenPositions($per_page, $request)
    {
              return $positons = Position::
                                where(function ($query) use ($request){
                                    if ($request->has('address')) {
                                        $query->where('address', 'LIKE', "%{$request->address}%");
                                    }
                                    if ($request->has('salary')) {
                                        $query->where('salary', 'LIKE', "%{$request->salary}%");
                                    }
                                    if ($request->has('keyword')) {
                                        $query->orWhere('address', 'LIKE', "%{$request->keyword}%");
                                        $query->orWhere('salary', 'LIKE', "%{$request->keyword}%");
                                        $query->orWhere('description', 'LIKE', "%{$request->keyword}%");
                                        $query->orWhere('title', 'LIKE', "%{$request->keyword}%");
                                    }
                                })
                                ->whereHas('company', function ($query) use ($request){
                                    if ($request->has('company_name')) {
                                        $query->where('name', 'LIKE', "%{$request->company_name}%");
                                    }
                                })
                                ->where('status', '1')
                                ->paginate($per_page);
    }
}
