<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $usuario = $_POST['username'];
        $senha = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM cadastro WHERE usuario=:username");
        $query->bindParam("username", $usuario, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo 'combinação email e senha está errada';
        } else {
            if (password_verify($senha, $result['senha'])) {
                $_SESSION['user_id'] = $result['id'];
                echo 'Sucesso, você está logado';
            } else {
                echo 'combinação email e senha está errada';
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Tela de Login</title>
</head>
<body>
<div class="login-page">
  <div class="form">   
        <form class="login-form" method="post" action="inicio.php" name="signup-form">
        <input type="text" name="username" placeholder="Usuário" pattern="[a-zA-Z0-9]+" required />
        <input type="password"  name="password" placeholder="Senha"required />
        <button type="submit" name="login" value="login">Entrar</button>
        <p class="message">Não é registrado? <a href="register.php">Cadastre-se</a></p>
        <p class="message"> <a href="login.php">Recuperar usuário ou senha.
        </form>
    </div>
</div>

</body>
</html>

