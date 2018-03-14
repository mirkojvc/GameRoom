<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Survey {
    public $id;
    public $name;

    private $table = 'Survey';


    public function createSurvey(){
        $data = [
            'name' => $this->name,
        ];
        $survey = DB::table($this->table)
        ->insert($data)
        ;

        return $survey;
    }

    public function getAll() {
        $surveys = DB::table($this->table)
        ->get();

        return $surveys;
    }

    public function getSurvey() {
        $surveys = DB::table($this->table)
        ->where('id', $this->id)
        ->first();

        return $surveys;
    }

    public function getNotDone($userId) {

        //$survey_id =  DB::select(DB::raw('SELECT s.id FROM Survey s  LEFT  JOIN SurveyResults sr on s.id = sr.surveyId
        //WHERE sr.userId IS  NULL OR sr.userId NOT IN ('.$userId.') LIMIT 1'));
        $user_surveys = DB::table('SurveyResults')
        ->select('surveyId')
        ->where('userId', $userId)
        ->get()
        ;

        $test = json_decode(json_encode($user_surveys), True);

        $survey = DB::table('Survey')
        ->whereNotIn('id', $test)
        ->first()
        ;

        return $survey;
    }

    public function updateSurvey() {
        $data = [
            'name' => $this->name,
        ];
        $survey = DB::table($this->table)
            ->where('id', $this->id)
            ->update($data)
            ;
        return $survey;
    }

    public function deleteSurvey() {
        $survey = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;

        return $survey;
    }


}
