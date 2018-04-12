@extends('layout')

@section('title')
    Create a new post for {{$location->name}}!
@stop

@section('content')

    <!-- please make this look nicer -->
    <div class="container-fluid">
        <form action={{url()->route('location', ['id'=> $location->id])}} method="POST" enctype="multipart/form-data">
            {{csrf_field()}}


                <div class = "row p-2 text-center" >
                    <textarea title="body" name="body" rows="20" placeholder="Write something friendly." required></textarea> <br>
                </div>

                <div class = "row p-2 text-center">
                    <input type="file" name="image" accept="image/*">
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
@stop
