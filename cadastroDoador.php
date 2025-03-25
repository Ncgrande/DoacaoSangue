<?php
// Requer os arquivos necessários
require_once 'app/controllers/doadorController.php';

// Cria uma instância do controlador
$controller = new doadorController();

// Chama o método de cadastro do controlador e captura a resposta
$response = $controller->cadastrar();

if (isset($response)): ?>
    <div class="alert alert-<?php echo $response['status'] === 'success' ? 'success' : 'danger'; ?>" role="alert">
        <?php echo $response['message']; ?>
    </div>
<?php endif;
?>

