<?php

namespace App\Http\Controllers;

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendTestEmail()
    {
        $name = "Fany coder";//Starcraft20102000@yandex.ru Test@mailtrap.club
        Mail::to("Test@mailtrap.club")->send(new MyTestEmail($name));
    }
}
