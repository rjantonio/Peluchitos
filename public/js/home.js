function inicio () {

    //inicialización de variables

    /* var item = document.getElementById('lista');

    item.addEventListener('click', function () {
        //console.log(item);
    }); */

    const lista = document.getElementById("lista");
    for (const child of lista.children) {
        child.addEventListener('click', function () {
            var valor = child.getAttribute('value');
            console.log(valor);

            if (valor == 'nuevoitem') {
                window.location.href = "/nuevoitem";
            } else {
                window.location.href = "/detalle/"+valor;
            }
    })
}

}
window.onload = inicio;