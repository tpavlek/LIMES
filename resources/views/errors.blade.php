@if ($errors->any())
    <div class="mx-4 mb-4 bg-red-lightest border-l-4 border-red text-red-dark p-4" role="alert">
        <p class="font-bold">Errors Occurred</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif
