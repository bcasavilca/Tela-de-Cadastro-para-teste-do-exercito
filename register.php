<?php
    session_start();
    include('config.php');
    if (isset($_POST['register'])) {
        $usuario = $_POST['username'];
        $email = $_POST['email'];
        $senha = $_POST['password'];
        $senhaSegura = password_hash($senha, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM cadastro WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo 'O email ja está cadastrado';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO cadastro(usuario,senha,email) VALUES (:username,:password_hash,:email)");
            $query->bindParam("username", $usuario, PDO::PARAM_STR);
            $query->bindParam("password_hash", $senhaSegura, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo 'Registrado com sucesso';
            } else {
                echo 'Algo deu errado';
            }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title></title>
</head>
<body>

	<div class="login-page">
  <div class="form">
   
<form method="post" action="" name="signup-form">
<div class="form-element">

<input type="text" name="username" placeholder="Usuário" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">

<input type="email" placeholder="Email" name="email" required />
</div>
<div class="form-element">

<input type="password" placeholder="Senha "name="password" required />
</div>
<button type="submit" name="register" value="register">Cadastrar</button>
  <p class="message">Já sou registrado. <a href="login.php"> Login
      </a></p>
</form>



    </div>
    </div>
</body>
</html>

