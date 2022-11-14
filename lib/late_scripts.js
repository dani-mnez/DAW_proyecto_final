// Para el menú de la foto de perfil
if (document.getElementById('prof_wrap')) {
    let profile_pic = document.getElementById('prof_wrap'),
        prof_menu = document.getElementById('profile_pic_menu')

    profile_pic.addEventListener('mouseenter', () => {
        // position_menu()
        prof_menu.style.display = 'block'
    })

    profile_pic.addEventListener('mouseleave', () => {
        prof_menu.style.display = 'none'
    })
}

// Para abrir el menú de login y registro
let access_btn = document.getElementById('access_btn')
access_btn.onclick = e => { // FIX Solo funciona la primera vez
    console.log(e.target)
    console.log('HOLA')
    show_log_reg()

    setTimeout(() => {  // REV Solución cutre
        // Para cerrar el menú de login y registro
        let close_login = document.getElementById('close_access_view')
        close_login.addEventListener("click", hide_log_reg)

        // Para cambiar de login a registro
        let reg_btn = document.getElementById('reg_btn')
        reg_btn.addEventListener("click", show_register)
    }, 1000)
}

// Para acceder a las páginas de detalle de producto
let product_cards = document.getElementsByClassName('product')

for (const prod of product_cards) {
    prod.addEventListener('click', () => {
        window.location = `/DAW_proyecto_final/templates/product_detail.php?id=${prod.getAttribute('data-id')}`
    })
}

// let PAGE = document.getElementsByTagName('body')[0].getAttribute('data-page')

// switch (PAGE) {
//     case 'index':

//         break;
//     case 'shop':
//         let prod_cont = document.getElementsByClassName('product')

//         for (const prod of prod_cont) {
//             prod.addEventListener('mouseenter', (e) => {
//                 console.log(e.relatedTarget)
//             })
//         }

//         break;
//     case 'cart':

//         break;

//     default:
//         break;
// }