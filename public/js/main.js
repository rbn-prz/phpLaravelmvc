
let campo = document.querySelector('input[name="prdImagen"]');
let label = document.querySelector('.custom-file-label');

campo.addEventListener( 'change', cambiarTexto );
function cambiarTexto()
{
    let prod = campo.value.split('\\'); 
    label.innerText = prod.slice(-1);

    /* label.innerText = campo.value; */
}