<?

function pr($dado) {
    echo '<pre>';
    print_r($dado);
}

//CONEXAO
$PDO = new PDO('mysql:host=127.0.0.1;dbname=CRUD', 'root', '');

//INCLUIR
/*
  $pesIncluir = $PDO->prepare('INSERT INTO PESSOA (NOME) VALUES(:NOME)');
  $pesIncluir->execute(array(
  ':NOME' => 'Marcos Tolentino da Rosa'
  ));
 */

/*
  //ALTERAR
  $pesAlterar = $PDO->prepare('UPDATE PESSOA SET NOME = :NOME WHERE ID_PESSOA = :ID_PESSOA');
  $pesAlterar->execute(array(
  ':NOME' => 'Não é mais marcos tolentino',
  ':ID_PESSOA' => '1'
  ));
 */


//EXCLUIR
$pesAlterar = $PDO->prepare('DELETE FROM PESSOA WHERE ID_PESSOA = :ID_PESSOA');
$pesAlterar->execute(array(
    ':ID_PESSOA' => '1'
));


//LISTAR
$sql = "
    SELECT P.ID_PESSOA, 
           P.NOME AS PES_NOME
      FROM PESSOA P
";
$pesListar = $PDO->query($sql);
echo '<h1>Lista de pessoas</h1>';
while ($pes = $pesListar->fetch(PDO::FETCH_ASSOC)) {
    echo "$pes[ID_PESSOA] - $pes[PES_NOME]<br>";
}    