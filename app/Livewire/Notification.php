<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends Component
{
    public $announcements;

    public function showNotification($notificationId)
    {
        $notification = Auth::user()->notifications->where('id', $notificationId)->first();
        $notification->markAsRead();
        return $this->redirect($notification->data['link']);

    }

    public function render()
    {
        return view('livewire.notification');
    }
}
