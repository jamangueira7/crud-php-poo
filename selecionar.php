<?php 
require_once("classe/usuarioDAO.class.php");
require_once("classe/usuarioVO.class.php");



$teste1 = new usuarioDAO();
$listaUsuarios = $teste1->selecionar();

if(sizeof($listaUsuarios)){

	foreach ($listaUsuarios as $objVO ) {
		printf('ID: %s <br />', $objVO->getIdUsuario());
		printf('Nome: %s <br />', $objVO->getNome());
		printf('Email: %s <br />', $objVO->getEmail());
		printf('Login: %s <br />', $objVO->getLogin());
		printf('Senha: %s <br />', $objVO->getSenha());
		echo '<hr>';
	}
}

/*
COMO USAR O getALL e o getByID

********getALL*********

$teste1 = new usuarioDAO();
$listaUsuarios = $teste1->getALL();

if(sizeof($listaUsuarios)){

	foreach ($listaUsuarios as $objVO ) {
		printf('ID: %s <br />', $objVO->getIdUsuario());
		printf('Nome: %s <br />', $objVO->getNome());
		printf('Email: %s <br />', $objVO->getEmail());
		printf('Login: %s <br />', $objVO->getLogin());
		printf('Senha: %s <br />', $objVO->getSenha());
		echo '<hr>';
	}
}

********getByID*********

$teste1 = new usuarioDAO();
$listaUsuarios = $teste1->getByID(4);

if(sizeof($listaUsuarios)){

	foreach ($listaUsuarios as $objVO ) {
		printf('ID: %s <br />', $objVO->getIdUsuario());
		printf('Nome: %s <br />', $objVO->getNome());
		printf('Email: %s <br />', $objVO->getEmail());
		printf('Login: %s <br />', $objVO->getLogin());
		printf('Senha: %s <br />', $objVO->getSenha());
		echo '<hr>';
	}
}

********Usando condição*********

$teste1 = new usuarioDAO();
$listaUsuarios = $teste1->selecionar(NULL,'idusuario<=4');

if(sizeof($listaUsuarios)){

	foreach ($listaUsuarios as $objVO ) {
		printf('ID: %s <br />', $objVO->getIdUsuario());
		printf('Nome: %s <br />', $objVO->getNome());
		printf('Email: %s <br />', $objVO->getEmail());
		printf('Login: %s <br />', $objVO->getLogin());
		printf('Senha: %s <br />', $objVO->getSenha());
		echo '<hr>';
	}
}

*/