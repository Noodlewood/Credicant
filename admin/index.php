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

<div class="small-12 columns small-centered">
    <div class="row">
        <h2>Bestellungen</h2>
        <div class="large-12 columns">
            <table>
                <thead>
                <tr>
                    <th width="20">Nr.</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Adresse</th>
                    <th>Stadt</th>
                    <th>PLZ</th>
                    <th>E-Mail</th>
                    <th>Produkte</th>
                    <th>Summe</th>
                </tr>
                </thead>
                <tbody id="ordersList"></tbody>
            </table>
        </div>
    </div>
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
            <form id="product" action="../file.php" method="post" enctype="multipart/form-data">
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
                            <input type="number" step="any" name="price" required/>
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
                            <textarea name="description" style="height: 200px;" requireds></textarea>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label id="picturesLabel">Bilder
                            <input id="file-input" type="file" name="pictures[]" accept="image/*" multiple/>
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
    <div class="row">
        <h2>Produkte löschen</h2>
        <div class="large-12 columns">
            <table>
                <thead>
                <tr>
                    <th width="300">Produkt</th>
                    <th width="300">löschen?</th>
                </tr>
                </thead>
                <tbody id="productDeleteList"></tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <button style="margin-top: 100px;" class="alert radius" id="recreateDbBtn">Datenbank neu erstellen</button>
    </div>
</div>
<script src="../libs/vendor/jquery.js"></script>
<script src="../libs/foundation.min.js"></script>
<script src="../libs/inheritance-2.7.js"></script>
<script src="../libs/Namespace.js"></script>
<script src="../libs/Observable.js"></script>
<script src="../js/views/AdminView.js"></script>
<script src="../js/controller/Database.js"></script>
<script src="../js/models/Product.js"></script>
<script src="../js/models/Order.js"></script>
<script src="Admin.js"></script>
</body>
</html>