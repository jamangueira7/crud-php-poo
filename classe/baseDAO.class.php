<?php
abstract class baseDAO {

	//Propriedades
	protected $servidor			=	"localhost";
	protected $usuario			=	"root";
	protected $senha			=	"123456";
	protected $nomeBanco		=	"ConexaoPOO";
	protected $conexao			= 	NULL;	
	protected $linhasAfetadas	= 	0;
	protected $autoCommit		= 	0; // 0 = controle de transações | 1 = autocommit


	//Metodos	
	public function __construct() {
		//Chama o metodo conecta
		$this->conecta();
	}//__construct

	public function __destruct() {
		//Verifica se conexão é diferente de nulo, e mata a conexão
		if ($this->conexao != NULL) {
			mysql_close($this->conexao);
		}
	}//__destruct

	public function conecta(){

		$this->conexao = mysql_connect($this->servidor, $this->usuario, $this->senha) 
			or die ($this->trataErro (__FILE__, __FUNCTION__, mysql_errno(), mysql_error(), TRUE));

		mysql_select_db($this->nomeBanco)
			or die ($this->trataErro (__FILE__, __FUNCTION__, mysql_errno(), mysql_error(), TRUE));

		if ($this->autoCommit == 0) {
			mysql_query("SET AUTOCOMMIT=0");
		}
		else{
			mysql_query("SET AUTOCOMMIT=1");
		}
		//Evitar problemas com pontuação
		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET character_set_connection=utf8");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_results=utf8");

	}//conecta

	public function start(){
		mysql_query("START TRANSACTION");

	}//start

	public function commit(){
		mysql_query("COMMIT");	

	}//commit

	public function rollback(){
		mysql_query("ROLLBACK");

	}//rollback

	public function INSERT($sql=NULL){
		if ($sql != NULL) {
			if ($this->autoCommit == 0) {
				$this->start();
			}

			$query = mysql_query($sql) or die ($this->trataErro(__FILE__, __FUNCTION__));
			$this->setLinhasAfetadas(mysql_affected_rows($this->conexao));
		}
		else{
			$this->trataErro(__FILE__, __FUNCTION__,NULL, "SQL não informado", FALSE);
		}

	}//INSERT

	public function UPDATE($sql=NULL){
		if ($sql != NULL) {
			if ($this->autoCommit == 0) {
				$this->start();
			}

			$query = mysql_query($sql) or die ($this->trataErro(__FILE__, __FUNCTION__));
			$this->setLinhasAfetadas(mysql_affected_rows($this->conexao));
		}
		else{
			$this->trataErro(__FILE__, __FUNCTION__,NULL, "SQL não informado", FALSE);
		}

	}//UPDATE

	public function DELETE($sql=NULL){
		if ($sql != NULL) {
			if ($this->autoCommit == 0) {
				$this->start();
			}

			$query = mysql_query($sql) or die ($this->trataErro(__FILE__, __FUNCTION__));
			$this->setLinhasAfetadas(mysql_affected_rows($this->conexao));
		}
		else{
			$this->trataErro(__FILE__, __FUNCTION__,NULL, "SQL não informado", FALSE);
		}

	}//DELETE

	public function SELECT($sql=NULL){
		if ($sql != NULL) {
			
			$query = mysql_query($sql) or die ($this->trataErro(__FILE__, __FUNCTION__));
			$this->setLinhasAfetadas(mysql_affected_rows($this->conexao));
			return $query;
		}
		else{
			$this->trataErro(__FILE__, __FUNCTION__,NULL, "SQL não informado", FALSE);
		}

	}//SELECT

	public function setLinhasAfetadas($numLinhas){
		$this->linhasAfetadas = $numLinhas;

	}//setLinhasAfetadas

	public function getLinhasAfetadas(){
		return $this->linhasAfetadas;

	}//getLinhasAfetadas

	public function trataErro($arquivo=NULL, $rotina=NULL, $numerro=NULL, $msgerro=NULL, $geraexcpt=FALSE){
		if ($arquivo == NULL) {
			$arquivo = "não informado";
		}

		if ($rotina == NULL) {
			$rotina = "não informado";
		}

		if ($numerro == NULL) {
			$numerro = mysql_errno($this->conexao);
		}

		if ($msgerro == NULL) {
			$msgerro = mysql_error($this->conexao);
		}

		$resultado = 'Ocorreu um erro com os seguintes detalhes: <br />
				   <strong>Arquivo:</strong>' .$arquivo. '<br />
				   <strong>Rotina:</strong>' .$rotina. '<br />
				   <strong>Codigo:</strong>' .$numerro. '<br />
				   <strong>Mensagem:</strong> '.$msgerro;

		if ($geraexcpt == FALSE) {
			echo ($resultado);
		}
		else{
			throw new Exception($resultado);
			
		}

	}//trataErro
}//baseDAO