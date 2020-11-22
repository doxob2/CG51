<?php

namespace App\Http\Controllers;


use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Http\Request;

class MainController extends Controller

{
    public function main(){
        $context = [];
        $questions = Question::all();
        $context[] = count($questions);
        if (count($questions)>0){
            foreach ($questions as $question) {
                $temp[]=$question->Question;
            }
            $context[]=$temp;
        } else {
            $temp[]='Добавьте вопросы!';
            $context[]=$temp;
        }

        
        return view('main',compact('context'));
    }


    public function quiz(){
        return view('quiz');
    }


    public function create(){
        return view('create');
    }


    public function add_question_into_db(Request $request){

        $question = new Question();
        $question->question = $request->input('question');
        $question->save();
        $qw = $question->id;



        for ($i=1;$i<4;$i++){
            $answerOption = new Answer();
            $answerOption->Answer = $request->input('answers'.$i);
            $answerOption->isRight = False;
            $answerOption->questions_id = $qw;
            $answerOption->save();
        }


        $answer = new Answer();
        $answer->Answer = $request->input('answers4');
        $answer->isRight = True;
        $answer->questions_id = $qw;
        $answer->save();

        dd($request);
    }

    public function get_question_from_db(){
        $data = [];
        $question = Question::all();
        foreach ($question as $value) {
            $temp=[];
            $current = '';
            $temp[]= $value->Question;
            $answers = Answer::where('questions_id', '=', $value->id)->get();
            $options=[];
            //echo($answers);
            foreach ($answers as $answer) {
                $options[]= $answer->Answer;
                if ($answer->isRight) {
                    $current=$answer->Answer;
                }
            }
            $temp[]=$options;
            $temp[]=$current;
            $data[]=$temp;
        }
        $context = ['data'=> $data];
        return $context;
    }

    public function add_result_into_db(Request $request){
        $result = new Result();
        $result->name = $request->input('name');
        $result->point = $request->input('point');
        $result->save();
    }

    public function get_result(){
        $context=[];
        $results = Result::all();
        if (count($results)>0){
            foreach ($results->reverse() as $result) {
                $temp[]=[($result->name!='undefined' ? $result->name : 'anon' ),$result->point,$result->created_at];
            }
            $context[]=$temp;
            return view('result',compact('context'));
        } else {
            $temp=[0];
            $context[]='0';
            return view('result',compact('context'));
        }
        
    }

}
