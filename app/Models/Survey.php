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
        $survey_id =  DB::select(DB::raw('SELECT s.id FROM Survey s  LEFT  JOIN SurveyResults sr on s.id = sr.surveyId
        WHERE sr.userId IS  NULL OR sr.userId NOT IN ('.$userId.') LIMIT 1'));
        $survey_id = $survey_id[0]->id;

        $survey = DB::table($this->table)
        ->where('id', $survey_id)
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
