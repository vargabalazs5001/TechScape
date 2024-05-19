function addProduct() {
    const formData = new FormData(document.getElementById('productForm'));

    fetch('feltolt.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // A szerver válaszának kezelése (például: alert(data);)
        console.log(data);
    })
    .catch(error => console.error('Hiba történt:', error));
}

function modosit(id){
    location.href="edit_product.php?id=" + id;
}

function torol(id){
    if(confirm("Biztosan törli?")){
        location.href="delete_product.php?id=" + id;
    }
}
