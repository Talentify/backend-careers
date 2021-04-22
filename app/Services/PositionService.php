<?php


namespace App\Services;


use App\Repositories\Contracts\PositionRepositoryInterface;

class PositionService
{
    private $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function index(int $per_page)
    {
        return $this->positionRepository->orderBy('title', 'ASC')->paginate($per_page);
    }

    public function listOpenPositions(int $per_page)
    {
        return $this->positionRepository->orderBy('title', 'ASC')->findWhereNoGet('status', 1)->paginate($per_page);
    }

    public function searchOpenPositions(int $per_page, $request)
    {
        return $this->positionRepository->searchOpenPositions($per_page, $request);
    }

    public function show($id)
    {
        return $this->positionRepository->findWhereFirst("id", $id);
    }

    public function store($request)
    {
        $position = $this->positionRepository->store($request->all());

        if (!$position)
            return false;

        return true;
    }

    public function update($id, $request)
    {
        $result = $this->verifyId($id, $request);
        if($result === 'notFound')
            return 'notFound';

        if($result === 'notAuthorized')
            return 'notAuthorized';

        $data = $request->all();
        return $this->positionRepository->update($id, $data);
    }

    public function delete($id, $request)
    {
        $result = $this->verifyId($id, $request);
        if($result === 'notFound')
            return 'notFound';

        if($result === 'notAuthorized')
            return 'notAuthorized';

        return $this->positionRepository->delete($id);
    }

    public function verifyId($id, $request)
    {
        $position = $this->positionRepository->findById($id);

        if($position === null)
            return 'notFound';

        $recruiter_logged_id = $this->getIdFromToken($request);

        if ($recruiter_logged_id != $position->recruiter_id) {
            return 'notAuthorized';
        }
    }

    public function getIdFromToken($request)
    {
        //$arrHeader = getallheaders();
        //if ($arrHeader == []) {
            $token = substr($request->header('Authorization'), 7);
        //} else {
        //    $token = substr($arrHeader["Authorization"], 7);
        //}
        $tokenStruct = explode('.',$token);
        $payload = $tokenStruct[1];
        $payload = json_decode(base64_decode($payload),true);

        return $payload["id"];
    }
}
