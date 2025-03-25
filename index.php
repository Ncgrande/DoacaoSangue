<?php
session_start();
require_once __DIR__ . '/config/db.php';

$database = new Database();
$conn = $database->getConnection();
$loginError = ""; 


if (isset($_SESSION['login'])) {
    header('location: ./app/views/logado.php'); 
    exit;
}

if (isset($_POST['login'])) {
    
    if (!empty($_POST['cpf']) && !empty($_POST['datanascimento'])) {
        $cpf = $_POST['cpf'];
        $datanascimento = $_POST['datanascimento'];

        
        $stmt = $conn->prepare("SELECT * FROM `doadores` WHERE `cpf` = ? AND `data_nascimento` = ?");
        $stmt->bind_param("ss", $cpf, $datanascimento);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $loginError = "Login ou senha inválido!";
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['login'] = $row['cpf'];
            header('location: ./app/views/logado.php'); 
            exit;
        }

        $stmt->close();
    } else {
        $loginError = "Por favor, preencha todos os campos!";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doe Sangue</title>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./app/views/css/index.css">
</head>
<body>
    <header class="header">
        <div class="container header__container">
            <div class="header__logo">
                <a class="navbar-brand" href="#"><img src="app/views/images/logo.png" alt="Logo" /></a>
            </div>
            
           
            <nav class="header__menu">
                <ul class="menu">
                    <li class="menu__item"><a class="menu__link" href="./app/views/requisitos.html">Requisitos para Doação</a></li>
                    <li class="menu__item"><a class="menu__link" href="./app/views/quemsomos.html">Quem Somos</a></li>
                    <li class="menu__item"><a class="menu__link" href="./app/views/ondedoar.html">Onde Doar</a></li>
                    <li class="menu__item"><a class="menu__link" href="./app/views/contato.html">Contato</a></li>
                </ul>
            </nav>
            
           
            <div class="header__button d-flex align-items-center">
                
                <a class="btn btn-outline-light me-3 mb-0" href="./app/views/cadastro.php">Cadastre-se</a>
                
                <div class="dropdown">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Logar
                    </button>
                    <form class="dropdown-menu p-4" method="post" action="">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" required>
                        </div>
                        <div class="mb-3">
                            <label for="datanascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" name="datanascimento" id="datanascimento" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Entrar</button>
                    </form>
                    
                    
                    <?php if ($loginError): ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $loginError; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

      <section class="carousel">
        <div
          id="carouselExampleAutoplaying"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="app/views/images/imagem1.jpg"
                class="d-block w-100"
                alt="Imagem 1"
              />
            </div>
            <div class="carousel-item">
              <img
                src="app/views/images/imagem2.jpg"
                class="d-block w-100"
                alt="Imagem 2"
              />
            </div>
            <div class="carousel-item">
              <img
                src="app/views/images/imagem3.jpg"
                class="d-block w-100"
                alt="Imagem 3"
              />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
          </button>
        </div>
      </section>

      <section class="section-doador">
        <div class="container section-doador__container">
          <div class="section-doador__image">
            <img
              src="app/views/images/carteirinha.jpg"
              class="img-fluid"
              alt="Carteirinha"
            />
          </div>
          <div class="section-doador__content">
            <h1 class="section-doador__title">Carteira de Doador</h1>
            <p class="section-doador__text">
              Incentivar a doação de sangue voluntária, captar mais doadores e
              conscientizar a população sobre a importância de manter os
              estoques de sangue em níveis seguros. Esses são alguns de nossos
              objetivos.
            </p>
            <p class="section-doador__text">
              SEJA UM DOADOR – A doação de sangue é totalmente voluntária e,
              para doar, é necessário ter entre 16 e 69 anos; pesar mais de 50
              quilos e estar em bom estado de saúde. O candidato deve estar
              descansado, não ter ingerido bebidas alcoólicas nas 12 horas
              anteriores à doação e não estar em jejum. No dia da doação, é
              imprescindível levar documento de identidade com foto.
              <br /><br />
              Para os menores de 18 anos, é necessário autorização do
              responsável legal. Entre 60 e 69 anos, a pessoa só poderá doar se
              já o tiver feito antes dos 60 anos. Os homens podem doar a cada
              dois meses e, no máximo, quatro doações ao ano. Mulheres podem
              doar a cada três meses, com no máximo três doações anuais.
              <br /><br />
              No dia da doação não é necessário jejum. O doador precisa fazer um
              repouso mínimo de seis horas na noite anterior à doação, não
              ingerir bebidas alcoólicas nas 12 horas anteriores, evitar fumar
              por pelo menos duas horas antes e depois da doação e evitar
              ingerir alimentos gordurosos.
            </p>
            <p class="section-doador__text">
              Carteira do Doador: Carteirinha virtual com informações de saúde,
              tipo sanguíneo e a data da última doação. Fornece um registro
              pessoal e útil em situações de emergência.
            </p>
            <div class="section-doador__button">
              <a class="btn btn-outline-light" href="app/views/carteirinha.html"
                >Leia Mais</a>
            </div>
          </div>
        </div>
      </section>

      <section class="section-imagens">
        <div class="container p-3">
          <div class="row">
            <div class="col">
              <img
                class="img-fluid img-thumbnail"
                src="app/views/images/doadora.jpg"
                alt="Doadora 1"
              />
            </div>
            <div class="col">
              <img
                class="img-fluid img-thumbnail"
                src="app/views/images/doadora2.jpg"
                alt="Doadora 2"
              />
            </div>
            <div class="col">
              <img
                class="img-fluid img-thumbnail"
                src="app/views/images/doadora3.jpg"
                alt="Doadora 3"
              />
            </div>
          </div>
        </div>
      </section>
      <footer class="footer">
        <p class="footer__text">hemouni@email.com</p>
      </footer>
    </div>
  </body>
</html>
