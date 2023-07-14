<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $horasTotais = $_POST["horasTotais"];
    $horasAssistidas = $_POST["horasAssistidas"];
    $horasFaltadas = $_POST["horasFaltadas"];

    $totalAulas = floor($horasTotais / 3.5); // Total de aulas do curso
    $aulasAssistidas = floor($horasAssistidas / 3.5); // Aulas já assistidas
    $aulasFaltadas = floor($horasFaltadas / 3.5); // Aulas faltadas

    $porcentagemFaltas = ($aulasFaltadas / $totalAulas) * 100; // Porcentagem de faltas
    $porcentagemFaltas = number_format($porcentagemFaltas, 2); // Reduz para 2 casas decimais
    $porcentagemFaltas = rtrim($porcentagemFaltas, '0'); // Remove zeros à direita (caso haja)
    $porcentagemFaltas = rtrim($porcentagemFaltas, '.'); // Remove o ponto decimal se não houver casas decimais

    $aulasPermitidas = floor(($totalAulas * 0.25) - $aulasFaltadas); // Faltas disponivels :P
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#eee">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cálculo de Frequências</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
        .instructions {
            background-color: #f5f5f5;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
        }
    </style>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body style="background-color: #eee">
    <div class="jumbotron">
        <div class="container">
            <h1>Cálculo de Frequências</h1>
            <h3 class="hidden-xs" style="color: gray">Esse é um site para ajudar alunos do SENAC a se organizar com as faltas</h3>

            <form method="post" action="calculadora.php" class="row">
                <div class="col-sm-4 col-xs-12" style="margin-top: 30px;">
                    <p>Horas totais do curso</p>
                    <input type="number" class="form-control" placeholder="Horas totais do curso" name="horasTotais" aria-describedby="basic-addon1">
                </div>

                <div class="col-sm-4 col-xs-12" style="margin-top: 30px;">
                    <p>Horas assistidas</p>
                    <input type="number" class="form-control" placeholder="Horas assistidas" name="horasAssistidas" aria-describedby="basic-addon1">
                </div>

                <div class="col-sm-4 col-xs-12" style="margin-top: 30px;">
                    <p>Horas faltadas</p>
                    <input type="number" class="form-control" placeholder="Horas faltadas" name="horasFaltadas" aria-describedby="basic-addon1">
                </div>

                <div class="container text-center" style="margin-top: 20px;">
                    <button class="btn btn-primary" type="submit">Calcular</button>
                </div>
            </form>

            <?php if (isset($porcentagemFaltas)) { ?>
                <div class="container text-center" style="margin-top: 30px;">
                    <h2>Resultados</h2>
                    <p>Porcentagem de faltas: <?php echo $porcentagemFaltas; ?>%</p>
                    <p>Aulas assistidas: <?php echo $aulasAssistidas; ?></p>
                    <p>Aulas faltadas: <?php echo $aulasFaltadas; ?></p>
                    <p>Faltas disponíveis para usar: <?php echo $aulasPermitidas; ?></p>
                </div>
            <?php } ?>
        </div>

        <div class="container">
            <h5>Desenvolvido por Adriel Rodrigues <a href="https://github.com/nokfromdfuture" target="_blank">Github</a>, <a href="https://twitter.com/Devadevam_" target="_blank">Twitter</a></h5>
        </div>
    </div>

    <div class="container instructions">
        <h2>Instruções de Uso</h2>
        <p>Visite o portal do aluno na aba Frequencia para obter as informações necessárias para o cálculo.</p>
        <p>Insira o total de horas do curso no campo "Horas totais do curso".</p>
        <p>Insira a quantidade de aulas já assistidas no campo "Horas assistidas".</p>
        <p>Insira a quantidade de horas faltadas no campo "Horas faltadas", caso possua.</p>
        <p>Clique no botão "Calcular" para obter o resultado.</p>
    </div>

</body>
</html>
