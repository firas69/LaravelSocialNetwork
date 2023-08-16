@extends('layout')

@section('content')
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <x-main_post :post="$post" />
    </main>
@endsection
