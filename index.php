<?php

require "model.php";
require "view.php";

function closeSession() {
  session_destroy();
}

function startSession() {
  $_SESSION["logged"] = true;
}

function redirect($url) {
    if (headers_sent()){
      die('<script type="text/javascript">window.location=\''.$url.'\';</script‌>');
    }else{
      header('Location: ' . $url);
      die();
    }
    printFoot();
}

session_start();

printHead();

if ( isset($_GET["session"]) && $_GET["session"] == "close" ) {
  closeSession();
  //redirect("index.php");
  header('Location: index.php');
}

if ( isset($_SESSION["logged"]) && $_SESSION["logged"] == true ) {
  printBody(true);
  if ( !isset($_GET["finderfs"]) && !isset($_GET["interiorPost"]) ) {
    /*$posts = getPostsByTitle("");
    for ($i=0 ; $i<count($posts) ; $i+=3) {
      $postId = $posts[$i];
      $userNamePost = getUserNameById( $posts[$i+1] );
      $postTitle = $posts[$i+2];
      printPosts($postId, $userNamePost, $postTitle);
    }*/
  }
  if ( isset($_POST["añadirPost"]) ) {
    $titulo = getPostIdByTitle($_POST["titulo"]);
    insertPost(getUserId( $_SESSION["userName"] ), $_POST["titulo"], $_POST["descripcion"]);
    redirect( "index.php?finderfs=");
  }
  if ( isset($_POST["añadirComentario"]) ) {
    $idPostForReply = $_GET["interiorPost"];
    $idUserReply = getUserId( $_SESSION["userName"] );
    $bodyReply = $_POST["descripcionReply"];
    insertReplyPost($idPostForReply, $idUserReply, $bodyReply);
  }
}
else if ( isset($_POST["enviarLogin"]) ) {
  $userLog = $_POST["loginName"];
  $passLog = $_POST["loginPass"];
  if ( checkUser($userLog, $passLog) ) {
    startSession();
    $_SESSION["userName"] = $_POST["loginName"];
    redirect("index.php");
  }
  else {
    printError();
    //redirect("index.php");
  }
}
else {
  printBody(false);
}

if ( isset($_POST["enviarReg"]) ) {
  $userReg = $_POST["name"];
  $pass1Reg = $_POST["firstPass"];
  $pass2Reg = $_POST["secPass"];
  $emailReg = $_POST["email"];
  $conditionReg = $_POST["condition"];
  if ( !checkUserNameExist($userReg) && !checkUserEmailExist($emailReg) && checkUserName($userReg) && checkUserEmail($emailReg) && checkUserPassword($pass1Reg) && confirmPassword($pass1Reg, $pass2Reg) ) {
    insertUser($userReg, $pass1Reg, $emailReg);
  }
  else {
    printError();
  }
}

if ( isset($_GET["conf"]) ) {
  checkDecoder($_GET["conf"]);
}

if ( isset($_GET["finderfs"]) ) {
  $posts = getPostsByTitle($_GET["finderfs"]);
  for ($i=0 ; $i<count($posts) ; $i+=3) {
    $postId = $posts[$i];
    $userNamePost = getUserNameById( $posts[$i+1] );
    $postTitle = $posts[$i+2];
    printPosts($postId, $userNamePost, $postTitle);
  }
}

if ( isset($_GET["interiorPost"]) && !isset($_POST["añadirPost"]) ) {
  $postArray = getInteriorPost($_GET["interiorPost"]);
  $postIdu = $_GET["interiorPost"];
  $userNamePostu = getUserNameById( $postArray[0] );
  $postTitleu = $postArray[1];
  $postBodyu = $postArray[2];
  printPost($postIdu, $userNamePostu, $postTitleu, $postBodyu);

  $postReplyArray = getReplyPost($postIdu);
  for ($i=0 ; $i<count($postReplyArray) ; $i+=2) {
    $userNamePostR = getUserNameById( $postReplyArray[$i] );
    $postBodyR = $postReplyArray[$i+1];
    printReplyPost($userNamePostR, $postBodyR);
  }
}

printFoot();

?>
