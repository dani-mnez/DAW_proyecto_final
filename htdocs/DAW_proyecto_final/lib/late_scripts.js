// Para el menú de la foto de perfil
if (document.getElementById('prof_wrap')) {
    let profile_pic = document.getElementById('prof_wrap'),
        prof_menu = document.getElementById('profile_pic_menu'),
        extra_space = 10

    profile_pic.addEventListener('mouseenter', () => {
        // position_menu()
        prof_menu.style.display = 'block'
    })

    profile_pic.addEventListener('mouseleave', () => {
        prof_menu.style.display = 'none'
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