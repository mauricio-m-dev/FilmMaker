<?php
session_start();
require_once '../vendor/autoload.php';

use Controller\FilmController;
use Controller\UserController;

// Protege a página: redireciona se não estiver logado
if (!isset($_SESSION['id'], $_SESSION['user_fullname'], $_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['id'];
$user_fullname = $_SESSION['user_fullname'];
$email = $_SESSION['email'];

$filmController = new FilmController();
$userController = new UserController();

$userInfo = $userController->getUserData($user_id, $user_fullname, $email);

// Tratamento do POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['filme']) && !empty(trim($_POST['filme']))) {
        $filme = trim($_POST['filme']);
        $filmController->CreateFilm($filme, $user_id);

        header("Location: home.php");
        exit();
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    if (isset($_POST['delete_film'])) {
        $film_id = $_POST['delete_film'];
        $filmController->deletarFilme($film_id, $user_id);

        header("Location: home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FilmTracker</title>
  <link rel="stylesheet" href="../template/assets/css/home.css" />
</head>
<body>
  <div class="container">
    <header class="top-header">
      <h2>FilmTracker</h2>
    </header>

    <div class="todo-app">
      <div class="header-bar">
        <h2>Olá, <span class="user-name"><?= htmlspecialchars($user_fullname); ?></span></h2>

        <form method="POST" action="home.php" class="logout-form">
          <button type="submit" name="logout" class="logout-btn" title="Sair">
            <img src="../template/assets/img/exit.webp" alt="Sair" />
          </button>
        </form>
      </div>

      <!-- Campo de Entrada -->
      <form method="POST" action="home.php" class="row">
        <input 
          type="text" 
          id="input-box" 
          name="filme" 
          placeholder="Adicione aqui" 
          required 
          autocomplete="off"
        />
        <button type="submit">Adicionar</button>
      </form>

      <!-- Lista de Filmes -->
      <ul id="list-container1">
        <?php
          $filmes = $filmController->getFilmesDoUsuario($user_id);
          foreach ($filmes as $filme) {
              echo "<li class='before'>" . htmlspecialchars($filme['filme']) .
                   "<form method='POST' class='remove-form' style='margin:0;'>
                      <input type='hidden' name='delete_film' value='" . (int)$filme['id'] . "' />
                      <button type='submit' class='remove-btn' title='Remover filme'>X</button>
                    </form>
                  </li>";
          }
        ?>
      </ul>
      
    </div>
  </div>

  <script src="../template/assets/js/script.js"></script>
</body>
</html>
