<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestMailController extends Controller {
   
   	public function mailable() {

   		$user = \App\Models\User::first();

   		// dd($user);
   		$user->passwordPlane 			= "12345685";
       	Mail::to('pk836746@gmail.com')->send(new \App\Mail\RegisterMailable($user));
       	dd("Done");
   	}

   	public function html_email() {
      	$data = array('name'=>"Virat Gandhi");
      	Mail::send('emails/registration/index', $data, function($message) {
         	$message->to('pk836746@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         	$message->from('xyz@gmail.com','Virat Gandhi');
      	});
      	echo "HTML Email Sent. Check your inbox.";
   	}

   	public function attachment_email() {

      	$data = array('name'=>"Virat Gandhi");
      	Mail::send('emails/test', $data, function($message) {
         	$message->to('pk836746@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         	$message->attach('./uploads/0745d018-b91a-462b-a053-63297f7ad428.jpg');
         	$message->from('xyz@gmail.com','Virat Gandhi');
      	});

      	echo "Email Sent with attachment. Check your inbox.";
   }

}
