window.addEventListener('load', () => {
    let PAGE = document.getElementsByTagName('body')[0].getAttribute('data-page')

    if (PAGE == 'shop') {
        // Para el selector del menú lateral
        let side_menu_selector = document.getElementById('bkg_sel'),
            nav_elems = document.querySelectorAll('#side_menu a'),
            menu_TODO = document.getElementById('side_menu').getBoundingClientRect(),
            el_selector_extra = 10;

        let el_init = document.querySelector("#side_menu a:first-of-type").getBoundingClientRect();

        side_menu_selector.style.left = (el_init.left - menu_TODO.left - el_selector_extra/2) + 'px';
        side_menu_selector.style.top = (el_init.top - menu_TODO.top - el_selector_extra/2) + 'px';
        side_menu_selector.style.width = el_init.width + el_selector_extra + 'px';
        side_menu_selector.style.height = el_init.height + el_selector_extra + 'px';

        nav_elems.forEach(el => {
            el.addEventListener('click', () => {
                let el_info = el.getBoundingClientRect();

                side_menu_selector.style.left = (el_info.left - menu_TODO.left - el_selector_extra/2) + 'px';
                side_menu_selector.style.top = (el_info.top - menu_TODO.top - el_selector_extra/2) + 'px';
                side_menu_selector.style.width = el_info.width + el_selector_extra + 'px';
                side_menu_selector.style.height = el_info.height + el_selector_extra + 'px';
            });
        });
    }
});
