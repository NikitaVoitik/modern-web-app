<?php

namespace App\Livewire;

use App\Services\TwitterApiService;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class TwitterTrends extends Component
{
    public $trends = [];

    public function mount(TwitterApiService $twitterApiService)
    {
        $this->trends = $twitterApiService->getTrends();
    }

    public function render()
    {
        return view('livewire.twitter-trends');
    }
}
