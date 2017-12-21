<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

// Create connection
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "clientes_padaria";

$conn = new mysqli($servername, $username, $password, $dbname);

//ajustar o charset de comunicação entre a aplicação e o banco de dados
mysqli_set_charset($conn, 'utf8');

// Check connection
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sql = "INSERT INTO contatos (nome, email, assunto, mensagem) VALUES ('$nome', '$email', '$assunto', '$mensagem')";

if ($conn->query($sql) === TRUE) {
    //mostra alerta de envio na mesma página
    echo '<script type="text/javascript">
    alert("Mensagem enviada!");
    location.href="contatos.html";
    </script>';

    // enviar mensagem por email
    $mensagem = wordwrap($mensagem,70);
    mail("contatos@pointdopao.com.br", "Point do Pão - ".$assunto, $mensagem);

  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();

?>
