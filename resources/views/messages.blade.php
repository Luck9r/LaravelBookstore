@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="row">
            <div class="col s12 m12">
                <div class="card-panel red">
                    <span class="white-text">{{ $error }}</span>
                </div>
            </div>
        </div>
        @pushOnce('scripts')
            <script type="text/javascript">
                $(document).load(function() {
                    M.toast({html: 'I am a toast!'});
                });
            </script>
        @endPushOnce
    @endforeach
@endif

@if(session('success'))
    <div class="row">
        <div class="col s12 m12">
            <div class="card-panel green">
                <span class="white-text">{{ session('success') }}</span>
            </div>
        </div>
    </div>
@endif
