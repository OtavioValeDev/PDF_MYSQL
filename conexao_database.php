<?php
require 'vendor/autoload'; //conecta/linka com a biblioteca do MPDF, vulgo o carinha que gera o PDF

//DADOS PARA A CONEXÃO COM O BANCO DE DADOS
$host = 'localhost'; //o certo é usar o IP do servidor, mas como é local, então colocamos como "localhost"
$dbname = 'biblioteca'; //qual é o nome do banco de dados a ser acessado
$username = 'root'; //qual o nome do usuario que pode acessar o banco, o "root" é a ADM, nunca use a não ser que o sistema seja pro ADM
$password = 'ETEC_2024'; //qual a senha do banco??????????, isso se aplica a somente a ETEC, em casa ai depende de qual a senha do seu banco de dados

//CONEXÃO COM O BANCO DE DADOS USANDO O PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); //instancia a classe PDO para a conexão com o banco
//lembre-se que o bloco para fazer o try...catch funcionar. 
/*try entra o código possivel de dar erro e o 
catch o codigo que serve para solucionar o erro 
e o finally só obriga o catch a funcionar, resumindo, lembre-se do Hemerson e de como o JavaScript te dá dor de cabeça*/
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
