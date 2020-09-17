<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('inventory.admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getForShow($id);

        return view('inventory.admin.user.show', compact('user'));
    }
}
