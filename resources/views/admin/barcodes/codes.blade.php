<!DOCTYPE html>
<html lang="es">
<head></head>
<body>
	<table width="100%">
		<thead><tr><th></th><th></th><th></th><th></th><th></th></tr></thead>
		<tbody>
		@for($i = 1, $k = 0; $i <= $total_rows; $i++, $k+=5) {{-- 22|23 codes per column --}}
		<tr>
			@for($j = $k; $j < $k+5; $j++) {{--   K = 5 codes per row --}}
			<td width="20%">
				<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG("$codes[$j]", "C128") }}" 
					alt="{{ $codes[$j] }}" height="20px" width="125px"/> 
				<sup>{{ $codes[$j] }}</sup>
			</td>
			@endfor
		</tr>
		@endfor
		</tbody>
	</table>
</body>
<html>