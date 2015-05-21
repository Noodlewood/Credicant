<?php
$need_login = true;

if ($need_login) {
    session_start();
    if (!isset($_SESSION['login'])) header('LOCATION:login.php');
    if ($_SESSION['login'] != true) header('LOCATION:login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Credicant Produkt anlegen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Kalam' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../resources/css/foundation.min.css">
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>

<div class="large-12 columns small-centered">
    <div class="row">
        <div data-alert class="alert-box success radius">
            Produkt wurde angelegt.
            <a href="#" class="close">&times;</a>
        </div>
        <div data-alert class="alert-box alert radius">
            Produkt wurde nicht angelegt.
            <a href="#" class="close">&times;</a>
        </div>
        <h2 id="cartTitle">Produkt anlegen</h2>
        <div class="large-12 columns">
            <form id="product">
                <div class="row">
                    <div class="large-12 columns">
                        <label>Titel
                            <input type="text" name="title" required/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label>Preis
                            <input type="number" name="price" required/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label id="keywordsLabel">Keywords
                            <input type="text" name="keywords"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label>Beschreibung
                            <textarea name="description" style="height: 200px;" required></textarea>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label id="picturesLabel">Bilder
                            <input type="text" name="pictures" required/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <input type="submit" class="button medium primary radius"
                               value="Produkt anlegen"/>
                    </div>
                </div>
            </form>
        </div>
        <div id="cartItems" class="large-6 columns"></div>
    </div>
</div>
<script src="../libs/vendor/jquery.js"></script>
<script src="../libs/foundation.min.js"></script>
<script src="../libs/inheritance-2.7.js"></script>
<script src="../libs/Namespace.js"></script>
<script src="../libs/Observable.js"></script>
<script src="../js/controller/Database.js"></script>
<script src="../js/models/Product.js"></script>
<script src="../js/models/Order.js"></script>
<script>

    $(document).ready(function() {
        $(document).foundation();
        CRC.ns('CRC');
        var db = new CRC.controller.Database();

        var _productsLoaded = function(products) {
            $.each(products, function(index, product) {
                console.log(product)
            });
        };

        db.addListener('productsLoaded', _productsLoaded, this);

        var _ordersLoaded = function(orders) {
            $.each(orders, function(index, c) {
                console.log(orders)
            });
        };

        db.addListener('ordersLoaded', _ordersLoaded, this);

        db.loadOrders();

        var cloneKeywordsOnKeydown = function() {
            var field = $('<input type="text" name="keywords"/>');
            field.one('keydown', cloneKeywordsOnKeydown);
            $('#keywordsLabel').append(field)
        };

        var clonePicturesOnKeydown = function() {
            var field = $('<input type="text" name="pictures"/>');
            field.one('keydown', clonePicturesOnKeydown);
            $('#picturesLabel').append(field)
        };

        var titleField = $("input[name='title']");
        var priceField = $("input[name='price']");
        var descField = $("textarea[name='description']");

        $("input[name='keywords']").one('keydown',cloneKeywordsOnKeydown);
        $("input[name='pictures']").one('keydown',clonePicturesOnKeydown);

        $('#product').submit(function(){
            event.preventDefault();

            var keywordsField = $("input[name='keywords']");
            var picturesField = $("input[name='pictures']");

            var title = titleField.val();
            var price = priceField.val();
            var keywords = [];
            $.each(keywordsField, function(index, field) {
                keywords.push($(field).val());
            });
            var desc = descField.val();
            var pictures = [];
            $.each(picturesField, function(index, field) {
                pictures.push($(field).val());
            });

            var newProduct = new CRC.model.Product(title, price, desc, keywords, pictures);
            db.addDBProduct(newProduct);
        });
    });
</script>
</body>
</html>