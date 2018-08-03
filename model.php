<?php

require 'PHPMailer/PHPMailerAutoload.php';
require 'constantes.php';

require "Database.php";

function checkUser($user, $password) {
	$connection = new Database();
	$sql = "SELECT * FROM from_space_users WHERE user = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $user);
	$query->execute();
	$row = $query->fetch();
	$pass = $row[2];
	if ($row == null) {
		return false;
	}
	else {
		if ($pass == $password) {
			return true;
		}
		else {
			return false;
		}
	}
}

function checkUserNameExist($user) {
	$connection = new Database();
	$sql = "SELECT * FROM from_space_users WHERE user = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $user);
	$query->execute();
	$row = $query->fetch();
	if ($row == null) {
		return false;
	}
	else {
		return true;
	}
}

function checkUserEmailExist($email) {
	$connection = new Database();
	$sql = "SELECT * FROM from_space_users WHERE email = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $email);
	$query->execute();
	$row = $query->fetch();
	if ($row == null) {
		return false;
	}
	else {
		return true;
	}
}

function checkUserName($user) {
	if (preg_match("/^[a-z0-9_]{6,13}$/i", $user)) {
		return true;
	}
	else {
		return false;
	}
}

function checkUserPassword($pass) {
	if (preg_match("/^[a-z0-9_]{9,15}$/i", $pass)) {
		return true;
	}
	else {
		return false;
	}
}

function checkUserEmail($email) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL) ) {
		return true;
	}
	else {
		return false;
	}
}

function confirmPassword($passt, $passd) {
	if ($passt == $passd) {
		return true;
	}
	else {
		return false;
	}
}

function generateRandomString($length = 11) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function insertUser($user, $pass, $email) {
	$decoder = generateRandomString();
	$conexion = new Database();
	$sql = "INSERT INTO from_space_users_c VALUES('', '" . $decoder . "', ?, ?, ?)";
	$query = $conexion->prepare($sql);
	$query->bindParam(1, $user);
	$query->bindParam(2, $pass);
	$query->bindParam(3, $email);
	$query->execute();
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = EMAIL;
	$mail->Password = PX_555923_XD;

	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	$mail->setFrom('youremail', 'FromSpace Confirmacion de registro');
	$mail->addAddress($email, 'FromSpace');
	$mail->Subject  = 'Tu registro en FromSpace esta a punto de finalizar';
	$mail->Body     = "Haz click en este enlace para confirmar tu email: http://www.nicolasmeseguer.com/FromSpace/index.php?conf=".$decoder;
	$mail->send();
}

function getDataUserByDecoder($decoder) {
	$connection = new Database();
	$sql = "SELECT user, password, email FROM from_space_users_c WHERE decoder = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $decoder);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$dataUser = array();
	foreach ($rows as $row) {
		$dataUser[] = $row["user"];
		$dataUser[] = $row["password"];
		$dataUser[] = $row["email"];
	}
	return $dataUser;
}

function insertUserConf($user, $pass, $email) {
	$conexion = new Database();
	$sql = "INSERT INTO from_space_users VALUES('', ?, ?, ?)";
	$query = $conexion->prepare($sql);
	$query->bindParam(1, $user);
	$query->bindParam(2, $pass);
	$query->bindParam(3, $email);
	$query->execute();
}

function deleteUserCByDecoder($decoder) {
	$conexion = new Database();
	$sql = "DELETE FROM from_space_users_c WHERE decoder = ?";
	$query = $conexion->prepare($sql);
	$query->bindParam(1, $decoder);
	$query->execute();
}

function checkDecoder($decoderNew) {
	$connection = new Database();
	$sql = "SELECT decoder FROM from_space_users_c WHERE decoder = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $decoderNew);
	$query->execute();
	$row = $query->fetch();
	if ($row == null) {
		return false;
	}
	else {
		$dataUser = getDataUserByDecoder($decoderNew);
		insertUserConf($dataUser[0], $dataUser[1], $dataUser[2]);
		deleteUserCByDecoder($decoderNew);
	}
}

function getPostsByTitle($title) {
	$connection = new Database();
	$sql = "SELECT id, ownership, title FROM from_space_posts WHERE title LIKE '%" . $title ."%'";
	$query = $connection->prepare($sql);
	//$query->bindParam(1, $title);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$dataPost = array();
	foreach ($rows as $row) {
		$dataPost[] = $row["id"];
		$dataPost[] = $row["ownership"];
		$dataPost[] = $row["title"];
	}
	return $dataPost;
}

function getPostIdByTitle($title) {
	$connection = new Database();
	$sql = "SELECT id FROM from_space_posts WHERE title = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $title);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$userArray = array();
	if($rows == null) {
		$result = null;
	}
	else {
		foreach ($rows as $row) {
			$userArray[] = $row["id"];
		}
		$result = $userArray[0];
	}
	return $result;
}

function getUserId($user) {
	$connection = new Database();
	$sql = "SELECT id FROM from_space_users WHERE user = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $user);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$userArray = array();
	if($rows == null) {
		$result = null;
	}
	else {
		foreach ($rows as $row) {
			$userArray[] = $row["id"];
		}
		$result = $userArray[0];
	}
	return $result;
}

function getUserNameById($id) {
	$connection = new Database();
	$sql = "SELECT user FROM from_space_users WHERE id = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $id);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$userArray = array();
	if($rows == null) {
		$result = null;
	}
	else {
		foreach ($rows as $row) {
			$userArray[] = $row["user"];
		}
		$result = $userArray[0];
	}
	return $result;
}

function insertPost($idUser, $titulo, $descripcion) {
	$connection = new Database();
	$sql = "INSERT INTO from_space_posts VALUES('', ?, ?, ?);";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $idUser);
	$query->bindParam(2, $titulo);
	$query->bindParam(3, $descripcion);
	$query->execute();
}

function insertReplyPost($idPost, $idUser, $body) {
	$connection = new Database();
	$sql = "INSERT INTO from_space_replyposts VALUES(?, ?, ?);";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $idPost);
	$query->bindParam(2, $idUser);
	$query->bindParam(3, $body);
	$query->execute();
}

function getInteriorPost($id) {
	$connection = new Database();
	$sql = "SELECT ownership, title, body FROM from_space_posts WHERE id = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $id);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$dataPost = array();
	foreach ($rows as $row) {
		$dataPost[] = $row["ownership"];
		$dataPost[] = $row["title"];
		$dataPost[] = $row["body"];
	}
	return $dataPost;
}

function getReplyPost($postid) {
	$connection = new Database();
	$sql = "SELECT ownership, body FROM from_space_replyposts WHERE post = ?";
	$query = $connection->prepare($sql);
	$query->bindParam(1, $postid);
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	$dataPost = array();
	foreach ($rows as $row) {
		$dataPost[] = $row["ownership"];
		$dataPost[] = $row["body"];
	}
	return $dataPost;
}


?>