// Ez a függvény megvizsgálja, hogy a felhasználó be van-e jelentkezve, és ha nem, akkor megnyit egy bejelentkezési űrlapot.
function openPaymentPopup() {
    var isLoggedIn = document.body.getAttribute('data-isloggedin') === 'true';
    var inputFields = document.querySelectorAll('.input-container input');

    // Ha a felhasználó be van jelentkezve, adjuk hozzá a required attribútumot
    if (isLoggedIn) {
        inputFields.forEach(function(input) {
            input.setAttribute('required', 'required');
        });
    } else {
        // Ha a felhasználó nincs bejelentkezve, távolítsuk el a required attribútumot
        inputFields.forEach(function(input) {
            input.removeAttribute('required');
        });
    }

    if (!isLoggedIn) {
        // Ha a felhasználó nincs bejelentkezve, jelenítsük meg a bejelentkezési popup-ot
        document.getElementById('loginForm').classList.add('active');
        document.getElementById('overlay').classList.add('active');
    }
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closePopup();
        }
    });
}

// Ez a függvény bezárja a felugró ablakot.
function closePopup() {
    document.getElementById('loginForm').classList.remove('active');
    document.getElementById('overlay').classList.remove('active');
}

document.addEventListener("DOMContentLoaded", function () {
    var processOrderButton = document.getElementById('processOrderButton');

    processOrderButton.addEventListener('click', function () {
        processOrder();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var paymentButton = document.getElementById('paymentButton');

    paymentButton.addEventListener('click', function () {
        openPaymentPopup();
    });

    var isLoggedIn = document.body.getAttribute('data-isloggedin') === 'true';
    if (!isLoggedIn) {

    }
});

updateCartCounter();
// Ez a függvény frissíti a kosárban lévő elemek számát a weboldalon.
function updateCartCounter() {
    var cartItems = document.querySelectorAll('.product-info').length;
    document.getElementById('cartCounter').textContent = cartItems;
}

// Ez a függvény elküld egy AJAX kérést a termék mennyiségének frissítésére a kosárban.
function updateCartItemQuantity(index, quantity) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'termek_dbszam.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateTotalProductPrice();
            }
        }
    };
    xhr.send('index=' + encodeURIComponent(index) + '&quantity=' + encodeURIComponent(quantity));
}

// Ez a függvény elküld egy AJAX kérést egy tétel eltávolítására a kosárból.
function removeFromCart(index) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'kosar_torles.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                location.reload();
            }
        }
    };
    xhr.send('index=' + encodeURIComponent(index));
}

// Ez a kód rész arra figyel, hogy az oldal betöltődjön, majd végez különböző inicializálásokkal és eseménykezelők hozzáadásával.
document.addEventListener("DOMContentLoaded", function () {
    var selectedDelivery = localStorage.getItem('selectedDelivery');
    if (selectedDelivery) {
        document.getElementById(selectedDelivery).checked = true;
    }

    var selectedPayment = localStorage.getItem('selectedPayment');
    if (selectedPayment) {
        document.getElementById(selectedPayment).checked = true;
    }

    var deliveryOptions = document.querySelectorAll('input[name="delivery"]');
    deliveryOptions.forEach(function (option) {
        option.addEventListener('change', function () {
            localStorage.setItem('selectedDelivery', this.id);
            updateTotalProductPrice();
        });
    });

    var paymentOptions = document.querySelectorAll('input[name="payment"]');
    paymentOptions.forEach(function (option) {
        option.addEventListener('change', function () {
            localStorage.setItem('selectedPayment', this.id);
            updateTotalProductPrice();
        });
    });

    var quantityInputs = document.querySelectorAll('.product-quantity');
    quantityInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            updateTotalProductPrice();
        });
    });

    var currentPage = 1; 
    var itemsPerPage = 3; 

    // Ez a függvény frissíti a kosár megjelenítését az aktuális oldal szerint.
    function updateCartDisplay() {
        var cartItems = document.querySelectorAll('.product-info');
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;

        cartItems.forEach(function (item, index) {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });

        updateCartCounter();
        updateTotalProductPrice();
    }
    updateCartDisplay();

    // Ezek az eseménykezelők megengedik a felhasználónak, hogy a kosárban lévő elemek között lapozzon.
    var prevButton = document.getElementById('prevButton');
    var nextButton = document.getElementById('nextButton');

    prevButton.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            updateCartDisplay();
        }
    });

    nextButton.addEventListener('click', function () {
        var cartItems = document.querySelectorAll('.product-info');
        var numItems = cartItems.length;
        var numPages = Math.ceil(numItems / itemsPerPage);

        if (currentPage < numPages) {
            currentPage++;
            updateCartDisplay();
        }
    });

    // Ez a függvény frissíti a kosárban lévő elemek számát a weboldalon.
    function updateCartCounter() {
        var cartItems = document.querySelectorAll('.product-info').length;
        document.getElementById('cartCounter').textContent = cartItems;
    }

    // Ez a függvény számítja ki és frissíti a termékek összesített árát a kosárban, beleértve a szállítási és fizetési módok díjait is.
    function updateTotalProductPrice() {
        var totalProductPrice = calculateTotalProductPrice();
        var deliveryPrice = 0;

        if (document.getElementById('dpd').checked) {
            deliveryPrice = 1200;
        } else if (document.getElementById('gls').checked) {
            deliveryPrice = 1400;
        }

        var totalPrice = totalProductPrice + deliveryPrice;

        var paymentOption = document.querySelector('input[name="payment"]:checked').value;
        if (paymentOption === 'cod') {
            totalPrice += 300;
        }

        document.getElementById('finalPrice').textContent = formatPrice(totalPrice);
    }

    // Ez a függvény számolja ki a termékek összesített árát a kosárban.
    function calculateTotalProductPrice() {
        var totalProductPrice = 0;
        document.querySelectorAll('.product-info').forEach(function (product) {
            var price = parseFloat(product.querySelector('.product-price').textContent.replace(' Ft', '').replace(',', '.'));
            var quantity = parseInt(product.querySelector('.product-quantity').value);
            totalProductPrice += price * quantity;
        });
        return totalProductPrice;
    }

    // Ez a függvény formátumra alakítja az árat.
    function formatPrice(price) {
        return price.toLocaleString('hu-HU', { style: 'currency', currency: 'HUF' }).replace(/(\d+)\s?Ft,00/, "$1 Ft").replace(/,00\s?Ft/, " Ft");
    }
});

