<table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #f0f0f0;">
                <img src="{{ asset('path/to/your/logo.png') }}" alt="Your Logo" style="max-width: 100px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #f9f9f9;">
                <h1>Welcome to Our Website!</h1>
                <p>Dear {{ $user->name }},</p>
                <p>Thank you for joining us. We are excited to have you on board!</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #f0f0f0;">
                <p>If you have any questions or need assistance, feel free to <a href="{{ route('contact') }}">contact us</a>.</p>
                <p>Best regards,<br>Your Company Name</p>
            </td>
        </tr>
    </table>