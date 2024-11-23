<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
</head>
<body>
    <h1>Terima kasih atas pemesanan Anda!</h1>

    <p>Hallo {{ $booking['customer_name'] }},</p>

    <p>Pesanan Anda telah berhasil kami terima. Berikut adalah rincian pemesanan Anda:</p>

    <table>
        <tr>
            <td>Nomor Pemesanan:</td>
            <td>{{ $booking['order_number'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan:</td>
            <td>{{ $booking['created_at']->format('d M Y') }}</td>
        </tr>
        <tr>
            <td>Total Pembayaran:</td>
            <td>Rp. {{ number_format($booking['total_amount'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <p>Terima kasih telah menggunakan layanan kami. Kami berharap Anda menikmati pengalaman Anda!</p>

    <p>Salam,<br>{{ config('app.name') }}</p>
</body>
</html>
