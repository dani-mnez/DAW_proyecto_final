// Para el menú de la foto de perfil
if (document.getElementById("prof_wrap")) {
    let profile_pic = document.getElementById("prof_wrap"),
        prof_menu = document.getElementById("profile_pic_menu");

    profile_pic.addEventListener("mouseenter", () => {
        // position_menu()
        prof_menu.style.display = "block";
    });

    profile_pic.addEventListener("mouseleave", () => {
        prof_menu.style.display = "none";
    });
}

// Para abrir el menú de login y registro
// let access_btn = document.getElementById('access_btn')
// if (access_btn) {
//     // FIX El evento click solo va la primera vez - tiene que ver algo con el FETCH
// REV Al meter el onclick desde el HTML no da errores (pero no es tan recomendado como tener los eventos todos juntos en los JS)
//     access_btn.addEventListener('click', (e) => show_log_reg())
// }

// Para acceder a las páginas de detalle de producto
let product_cards = document.getElementsByClassName("product");

for (const prod of product_cards) {
    prod.addEventListener("click", () => {
        window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod.getAttribute(
            "data-id"
        )}`;
    });
}

let PAGE = document.getElementsByTagName("body")[0].getAttribute("data-page");

switch (PAGE) {
    case "index":
        break;
    case "shop":
        let prods = document.getElementsByClassName("product");

        for (const prod of prods) {
            prod.addEventListener("mouseover", (e) => {
                console.log(e.target);
            });
        }

        break;
    case "cart":
        break;

    default:
        break;
}
