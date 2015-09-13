<?php
	/* Terceira Avaliacao da Disciplina Programacao 3 WEB
	 * Desenvolvido por
	 *		Manoel Luiz de Carvalho Melo
	 */

class Contato extends Configuracao{
	protected $id;		//Indice do Contato
	protected $nome;	//Nome do Contato
	protected $email;	//Email do Contato
	protected $sexo;	//Sexo do Contato
	protected $dataNascimento; //Data de nacimento

	//Constroi o Objeto realizando conexao com o banco de dados
	public function __construct(){
		$this->conexao = mysql_connect($this->getHost(),$this->getUser(),$this->getPass()) or die("Conexao invalida: ".mysql_error());
		$this->base = mysql_select_db($this->getBD(),$this->conexao) or die ("Erro ao selecionar o BD".mysql_error());
	}
	public function __destruct(){
		/*O objeto que tem essa função quando nao he mais utilizado a invoca altomaticamente para
		 * a liberacao da memoria.
		 */
	}

	//Metodos GET
	public function getId(){
		return $this->id; // retorna o valor do id do objeto
	}
	public function getNome(){
		return $this->nome; // retorna o valor do nome do objeto
	}
	public function getEmail(){
		return $this->email; // retorna o valor do email do objeto
	}
	public function getSexo(){
		return $this->sexo; // retorna o valor do sexo do objeto
	}
	public function getDataNascimento(){
		return $this->dataNascimento; // retorna o valor da dataNascimento do objeto
	}

	//Metodos SET
	public function setId($id){
		if($id==NULL){
			$this->id=$id;
		}else{
			$this->id=NULL;//O BANCO DE DADOS POSSUI AUTO INCREMENTO
		}
	}
	public function setNome($nome){
		//tratamento para permitir que o nome contenha numeros e outros caracteres
		if(!ereg("[A-Za-z_]$", $nome) || $nome=="" || strlen($nome)>40) {
			$this->nome=NULL; //casso haja erro ele insere null na variavel nome para o SQL bloquear a insersao, ja que he not null
			echo "<p class='error'>Erro: Nome Invalido.</p>";
		}else{
			$this->nome=$nome;
		}
	}
	public function setEmail($email){
		//tratamento para entrada do email
		$regex = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+"; 
		$regex.=")*[.][A-z]{2,4}$/";
		if(!preg_match($regex, $email) || strlen($email)>128 || $email=='' || strlen($email)>60){
			$this->email=NULL; //casso haja erro ele insere null na variavel email para o SQL bloquear a insersao, ja que he not null
			echo "<p class='error'>Erro: Email Invalido.</p>"; 
		}else{
			$this->email=$email;
		}
	}
	public function setSexo($sexo){
		if($sexo=='m' or $sexo=='M' or $sexo=='f' or $sexo=='F'){
			$this->sexo=$sexo;
		} else {
			echo "<p class='error'>Erro: nao foi possivel a açao, sexo inexistente.</p>";
		}
	}
	public function setDataNascimento($dataNascimento){
		//FAZER O TRATAMENTO converte o formato dd/mm/yyyy em yyyy-mm-dd aceito no mysql
		$arrayData = explode("/",$dataNascimento);
		$this->dataNascimento=$arrayData[2]."-".$arrayData[1]."-".$arrayData[0];
	}

