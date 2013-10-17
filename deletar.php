<?php 
require_once("classe/usuarioDAO.class.php");
require_once("classe/usuarioVO.class.php");



$user1 = new usuarioVO();
$user1->setIdUsuario(2);

$teste1 = new usuarioDAO();

$teste1->deletar($user1);