
//visualizar imagen al cargarla
const image = document.getElementById("imgPrevisualizacion");
input = document.getElementById("uploadedfile");

input.addEventListener("change", () => {
    image.src = URL.createObjectURL(input.files[0]);
});

//nombre de la imagen seleccionada
const imgInput = document.getElementById('uploadedfile');
const impName = document.getElementById('textoImg');

imgInput.addEventListener('change', (event) => {
    const selectedImg = event.target.files[0];

    // Actualizar el contenido del párrafo con el nombre del archivo
    impName.textContent = selectedImg ? selectedImg.name : "No se ha seleccionado ningún archivo.";
});