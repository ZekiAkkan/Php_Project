function sepeteEkle(urunID) {
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            console.log(this.responseText);
        }
    };
    xhr.open("POST", "urunsepet_ajax.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("urunID=" + urunID + "&action=ekle");
}