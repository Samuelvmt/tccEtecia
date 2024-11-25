// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

// Get the modal
var modals = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modals) {
        modal.style.display = "none";
    }
}
