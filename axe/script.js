// Escuchar el evento submit para el formulario de usuario
document.getElementById("userForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    
    var formData = new FormData(this);
    
    fetch("process_user.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("userMessage").innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});

// Escuchar el evento submit para el formulario de comunidad
document.getElementById("communityForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    
    var formData = new FormData(this);
    
    fetch("process_community.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("communityMessage").innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});
