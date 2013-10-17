<?php 
require_once("classe/usuarioDAO.class.php");
require_once("classe/usuarioVO.class.php");



$user1 = new usuarioVO();
$user1->setNome('João Antônio');
$user1->setLogin('joao');
$user1->setEmail('ja@mail.com');
$user1->setSenha('1234');

$teste1 = new usuarioDAO();

$teste1->inserir($user1);

