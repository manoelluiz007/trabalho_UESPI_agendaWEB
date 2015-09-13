<?php
	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
abstract class Configuracao{
	protected $port = ":3306";
	protected $host = "localhost";
	protected $username = "root";
	protected $password = "";
	protected $bdados = "agenda_eletronica";	
	
	public function getHost(){
		return $this->host.=$this->port;
	}
	public function getUser(){
		return $this->username;
	}
	public function getPass(){
		return $this->password;
	}
	public function getBD(){
		return $this->bdados;
	}
}
