<!DOCTYPE html>
<html>
<head>
    <title>Payment Reminder for your Booking</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; padding: 20px;">
        <h2>Payment Reminder</h2>
        <p>Dear Customer,</p>
        <p>This is a gentle reminder that your Removal Service booking with Order ID <strong>#{{ $order->id }}</strong> is pending payment.</p>
        <p>Booking Amount: <strong>{{ amount_with_currency_symbol($order->total) }}</strong></p>
        
        <p>Here is a link to your order invoice where you can complete your payment:</p>
        <p>
            <a href="{{ route('frontend.book.invoice', $order->trx) }}" style="display:inline-block; padding:10px 20px; background-color:#1c4ed8; color:#ffffff; text-decoration:none; border-radius:5px;">Pay Now</a>
        </p>

        <p>If you have already paid or have any questions, please contact us.</p>
        <p>Best regards,<br>The Express-Van Team</p>
    </div>
</body>
</html>
