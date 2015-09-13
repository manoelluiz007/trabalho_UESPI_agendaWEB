<?php
	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
	include ('Inc/header.inc.php');

	$sort = (isset($_GET['sort']) ? $_GET['sort'] : 'rd');
	switch ($sort) {
		case 'sobre':
			//PAGINA SOBRE
			echo '</br><h2>SOBRE</h2>';
			//echo	 '<p></p></br></br>';
			echo	 '<h3>Developer:</h3>';
			echo	 '<p>Manoel Luiz</p>';
			break;
		case 'faq':
			//PAGINA FAQ
			echo '</br><h2>FAQ</h2>
				  <p></p>';
			break;
		default:
			//PAGINA INICIAL
			echo '</br><h2>INICIAL</h2>';
			echo '<p></p>
				  <h3>O QUE CONTEM O PROGRAMA:</h3>
				  <p>Funcao Inserir Contato ===> Submenur de Contato > Cadastrar</p>
				  <p>Funcao Buscar,Listar Todos, Busca por Mes os aniversariante,Deletar e Alterar ===> Submenur de Contato > Buscar e Listar</p>
				  ';

			break;
	}
	
	include ('Inc/footer.inc.php');