	//Funções para interacao com o BD e as criacao das Paginas
	public function inserir(){
		if ($this->nome!=null && $this->email!=null && $this->sexo!=null && $this->dataNascimento!=null){
			$query = "INSERT INTO Contato (id, nome, email, sexo, dataNascimento)
					   VALUES ('', '$this->nome','$this->email','$this->sexo','$this->dataNascimento')
					  ";
			$resultado = mysql_query($query) or die("Query invalida: ".mysql_error()); //inseri os valores dentro do BD
			//mysql_close($this->conexao);
			echo '<p class="sucess">Cadastro realizado com sucesso.</p>';
		} else {
			echo '<p class="error">Erro: nao foi possivel inserir o Contato.</p>';
		}
	}
	public function listarTodos(){
		$query = "SELECT id, nome, email, sexo, dataNascimento FROM Contato";
		$resultado = mysql_query($query,$this->conexao);
		
		if($resultado){
			echo '<h1>Listagem de Todos os Contatos</h1>';
			echo '<table align="center">';
			echo '<tr>
					<td><b>Editar</b></td>
					<td><b>Deletar</b></td>
					<td><b>Indice</b></td>
					<td><b>Nome</b></td>
					<td><b>Email</b></td>
					<td><b>Sexo</b></td>
					<td><b>Data de Nascimento</b></td>
				</tr>';
			while ($row = mysql_fetch_assoc($resultado)){
				//EXIBE OS DADOS NA TELA
				$arrayData2 = explode("-",$row["dataNascimento"]); //divide a estrutura em um array
				//lista o resultado
				echo '<tr>
						<td><a href="contato.php?sort=alcontato'.
										'&&edcon='.$row['id'].
										'&&edconN='.$row['nome'].
										'&&edconE='.$row['email'].
										'&&edconD='.$row['dataNascimento'].
										'">Edit</a></td>
						<td><a href="contato.php?sort=lcontato&&delcon=' . $row['id'] . '">Delete</a></td>
						<td>' . $row["id"] . '</td>
						<td>' . $row["nome"] . '</td>
						<td>' . $row["email"] . '</td>
						<td>' . $row["sexo"] . '</td>
						<td>' . $arrayData2[2]."/".$arrayData2[1]."/".$arrayData2[0] . '</td>
					  </tr>';
			}
			echo '</table>';
		}
	}
	public function consultarPorNome($busca){
		$query = "SELECT id, nome, email, sexo, dataNascimento FROM Contato 
				  WHERE `nome` LIKE '%$busca%'";
		$resultado = mysql_query($query,$this->conexao);
		
		if($resultado){
			echo '<h1>Consulta por nome dos Contatos</h1>';
			echo '<table align="center">';
			echo '<tr>
					<td><b>Editar</b></td>
					<td><b>Deletar</b></td>
					<td><b>Indice</b></td>
					<td><b>Nome</b></td>
					<td><b>Email</b></td>
					<td><b>Sexo</b></td>
					<td><b>Data de Nascimento</b></td>
				</tr>';
			while ($row = mysql_fetch_assoc($resultado)){
				//EXIBE OS DADOS NA TELA
				$arrayData2 = explode("-",$row["dataNascimento"]);//divide a estrutura em um array
				//lista o resultado
				echo '<tr>
						<td><a href="contato.php?sort=alcontato'.
										'&&edcon='.$row['id'].
										'&&edconN='.$row['nome'].
										'&&edconE='.$row['email'].
										'&&edconD='.$row['dataNascimento'].
										'">Edit</a></td>
						<td><a href="contato.php?sort=lcontato&&delcon=' . $row['id'] . '">Delete</a></td>
						<td>' . $row["id"] . '</td>
						<td>' . $row["nome"] . '</td>
						<td>' . $row["email"] . '</td>
						<td>' . $row["sexo"] . '</td>
						<td>' . $arrayData2[2]."/".$arrayData2[1]."/".$arrayData2[0]. '</td>
					  </tr>';
			}
			echo '</table>';
		}
	}
	public function alterar($indice){
		if($this->email != NULL) //Forca Validacao, se nao hover essa linha ele nao valida corretamente
		if($indice > 0){
			//alterar os valores dentro do DB
			$query = "UPDATE Contato
				  SET nome='$this->nome', email='$this->email', sexo='$this->sexo', dataNascimento='$this->dataNascimento'
				  WHERE id=$indice;
				  ";
			$resultado = mysql_query($query) or die("Query invalida: ".mysql_error());
			echo '<p class="sucess">Alteracao realizado com sucesso.</p>';
		} else {
			echo '<p class="error">Erro: nao foi possivel alterar o Contato.</p>';
		}
	}
	public function excluir($indice){
		if($indice > 0){
			//Exclue os valores dentro do DB que tiverem id=$indice
			$query = "DELETE FROM Contato
				  	  WHERE id=$indice;
				  	 ";
			$resultado = mysql_query($query) or die("Query invalida: ".mysql_error());
			echo '<p class="sucess">Exclusao realizado com sucesso.</p>';
		} else {
			echo '<p class="error">Erro: nao foi possivel excluir o Contato.</p>';
		}
	}
	//PLUS++ Relatorio dos aniversariantes do mes
	public function aniversariantesMes($buscaMes){
		//selecio os campors de uma tabela para posteriro tratamento
		$query = "SELECT id, nome, email, sexo, dataNascimento FROM Contato";
		$resultado = mysql_query($query,$this->conexao);
		
		if($resultado){
			echo '<h1>Listagem de Todos os Aniversariantes do mes '.$buscaMes.'</h1>';
			echo '<table align="center">';
			echo '<tr>
					<td><b>Editar</b></td>
					<td><b>Deletar</b></td>
					<td><b>Indice</b></td>
					<td><b>Nome</b></td>
					<td><b>Email</b></td>
					<td><b>Sexo</b></td>
					<td><b>Data de Nascimento</b></td>
				</tr>';
			while ($row = mysql_fetch_assoc($resultado)){
				//EXIBE OS ANIVERSARIANTES
				//Separa os campos da data em um array
				$arrayData = explode("-",$row["dataNascimento"]);
				if($arrayData[1]==$buscaMes){
					$arrayData2 = explode("-",$row["dataNascimento"]);//divide a estrutura em um array
					//lista o resultado
					echo '<tr>
							<td><a href="contato.php?sort=alcontato'.
										'&&edcon='.$row['id'].
										'&&edconN='.$row['nome'].
										'&&edconE='.$row['email'].
										'&&edconD='.$row['dataNascimento'].
										'">Edit</a></td>
							<td><a href="contato.php?sort=lcontato&&delcon=' . $row['id'] . '">Delete</a></td>
							<td>' . $row["id"] . '</td>
							<td>' . $row["nome"] . '</td>
							<td>' . $row["email"] . '</td>
							<td>' . $row["sexo"] . '</td>
							<td>' . $arrayData2[2]."/".$arrayData2[1]."/".$arrayData2[0] . '</td>
						  </tr>';
				}
			}
			echo '</table>';
		}
	}
}
