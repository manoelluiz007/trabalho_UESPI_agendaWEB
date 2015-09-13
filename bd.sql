	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
CREATE DATABASE agenda_eletronica;
CREATE TABLE agenda_eletronica.Contato(
	id int AUTO_INCREMENT PRIMARY KEY,
	nome varchar(40) NOT NULL,
	email varchar(60) NOT NULL,
	sexo char(1) NOT NULL,
	dataNascimento Date NOT NULL
)
