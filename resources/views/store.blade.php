<x-app-layout>
    <div class="container mt-8">
        <div class="row">
            @foreach ($books as $book)
                @if($book->published_state == 0)
                    <div class="col m3">
                        <div class="card hoverable">
                            <div class="card-content">
                                <span class="card-title truncate">{{ $book->title }}</span>
                                <p class="truncate">{{ $book->first_name }} {{ $book->last_name }} </p>
                                <p class="grey-text">@if($book->quantity < 1) Out of stock @else In stock @endif</p>
                                @if (Route::has('login'))
                                    @auth
                                        <form action="{{ route('shopping_cart_modify') }}" method="POST">
                                            @csrf
                                            <input value="{{ $book->id }}" name="book_id" type="hidden">
                                            <input value="{{ Auth::user()->id }}" name="user_id" type="hidden">
                                            <button @if($book->quantity < 1) disabled @endif class="green mt-4 waves-effect waves-light btn-large" type="submit" name="action" value="add">
                                                <i class="material-icons left">add_shopping_cart</i>${{ number_format((float)$book->price, 2, '.', '') }}
                                            </button>
                                        </form>
                                @else
                                        <a class="waves-effect waves-light btn-large mt-8 disabled">
                                            <i class="material-icons left">add_shopping_cart</i>${{ number_format((float)$book->price, 2, '.', '') }}
                                        </a>
                                        <p class="grey-text">You have to be logged in to make purchases.</p>
                                    @endauth
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
