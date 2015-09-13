<?php
	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
	//CLASSES PARA OBJETOS RELACIONADOS A INTERACAO
	include_once 'class/Configuracao.class.php';//Configuracao de conexao ao MySQL
	include_once 'class/Contato.class.php';		//Classe Contato que possue metodos de insersao no BD
	include_once 'class/Sql.class.php';			//Classe Sql para criacao automatica do BD caso ele nao exista
	//CLASSES PARA A INTERFACE DO PROGRAMA WEB
	
	// Determina o titulo...
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';
	// Determina o titulo da pagina:
	switch ($sort) {
		case 'ccon': //Se a variavel sort continver 'ccon' entao define:
			$page_title = 'Cadastro de Contato';
			break;
		case 'edcon': //Se a variavel sort continver 'edcon' entao define:
			$page_title = 'Alterar Contato';
			break;
		case 'bcon': //Se a variavel sort continver 'bcon' entao define:
			$page_title = 'Buscar por Contato';
			break;
		case 'sobre': //Se a variavel sort continver 'sobre' entao define:
			$page_title = 'Sobre';
			break;
		case 'faq': //Se a variavel sort continver 'faq' entao define:
			$page_title = 'FAQ';
			break;
		default:
			$page_title = 'Agenda Eletronica';
			break;
	}

	//Instancia a class Sql para automatizar a criacao do banco de dados se necessario
	$slq=new Sql();

echo "
	<!DOCTYPE html >
	<html xmlns='http://www.w3.org/1999/xhtml' lang='pt-br' xml:lang='pt-br'>
	<head>
		<title>$page_title</title>	
		<meta charset='utf-8'></meta>
		<link rel='stylesheet' href='./Inc/style.css' type='text/css' media='screen' />
		<script type='text/javascript' src='./Inc/javascript.js'></script>
	</head>
	<body>
		<div id='header'>
			<h1>Agenda Eletronica</h1>
			<h2>versao 1.00</h2>
		</div>
		<div id='nav'>
			<ul id='navigation'>
				<li class='first'><a href='index.php'>Inicial</a></li>
				<li class='parent'><a href='#'>Contato</a>
					<ul class='sub-menu'>
						<li><a href='contato.php?sort=ccon'>Cadastrar</a></li>
						<li><a href='contato.php?sort=bcon'>Buscar & Lista</a></li>
					</ul>
				</li>
				<li><a href='index.php?sort=sobre'>Sobre</a></li>
				<li><a href='index.php?sort=faq'>FAQ</a></li>
			</ul>
		</div>
		<div id='content'><!-- Start of the page-specific content. -->
		<!-- Script 8.1 - header.html -->
";
