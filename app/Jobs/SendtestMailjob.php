<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendtestMail;
use App\Models\User;
use App\Models\Event;



class SendtestMailjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public Event $result;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Event $result)
    {
        $this->result = $result;    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {    $email = new SendtestMail($this->result);
        Mail::to($this->result->email, "send Test mail")->send($email);

    }
}
