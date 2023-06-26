<?php
include('conecta-inc.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
		echo "<script language='javascript' type='text/javascript'>
        alert('Insira seu email!');window.location
        .href='login.php';</script>";
    } else if(strlen($_POST['senha']) == 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Insira sua senha!');window.location
        .href='login.php';</script>";
    } else {

        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conn->query($sql_code) or die("Falha na execu��o do c�digo SQL: " . $conn->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];

            header("Location: painel.php");

        } else {
            echo "<script language='javascript' type='text/javascript'>
        alert('Usuário e/ou senha incorreta!');window.location
        .href='login.php';</script>";
        }

    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cuidadores de 4 Patas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="icon" type="image/png" sizes="32x32" href="image/logo-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/logo-16x16.png">
	<script src="https://kit.fontawesome.com/af233e75ce.js" crossorigin="anonymous"></script>
</head>

<body>
  
	<header class="p-3 text-white fixed-top bg-danger">
		<nav class="navbar navbar-expand-lg navbar-danger">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
					aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
					<img class="" src="image/logo.png" width="81" height="44" role="img"
						aria-label="Logo"></img>
				</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link header-link" href="index.php">Retornar ao Inicio <span class="sr-only"></span></a>
						</li>
					</ul>
				</div>
		</nav>
	</header>


	
	<div class="container add-edit">
								<h2 class="text-center">Informe seus Dados de Acesso</h2>
								<hr>
								</hr>
								<div class="content">
									<form action="" method="POST">
										<label for="email" class="form-label">Email:</label>
										<input type="text" class="form-control" id="emailnome" name="email" placeholder="Usuario"/>
										<label for="senha" class="form-label">Senha:</label>
										<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha"/>
										<br>
                    <div class="d-grid gap-2">
										<button type="submit" name="login" class="btn btn-danger">Acessar</button>
                    </div>
									</form>
								</div>
								<hr>
								</hr>
							</div>
  
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="script.js"></script>

</body>