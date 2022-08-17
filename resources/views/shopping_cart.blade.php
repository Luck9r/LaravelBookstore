<x-app-layout>
    <div class="container mt-8">
        <table class="highlight">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th class="right">Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (Route::has('login'))
                @auth
                    @foreach($shopping_cart_items as $shopping_cart_item)
                        @if($shopping_cart_item->user_id == Auth::user()->id)
                            <form action="{{ route('shopping_cart_modify') }}" method="POST">
                                @csrf
                                <tr>
                                    <input value="{{ $shopping_cart_item->user_id }}" name="user_id" type="hidden">
                                    <input value="{{ $shopping_cart_item->book_id }}" name="book_id" type="hidden">
                                    <td>{{ $shopping_cart_item->book->title }}</td>
                                    <td>{{ $shopping_cart_item->book->first_name }} {{ $shopping_cart_item->book->last_name }}</td>
                                    <td class="right">${{ $shopping_cart_item->book->price }} x {{ $shopping_cart_item->quantity }}</td>
                                    <td><button class="waves-effect waves-light btn-small right" type="submit" name="action" value="remove">Remove</button></td>
                                </tr>
                            </form>
                        @endif
                   @endforeach
                @endauth
            @endif
                <tr>
                    <td></td>
                    <td></td>
                    <td class="right">
                        @if (Route::has('login'))
                            @auth
                                @foreach($shopping_cart_totals as $total)
                                    @if($total->user_id == Auth::user()->id)
                                        ${{ $total->s}} Total
                                    @endif
                                @endforeach
                            @endauth
                        @endif
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
