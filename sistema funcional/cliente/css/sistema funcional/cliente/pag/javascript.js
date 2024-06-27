function to_bebidas() {
    document.getElementById("bebidas").style.display = "block";
    document.getElementById("platos").style.display = "none";
    document.getElementById("postres").style.display = "none";
}

function to_platos() {
    document.getElementById("bebidas").style.display = "none";
    document.getElementById("platos").style.display = "block";
    document.getElementById("postres").style.display = "none";
}

function to_postres() {
    document.getElementById("bebidas").style.display = "none";
    document.getElementById("platos").style.display = "none";
    document.getElementById("postres").style.display = "block";
}

function mostrar(opcion) {
    let el = document.getElementsByClassName("overall-view");
    for (let i = 0; i < el.length; i++) {
        el[i].style.display = "none";
    }
    document.getElementById(opcion).style.display = "block";
}
