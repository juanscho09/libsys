<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Exceptions\NotFoundException;

class UserController extends BaseController
{
    /**
     * The repository instance.
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\UserRepository  $userRepository
     * @return void
     */
    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        //$this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$users = $this->userRepository->paginate($request->perPage);
        //return $this->successPaginateResponse($users);
        $users = $this->userRepository->list($request->all());
        return $this->successPaginateResponse($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try{
            $user_saved = $this->userRepository->store($request->all());
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al crear el usuario.".$ex->getMessage(), 500);
        }

        return $this->successResponse($user_saved, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try{
            $user_found = $this->userRepository->find($user->id);
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al buscar el libro: ".$ex->getMessage(), 500);
        }

        return $this->successResponse($user_found);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try{
            $user_updated = $this->userRepository->update($request->all(), $user->id);
        }catch(NotFoundException $ex){
            return $this->errorResponse($ex->getMessage(), $ex->getCode());
        }catch(\Exception $ex){
            return $this->errorResponse("Error al editar el usuario: ".$ex->getMessage(), 500);
        }

        return $this->successResponse($user_updated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = $this->userRepository->delete($user);
        return $this->successResponse($user, 204);
    }
}
