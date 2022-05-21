<?php 

namespace App\Http\APIV1\Modules\Autos\Controllers;

use App\Domain\Autos\Actions\CreateAutoAction;
use App\Domain\Autos\Actions\DeleteAutoAction;
use App\Domain\Autos\Actions\GetAllAutoAction;
use App\Domain\Autos\Actions\GetAutoAction;
use App\Domain\Autos\Actions\PatchAutoAction;
use App\Domain\Autos\Actions\ReplaceAutoAction;

use App\Http\APIV1\Modules\Autos\Requests\CreateAutoRequest;
use App\Http\APIV1\Modules\Autos\Requests\PatchAutoRequest;
use App\Http\APIV1\Modules\Autos\Requests\ReplaceAutoRequest;

use App\Http\APIV1\Modules\Autos\Resources\AutoResource;

class AutoController
{
    public function getList(GetAllAutoAction $action)
    {
        $autos = $action->execute();
        return response()->json(["data" => $autos]);
    }

    public function get(GetAutoAction $action, int $clientId)
    {
        return new AutoResource($action->execute($clientId));
    }

    public function post(CreateAutoAction $action, CreateAutoRequest $request)
    {
        return new AutoResource($action->execute($request->validated()));
    }

    public function delete(DeleteAutoAction $action, int $clientId)
    {
        return new AutoResource($action->execute($clientId));
    }

    public function patch(PatchAutoAction $action, PatchAutoRequest $request, int $clientId)
    {
        return new AutoResource($action->execute($clientId, $request->validated()));
    }

    public function put(ReplaceAutoAction $action, ReplaceAutoRequest $request, int $clientId)
    {
        return new AutoResource($action->execute($clientId, $request->validated()));
    }
}