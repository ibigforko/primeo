<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\StoreRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\JsonResponse;
use App\Models\User\User;

class UsersController extends Controller
{
    public function index(): JsonResponse
    {
        return responseWithPayload(QueryBuilder::for(User::class)
                                            ->allowedFilters(['first_name', 'last_name', 'email'])
                                            ->jsonPaginate());
    }

    public function show(User $user): JsonResponse
    {
        return responseWithPayload($user);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return responseWithPayload($request->insert(), 201);
    }

    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        return responseWithPayload($request->actualise());
    }

    public function destroy(String $users): JsonResponse
    {
        $userIds = explode(',', $users);
        $foundUsersCount = User::whereIn('id', $userIds)->count();

        if($foundUsersCount === count($userIds)):
            User::destroy($userIds);

            return responseWithLang('main.users.destroy.success', 200);
        endif;

        return responseWithLang('main.users.destroy.failed', 400);
    }
}