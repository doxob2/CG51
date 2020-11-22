@extends('layouts/mainpage')


@section('title_block')
Main Page
@endsection


@section('content')
    <h2>Всего вопросов в базе: {{ $context[0] }}</h2>

    <ul>
        @foreach($context[1] as $question)
        <li>{{$question}} </li>
        @endforeach
    </ul>

@endsection


@section('scripts')
    <script>
        sidebar_elem = document.getElementById(1)
        sidebar_elem.setAttribute('class', 'active')
    </script>
@endsection