/*function order_email() {
    document.getElementById("orderForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Az alapértelmezett űrlap elküldésének megakadályozása
    
        // Email elküldése AJAX segítségével
        var email = document.getElementById("email").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "order_email.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert('Rendelés sikeresen felvéve az adatbázisba'); window.location = 'kosar.php';
                } else {
                    alert('Hiba a rendelés felvétele közben: ');
                }
            }
        };
        xhr.send("email=" + encodeURIComponent(email));
    });
}*/


document.addEventListener('DOMContentLoaded', function() {
    var telefonszamInput = document.getElementById('telefonszam');
    var telefonszamError = document.getElementById('telefonszam-error');

    telefonszamInput.addEventListener('keyup', function(event) {
        var telefonszamValue = event.target.value;

        if (!/^(20|30|70) \d{3} \d{4}$/.test(telefonszamValue)) {
            telefonszamError.textContent = 'Hibás telefonszám formátum!';
        } else {
            telefonszamError.textContent = ''; // Üzenet törlése
        }
    });

    // Eltávolítjuk az üzenetet, ha a felhasználó kikattint a beviteli mezőből
    telefonszamInput.addEventListener('blur', function() {
        if (telefonszamError.textContent === '') {
            telefonszamError.textContent = ''; // Csak üres üzenet esetén töröljük
        }
    });
});

function clearDefaultValue(input) {
    if (input.value === input.defaultValue) {
        input.value = '';
        input.style.color = '#000'; // Visszaállítjuk az alapértelmezett színre
    }
}

function restoreDefaultValue(input) {
    if (input.value === '') {
        input.value = input.defaultValue;
        input.style.color = '#999'; // Szürke szín
    }
}


document.addEventListener("DOMContentLoaded", function() {
    var iranyitoszamInput = document.getElementById('iranyitoszam');
    var cityInput = document.getElementById('varos');

    iranyitoszamInput.addEventListener('input', function(event) {
        var iranyitoszam = event.target.value.trim();

        // Ellenőrizzük, hogy az irányítószám megtalálható-e az adatforrásban
        if (iranyitoszamok.hasOwnProperty(iranyitoszam)) {
            // Ha az irányítószám megtalálható, automatikusan kitöltjük a Város mezőt
            cityInput.value = iranyitoszamok[iranyitoszam];
        } else {
            // Ha az irányítószám nem található az adatforrásban, a Város mezőt üresre állítjuk
            cityInput.value = '';
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var paymentOptions = document.querySelectorAll('input[name="payment"]');
    var cardDetails = document.getElementById('cardDetails');

    paymentOptions.forEach(function (option) {
        option.addEventListener('change', function () {
            if (this.value === 'card') {
                cardDetails.style.display = 'block';
            } else {
                cardDetails.style.display = 'none';
            }
        });
    });

    var kartyaszamInput = document.getElementById('kartyaszam');

    kartyaszamInput.addEventListener('input', function () {
        var trimmedValue = this.value.replace(/\s/g, ''); // Szóközök eltávolítása
        var formattedValue = '';
        for (var i = 0; i < trimmedValue.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formattedValue += ' '; // Szóköz hozzáadása minden 4. karakter után
            }
            formattedValue += trimmedValue[i];
        }
        this.value = formattedValue.substr(0, 19); // Csak a maximális hosszúságig engedélyezzük a bevitelt
    });

    var lejaratInput = document.getElementById('lejarat');

    lejaratInput.addEventListener('input', function () {
        var trimmedValue = this.value.replace(/\//g, ''); // Szóközök eltávolítása
        if (trimmedValue.length > 2) {
            trimmedValue = trimmedValue.substr(0, 2) + '/' + trimmedValue.substr(2, 2);
        }
        this.value = trimmedValue.substr(0, 5); // Csak a maximális hosszúságig engedélyezzük a bevitelt
    });
});

function formatPhoneNumber(input) {
    var trimmedValue = input.value.replace(/\s/g, ''); // Szóközök eltávolítása
    var formattedValue = '';
    for (var i = 0; i < trimmedValue.length; i++) {
        if (i === 2 || i === 5) {
            formattedValue += ' '; // Szóköz hozzáadása a megfelelő helyeken
        }
        formattedValue += trimmedValue[i];
    }
    input.value = formattedValue.substr(0, 11); // Csak a maximális hosszúságig engedélyezzük a bevitelt
}
