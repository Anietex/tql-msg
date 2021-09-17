<?php

namespace App\Mail;

use App\Models\Company;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $company;
    private $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Company $company
     */
    public function __construct(User $user, Company $company)
    {
        $this->user = $user;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Company created')
            ->view('mails.company-created',['user'=>$this->user, 'company' => $this->company]);
    }
}
