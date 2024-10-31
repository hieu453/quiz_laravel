<?php

namespace App\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Notification extends Component
{
    public $announcements;

    public function markAsRead(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return $this->redirect(route('index'));
    }

    public function render()
    {
        // return view('livewire.notification')-with([
        //     // 'announcements' => Not
        // ]);

        return view('livewire.notification');
    }
}
