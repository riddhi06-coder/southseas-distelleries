<div style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="Southseas Distilleries" title="Southseas Distilleries" style="width: 220px; height: auto;">
    </div>

    <h2 style="text-align: center; color: #2c3e50;">New Career Application</h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr><td style="padding: 8px 0;"><strong>Name:</strong></td><td>{{ $name }}</td></tr>
        <tr><td style="padding: 8px 0;"><strong>Email:</strong></td><td>{{ $email }}</td></tr>
        <tr><td style="padding: 8px 0;"><strong>Subject:</strong></td><td>{{ $subject }}</td></tr>
        <tr><td style="padding: 8px 0;"><strong>Position Applied:</strong></td><td>{{ $position }}</td></tr>
    </table>

    <hr>
    <div style="margin-top: 30px; text-align: center; color: #555;">
        <p style="font-size:16px; color:#555; line-height:18px; margin:0;">
            &copy; {{ date('Y') }} Southseas Distilleries. All rights reserved.
        </p>

    </div>
</div>
