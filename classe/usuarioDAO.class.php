<?php

require_once("baseDAO.class.php");
require_once("usuarioVO.class.php");

class usuarioDAO extends baseDAO {

	//Metodos
	public function inserir(usuarioVO $objVO){

		$sql = sprintf ('INSERT INTO Usuario (nome, email, login, senha) VALUES ("%s","%s","%s","%s");',
			addslashes($objVO->getNome()),			
			addslashes($objVO->getEmail()),
			addslashes($objVO->getLogin()),
			addslashes($objVO->getSenha())
			);	

		$this->INSERT($sql); 
		if ($this->getLinhasAfetadas()==1) {
			$objVO->setIdUsuario(mysql_insert_id($this->conexao));
			$this->commit();
			return $objVO;
		}
		else{
			$this->rollback();
			$this->trataErro(__FILE,__FUNCTION__,NULL,'Quantidade de linhas inseridas diferente de 1, verifique',TRUE);
		}
	}//inserir

	public function atualizar(usuarioVO $objVO){
		if ($objVO->getIdUsuario() == NULL) {
			$this->trataErro(__FILE, __FUNCTION__, NULL,'Chave primaria não definida ou invalida, verifique', TRUE);
		}
		else{
			$sql = sprintf('UPDATE Usuario SET nome="%s", email="%s", login="%s", senha="%s" WHERE idusuario="%s";',
				addslashes($objVO->getNome()),			
				addslashes($objVO->getEmail()),
				addslashes($objVO->getLogin()),
				addslashes($objVO->getSenha()),
				addslashes($objVO->getIdUsuario())
			);

			$this->UPDATE($sql);
			if ($this->getLinhasAfetadas() == 1) {
				$this->commit();
				return $objVO;
			}
			else{
				$this->rollback();
				$this->trataErro(__FILE, __FUNCTION__, NULL,'Quantidade de linhas inseridas diferente de 1, verifique', TRUE);
			}
		}

	}//atualizar

	public function deletar(usuarioVO $objVO){

		if ($objVO->getIdUsuario() == NULL) {
			$this->trataErro(__FILE, __FUNCTION__, NULL,'Chave primaria não definida ou invalida, verifique', TRUE);
		}
		else{
			$sql = sprintf('DELETE FROM Usuario WHERE idusuario="%s";',
				addslashes($objVO->getIdUsuario())
			);

			$this->DELETE($sql);
			if ($this->getLinhasAfetadas() == 1) {
				$this->commit();
				return $objVO;
			}
			else{
				$this->rollback();
				$this->trataErro(__FILE, __FUNCTION__, NULL,'Quantidade de linhas inseridas diferente de 1, verifique', TRUE);
			}
		}
	}//deletar

	public function selecionar($id=NULL, $condicao=NULL){

		if ($id != NULL && $condicao==NULL) {
			$sql = sprintf('SELECT * FROM Usuario WHERE idusuario="%s";', $id);
		}
		elseif ($id==NULL && $condicao !=NULL) {
			$sql = sprintf('SELECT * FROM Usuario WHERE idusuario="%s";', $condicao);
		}
		else{
			$sql = sprintf('SELECT * FROM Usuario');
		}

		$objVO = new usuarioVO();
		$resultado = array();
		$query = $this->SELECT($sql);

		while($rs = mysql_fetch_assoc($query)){
		     $objVO->setIdUsuario(stripslashes($rs['idusuario']));
		     $objVO->setNome(stripslashes($rs['nome']));
		     $objVO->setEmail(stripslashes($rs['email']));
		     $objVO->setLogin(stripslashes($rs['login']));
		     $objVO->setSenha(stripslashes($rs['senha']));

		     $resultado[] = clone $objVO;
		}
		return $resultado;
	}//selecionar

	public function getALL(){
		return $this->selecionar();
	}//getALL

	public function getByID($id){
		return $this->selecionar($id,NULL);
	}//getByID
}