<?php 

namespace App\Http\ApiV1\Modules\Clients\Controllers;

use App\Domain\Clients\Actions\CreateClientAction;
use App\Domain\Clients\Actions\DeleteClientAction;
use App\Domain\Clients\Actions\GetAllClientAction;
use App\Domain\Clients\Actions\GetClientAction;
use App\Domain\Clients\Actions\PatchClientAction;
use App\Domain\Clients\Actions\ReplaceClientAction;

use App\Http\ApiV1\Modules\Clients\Requests\CreateClientRequest;
use App\Http\ApiV1\Modules\Clients\Requests\PatchClientRequest;
use App\Http\ApiV1\Modules\Clients\Requests\ReplaceClientRequest;
use App\Http\ApiV1\Modules\Clients\Resources\ClientResource;

class ClientController
{
    public function getList(GetAllClientAction $action)
    {
        $clients = $action->execute();
        return response()->json($clients);
    }

    public function get(GetClientAction $action, int $clientId)
    {
        return new ClientResource($action->execute($clientId));
    }

    public function post(CreateClientAction $action, CreateClientRequest $request)
    {
        return new ClientResource($action->execute($request->validated()));
    }

    public function delete(DeleteClientAction $action, int $clientId)
    {
        return new ClientResource($action->execute($clientId));
    }

    public function patch(PatchClientAction $action, PatchClientRequest $request, int $clientId)
    {
        return new ClientResource($action->execute($clientId, $request->validated()));
    }

    public function put(ReplaceClientAction $action, ReplaceClientRequest $request, int $clientId)
    {
        return new ClientResource($action->execute($clientId, $request->validated()));
    }
}