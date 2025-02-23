<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Ovde možete dodati logiku za slanje emaila
        // Na primer:
        /*
        Mail::send('emails.contact', $validated, function($message) use ($validated) {
            $message->to('info@ddradovic.rs')
                    ->subject('Nova kontakt poruka: ' . $validated['subject']);
        });
        */

        return redirect()
            ->back()
            ->with('success', 'Vaša poruka je uspešno poslata. Kontaktiraćemo vas uskoro.');
    }
}
