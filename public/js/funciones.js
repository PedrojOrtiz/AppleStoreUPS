function openWindow() {
    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "flex"
}

function cluseWindow() {
    let windowFloat = document.getElementById("floatWindow")
    windowFloat.style.display = "none"
}
//PENDIENTE
function elemento(e) {
    let elements = document.getElementById('valoration')

    for (let i = 0; i < elements.length; i++) {
        console.log(elements[i].srcElement)

    }

    if (e.srcElement)
        tag = e.srcElement.tagName;
    else if (e.target)
        tag = e.target.tagName;
    //console.log("El elemento selecionado ha sido " + tag);
}

function stock(elemnt) {
    //console.log(elemnt.selectedIndex)
    //console.log(text)
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("stok").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/stock.php?idx=" + (elemnt.selectedIndex + 1), true)
    xmlhttp.send()
}

function searchBtn(url) {
    //console.log('hola')
    let txtSearch = document.getElementById('search').value
    txtSearch = txtSearch.toUpperCase()
    window.location.href = url + '?searchName=' + txtSearch
}

function searchBox(elemnt) {
    let text = elemnt.value.trim()
    text = text.toUpperCase()
    //console.log(text)
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("contentCards").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/search.php?searchName=" + text, true)
    xmlhttp.send()
}

function cartAdd(cod) {
    //console.log(cod)
    //console.log(precioTotal)
    let storeId = (document.getElementById('selectStore').selectedIndex + 1)
    //console.log("IDX STORE" + storeId)

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            carNot()
            if (document.getElementById("cartAdd") === null) {
                document.body.innerHTML += this.responseText
            } else {
                openWindowCart()
            }
            //document.getElementById('body').innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/cartAdd.php?codProd=" + cod + "&storeID=" + storeId, true)
    xmlhttp.send()
}

function openWindowCart() {
    let windowFloat = document.getElementById("cartAdd")
    windowFloat.style.display = "flex"
}

function cluseWindowCart() {
    let windowFloat = document.getElementById("cartAdd")
    windowFloat.style.display = "none"
}

function prodValoration(elemnt, prodID) {
    let rat = elemnt.value
    //console.log(rat)
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("clasificacion").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/rat.php?rat=" + rat + "&prodID=" + prodID, true)
    xmlhttp.send()
}

var imag = []
var indice = 0

function galeria(img, i) {
    //console.log(img)
    imag[i] = img
}

function cambiarImagen(int) {

    if (int == 1) {
        if (indice < imag.length - 1) {
            indice++
        } else {
            indice = 0
        }
    } else {
        if (indice > 0) {
            indice--
        } else {
            indice = 0
        }
    }
    document.getElementById("galeria").src = imag[indice]
}

function cartDelete(carId) {

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cartUpdatePrice()
            carNot()
            document.getElementById("cart").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/cartRemove.php?carId=" + carId, true)
    xmlhttp.send()
}
function cartUpdatePrice() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("buydetall").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/updatePrice.php", true)
    xmlhttp.send()
}

function carNot(url) {

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log('Notificacion')
            document.getElementById("fa-shopping-cart").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", url, true)
    xmlhttp.send()
}
