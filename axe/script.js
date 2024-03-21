document.getElementById("userForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    
    var formData = new FormData(this);
    
    fetch("process_user.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("message").innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});
