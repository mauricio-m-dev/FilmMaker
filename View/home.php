<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FilmTracker</title>
  <link rel="stylesheet" href="../template/assets/css/home.css">
</head>
<body>
  <div class="container">
    <div class="todo-app">
      
      <!-- Barra de Cabeçalho -->
      <div class="header-bar">
        <h2>FilmTracker</h2>
        <img src="../template/assets/img/perfil.png" alt="Foto de Perfil" class="profile-pic">
      </div>

      <!-- Campo de Entrada -->
      <div class="row">
        <input type="text" id="input-box" placeholder="Adicione aqui">
        <button onclick="addTask()">Adicionar</button>
      </div>

      <!-- Lista de Tarefas -->
      <ul id="list-container">
        <!-- Exemplo:
        <li class="checked">Tarefa 1</li>
        <li>Tarefa 2</li>
        <li>Tarefa 3</li>
        -->
      </ul>

    </div>
  </div>
  
  <script src="../template/assets/js/script.js"></script>
</body>
</html>
