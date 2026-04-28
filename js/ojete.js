document.querySelector("#ojo").addEventListener("click", ver);

function ver() {

    let input = document.querySelector("#password");
    let icono = document.querySelector("#ojo");
    let estado = input.getAttribute("type");

    if (estado == "password") {
        input.setAttribute("type", "text");
        icono.setAttribute("src", "../img/ojo.png");
    } else {
        input.setAttribute("type", "password");
        icono.setAttribute("src", "../img/ojo_cerrado.png");
    }
}