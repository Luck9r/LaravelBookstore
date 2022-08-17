<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\User;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    public function test_add_book()
    {
        $this->post('/dashboard/books/add', [
            'title' => 'testytitle',
            'price' => 24,
            'quantity' => 8,
            'published_state' => 1,
            'first_name' => 'fakename',
            'last_name' => 'fakesurname',
            'action' => 'add'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'testytitle',
        ]);
    }

    public function test_modify_book()
    {
        $book = Book::factory()->create();

        $this->post('/dashboard/books/modify', [
            'id' => $book->id,
            'title' => 'testytitle',
            'price' => $book->price,
            'quantity' => $book->quantity,
            'published_state' => $book->published_state,
            'first_name' => $book->first_name,
            'last_name' => $book->last_name,
            'action' => 'update'
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'testytitle',
        ]);
    }

    public function test_remove_book()
    {
        $book = Book::factory()->create();

        $this->post('/dashboard/books/modify', [
            'id' => $book->id,
            'title' => $book->title,
            'price' => $book->price,
            'quantity' => $book->quantity,
            'published_state' => $book->published_state,
            'first_name' => $book->first_name,
            'last_name' => $book->last_name,
            'action' => 'remove'
        ]);

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

}
