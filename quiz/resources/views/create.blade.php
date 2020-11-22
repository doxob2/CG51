@extends('layouts/mainpage')


@section('title_block')
Add question
@endsection



@section('content')
    <div class='form_grid'>
        <form action='/add' method="post">
            @csrf
            <div class='question_area'>
                <textarea name='question' placeholder="Вопрос"></textarea>
            </div>
            <div class='answer_div'>
                <input type="text" name="answers1" placeholder= 'Вариант ответа'>
                <input type="text" name="answers2" placeholder= 'Вариант ответа'>
                <input type="text" name="answers3" placeholder= 'Вариант ответа'>
                <input type="text" name="answers4" placeholder='Правильный ответ'>
            </div>
            <input class='btn' type="submit" value='Add'>
        </form>
    </div>
@endsection


@section('scripts')
    <script>
        sidebar_elem = document.getElementById(3)
        sidebar_elem.setAttribute('class', 'active')
    </script>
@endsection