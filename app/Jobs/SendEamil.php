<?php

namespace App\Jobs;

use App\Mail\SendCodeEamil;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Mail;

class SendEamil implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;

    protected $code;

    protected $emailTemplate;
    public function __construct($email , $code)
    {
        $this->email = $email;
        $this->code = $code;
        $this->emailTemplate = new SendCodeEamil($this->code);

    }

    
    public function handle()
    {

        Artisan::call('queue:work');
        Mail::to($this->email)->send($this->emailTemplate);
    }
}
    