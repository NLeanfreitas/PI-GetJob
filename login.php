<?php

include_once(dirname(__FILE__) . "/inc/MySQL.php");

include_once(dirname(__FILE__)."/inc/menu.php");

include_once(dirname(__FILE__)."/inc/header.php");

$aviso = false;
if (isset($_POST['enviar'])) {
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$sql = $pdo->prepare("SELECT * FROM usuarios 
                              WHERE email= ? AND senha = ?");
	if ($sql->execute(array($email, $senha))) {
		$info = $sql->fetchAll(PDO::FETCH_ASSOC);
		if (count($info) > 0) {
			foreach ($info as $key => $values) {
				$_SESSION['email'] = $values['email'];
				$_SESSION['senha'] = $values['senha'];
			}
			$aviso = '<h6 class="alert alert-primary" style="color: green;">Usuario Logado</h6>';
		} else {
			$aviso = '<h6 class="alert alert-danger" style="color: red">Este usuario não existe</h6>';
		}
	}
}
?>




<?php
 if (!isset($_SESSION['email'])){
?>
<form action="" method="post">
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Entrar</label>
			<input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">Esqueci senha</label>
			<div class="login-form">
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">Email</label>
						<input id="user" type="text" class="input" name="email">
						<hr>
					</div>
					<div class="group">
						<label for="pass" class="label">Senha</label>
						<input id="pass" type="password" class="input" data-type="password" name="senha">
						<hr>
					</div>
					<div class="group">
						<form action="/lista-funcionarios.php" method="post">
							<input type="submit" class="button" value="Entrar" name="enviar">
						</form>
					</div>
					<div class="hr"></div>
				</div>
				<div class="for-pwd-htm">
					<div class="group">
						<label for="user" class="label">Email</label>
						<input id="user" type="text" class="input">
						<hr>
					</div>
					<div class="group">
						<form action="/admin/teste-admin.php" method="post">
							<input type="submit" class="button" value="Redefinir Senha">
						</form>
					</div>
					<div class="hr"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	 //echo "Bem Vindo1: ". $_SESSION['email'];
	if ($aviso) {
		echo $aviso;
	}
	?>
</form>
<?php
 } else {
	 echo "Bem Vindo2: ". $_SESSION['email'];
 }
?>

<?php

include_once(dirname(__FILE__) . "/inc/footer.php");


