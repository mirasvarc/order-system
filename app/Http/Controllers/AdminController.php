<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\String\b;

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


    public function setRole() {
        $user = $_POST['user'];
        $role = $_POST['role'];

        
        if($role_old = UserRole::where('user_id', $user)->where('role_id', $role)->first()) {
            $role_old->delete();
        } else {
            $role_new = new UserRole();
            $role_new->user_id = $user;
            $role_new->role_id = $role;
            $role_new->save();
        }

        return true;
        
    }

    public function showChangelog() {
        return view('admin.changelog');
    }

    public function login() {
        $password = $_POST['password'];

        if($password == '123fabicovic') {
            session(['admin' => true]);
            return true;
        } else {
            return false;
        }

    }

    public function logout() {
     
        session(['admin' => false]);
        return true;
    
    }
}
