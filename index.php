<?

//PRINT_RP
function pr($dado) {
    echo '<pre>';
    print_r($dado);
}

//CONEXAO
$PDO = new PDO('mysql:host=127.0.0.1;dbname=CRUD', 'root', '');

//INCLUIR
if (@$_POST['ACAO'] == 'Incluir') {
    $pesIncluir = $PDO->prepare('INSERT INTO PESSOA (NOME) VALUES(:NOME)');
    $pesIncluir->execute(array(
        ':NOME' => $_POST['NOME']
    ));
}
//ALTERAR
elseif (@$_POST['ACAO'] == 'Alterar') {
    $pesAlterar = $PDO->prepare('UPDATE PESSOA SET NOME = :NOME WHERE ID_PESSOA = :ID_PESSOA');
    $pesAlterar->execute(array(
        ':NOME' => $_POST['NOME'],
        ':ID_PESSOA' => $_POST['ID_PESSOA']
    ));
}
//EXCLUIR
elseif (@$_GET['ACAO'] == 'Excluir') {
    $pesAlterar = $PDO->prepare('DELETE FROM PESSOA WHERE ID_PESSOA = :ID_PESSOA');
    $pesAlterar->execute(array(
        ':ID_PESSOA' => $_GET['ID_PESSOA']
    ));
}
?>

<center>
    <table border="1" style="min-width: 500px">
        <tr style=" vertical-align: top">
            <td style="text-align: right;">
                <h1 style="text-align: center">Listar Pessoas</h1> 

                <?
                $sql = "
                    SELECT ID_PESSOA, 
                           NOME
                      FROM PESSOA
                  ORDER BY NOME
                ";
                $pessoaQuery = $PDO->query($sql);
                $pessoaArray = [];
                while ($pessoaFetch = $pessoaQuery->fetch(PDO::FETCH_ASSOC)) {
                    $pessoaArray[$pessoaFetch['ID_PESSOA']] = $pessoaFetch;
                    echo "$pessoaFetch[ID_PESSOA] - $pessoaFetch[NOME]";
                    ?>
                    <form style="display: inline">
                        <input name="ID_PESSOA" value="<?= @$pessoaFetch[ID_PESSOA] ?>" hidden>
                        <input name="ACAO" value="Alterar" type="submit">
                        <input name="ACAO" value="Excluir" type="submit">
                    </form>
                    <hr>
                    <?
                }
                $pessoaAlterar = @$pessoaArray[@$_GET['ID_PESSOA']];
                $acaoDescricao = ($pessoaAlterar ? 'Alterar' : 'Incluir');
                ?>
            </td>
            <td style="text-align: center;">
                <h1><?= $acaoDescricao ?> Pessoa</h1> 
                <form method="POST">
                    <input name="ID_PESSOA" value="<?= $pessoaAlterar['ID_PESSOA'] ?>" hidden>
                    <input name="NOME" value="<?= $pessoaAlterar['NOME'] ?>" maxlength="100" required><br>
                    <input name="ACAO" value="<?= $acaoDescricao ?>" type="submit">
                </form>
            </td>
        </tr>
    </table>
</center>
