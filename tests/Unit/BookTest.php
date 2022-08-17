<?php

namespace Tests\Unit;

use App\Models\Book;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_book_can_be_added()
    {
        $book = Book::factory()->create();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);
    }
    public function test_book_can_be_removed()
    {
        $book = Book::factory()->create();
        $book->delete();

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
    public function test_get_books_data()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
