@extends('layout')

@section('title')
    Create a new post for {{$location}}!
@endsection

@section('content')

    <!-- please make this look nicer -->
    <div class="container-fluid">
        <form action="../{{$location}}" method="POST">
            {{csrf_field()}}

                <div class = "row p-2 text-center">

                    <div class="col-md-4" style="margin: 0 auto">
                        <input type="text" title = "title" name="title" placeholder="Title your post."> <br>
                    </div>

                </div>

                <div class = "row p-2 text-center" >
                    <textarea title="body" name="body" rows="20" placeholder="Write something friendly." required></textarea> <br>
                </div>

            <div class = 'row p-2 text-center'>
                <input type="submit" value="Post!">
            </div>

        </form>

        <!-- please make this look nicer -->
        @if($errors -> any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
@endsection