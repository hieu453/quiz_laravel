<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QuizRate;
use Illuminate\Support\Facades\Auth;

class Rating extends Component
{
    public $quizId;
    public $ratedCount = 0;
    public $activeNumber = null;
    public $avgStar = null;

    public function mount()
    {
        if (Auth::user()) {
            $this->activeNumber = QuizRate::where([
                'quiz_id' => $this->quizId,
                'user_id' => Auth::user()->id,
                ])->first()->rating ?? null;
        }

        $this->ratedCount = QuizRate::where('quiz_id', $this->quizId)->count();
        if ($this->ratedCount > 0) {
            $this->avgStar = QuizRate::where('quiz_id', $this->quizId)->sum('rating') / $this->ratedCount;
        } else {
            $this->avgStar = 0;
        }
    }

    public function rate($star, $quizId)
    {
        if (Auth::user()) {
            $userRated = QuizRate::where([
                'user_id' => Auth::user()->id,
                'quiz_id' => $quizId,
            ])->first();

            if ($userRated) {

                // $this->activeNumber = null;
                $userRated->rating = $star;
                $userRated->save();
                $this->activeNumber = $star;
                $this->avgStar = QuizRate::where('quiz_id', $this->quizId)->sum('rating') / $this->ratedCount;
                $this->dispatch('updated-rating', star: $star);
            } else {
                QuizRate::create([
                    'user_id'   => Auth::user()->id,
                    'quiz_id'   => $quizId,
                    'rating'    => $star
                ]);

                $this->ratedCount++;
                $this->avgStar = QuizRate::where('quiz_id', $this->quizId)->sum('rating') / $this->ratedCount;
                $this->activeNumber = $star;
                $this->dispatch('rated', star: $star);
            }
        }
    }

    public function render()
    {
        return view('livewire.rating', [
            'quiz_id' => $this->quizId,
        ]);
    }
}
