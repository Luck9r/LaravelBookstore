<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Book;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ShoppingCartControllerTest extends TestCase
{
    public function test_get_shopping_cart_data()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/shopping_cart');

        $response->assertStatus(200);
    }

    public function test_add_item_to_shopping_cart()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->post('/shopping_cart/modify', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'action' => 'add'
        ]);

        $this->assertDatabaseHas('shopping_cart_items', [
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_remove_item_from_shopping_cart()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->post('/shopping_cart/modify', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'action' => 'add'
        ]);

        $this->post('/shopping_cart/modify', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'action' => 'remove'
        ]);

        $this->assertDatabaseMissing('shopping_cart_items', [
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_add_item_out_of_stock_to_shopping_cart()
    {
        $user = User::factory()->create();
        $book = Book::factory()->make([
            'quantity' => 0,
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->post('/shopping_cart/modify', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'action' => 'add'
        ]);

        $this->assertDatabaseMissing('shopping_cart_items', [
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);
    }
}
