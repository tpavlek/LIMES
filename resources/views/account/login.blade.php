@extends('layout')

@section('content')

    @include('errors')

    <div class="p-4 mx-4 border-b border-l border-r shadow bg-white">
        <h2 class="mb-4">Login</h2>
        <form action="{{ URL::route('login') }}" method="post">
            {{ csrf_field() }}
            @include('partials/formfield/text', [ 'name' => 'email', 'placeholder' => "email@address.com" ])

            <label for="password" class="tracking-wide font-bold text-sm text-grey-dark">PASSWORD</label>
            <input type="password" name="password" id="password" placeholder="Keep it secret, keep it safe" class="my-2 bg-grey-light p-2 rounded w-full" />

            <div class="text-center">
                <button type="submit" class="bg-green-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center font-bold text-sm tracking-wide text-grey-dark mt-4">
            OR
        </div>
        <hr class="border-b"/>

        <div class="text-center">
            <a href="{{ URL::route('fb-redirect') }}" class="inline-block no-underline bg-blue-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4">
                <i class="fab fa-facebook-square text-xl"></i> &nbsp; Login with Facebook
            </a>
        </div>
    </div>

    <div class="p-4 m-4 border-b border-l border-r shadow bg-white">
        <h2 class="mb-4">Register</h2>
        <form action="{{ URL::route('register') }}" method="post">
            {{ csrf_field() }}
            <label for="email" class="tracking-wide font-bold text-sm text-grey-dark">EMAIL</label>
            <input type="text" name="email" id="email" placeholder="email@address.com" class="my-2 bg-grey-light p-2 rounded w-full" value="{{ old("email") }}"/>

            <label for="name" class="tracking-wide font-bold text-sm text-grey-dark">DISPLAY NAME</label>
            <input type="text" name="name" id="name" placeholder="Display Name" class="my-2 bg-grey-light p-2 rounded w-full" value="{{ old("name") }}"/>

            <label for="password" class="tracking-wide font-bold text-sm text-grey-dark">PASSWORD</label>
            <input type="password" name="password" id="password" placeholder="Keep it secret, keep it safe" class="my-2 bg-grey-light p-2 rounded w-full" />

            <label for="password_confirmation" class="tracking-wide font-bold text-sm text-grey-dark">CONFIRM</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Doubly secret, double the safety" class="my-2 bg-grey-light p-2 rounded w-full" />

            <div class="text-center">
                <button type="submit" class="bg-green-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4">
                    Register
                </button>
            </div>
        </form>

        <div class="text-center font-bold text-sm tracking-wide text-grey-dark mt-4">
            OR
        </div>
        <hr class="border-b"/>

        <div class="text-center">
            <a href="{{ URL::route('fb-redirect') }}" class="inline-block no-underline bg-blue-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4">
                <i class="fab fa-facebook-square text-xl"></i> &nbsp; Register with Facebook
            </a>
        </div>
    </div>
@stop
