@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        {{-- Show all errors --}}
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span><br />
        @endforeach

        {{-- Allow close alert message --}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
