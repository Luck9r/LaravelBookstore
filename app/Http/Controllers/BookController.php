<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\DB;



class BookController extends Controller
{
    public function modify(BookRequest $request)
    {
        $book = Book::find($request->input('id'));
        if($request->input('action') == "update")
        {
            $this->update($book, $request);
        } else if($request->input('action') == "remove")
        {

            $this_book_in_shopping_carts = DB::table('shopping_cart_items')->where('book_id', '=', $request->input('id'));
            $this_book_in_shopping_carts->delete();
            $book->delete();
        }
        return redirect()->route('dashboard')->with('success', 'A book was updated.');
    }

    public function add(BookRequest $request)
    {
        $book = new Book();
        $this->update($book, $request);
        return redirect()->route('dashboard')->with('success', 'A book was added.');
    }

    public function update(Book $book, BookRequest $request)
    {

        $book->title = $request->input('title');
        $book->price = $request->input('price');
        $book->quantity = $request->input('quantity');
        $book->published_state = $this->retrieve_state($request->input('published_state'));
        $book->first_name = $request->input('first_name');
        $book->last_name = $request->input('last_name');
        $book->save();
    }

    public function retrieve_state($state)
    {
        switch($state)
        {
            case 'on':
                return 0;
            default:
                return 1;
        }
    }
}
