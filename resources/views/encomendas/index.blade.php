<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="get" action="{{ route('encomendas.store') }}">
		<label for="estado">Estado:</label>
		<select name="estado" id="estado">
			<option value="pendente">Pendente</option>
			<option value="paga">Paga</option>
			<option value="fechada">Fechada</option>
			<option value="anulada">Anulada</option>
		</select><br>
		<label for="nota">Notas:</label>
		<input type="text" name="notas" id="nota" placeholder="notas"><br>
		<label for="nif">Nif:</label>
		<input type="text" name="nif" id="nif" placeholder="nif"><br>
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