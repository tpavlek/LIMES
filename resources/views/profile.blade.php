<?php /** @var \App\User $user */ ?>
@extends('layout')

@section('content')
    <div class="p-2 border-t border-l border-r mx-4 bg-white px-4 relative z-10 mt-2 rounded-t">
        <h2 class="text-grey-darkest">{{ $user->name }}</h2>
        Hi, {{$user->name}}! <br>
        You can edit your contact details below: <br> <br>
        <form action="{{ URL::route('save_profile') }}" enctype="multipart/form-data" method="post">
            @csrf

            @include('partials/formfield/text', [ 'name' => 'email', 'display_name'=> 'e-mail address', 'value' => $user->email ])
            @include('partials/formfield/text', [ 'name' => 'twitter', 'display_name'=> 'twitter handle', 'value' => $user->twitter ])
            @include('partials/formfield/text', [ 'name' => 'snapchat', 'display_name'=> 'snapchat', 'value' => $user->snapchat ])
            @include('partials/formfield/text', [ 'name' => 'facebook', 'value' => $user->facebook ])

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit"
                    class="bg-green-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4">
                <i class="fas fa-save"></i> Save </button>
        </form>
    </div>
    <div class="p-4 bg-yellow-lighter text-grey-darkest">
        <h3><span class="fas fa-link"></span> Your Connections</h3>
        <p class="py-2">
            The following people would like to connect with you! You can either accept these connections, or remove them.
        </p>
    </div>
    <div class="bg-white mx-4 border shadow rounded-b p-2">
        @foreach($user->incoming_connections as $connection)
            <div class="flex">
                <div class="inline-block flex flex-col justify-center">
                    <div class="w-12 h-12 bg-center bg-cover rounded-full border-green border-2" style='background-image: url("{{ $connection->getImage() }}")'></div>
                </div>
                <div class="inline-block flex-grow py-2">
                    <p class="p-2">
                        <span class="font-bold font-grey-darker">{{ $connection->name }}</span>
                    </p>
                    <ul>
                        @if ($connection->facebook)
                            <li><span class="font-bold">Facebook</span> {{ $connection->facebook }}</li>
                        @endif
                        @if ($connection->twitter)
                            <li><span class="font-bold">Twitter</span> {{ $connection->twitter }}</li>
                        @endif
                        @if ($connection->snapchat)
                            <li><span class="font-bold">Snapchat</span> {{ $connection->snapchat }}</li>
                        @endif
                        @if ($connection->email)
                            <li><span class="font-bold">Email</span> {{ $connection->email }}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="text-right p-2 border-t">
                <form class="inline" action="{{ URL::route('connection.remove', $connection->pivot->id) }}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}

                    <button type="submit" class="no-underline text-grey-darker px-2">
                        <span class="fas fa-times"></span>
                    </button>
                </form>

                @if (! $connection->pivot->accepted)
                    <form class="inline" action="{{ URL::route('connection.accept', $connection->pivot->id) }}" method="post">
                        @csrf
                        <button type="submit" class="no-underline text-grey-darker px-2 border-l">
                            <span class="fas fa-check"></span>
                        </button>
                    </form>
                @endif

            </div>
        @endforeach
    </div>
@stop
