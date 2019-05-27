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