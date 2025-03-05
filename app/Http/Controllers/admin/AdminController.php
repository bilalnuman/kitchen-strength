<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users=User::orderBy("created_at","desc")->paginate(10);
        // dd($users);
        return view('admin.dashboard',compact('users'));
    }

    public function settings()
    {
        return view('admin.settings');
    }
    public function users()
    {
        return view('admin.users');
    }
    public function add()
    {
        return view('admin.add-user');
    }
}
