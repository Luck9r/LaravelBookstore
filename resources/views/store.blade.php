<x-app-layout>
    <div class="container mt-8">

        {{--@foreach ($books as $book)
            <p>This is book {{ $book->id }}</p>
        @endforeach--}}
        <div class="row">
            <div class="col m3">

                <div class="card hoverable">
                    <div class="card-content">
                        <span class="card-title">1984</span>
                        <p>George Orwell</p>
                        <a class="waves-effect waves-light btn-large mt-8" onclick="notify();">
                            <i class="material-icons left">add_shopping_cart</i>$7.00
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        function notify() {

            M.toast({html: ''});

        }

    </script>
</x-app-layout>
