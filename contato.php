<?php
	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */
	
	//ARQUIVO ONDE FICAM OS FORMULARIOS
	include ('Inc/header.inc.php'); //tudo que possue em header he criado nesse arquivo
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd'; //recebe por metodo get o valor de sort e guarda em variavel
	$delcon = (isset($_GET['delcon'])) ? $_GET['delcon'] : 'rd';
	$edcon = (isset($_GET['edcon'])) ? $_GET['edcon'] : 'rd'; //Valor do indice pego no BD

	//Se for clicado em Cadastra no Navbar ele realiza essa acao
	if ($page_title == 'Cadastro de Contato'){
		echo '<h1>Cadastro de Contato</h1>';
		echo "<form action='contato.php?sort=ccon' method='post'>
			<fieldset><legend>Entre com as informacoes do contato abaixo:</legend>
			<p><b>Nome:</b><b class='required'>*</b> <input type='text' name='nome' size='30' maxlength='40' /></p>
			<p><b>Email:</b><b class='required'>*</b> <input type='text' name='email' size='40' maxlength='60' /><b>
			<p><b>Sexo:</b><b class='required'>*</b> <input type='radio' name='sexo' value='m'/>Masculino 
													 <input type='radio' name='sexo' value='f'/>Feminino </p>
			<p><b>Data de Nascimento:</b><b class='required'>*</b> <input onkeypress='mascara( this, mdata );' type='text' name='dataNascimento' maxlength='10'/></p>
            </fieldset>
            <br>
			<div align='center'><input type='submit' name='enviado' value='Gravar Contato' />
								<input type='reset' name='#' value='Limpar' /></div>
			</form>";

		//A pagina continuarar abertar apois o submit entao ele realiza essa verificacao e acao se necessario
		if(isset($_POST['enviado'])){
			if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['sexo']) && !empty($_POST['dataNascimento']) ) {
				echo "<p>".$_POST['nome']."</p>";
				$contato = new Contato(); //cria o objeto e realiza conexao com o BD
					if(!empty($_POST['id'])){ $contato->setNome($_POST['id']); } //seta o valor null em ID do objeto
				$contato->setNome($_POST['nome']); //seta o valor nome do formulario para o objeto
				$contato->setEmail($_POST['email']); // seta o valor email do formulario para o objeto
				$contato->setSexo($_POST['sexo']); // seta o valor sexo do formulario para o objeto
				$contato->setDataNascimento($_POST['dataNascimento']); // seta o valor data do formulario para o objeto

				$contato->inserir(); //Realiza a insersao dos dados dentro do BD;
				$contato->__destruct(); //invoca a destruicao desse objeto
			}
		}
	}

	//Se for clicado em Alterar na listagem ele realiza essa acao
	if ($page_title == 'Alterar Contato' || $sort == 'alcontato'){
		echo '<h1>Alterar de Contato</h1>';
		echo "<form action='contato.php?sort=alcontato&&edcon=$edcon' method='post'>
			<fieldset><legend>Entre com as informacoes do contato abaixo:</legend>
			<p><b>Indice:</b> $edcon</p>
			<p><b>Nome:</b><b class='required'>*</b> <input type='text' name='nome' size='30' maxlength='40'/></p>
			<p><b>Email:</b><b class='required'>*</b> <input type='text' name='email' size='40' maxlength='60' /><b>
			<p><b>Sexo:</b><b class='required'>*</b> <input type='radio' name='sexo' value='m'/>Masculino 
													 <input type='radio' name='sexo' value='f'/>Feminino </p>
			<p><b>Data de Nascimento:</b><b class='required'>*</b> <input onkeypress='mascara( this, mdata );' type='text' name='dataNascimento' maxlength='10'/></p>
            </fieldset>
            <br>
			<div align='center'><input type='submit' name='enviado' value='Alterar Contato' />
								<input type='reset' name='#' value='Limpar' /></div>
			</form>";
		//A pagina continuarar abertar apois o submit entao ele realiza essa verificacao e acao se necessario
		if(isset($_POST['enviado'])){
			if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['sexo']) && !empty($_POST['dataNascimento']) ) {
				echo "<p>$edcon = ".$_POST['nome']."</p>";
				$contato = new Contato(); //cria o objeto e realiza conexao com o BD
				$contato->setId($edcon); //seta o valor da ID que se deseja alterar
				$contato->setNome($_POST['nome']); //seta o valor do nome que se deseja alterar 
				$contato->setEmail($_POST['email']); //seta o valor do email que se deseja alterar
				$contato->setSexo($_POST['sexo']); //seta o valor do sexo que se deseja alterar
				$contato->setDataNascimento($_POST['dataNascimento']); //seta o valor da data que se deseja alterar

				$contato->alterar($edcon); //Realiza a alteracao dos dados dentro do BD;
				$contato->__destruct(); //invoca a destruicao desse objeto
			}
		}
	}

	//Se for clicado em Buscar no Navbar ele realiza essa acao
	if ($page_title == 'Buscar por Contato'){
		echo '<h1>Buscar e Listagem por Contato</h1>';
		echo "<form action='contato.php?sort=bcon' method='post'>
			<fieldset><legend>Entre com as informacoes do contato abaixo:</legend>
			<p><b>Buscar por:</b> <input type='radio' name='busca_por' value='nome' /> Nome 
								  <input type='radio' name='busca_por' value='mes' /> Aniversariante do Mes 
								  <input type='radio' name='busca_por' value='lista' /> Listar Todos</p>
			<p><b>Nome:</b> <input type='text' name='nome' size='25' maxlength='40' /> Insira nesse campo se selecionar busca por nome</p>
			<p><b>Aniversariante do Mes:</b> <input onkeypress='mascara( this, mnum );'type='text' name='mes' size='25' maxlength='2' /> Insira nesse campo se selecionar busca por Aniversariante do Mes<p>
			</fieldset>
			<br>
			<div align='center'><input type='submit' name='enviado' value='Realizar Busca' />
								<input type='reset' name='#' value='Limpar' /></div>
			</form>";//no php existe procedimentos "leonam" esvazia a memoria automaticamente
					//Pesquisa na web W3C site que padroniza
		echo "<p>Ao listar os resultados he exibido dois links que agem como butoes para as funcoes de deletar e alterar.</p>";
		if(isset($_POST['enviado'])){
			if ( !empty($_POST['nome']) || !empty($_POST['mes']) || !empty($_POST['busca_por'])){
				if (!empty($_POST['busca_por'])){
					if($_POST['busca_por'] == 'nome'){
						$contato = new Contato(); //cria o objeto e realiza conexao com o BD
						$contato->consultarPorNome($_POST['nome']); //chama o metodo para buscar por nome
						$contato->__destruct();
					} elseif ($_POST['busca_por'] == 'mes'){
						if(is_numeric($_POST['mes'])){
							$contato = new Contato(); //cria o objeto e realiza conexao com o BD
							$contato->aniversariantesMes($_POST['mes']); //chama o metodo para buscar os aniversariantes
							$contato->__destruct();
						}
					} elseif ($_POST['busca_por'] == 'lista'){
						$contato = new Contato(); //cria o objeto e realiza conexao com o BD
						$contato->listarTodos(); //chama o metodo listarTodos
						$contato->__destruct(); //invoca a destruicao desse objeto
					}
				}
			} else {
				$contato = new Contato();//cria o objeto e realiza conexao com o BD
				$contato->listarTodos();//chama o metodo listarTodos
				$contato->__destruct();//invoca a destruicao desse objeto
			}
		}
	}


	//Excusao dos dados se presionar o butao 'deletar'
	if ($sort == 'lcontato' && $delcon>0){
		$contato = new Contato();
		$contato->excluir($delcon); //tratamento de valor dentro da classe contato
		$contato->__destruct(); //invoca a destruicao desse objeto
	}


	include ('Inc/footer.inc.php'); //tudo que possue em footer he criado nesse arquivo
