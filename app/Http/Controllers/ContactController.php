<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;
use App\Models\Contact;

class ContactController extends Controller
{

    public function indexContact()
    {
        $contact = Contact::first();

        // Create a dummy contact if it doesn't exist
        if (!$contact) {
            $contact = Contact::create([
                'title' => '',
                'description' => '',
                'address' => '',
                'email' => '',
                'email2' => '',
                'phone' => '',
                'phone2' => '',
                'status' => 'active'
            ]);
        }

        return view('backEnd.admin.contact.index', compact('contact'));
    }

    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'email2' => 'nullable|email',
            'phone' => 'nullable|string',
            'phone2' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Contact information updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | Frontend Contact Form Submission
    |--------------------------------------------------------------------------
    */

    public function indexSubmission()
    {
        $submissions = ContactSubmission::latest()->paginate(10);
        return view('backEnd.admin.contact.submissions', compact('submissions'));
    }

    public function showSubmission($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        // Mark as read
        if ($submission->status == 'unread') {
            $submission->update(['status' => 'read']);
        }

        return view('backEnd.admin.contact.submission-show', compact('submission'));
    }

    public function destroySubmission($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->route('admin.contact.submissions')
            ->with('success', 'Submission deleted successfully.');
    }
}
