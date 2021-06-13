document.addEventListener('DOMContentLoaded', function(){

    eventListeners();
    darkMode();

});

function darkMode(){

    // chrome://flags/#enable-force-dark
    const prefieresDarkMode = window.matchMedia("{prefers-color-scheme: dark}");
    prefieresDarkMode.matches = true ? document.body.classList.add('dark-mode'):document.body.classList.remove('dark-mode'); 

    // prefieresDarkMode.addEventListener('change', function(){
    //     prefieresDarkMode.matches = true ? document.body.classList.add('dark-mode'):document.body.classList.remove('dark-mode'); 
    // })

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');

        //Para que el modo elegido se quede guardado en local-storage
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('modo-oscuro','true');
        } else {
            localStorage.setItem('modo-oscuro','false');
        }
    });

    if (localStorage.getItem('modo-oscuro') === 'true') {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive)
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

