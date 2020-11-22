@extends('layouts/mainpage')


@section('title_block')
Results
@endsection


@section('content')
    @if ($context[0]=='0')
        <h1> Никто еще не проходил </h1>
    @else
        @foreach($context[0] as $data)
            <h1> {{$data[0]}} -- {{$data[1]}} -- {{$data[2]}} </h1>
        @endforeach
    @endif

@endsection


@section('scripts')
    <script>
        sidebar_elem = document.getElementById(4)
        sidebar_elem.setAttribute('class', 'active')
    </script>
@endsection