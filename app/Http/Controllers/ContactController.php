<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->only(['adminIndex', 'show', 'destroy', 'markAsRead', 'markAsUnread']);
    }

    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            $contactMessage = ContactMessage::create($validated);

            // Send email to admin
            $adminEmail = config('mail.admin_address', 'admin@trainh-community.com');
            Mail::to($adminEmail)->send(new ContactFormSubmission($contactMessage));

            // Send confirmation email to user
            Mail::to($contactMessage->email)->send(new ContactFormSubmission($contactMessage));

            return redirect()->route('contact.index')
                ->with('success', 'Your message has been sent successfully. We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            
            return redirect()->route('contact.index')
                ->with('error', 'There was an error sending your message. Please try again later or contact us directly.')
                ->withInput();
        }
    }

    public function adminIndex()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.contact.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function markAsUnread(ContactMessage $message)
    {
        $message->update(['is_read' => false]);

        return redirect()->back()->with('success', 'Message marked as unread.');
    }
} 