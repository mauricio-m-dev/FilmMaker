<?php
require_once '../vendor/autoload.php';

use Controller\UserController;

$userController = new UserController();

$registerUserMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_fullname'], $_POST['email'], $_POST['password'])) {
        $user_fullname = trim($_POST['user_fullname']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if ($userController->checkUserByEmail($email)) {
            $registerUserMessage = "E-mail já cadastrado.";
            echo "<script>alert('Email já cadastrado');</script>";
        } else {
            if ($userController->createUser($user_fullname, $email, $password)) {
                header('Location: ../index.php');
                exit();
            } else {
                $registerUserMessage = "Erro ao cadastrar usuário.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    />
    <!-- Google Fonts: Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
        rel="stylesheet"
    />
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../template/assets/css/cadastro.css" />
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <main class="form-container shadow-sm rounded-4 bg-white p-4">
        <form action="cadastro.php" method="POST" novalidate>
            <h2 class="mb-4 text-center fw-semibold minimal-title">Criar Conta</h2>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control minimal-input"
                    id="floatingName"
                    placeholder="Seu nome"
                    autocomplete="name"
                    name="user_fullname"
                    required
                />
                <label for="floatingName">Nome</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="email"
                    class="form-control minimal-input"
                    id="floatingInput"
                    placeholder="seu-email@gmail.com"
                    autocomplete="username"
                    name="email"
                    required
                />
                <label for="floatingInput">E-mail</label>
            </div>

            <div class="form-floating mb-4">
                <input
                    type="password"
                    class="form-control minimal-input"
                    id="floatingPassword"
                    placeholder="Senha"
                    autocomplete="new-password"
                    name="password"
                    required
                />
                <label for="floatingPassword">Senha</label>
            </div>

            <button class="w-100 btn btn-minimal mb-3" type="submit">Cadastrar</button>

            <div class="text-center mt-2">
                <span class="text-muted">Já tem uma conta?</span>
                <a href="../index.php" class="cadastro-link ms-1">Entrar</a>
            </div>
        </form>
    </main>
</body>
</html>
