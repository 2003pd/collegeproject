<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    public function index()
    {
        $services = [
            [
                'title' => 'Visiting Card Design',
                'description' => 'Professional visiting card design for your business.',
                'image' => 'images/visiting-card.jpg',
            ],
            [
                'title' => 'Poster Design',
                'description' => 'Creative poster design for events and promotions.',
                'image' => 'images/poster.jpg',
            ],
            [
                'title' => 'Web Design',
                'description' => 'Responsive and modern website design.',
                'image' => 'images/web-design.jpg',
            ],
            [
                'title' => 'Banner Design',
                'description' => 'Eye-catching banners for online/offline promotions.',
                'image' => 'images/banner.jpg',
            ],
        ];

        return view('services', compact('services'));
    }

    public function sendMessage(Request $request)
    {
        // Save message to database
        \App\Models\ContactMessage::create($request->all());

        // Send email to admin
        $adminEmail = 'admin@example.com';
        Mail::raw("Service: {$request->service}\nName: {$request->name}\nEmail: {$request->email}\nPhone: {$request->phone}\nMessage: {$request->message}", function($message) use($adminEmail){
            $message->to($adminEmail)
                    ->subject('New Contact Message');
        });

        // Optional: send WhatsApp message via API (like Twilio/WhatsApp Business API)

        return back()->with('success', 'Message sent successfully!');
    }
}
