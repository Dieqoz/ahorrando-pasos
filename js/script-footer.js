//------------- INICIO DE FUNCIONALIDAD DESPLEGAR MENU CON NOSOTROS-------
let menUs = document.getElementById('menu-us');

function toggleUs(a) {
    if (a == 1) {
        menUs.style.display = 'flex';
    }
}
function closeUs(a) {
    if (a == 0) {
        menUs.style.display = 'none';
    }
}
//------------- FIN DE FUNCIONALIDAD DESPLEGAR MENU CON NOSOTROS----------