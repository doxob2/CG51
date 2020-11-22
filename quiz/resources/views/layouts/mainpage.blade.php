<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title_block')</title>
    <style>
      body {
        font-family: "Lato", sans-serif;
      }
      .content {
        position: relative;
      }
      .form_grid {
        position: relative;
        top: 45%;
        left: 45%;
        transform: translate(-50%, -50%);
        width: 600px;
      }
      .quiz {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        
      }
      .question_area {
        width: 100%;
        padding: 0 0 20px 0;
      }
      textarea {
        width: 100%;
        height: 200px;
        font-size: 25px;
        resize: none;
      }
      input {
        width: 95%;
        font-size: 20px;
      }
      .btn {
        width: 100%;
      }
      .quiz-btn {
        font-size: 20px;
      }
      .answer_div {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 10px;
        grid-row-gap: 1em;
        padding: 0 0 20px 0;
      }
      .buttons {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-row-gap: 20px;
        grid-column-gap: 20px;
      }
      body {
        margin: 0;
        font-family: "Lato", sans-serif;
      }

      .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
        position: fixed;
        height: 100%;
        overflow: auto;
      }

      .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
      }
      
      .sidebar a.active {
        background-color: #4CAF50;
        color: white;
      }

      .sidebar a:hover:not(.active) {
        background-color: #555;
        color: white;
      }

      div.content {
        margin-left: 200px;
        padding: 1px 16px;
        height: 1000px;
      }

      @media screen and (max-width: 700px) {
        .sidebar {
          width: 100%;
          height: auto;
          position: relative;
        }
        .sidebar a {float: left;}
        div.content {margin-left: 0;}
      }

      @media screen and (max-width: 400px) {
        .sidebar a {
          text-align: center;
          float: none;
        }
      }
    </style>
</head>
<body>
    <div class="sidebar">
      <a id='1' href="/">Home</a>
      <a id='2' href="/quiz">Quiz</a>
      <a id='3' href="/create">Add question</a>
      <a id='4' href="/result">Result</a>
    </div>
    <div class="content">

      @yield ('content')


      @yield ('quiz')


      @yield ('scripts')


    </div>






</body>
</html>