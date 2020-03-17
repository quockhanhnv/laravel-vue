
<div class="grid-view">
	@if (!empty ($data))
		<table border="1" width="600">
			@foreach ($data as $item)
				<tr>
					<td>{{ $item['name'] }}</td>
					<td><a href="">Edit</td>
					<td><a href="">Delete</td>
				</tr>
			@endforeach
		</table>
	@endif
</div>