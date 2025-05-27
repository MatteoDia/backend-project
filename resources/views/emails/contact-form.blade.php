<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; border-radius: 5px; padding: 20px; margin-bottom: 20px;">
        <h1 style="color: #2d3748; margin-top: 0;">New Contact Form Submission</h1>
        <p style="margin-bottom: 0;">You have received a new message from the contact form.</p>
    </div>

    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 5px; padding: 20px;">
        <h2 style="color: #2d3748; font-size: 18px; margin-top: 0;">Message Details</h2>
        
        <div style="margin-bottom: 20px;">
            <p style="margin: 0; color: #718096;">From:</p>
            <p style="margin: 5px 0; font-weight: bold;">{{ $contactMessage->name }} ({{ $contactMessage->email }})</p>
        </div>

        <div style="margin-bottom: 20px;">
            <p style="margin: 0; color: #718096;">Subject:</p>
            <p style="margin: 5px 0; font-weight: bold;">{{ $contactMessage->subject }}</p>
        </div>

        <div style="margin-bottom: 20px;">
            <p style="margin: 0; color: #718096;">Message:</p>
            <div style="margin: 5px 0; padding: 15px; background-color: #f8f9fa; border-radius: 5px;">
                {{ $contactMessage->message }}
            </div>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
            <p style="margin: 0; font-size: 14px; color: #718096;">
                This message was sent on {{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}
            </p>
        </div>
    </div>

    <div style="margin-top: 20px; text-align: center; font-size: 14px; color: #718096;">
        <p>You can view this message in the admin panel:</p>
        <p>
            <a href="{{ route('admin.contact.show', $contactMessage) }}" 
               style="display: inline-block; padding: 10px 20px; background-color: #4299e1; color: #ffffff; text-decoration: none; border-radius: 5px;">
                View Message
            </a>
        </p>
    </div>
</body>
</html> 