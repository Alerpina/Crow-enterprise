<?php

namespace App\Jobs;

use App\Mail\AdminEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use stdClass;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $objDemo;
    public $mailData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(stdClass $objDemo)
    {
        $this->objDemo = $objDemo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->objDemo->to)->send(new AdminEmail($this->mailData['body'], $this->objDemo->subject, ['to_email' => $this->objDemo->to, 'from_email' => $this->objDemo->from_email, 'from_name' => $this->objDemo->from_name, 'reply' => $this->objDemo->reply]));
    }
}
