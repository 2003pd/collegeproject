<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'service' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
        ]);

        // Save to database
        $contact = Contact::create($data);

        // Send Email to Admin
        Mail::raw("New Contact Message\n
Service: {$data['service']}
Name: {$data['name']}
Email: {$data['email']}
Phone: {$data['phone']}
Message: {$data['message']}", function ($message) {
            $message->to('admin@example.com')
                    ->subject('New Contact Form Submission');
        });

        // Send WhatsApp via Twilio
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM');
        $to = env('TWILIO_WHATSAPP_TO');

        $client = new Client($sid, $token);

        $msg = "New Contact Message:\nService: {$data['service']}\nName: {$data['name']}\nEmail: {$data['email']}\nPhone: {$data['phone']}\nMessage: {$data['message']}";

        $client->messages->create($to, [
            'from' => $from,
            'body' => $msg
        ]);

        return back()->with('success', 'Your message has been sent!');
    }
}
