<?php
//1 – Definimos Para quem vai ser enviado o email
$destinatario = "cuidadores4patas@alwaysdata.net";
//2 – Definimos um Assunto do Email
$assunto = "Adoção de Pet";
//3 - resgatar os dados digitado no formulário e  grava nas variaveis
$nomepet = $_POST['nomepet'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
 //4 – Agora definimos a  mensagem que vai ser enviado no corpo do e-mail
$mensagem = "<h1>Dados do Interessado no PET </h1>";
$mensagem .= "<br><strong>Nome do interessado:  </strong>".$nome;
$mensagem .= "<br><strong>Endereço:  </strong>".$endereco;
$mensagem .= "<br><strong>Telefone:  </strong>".$telefone;
$mensagem .= "<br><strong>Email:  </strong>".$email;
$mensagem .= "<br><strong>Nome do pet escolhido:  </strong>".$nomepet;

//5 – agora inserimos as codificações corretas e  tudo mais.
$headers =  "Content-Type:text/html; charset=UTF-8\n";
$headers .= "From:  dominio.com.br<sistema@dominio.com.br>\n";
//Vai ser //mostrado que  o email partiu deste email e seguido do nome
$headers .= "X-Sender:  <sistema@dominio.com.br>\n";
//email do servidor //que enviou
$headers .= "X-Mailer: PHP  v".phpversion()."\n";
$headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
$headers .= "Return-Path:  <sistema@dominio.com.br>\n";
//caso a msg //seja respondida vai para  este email.
$headers .= "MIME-Version: 1.0\n";

mail($destinatario, $assunto, $mensagem, $headers);  //função que faz o envio do email.

	include("conecta-inc.php");
	//cria as variaveis vazias.
	$id = $nomepet = $nome = $endereco = $telefone = "";

	$sql = "SELECT * FROM pets WHERE id = $id";
	$result = $conn->query($sql);
	if(isset($_POST["id"]) && !empty($_POST["id"])){
  	//este bloco é executado se o for  for enviado usando o botão (POST)
  	$id = $_POST["id"];

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$nomepet = $row["nome"];
		}
		$nome = trim($_POST["nome"]);
		$endereco = trim($_POST["endereco"]);
		$telefone = trim($_POST["telefone"]);
				
		$sql = "UPDATE cliente SET nome= '$nome', endereco = '$endereco', telefone = '$telefone' WHERE id=$id";

			if ($conn->query($sql) === TRUE) {
      	$conn->close(); //fecha a conexão antes de redirecionar
				header("location: index.php");
				exit();
			} else {
    		echo "Error updating record: " . $conn->error;
				$conn->close(); //fecha a conexão
			}} //fim do if conn

	elseif (isset($_GET["id"]) && !empty($_GET["id"])) { //elseif do primeiro isset
		//Este bloco é executado se existir o parametro na  URL
		$id = trim($_GET["id"]); //trata e armazena o parâmetro
		$sql = "SELECT * FROM cliente WHERE id = $id";
		$result = $conn->query($sql);
	
		if ($result->num_rows == 1) {
	    $row = $result->fetch_assoc();
			$nome = $row["nome"];
			$endereco = $row["endereco"];
			$telefone = $row["telefone"];
		} else {
			echo "Erro fatal, mais de um registro encontrado na consulta.";
		}
		$conn->close(); //fecha a conexão
																												
	}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["id"])) { //Verifica se foi pressionado o botão (POST) e ainda nao tem id (novo registro)
	  //não possuimos o ID, criaremos um usert para um novo registro
		$nome = trim($_POST["nome"]);
		$endereco = trim($_POST["endereco"]);
		$telefone = trim($_POST["telefone"]);
	
		$sql = "INSERT INTO cliente (nome, endereco, telefone) VALUES ('$nome','$endereco', $telefone)";
	
		if ($conn->query($sql) === TRUE) {
	    $conn->close(); //fecha a conexão antes de redirecionar
		echo"<script language='javascript' type='text/javascript'>
        alert('Solicitação de Adoção realizada com sucesso!');window.location
        .href='index.php';</script>";
        die();

      exit();
	  }else{
			echo "Erro ao inserir o registro: " . $conn->error;
			$conn->close(); //fecha a conexão
		}
	}
?>