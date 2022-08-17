<?php

namespace Tests\Unit;

use App\Models\ShoppingCartItem;
//use PHPUnit\Framework\TestCase;
use App\Models\User;
use Tests\TestCase;

class ShoppingCartItemTest extends TestCase
{
    public function test_shopping_cart_item_can_be_added()
    {
        $item = ShoppingCartItem::factory()->create();

        $this->assertDatabaseHas('shopping_cart_items', [
            'id' => $item->id,
        ]);
    }

    public function test_shopping_cart_item_can_be_removed()
    {
        $item = ShoppingCartItem::factory()->create();
        $item->delete();

        $this->assertDatabaseMissing('shopping_cart_items', [
            'id' => $item->id,
        ]);
    }

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
}
