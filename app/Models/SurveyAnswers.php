<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class SurveyAnswers {
    public $id;
    public $answer_text;
    public $surveyId;

    private $table = 'SurveyAnswers';


    public function createSurveyAnswer(){
        $data = [
            'answer_text' => $this->answer_text,
            'surveyId'    => $this->surveyId,
        ];
        $answer = DB::table($this->table)
        ->insert($data)
        ;

        return $answer;
    }

    public function getAll() {
        $surveys = DB::table($this->table)
        ->where('surveyId', $this->surveyId)
        ->get();
        return $surveys;
    }

    public function getSurveyAnswer() {
        $surveys = DB::table($this->table)
        ->where('id', $this->id)
        ->first();
        return $surveys;
    }

    public function updateSurveyAnswer() {
        $data = [
            'answer_text' => $this->answer_text,
        ];
        $survey = DB::table($this->table)
            ->where('id', $this->id)
            ->update($data)
            ;
        return $survey;
    }

    public function deleteSurveyAnswer() {
        $survey = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;

        return $survey;
    }


}
