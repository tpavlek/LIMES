@extends('layout')

@section('content')
    <div class="p-4 mx-4 border-b border-l border-r shadow bg-white">
        <h1>Import Open Data</h1>

        <opendata-form action-url="{{ URL::route('admin.opendata_fetch') }}"></opendata-form>
    </div>
@stop
