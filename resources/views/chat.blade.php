@extends('layouts.app')

@section('content')
<b-container fluid style="height: calc(100vh - 56px)">
    <router-view :user="{{ auth()->user() }}"/>
</b-container>

  <!-- " --> 

@endsection
