const inputBox = document.getElementById("input-box");
const listContainer = document.getElementById("list-container1");

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




