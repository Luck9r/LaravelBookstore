<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getData()
    {
        $params['users'] = User::all();
        $params['books'] = Book::all();
        return view('dashboard', $params);
    }
}
