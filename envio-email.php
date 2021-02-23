<?php
// Envia um e-mail para a Ok Facilities
/*
$content	= "From: $nome\nTelefone: $fone\nE-mail: $email\nAssunto: $assunto\nMensagem: $mensagem";
$recipient	= "marneicardoso.prof@gmail.com";
$mailheader	= "From: $email\r\n";

//echo("Nome: $nome<br>E-mail: $email<br>Telefone: $fone<br>Assunto: $assunto<br>Mensagem: $mensagem");
mail($recipient, $assunto, $content, $mailheader) or die("Êr row");
//echo("Mensagem enviada!");
print json_encode(array('mensagem' => 'Email successfully sent!', 'code' => 1));
*/

/*
Este arquivo recebe os dados vindos do fornulário de Contato no index,
e verifica se os campos obrigatórios foram preenchidos, mesmo tendo esta
validação com jQuery, pode haver algum erro (ser desativado) e passar sem validação.
*/
$nome = $_POST['nome'];
$email = $_POST['email'];
$fone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];
header('Content-Type: application/json');

$formaDeContato = false;

if (strcmp($email, "") != 0 || strcmp($telefone, "") != 0)
{
	$formaDeContato = true;
}

if (strcmp($nome, "") == 0 || strcmp($mensagem, "") == 0 || !$formaDeContato)
{
	print json_encode(array('message' => 'Por favor, preencha os campos', 'code' => 0));
	exit();
}

if (strcmp($email, "") != 0)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		print json_encode(array('message' => 'E-mail com formato inválido.', 'code' => 0));
		exit();
	}
}

// Dados do E-mail
$remetente = $nome;
$destino = "luisclaudiodaluz@gmail.com";
if (strcmp($assunto, "") == 0)
{
	$assunto = "Contato pelo site";
}
$conteudo = "<html>";
$conteudo = "<body style='font-family: Verdana;'>";
$conteudo .= "<h3>$assunto</h3>";
$conteudo .= "<p style='text-decoration: none;'>";
$conteudo .= "<b>Nome</b>: $nome<br>";
$conteudo .= "<b>Telefone</b>: $telefone<br>";
$conteudo .= "<b>E-mail</b>: $email<br>";
$conteudo .= "<b>Mensagem</b>:<br>$mensagem<br><br>";
$conteudo .= "</p>";
$conteudo .= "</body></html>";

$headers = "From: $nome\r\n";
$headers .= "Bcc: gabrielbrumdaluz@gmail.com\r\n"; // Envia uma cópia oculta, CCO
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";

if (mail($destino, $assunto, $conteudo, $headers)) {
	print json_encode(array('message' => 'E-mail enviado com sucesso!', 'code' => 1));
	exit();
}

/*
$content	= "From: $nome \nTelefone: $fone\nE-mail: $email\nAssunto: $assunto\nMensagem: $mensagem";
$recipient	= "marneicardoso.dev@gmail.com";
//$recipient = "youremail@here.com";
$mailheader = "From: $email \r\n";
mail($recipient, $assunto, $content, $mailheader) or die("Error!");
print json_encode(array('message' => 'E-mail enviado com sucesso!', 'code' => 1));
exit();
*/

/*
$headers = "From: $remetente <contato@dentsys.com.br>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";

if (mail($destino, $assunto, $conteudo, $headers)) {
	
}

// Dados do E-mail
$remetente = "DentSYS";
$destino = "marneicardoso.prof@gmail.com"; // Fixado para testes
$assunto = "Cadastro de Paciente [$cadastrador]";
$conteudo = "<html>";
$conteudo = "<body style='font-family: Verdana; font-size: 16px;'>";
$conteudo .= "<h4>Cadastro de Paciente</h4>";
$conteudo .= "<p style='text-decoration: none;'>";
$conteudo .= "Nome: $nome $sobrenome<br>";
$conteudo .= "E-mail: $email, Telefone: $fone1<br>";
$conteudo .= "Endereço: $endereco, $numero $complemento<br>";
$conteudo .= "$bairro - $nomeCidade<br><br>";
$conteudo .= "</p>";
$conteudo .= "</body></html>";
*/
