<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.index');
    }


    public function showUsersList() {
        $users = User::get();
       
        return view('admin.users')->with([
            'users' => $users
        ]);
    }

}
