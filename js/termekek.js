var isLoggedIn = document.body.getAttribute('data-isloggedin') === 'true';

function showDetailsPopup(button) {
    var productCard = button.closest('.product-card');
    var imageSrc = productCard.querySelector('img').src;
    var name = productCard.querySelector('.product-title').innerText;
    var price = productCard.querySelector('.product-price').innerText;
    var description = productCard.querySelector('.product-description').innerText;

    var popupContent = `
        <div class="popup-container">
            <div class="popup-content">
                <span class="close-popup" onclick="closePopup()">&times;</span>
                <img src="${imageSrc}" >
                <h3>${name}</h3>
                <p class="product-price">${price}</p>
                <p>${description}</p>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', popupContent);
    document.body.style.overflow = 'hidden';

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closePopup();
        }
    });
}


function closePopup() {
    var popup = document.querySelector('.popup-container');
    if (popup) {
        popup.remove();
        document.body.style.overflow = 'auto';
    }
}

function addToCart(button) {
    var productName = button.parentElement.querySelector('.product-details .product-title').innerText;
    var productPriceText = button.parentElement.querySelector('.product-details .product-price').innerText;
    var productPrice = parseFloat(productPriceText.replace(/\D/g, ''));
    var productDescription = button.parentElement.querySelector('.product-details .product-description').innerText;
    var quantity = 1;

    $.ajax({
        type: 'POST',
        url: 'kosar.php',
        data: {
            name: productName,
            price: productPrice,
            description: productDescription,
            quantity: quantity
        },
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}

$(document).ready(function () {
    function updateProducts() {
        var minPrice = $('#min-price').val();
        var maxPrice = $('#max-price').val();
        var category = $('#category').val();

        $.ajax({
            url: 'filter_products.php',
            type: 'GET',
            data: {
                minPrice: minPrice,
                maxPrice: maxPrice,
                category: category
            },
            success: function (response) {
                $('.product-container').html(response);
            }
        });
    }
    $('#min-price, #max-price, #category').change(function () {
        updateProducts();
    });
});
