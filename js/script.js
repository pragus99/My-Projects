//element diambil
var keyword = document.getElementById("keyword");
var tombolcari = document.getElementById("tombol-cari");
var container = document.getElementById("container");

//buat event live search
keyword.addEventListener('keyup', function() {
    
    // live search ajax
    var ajx = new XMLHttpRequest();

    //cek kesiapan ajx
    ajx.onreadystatechange = function() {
        if( ajx.readyState == 4 && ajx.status == 200 ) {
            container.innerHTML = ajx.responseText;
        }
    }

    // jalankan ajax
    ajx.open("GET", "js/keluarga.php?keyword=" + keyword.value, true);
    ajx.send();

} );