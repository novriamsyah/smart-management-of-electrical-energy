<?php $number = 1; ?>
@foreach($transaksis as $transaksi)
<tr>
	<th>{{ $number }}</th>
	<th>{{ $transaksi->tegangan }}</th>
	<td>{{ $transaksi->arus }}</td>
	<td>{{ $transaksi->dy_aktif }}</td>
	<td>{{ $transaksi->Energi }}</td>
	<td>{{ $transaksi->created_at }}</td>
</tr>
<?php $number++; ?>
@endforeach