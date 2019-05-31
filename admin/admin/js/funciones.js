function buscarPorNombre() {

    var nom = document.getElementById("nombre").value;
    if (nom == "") {
        document.getElementById("productos").innerHTML = "";
        if (window.XMLHttpRequest) {
            //code for actuar browsers
            xmlhttp = new XMLHttpRequest();
        } else {
            //code for old browsers
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue");
                document.getElementById("productos").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../controller/llenar_productos.php?nombre=",true);
        xmlhttp.send();
    } else {
        if (window.XMLHttpRequest) {
            //code for actuar browsers
            xmlhttp = new XMLHttpRequest();
        } else {
            //code for old browsers
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue");
                document.getElementById("productos").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../controller/buscar.php?nombre="+nom,true);
        xmlhttp.send();
    }
}
