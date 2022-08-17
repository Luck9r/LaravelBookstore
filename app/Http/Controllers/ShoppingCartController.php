<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingCartItemRequest;
use App\Models\Book;
use App\Models\ShoppingCartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function getShoppingCartItems()
    {
        $shopping_cart = ShoppingCartItem::getByUserId(Auth::user()->id);

        $shopping_cart_total = 0;
        foreach($shopping_cart as $item) {
            $shopping_cart_total += $item->book->price * $item->quantity;
        }

        $params['shopping_cart_items'] = $shopping_cart;
        $params['shopping_cart_total'] = $shopping_cart_total;
        return view('shopping_cart', $params);
    }

    public function modify(ShoppingCartItemRequest $request)
    {
        $stock = Book::find($request->input('book_id'));

        if($request->input('action') == "add") {
            if($stock->quantity > 0) {
                $item = ShoppingCartItem::firstOrNew([
                    'user_id' => $request->input('user_id'),
                    'book_id' => $request->input('book_id'),
                ]);
                $stock->quantity -= 1;
                $stock->save();
                $item->quantity += 1;
                $item->save();

                return redirect()->route('store')->with('success', $stock->title.' successfully added to cart!');
            } else {
                return redirect()->route('store')->with('error', 'This book is out of stock');
            }
        } else if($request->input('action') == "remove") {
            $item = ShoppingCartItem::firstOrNew([
                'user_id' => $request->input('user_id'),
                'book_id' => $request->input('book_id'),
            ]);
            $stock->quantity += $item->quantity;
            $stock->save();
            $item->delete();
        }

        return redirect()->route('shopping_cart')->with('success', 'Item removed.');
    }
}
