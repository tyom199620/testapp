<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Validator;

class SenderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This artisan command is used to send email data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Your email?');
        $letter_header = $this->ask('Your letter header?');
        $body_letter = $this->ask('Your body letter?');

        $validator = Validator::make([
            'email' => $email,
            'letter_header' => $letter_header,
            'body_letter' => $body_letter,
        ], [
            'email' => ['required', 'string'],
            'letter_header' => ['required', 'string'],
            'body_letter' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            $this->info('All data required');
        }else{
            $details = array(
                'email' => $email,
                'letter_header' => $letter_header,
                'body_letter' => $body_letter,
                'date_time' => strtotime(Carbon::now()),
            );

            Mail::to('your_receiver_email@gmail.com')->send(new MyTestMail($details));

            $this->info('Data added successfully');
        }
    }
}
