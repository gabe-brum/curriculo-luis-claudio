<?php
// Recebe os valores vindos do formulário
$remetente	= $_POST['nome'];
$email		= $_POST['email'];
$fone		= $_POST['telefone'];
$mensagem	= $_POST['mensagem'];

header('Content-Type: application/json');

// Verifica se os campos obrigatórios foram preenchidos
if (strcmp($remetente, "") == 0 || strcmp($email, "") == 0 || strcmp($mensagem, "") == 0)
{
	print json_encode(array('message' => 'Por favor, preencha os campos', 'code' => 0));
	exit();
}
else
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		print json_encode(array('message' => 'E-mail com formato inválido.', 'code' => 0));
		exit();
	}
}

// Dados do E-mail
$destino = "luisclaudiodaluz64@gmail.com";

// Dados do E-mail
$conteudo = "<html>";
$conteudo .= "<body style='font-family: Verdana;'>";
$conteudo .= "	<h3>$assunto</h3>";
$conteudo .= "	<p style='text-decoration: none;'>";
$conteudo .= "		<b>Nome</b>: $remetente<br>";
$conteudo .= "		<b>Telefone</b>: $fone<br>";
$conteudo .= "		<b>E-mail</b>: $email<br>";
$conteudo .= "		<b>Mensagem</b>: $mensagem<br><br>";
$conteudo .= "	</p>";
$conteudo .= "</body>";
$conteudo .= "</html>";

$headers = "From: $remetente<$email>\r\n";
$headers .= "Bcc: gabrielbrumdaluz@gmail.com\r\n"; // Envia uma cópia oculta, CCO
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";

if (mail($destino, "Contato pelo site", $conteudo, $headers)) {
	print json_encode(
		array('message' => 'Mensagem enviada!',
			'code' => 1)
	);
	exit();

} else {
	print json_encode(
		array('message' => 'Erro ao enviar mensagem...
			Por favor, entre em contato pelo e-mail:
			luisclaudiodaluz64@gmail.com',
			'code' => 0)
	);
	exit();
}
?>

