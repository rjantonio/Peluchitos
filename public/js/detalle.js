function inicio () {

    //inicialización de variables


    const butcar = document.getElementById("butcar");
    const id = document.getElementById("idA").value;

    butcar.addEventListener('click', function () {

        const cantidad = document.getElementById("cantidad").value; 

        /* console.log(id + "/" + cantidad); */
        location.href =  "/add/" + id + "/" + cantidad;


    });
    
}
window.onload = inicio;