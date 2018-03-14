<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class SurveyResults {
    public $id;
    public $userId;
    public $surveyId;
    public $answerId;
    public $ip_address;

    private $table = 'SurveyResults';


    public function createSurveyResult(){
        $data = [
            'userId'    => $this->userId,
            'surveyId'  => $this->surveyId,
            'answerId'  => $this->answerId,
            'ip_address'=> $this->ip_address,
        ];
        $res = DB::table($this->table)
        ->insert($data)
        ;

        return $res;
    }

    public function getStatistics() {

        $res = DB::table($this->table)
        ->where('surveyId', $this->surveyId)
        ->where('answerId', $this->answerId)
        ->get();

        return $res;
    }

    public function getAll() {
        $res = DB::table($this->table)
        ->where('surveyId', $this->surveyId)
        ->get();

        return $res;
    }

    public function canVote() {
        $res = DB::table($this->table)
        ->where('surveyId', $this->surveyId)
        ->where('userId', $this->userId)
        ->first();

        return $res === null?true :false;
    }


    public function deleteSurveyResult() {
        $res = DB::table($this->table)
        ->where('id', $this->id)
        ->delete()
        ;

        return $res;
    }


}
