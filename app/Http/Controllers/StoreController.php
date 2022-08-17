<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function getBooks()
    {
        $params['books'] = Book::all();
        return view('store', $params);
    }
}
