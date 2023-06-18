function inicio () {

    //inicialización de variables


    const butcar = document.getElementById("butcar");
    const wishlist = document.getElementById("wishlist");
    const id = document.getElementById("idA").value;

    butcar.addEventListener('click', function () {

        const cantidad = document.getElementById("cantidad").value; 

        /* console.log(id + "/" + cantidad); */
        location.href =  "/add/" + id + "/" + cantidad;

    });

    wishlist.addEventListener('click', function () {
        location.href =  "/wishlist/" + id;
    });
    
}
window.onload = inicio;