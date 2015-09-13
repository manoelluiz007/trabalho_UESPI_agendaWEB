<?php
	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
//CLASS PARA CRIACAO AUTOMATICA DO BANCO DE DADOS
class Sql extends Configuracao{
	public function __construct(){
		$this->conexao = mysql_connect($this->getHost(),$this->getUser(),$this->getPass()) or die("Conexao invalida: ".mysql_error());
		//VERIFICA SE O BANCO DE DADOS EXISTE, SE NAO ELE IRA CONSTRUIR
		if(mysql_select_db($this->getBD(),$this->conexao)==NULL){
			$bancoDeDados = "CREATE DATABASE ".$this->getBD().";";
			$resultado = mysql_query($bancoDeDados) or die("Comando invalido, erro ao construir o BD: ".mysql_error());
			$this->base = mysql_select_db($this->getBD(),$this->conexao);

			$query="CREATE TABLE Contato(
						id int AUTO_INCREMENT PRIMARY KEY,
						nome varchar(40) NOT NULL,
						email varchar(60) NOT NULL,
						sexo char(1) NOT NULL,
						dataNascimento Date NOT NULL
					);";
			$resultado = mysql_query($query) or die("Query invalida, erro ao executar comando SQL: ".mysql_error()."<br><p class='error'>EXECUTE O SQL MANUALMENTE NO SEU SQBD.</p>");
		}
	}
}
