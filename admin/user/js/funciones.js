function status(elemnt) {
    console.log('hola')
    var sel = document.getElementById("selectStatus");
    var text = sel.options[sel.selectedIndex].text;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest()
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tableHistory").innerHTML = this.responseText
        }
    };
    xmlhttp.open("GET", "../controller/status.php?idx=" + text, true)
    xmlhttp.send()
}