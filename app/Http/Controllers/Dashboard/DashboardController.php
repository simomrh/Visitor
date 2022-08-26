<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{

    public function Redirect(){
        if(Auth::user()->RoleUSR == 'admin'){
            return view('admin.dashboard');
          }else{
              return view('users.dashboard');
          }
    }

}
