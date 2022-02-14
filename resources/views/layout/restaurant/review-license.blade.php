@extends('layout.mainlayout')

@section('content')

    <embed
        src="{{ route('make-pdf', [$id]) }}"
        style="width:100%; height:800px;"
        frameborder="0"
    >

@endsection
