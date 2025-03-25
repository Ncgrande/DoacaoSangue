<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $emailUsuario = isset($_POST['email']) ? $_POST['email'] : null;

    if ($emailUsuario) {
      
        $de = rawurlencode("Nilson Caetano Grande");
        $assunto = rawurlencode("Carteira Digital de Doador de Sangue");
        $corpo = rawurlencode("Parabéns, sua Carteirinha chegou!");
        $para = rawurlencode($emailUsuario); 


        $endereco = "http://intranet.vidrolar.com/emailgenerico.php?from=$de&subject=$assunto&body=$corpo&to=$para";


        $envio = file_get_contents($endereco);

        echo '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Resultado do Envio</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
        <body class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa; text-align: center;">';

        if ($envio) {
            echo "<p class='fs-4 text-success'>E-mail enviado com sucesso para <b>$emailUsuario</b>.</p>";
        } else {
            echo "<p class='fs-4 text-danger'>Falha ao enviar o e-mail. Por favor, tente novamente.</p>";
        }

        echo '<a href="index.php" class="btn btn-warning mt-3">Voltar</a>';

        echo '
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
        </body>
        </html>';
    } else {
        echo '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Erro</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
        <body class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa; text-align: center;">
            <p class="fs-4 text-danger">Nenhum e-mail foi fornecido ou método inválido.</p>
            <a href="index.php" class="btn btn-warning mt-3">Voltar</a>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
        </body>
        </html>';
    }
}
?>
