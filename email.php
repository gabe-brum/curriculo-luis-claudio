<?php
//Variáveis

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Corpo E-mail
$arquivo = "
<style type='text/css'>
body {
margin:0px;
font-family:Verdana;
font-size:12px;
color: #000;
}
p{
  color: #000;
}
p:hover {
  color: #232323;
}
</style>
  <html>
    <h2>Contato pelo site</h2><br/>
    <p>Nome: $nome</p>
    <p>E-mail: $email</p>
    <p>Telefone: $telefone</p>
    <p>Mensagem: $mensagem</p>
  </html>
";

//enviar

// emails para quem será enviado o formulário
$emailenviar = "luisclaudiodaluz64@gmail.com";
$destino = $emailenviar;
$assunto = "Contato pelo Site";

// É necessário indicar que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Contato pelo Site <$email>';
//$headers .= "Bcc: $EmailPadrao\r\n";

$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if ($enviaremail) {
  $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
  echo " <meta http-equiv='refresh' content='1;URL=index.html'>";
} else {
  $mgm = "ERRO AO ENVIAR E-MAIL!";
  echo "";
}
