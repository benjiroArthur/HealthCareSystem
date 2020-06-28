<?php


namespace App\Traits;


use Carbon\Carbon;

trait FromNow
{
    public function getFromNowAttribute(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getNiceDateAttribute(){
        return Carbon::parse($this->date)->isoFormat('Do MMMM, YYYY');
    }

    public function getAwesomeDateAttribute(){
        if ($this->created_at->isToday()){
            return $this->created_at->isoFormat('hh:mm');
//            06:39
        }
        elseif ($this->created_at->isCurrentYear()){
            return $this->created_at->isoFormat('Do MMMM, hh:mm');
//            "16th February, 06:39"
        }else{
            return $this->created_at->isoFormat('Do MMMM, YYYY, hh:mm');
//            "16th February, 2020, 06:39"
        }

    }
}
