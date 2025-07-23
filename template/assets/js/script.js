const inputBox = document.getElementById("input-box");
const listContainer = document.getElementById("list-container");

// Função para adicionar uma nova tarefa
function addTask() {
    if (inputBox.value === '') {
        alert("Você deve escrever algo!");
    } else {
        let li = document.createElement("li");
        li.innerHTML = inputBox.value;

        // Cria o botão de exclusão (X)
        let span = document.createElement("span");
        span.innerHTML = "\u00D7"; // Símbolo de multiplicação (X)
        li.appendChild(span);

        listContainer.appendChild(li);
    }

    inputBox.value = "";
    saveData();
}

// Evento para marcar/desmarcar ou excluir tarefas
listContainer.addEventListener("click", function (e) {
    if (e.target.tagName === "LI") {
        e.target.classList.toggle("checked");
        saveData();
    } else if (e.target.tagName === "SPAN") {
        e.target.parentElement.remove();
        saveData();
    }
}, false);

// Salva a lista no Local Storage
function saveData() {
    localStorage.setItem("data", listContainer.innerHTML);
}

// Carrega a lista salva ao abrir a página
function showTask() {
    listContainer.innerHTML = localStorage.getItem("data") || "";
}

showTask();