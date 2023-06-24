// const inputElement = document.getElementById('clave');
// const resultadoElement = document.getElementById('resultado');

// inputElement.addEventListener('input', (event) => {
//     const texto = event.target.value; // Obtenemos el valor actual del campo de entrada
//     let mensajes = '';

//     // Validamos si el texto contiene letras mayúsculas, minúsculas o números
//     if (/[A-Z]/.test(texto)) {
//         mensajes += '<span class="verde">Mayúsculas <i class="fa fa-check" aria-hidden="true"></i></span><br>';
//     } else {
//         mensajes += '<span class="rojo">Mayúsculas <i class="fa fa-times" aria-hidden="true"></i></span><br>';
//     }
//     if (/[a-z]/.test(texto)) {
//         mensajes += '<span class="verde">Minúsculas <i class="fa fa-check" aria-hidden="true"></i></span><br>';
//     } else {
//         mensajes += '<span class="rojo">Minúsculas <i class="fa fa-times" aria-hidden="true"></i></span><br>';
//     }
//     if (/[0-9]/.test(texto)) {
//         mensajes += '<span class="verde">Números <i class="fa fa-check" aria-hidden="true"></i></span><br>';
//     } else {
//         mensajes += '<span class="rojo">Números <i class="fa fa-times" aria-hidden="true"></i></span><br>';
//     }
//     if (/\./.test(texto)) {
//         mensajes += '<span class="verde">Signo de puntuacion/punto <i class="fa fa-check" aria-hidden="true"></i></span><br>';
//     } else {
//         mensajes += '<span class="rojo">Signo de puntuacion/punto <i class="fa fa-times" aria-hidden="true"></i></span><br>';
//     }
//     if (texto.length >= 8) {
//         mensajes += '<span class="verde">8 caracteres <i class="fa fa-check" aria-hidden="true"></i></span><br>';
//     } else {
//         mensajes += '<span class="rojo">8 caracteres <i class="fa fa-times" aria-hidden="true"></i></span><br>';
//     }

//     // if(/[A-Z]/.test(texto) && /[a-z]/.test(texto) && /[0-9]/.test(texto) && /\./.test(texto) && texto.length >= 8){
//     //     mensajes = "";
//     // }

//     resultadoElement.innerHTML = mensajes;
// });