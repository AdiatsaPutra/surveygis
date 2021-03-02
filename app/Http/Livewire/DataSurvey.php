<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Livewire\Component;

class DataSurvey extends Component
{
    public function render()
    {
        $datasurvey = Survey::all();
        return view('livewire.data-survey', compact('datasurvey'));
    }
}
