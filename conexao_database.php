<?php
require 'vendor/autoload.php'; //conecta/linka com a biblioteca do MPDF, vulgo o carinha que gera o PDF

//DADOS PARA A CONEXÃO COM O BANCO DE DADOS
$host = 'localhost:3306'; //o certo é usar o IP do servidor, mas como é local, então colocamos como "localhost"
$dbname = 'biblioteca'; //qual é o nome do banco de dados a ser acessado
$username = 'root'; //qual o nome do usuario que pode acessar o banco, o "root" é a ADM, nunca use a não ser que o sistema seja pro ADM
$password = 'HORTETEC_115'; //qual a senha do banco??????????, isso se aplica a somente a ETEC, em casa ai depende de qual a senha do seu banco de dados
try{
//CONEXÃO COM O BANCO DE DADOS USANDO O PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); //instancia a classe PDO para a conexão com o banco
//lembre-se que o bloco para fazer o try...catch funcionar. 
/*try entra o código possivel de dar erro e o 
catch o codigo que serve para solucionar o erro 
e o finally só obriga o catch a funcionar, resumindo, lembre-se do Hemerson e de como o JavaScript te dá dor de cabeça*/
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Consulta o SQL em busca das informaçoes dos livros
$query = "SELECT titulo,autor,ano_publicacao,resumo FROM livros";
$stmt = $pdo->prepare($query);
$stmt->execute();

//Recupera os dados dos livros presentes no SQL
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

//instancia o Mpdf
$mpdf = new \Mpdf\Mpdf();

//Conteudo PDF
$html = '<h1>Bibliote-Lista de Livros</h1>
<table border="1" cellpadding="10" cellspacing="0" width"100%">
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Ano de Publicação</th>
        <th>Resumo</th>
    </tr>';

//Alimenta a tabela com os dados do SQL
foreach($livros as $livro){
    $html.='<tr>';
    $html.='<td>'.htmlspecialchars($livro['titulo']).'</td>';
    $html.='<td>'.htmlspecialchars($livro['autor']).'</td>';
    $html.='<td>'.htmlspecialchars($livro['ano_publicacao']).'</td>';
    $html.='<td>'.htmlspecialchars($livro['resumo']).'</td>';
    $html.='</tr>';
}
} catch (PDOException $e) {
    echo "Erro na conexão com o Banco de Dados:". $e->getMessage();
} catch (\Mpdf\MpdfException $e) {
    echo "Erro ao gerar o PDF:". $e->getMessage();
}
//fecha a tabela
$html.='</table>';

//Escreve o conteudo o HTMl no PDF
$mpdf->WriteHTML($html);
/*Gera o PDF
$mpdf->Output();*/

//Gera o PDF e força o Download
$mpdf->Output('lista_de_livros',\Mpdf\Output\Destination::DOWNLOAD);

?>