<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembaruan Status Pesanan</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f1eb; color: #252525; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding: 32px 16px; background-color: #f4f1eb;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border: 1px solid #e5dfd5;">
                    <tr>
                        <td style="padding: 32px;">
                            <p style="margin: 0 0 24px; color: #c34d2c; font-size: 13px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">OMH Vector</p>
                            <h1 style="margin: 0 0 16px; color: #252525; font-size: 26px; line-height: 1.25;">Status pesanan Anda diperbarui</h1>
                            <p style="margin: 0 0 24px; color: #5f5a53; font-size: 16px; line-height: 1.6;">Halo, {{ $order->customer_name }}. Berikut adalah informasi terbaru untuk pesanan Anda.</p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px; border-collapse: collapse;">
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #eee9e1; color: #77716a; font-size: 14px;">Nomor pesanan</td>
                                    <td align="right" style="padding: 12px 0; border-bottom: 1px solid #eee9e1; color: #252525; font-size: 14px; font-weight: bold;">{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0; color: #77716a; font-size: 14px;">Status terbaru</td>
                                    <td align="right" style="padding: 12px 0; color: #c34d2c; font-size: 14px; font-weight: bold;">{{ $order->status }}</td>
                                </tr>
                            </table>

                            @if (filled($order->admin_notes))
                                <div style="margin-bottom: 24px; padding: 16px; background-color: #faf7f2; border-left: 3px solid #c34d2c;">
                                    <p style="margin: 0 0 8px; color: #77716a; font-size: 13px; font-weight: bold;">Catatan admin</p>
                                    <p style="margin: 0; color: #5f5a53; font-size: 14px; line-height: 1.6;">{{ $order->admin_notes }}</p>
                                </div>
                            @endif

                            <a href="{{ $trackingUrl }}" style="display: inline-block; padding: 13px 20px; background-color: #c34d2c; color: #ffffff; font-size: 14px; font-weight: bold; text-decoration: none;">Lacak Pesanan</a>
                            <p style="margin: 24px 0 0; color: #8a847c; font-size: 12px; line-height: 1.5;">Terima kasih telah mempercayakan kebutuhan Anda kepada OMH Vector.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>