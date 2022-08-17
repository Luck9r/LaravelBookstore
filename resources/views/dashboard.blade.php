<x-app-layout>
    @if (Route::has('login'))
        @auth
            @if(Auth::user()->role == 1)
                <div class="container mt-8">
                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Books</h4></li>
                        @foreach ($books as $book)
                            <li class="collection-item">
                                <div class="mt-8"></div>
                                <form class="col s12" action="{{ route('books_modify') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input value="{{ $book->id }}" name="id" class="hide">
                                        <div class="input-field col s2">
                                            <input value="{{ $book->title }}" name="title" type="text">
                                            <label for="title">Book Title</label>
                                        </div>
                                        <div class="input-field col s2">
                                            <input value="{{ $book->first_name }}" name="first_name" type="text">
                                            <label for="first_name">First Name</label>
                                        </div>
                                        <div class="input-field col s2">
                                            <input value="{{ $book->last_name }}" name="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s1">
                                            <input value="{{ number_format((float)$book->price, 2, '.', '') }}"
                                                   name="price" type="text">
                                            <label for="price">Price($)</label>
                                        </div>
                                        <div class="switch input-field col s1">
                                            <label>
                                                P
                                                <input @checked($book->published_state == 0) type="checkbox"
                                                       name="published_state">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                        <div class="input-field col s1">
                                            <input value="{{ $book->quantity }}" name="quantity" type="text">
                                            <label for="quantity">Quantity</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <button class="red darken-2 waves-effect waves-light btn-small mt-1 right"
                                                    type="submit" name="action" value="remove">Remove
                                            </button>
                                            <button
                                                class="amber lighten-1 waves-effect waves-light btn-small mt-1 mr-1 right"
                                                type="submit" name="action" value="update">Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        @endforeach
                        <li class="collection-item">
                            <div class="mt-8"></div>
                            <form class="col s12" action="{{ route('books_add') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input value="" name="id" class="hide">
                                    <div class="input-field col s2">
                                        <input value="" name="title" type="text">
                                        <label for="title">Book Title</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input value="" name="first_name" type="text">
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="input-field col s2">
                                        <input value="" name="last_name" type="text">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                    <div class="input-field col s1">
                                        <input value="" name="price" type="text">
                                        <label for="price">Price($)</label>
                                    </div>
                                    <div class="switch input-field col s1">
                                        <label>
                                            P
                                            <input checked="checked" type="checkbox" name="published_state">
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                    <div class="input-field col s1">
                                        <input value="" name="quantity" type="text">
                                        <label for="quantity">Quantity</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <button class="amber lighten-1 waves-effect waves-light btn-small mt-1 right"
                                                type="submit" name="action" value="add">Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Users</h4></li>
                        <li class="collection-item">
                            <table class="highlight">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @switch($user->role)
                                                @case(0)
                                                    User
                                                    @break
                                                @case(1)
                                                    Admin
                                                    @break
                                                @case(2)
                                                    Blocked
                                                    @break
                                                @default
                                                    Error
                                            @endswitch
                                        </td>
                                        <td class="right">
                                            <form action="{{ route('users_modify') }}" method="POST">
                                                @csrf
                                                <input value="{{ $user->id }}" name="id" type="hidden">
                                                @if($user->role != 1)
                                                    <button class="red darken-1 waves-effect waves-light btn-small"
                                                            type="submit" name="action" value="remove">Remove
                                                    </button>
                                                    @if($user->role == 0)
                                                        <button class="blue darken-2 waves-effect waves-light btn-small"
                                                                type="submit" name="action" value="block">Block
                                                        </button>
                                                    @else
                                                        <button class="light-blue waves-effect waves-light btn-small"
                                                                type="submit" name="action" value="unblock">Unblock
                                                        </button>
                                                    @endif
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>
            @else
                <container class="valign-wrapper">
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="card-panel red">
                                <span class="white-text">You are not authorised to view this page!</span>
                            </div>
                        </div>
                    </div>
                </container>
            @endif
        @endauth
    @endif
</x-app-layout>

