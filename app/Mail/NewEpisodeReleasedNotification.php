<?php

namespace App\Mail;

use App\Models\Episode;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class NewEpisodeReleasedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $episode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Episode $episode)
    {
        $this->user = $user;
        $this->episode = $episode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
 
        return $this->view('mail.new-episode-released');
    }
}
