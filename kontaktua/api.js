function mezuaBidali() {
    if (document.getElemententById("izena").value == "" || documentById("mezua").value == "") {
        alert("Eremu guztiak bete beha dira");
    } else {
        httpRequest = new XMLHttpRequest();

        httpRequest.open("POST", "index.php", true);
        httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4) {
                if(httpRequest.status == 200) {
                    document.getElemententById('mezua').innerHTML = this.responseText;
                } else {
                    alert("Arazoa komunikazioan: " + this.statusText);
                }
            }
        }

        httpRequest.send("id=" + document.getElemententById('id').value 
        + "$izena=" + document.getElemententById('izena').value
        + "$email=" + document.getElemententById('email').value
        + "$mezua=" + document.getElemententById('mezua').value)
    }
}