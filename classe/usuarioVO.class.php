<?php 

class usuarioVO {

	//Propriedades
	private $idUsuario		= NULL;
	private $nome			= NULL;
	private $login			= NULL;
	private $email			= NULL;
	private $senha			= NULL;

	//Metodos GET
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getSenha() {
		return $this->senha;
	}

	//Metodos SET
	public function setIdUsuario($_idusuario) {
		$this->idUsuario = $_idusuario;
	}

	public function setNome($_nome) {
		$this->nome = $_nome;
	}

	public function setLogin($_login) {
		$this->login = $_login;
	}

	public function setEmail($_email) {
		$this->email = $_email;
	}

	public function setSenha($_senha) {
		$this->senha = $_senha;
	}


}