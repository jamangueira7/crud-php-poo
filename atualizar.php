<?php 
require_once("classe/usuarioDAO.class.php");
require_once("classe/usuarioVO.class.php");



$user1 = new usuarioVO();
$user1->setIdUsuario(3);
$user1->setNome('Jose');
$user1->setLogin('jose');
$user1->setEmail('jose@mail.com');
$user1->setSenha('1234');

$teste1 = new usuarioDAO();

$teste1->atualizar($user1);