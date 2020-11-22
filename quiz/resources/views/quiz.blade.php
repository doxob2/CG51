@extends ('layouts/mainpage')



@section('title_block')
QUIZ SYSTEM
@endsection




@section('quiz')
<input type="hidden" id="token" value="{{ csrf_token() }}" name="token">
<div class="grid">
    <div class='quiz' id="quiz">
        <div>
            <input type="text" name='name' id='name' placeholder='Name'>
        </div>
        <hr style="margin-bottom: 20px">

        <p id="question"></p>

        <div class="buttons">
            <button class='quiz-btn' id="btn0"><span id="choice0"></span></button>
            <button class='quiz-btn' id="btn1"><span id="choice1"></span></button>
            <button class='quiz-btn' id="btn2"><span id="choice2"></span></button>
            <button class='quiz-btn' id="btn3"><span id="choice3"></span></button>
        </div>

        <hr style="margin-top: 50px">
        <footer>
            <p id="progress">Question x of y</p>
        </footer>
    </div>
</div>
@endsection


@section('scripts')
    <script>
        function get_Name(){
            name = document.getElementById("name").value;
            if (name!=''){
                return document.getElementById("name").value;
            } else {
                alert('Вы забыли добавить имя в форму\nПройдите заново');
            }
        }


        qw = document.getElementById(2)
        qw.setAttribute('class', 'active')
        var XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest;

        function set_data(){
            var xhr = new XHR();
            var token = document.head.querySelector("[name=csrf-token]").content;
            xhr.open('POST', '/add_result?_token='+token, false);
            xhr.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content );
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var param = 'name='+get_Name()+'&point='+point;
            //xhr.setRequestHeader('Cookie', _token);
            //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                console.log( this.responseText );
            }

            xhr.onerror = function() {
                alert( 'Ошибка ' + this.status );
            }
            xhr.send('_token='+token+'&'+param);
        }

        function shuffle(a) {
            var j, x, i;
            for (i = a.length - 1; i > 0; i--) {
                j = Math.floor(Math.random() * (i + 1));
                x = a[i];
                a[i] = a[j];
                a[j] = x;
                }
            return a;
        }


        function getQuestions() {
            var xhr = new XHR();
            xhr.open('GET', '/question', false);
            xhr.send()
            var data = JSON.parse(xhr.response);
            console.log(data['data'])

            factor(data);
        }




        function factor(object) {
            Object.values(object).forEach(val =>{
                let value_arr = val;
                console.log(asd);
                for (var key in value_arr) {
                    for (var asd in key) {
                        //console.log(value_arr[asd]);
                        questions.push(new Question(value_arr[key][0],shuffle(value_arr[key][1]),value_arr[key][2]));
                    }
                }
            });
        }


        var point = 0;


        function Quiz(questions) {
            this.score = 0;
            this.questions = questions;
            this.questionIndex = 0;
        }


        Quiz.prototype.getQuestionIndex = function() {
            return this.questions[this.questionIndex];
        }

        Quiz.prototype.guess = function(answer) {
            if(this.getQuestionIndex().isCorrectAnswer(answer)) {
                this.score++;
                point++;
            }
            this.questionIndex++;
        }


        Quiz.prototype.isEnded = function() {
            return this.questionIndex === this.questions.length;
        }


        function Question(text, choices, answer) {
            this.text = text;
            this.choices = choices;
            this.answer = answer;
        }

        Question.prototype.isCorrectAnswer = function(choice) {
            return this.answer === choice;
        }

        function populate() {
            if(quiz.isEnded()) {
                set_data()
                showScores();
            } else {
                // show question
                var element = document.getElementById("question");
                element.innerHTML = quiz.getQuestionIndex().text;

                // show options
                var choices = quiz.getQuestionIndex().choices;
                for(var i = 0; i < choices.length; i++) {
                    var element = document.getElementById("choice" + i);
                    element.innerHTML = choices[i];
                    guess("btn" + i, choices[i]);
                }
                showProgress();
            }
        };

        function guess(id, guess) {
            var button = document.getElementById(id);
            button.onclick = function() {
                quiz.guess(guess);
                populate();
            }
        };

        function showProgress() {
            var currentQuestionNumber = quiz.questionIndex + 1;
            var element = document.getElementById("progress");
            element.innerHTML = "Question " + currentQuestionNumber + " of " + quiz.questions.length;
        };

        function showScores() {
            var gameOverHTML = "<h1>Result</h1>";
            gameOverHTML += "<h2 id='score'> Your scores: " + quiz.score + "</h2>";
            var element = document.getElementById("quiz");
            element.innerHTML = gameOverHTML;
        };


        // create questions here
        var questions = [];

        // create quiz
        var quiz = new Quiz(questions);

        getQuestions();
        // display quiz
        populate();
	</script>
@endsection