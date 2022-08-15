<x-app-layout>

        @if (Route::has('login'))
            @auth
                @if(Auth::user()->role == 1)
                    <div class="container mt-8">
                        <ul class="collection with-header">
                            <li class="collection-header"><h4>Books</h4></li>
                            <li class="collection-item">
                                <table class="highlight">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Price</th>
                                        <th>Published state</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)

                                        <tr class="">
                                            {{--Save book id to the update / remove buttons--}}
                                            <td>
                                                <div class="input-field inline">
                                                    <input placeholder="{{ $user->name }}" id="title" type="text">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field">
                                                    <input placeholder="{{ $user->name }}" id="first_name" type="text">
                                                    <label for="first_name">First Name</label>
                                                </div>
                                                <div class="input-field">
                                                    <input placeholder="{{ $user->name }}" id="last_name" type="text">
                                                    <label for="last_name">Last Name</label>
                                                </div>
                                            </td>
                                            <td>
                                                $
                                                <div class="input-field inline">
                                                    <input placeholder="{{ $user->id }}" id="last_name" type="text">
                                                </div>
                                            </td>
                                            <td>
                                                @switch($user->role)
                                                    @case(0)
                                                        <p>
                                                            <label>
                                                                <input name="published-{{ $user->id }}" type="radio" />
                                                                <span>Published</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="published-{{ $user->id }}" type="radio" checked/>
                                                                <span>Not Published</span>
                                                            </label>
                                                        </p>
                                                        @break
                                                    @case(1)
                                                        <p>
                                                            <label>
                                                                <input name="published-{{ $user->id }}" type="radio"  checked/>
                                                                <span>Published</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="published-{{ $user->id }}" type="radio" />
                                                                <span>Not Published</span>
                                                            </label>
                                                        </p>
                                                        @break
                                                    @default
                                                        Error
                                                @endswitch
                                            </td>
                                            <td>
                                                {{ $user->id }}
                                            </td>
                                            <td>
                                                <div style="padding-top: 12%">
                                                    <a class="waves-effect waves-light btn">Update</a>
                                                    <a class="waves-effect waves-light btn">Remove</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
                                                @if($user->role != 1)
                                                    <a class="waves-effect waves-light btn">Remove</a>
                                                    @if($user->role == 0)
                                                        <a class="waves-effect waves-light btn">Block</a>
                                                    @else
                                                        <a class="waves-effect waves-light btn">Unblock</a>
                                                    @endif
                                                @endif
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
                                <div class="card-panel teal">
                                    <span class="white-text">You are not authorised to view this page!</span>
                                </div>
                            </div>
                        </div>
                    </container>
                @endif
            @endauth
        @endif





</x-app-layout>

