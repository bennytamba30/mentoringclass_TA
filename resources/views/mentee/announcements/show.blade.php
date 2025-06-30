@extends('mentee.layout')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-semibold">{{ $announcement->title }}</h2>
    <p class="text-gray-700 mt-4 leading-relaxed">{{ $announcement->content }}</p>
</div>
@endsection
