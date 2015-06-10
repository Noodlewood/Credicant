$(document).ready(function() {
    $(document).foundation();
    CRC.Credicant.instance = new CRC.Credicant();
});

CRC.ns('CRC');
CRC.Credicant = Class.extend(CRC.util.Observable, {

    initialize: function () {
        this._orders = [];
        this._products = [];
        this._loadCount = 2;

        this._db = new CRC.controller.Database();
        this._db.addListener('ordersLoaded', this._ordersLoaded, this);
        this._db.addListener('productsLoaded', this._productsLoaded, this);
        this._db.addListener('productChanged', this._productChanged, this);
        this._db.addListener('dbRecreated', this._productChanged, this);

        this._db.loadOrders();
        this._db.loadProducts();

        this.addListener('dataLoaded', this._allDataLoaded, this);

        this._adminView = new CRC.views.AdminView(this._orders, this._products);

        var cloneKeywordsOnKeydown = function(e) {
            var field = $('<input type="text" name="keywords"/>');
            if (e.keyCode == 9) return;
            field.one('keydown', cloneKeywordsOnKeydown);
            $('#keywordsLabel').append(field)
        };
        $("input[name='keywords']").one('keydown',cloneKeywordsOnKeydown);

        var titleField = $("input[name='title']");
        var priceField = $("input[name='price']");
        var descField = $("textarea[name='description']");

        var me = this;
        $('#submitProduct').click(function(e) {

            var keywordsField = $("input[name='keywords']");
            var picturesField = $("input[name='pictures[]']");

            var title = titleField.val();
            var price = priceField.val();
            var keywords = [];
            $.each(keywordsField, function (index, field) {
                keywords.push($(field).val());
            });
            var desc = descField.val();
            var pictures = [];

            $.each(picturesField[0].files, function (index, file) {
                pictures.push("productphotos/" + title + "/" + file.name);
            });

            var newProduct = new CRC.model.Product(title, price, desc, keywords, pictures);
            me._db.addDBProduct(newProduct);

        });

        $('#recreateDbBtn').click(function() {
            me._db.recreateDB();
        });

        $('#deletePhotos').click(function() {
            me._db.deletePhotos();
        });
    },

    _ordersLoaded: function(orders) {
        this._orders = orders;
        this._loadCount--;
        this.fireEvent('dataLoaded');
    },

    _productsLoaded: function(products) {
        this._products = products;
        this._loadCount--;
        this.fireEvent('dataLoaded');
    },

    _allDataLoaded: function() {
        if (this._loadCount > 0) return;
        this._adminView.update(this._orders, this._products);
    },

    deleteProduct: function(product) {
        this._db.deleteDBProduct(product);

        $.post("../file.php", {
            action: 'delete',
            title: product.getTitle()
        });
    },

    _productChanged: function() {
        this._db.loadOrders();
        this._db.loadProducts();
    }
});