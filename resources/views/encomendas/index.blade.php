<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="{{ route('encomenda.store') }}">
		@CSRF
		
		<label for="nota">Notas:</label>
		<input type="text" name="notas" id="nota" placeholder="notas"><br>
		<label for="nif">Nif:</label>
		<input type="number" name="nif" id="nif" placeholder="nif"><br>
		<label for="endereco">Endereco:</label>
		<input type="text" name="endereco" id="endereco" placeholder="endereco"><br>
		<label for="metpag">Metodo de Pagamento</label>
		<select name="metpag" id="metpag">
			<option value="visa">Visa</option>
			<option value="mc">MC</option>
			<option value="Paypal">Paypal</option>
		</select><br>

	<input type="submit" value="Submeter">

	</form>

</body>
</html>