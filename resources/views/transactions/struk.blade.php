<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Struk {{ $trx->invoice_number }}</title>
  <style>
    body { font-family: "Courier New", monospace; max-width: 320px; margin: 20px auto; font-size: 13px; }
    h3, .center { text-align: center; }
    table { width: 100%; border-collapse: collapse; }
    .r { text-align: right; }
    hr { border: 0; border-top: 1px dashed #000; margin: 8px 0; }
    .actions { text-align: center; margin-top: 16px; }
    @media print { .actions { display: none; } }
  </style>
</head>
<body>
  <h3>TOKO SAYA</h3>
  <p>
    No. Invoice : {{ $trx->invoice_number }}<br>
    Tanggal     : {{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}
  </p>
  <hr>

  <table>
    @foreach($details as $d)
      <tr><td colspan="2">{{ $d->name }}</td></tr>
      <tr>
        <td>{{ $d->quantity }} x {{ number_format($d->price, 0, ',', '.') }}</td>
        <td class="r">{{ number_format($d->subtotal, 0, ',', '.') }}</td>
      </tr>
    @endforeach
  </table>
  <hr>

  <table>
    <tr><td>Subtotal</td><td class="r">{{ number_format($trx->subtotal, 0, ',', '.') }}</td></tr>
    <tr>
      <td>Diskon ({{ rtrim(rtrim(number_format($trx->discount_percent, 2, '.', ''), '0'), '.') }}%)</td>
      <td class="r">-{{ number_format($trx->discount_amount, 0, ',', '.') }}</td>
    </tr>
    <tr><th class="r" style="text-align:left">TOTAL</th><th class="r">{{ number_format($trx->total_amount, 0, ',', '.') }}</th></tr>
  </table>
  <hr>
  <p class="center">Terima kasih</p>

  <div class="actions">
    <button onclick="window.print()">Cetak</button>
    <a href="{{ route('transactions.create') }}">Transaksi Baru</a>
  </div>
</body>
</html>