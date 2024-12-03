var modal = document.getElementById("myModal");
var openModal = document.getElementById("openModal");
var closeModal = document.getElementById("closeModal");
openModal.onclick = function() {
    modal.style.display = "block";
}
closeModal.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}