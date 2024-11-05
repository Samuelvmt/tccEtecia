// Obter o modal
var modal = document.getElementById('id01');

// Quando o usuário clicar em qualquer lugar fora do modal, o modal será fechado
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
