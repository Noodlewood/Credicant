$(document).ready(function() {
    $(document).foundation();
    CRC.Credicant.instance = new CRC.Credicant();
});

CRC.ns('CRC');
CRC.Credicant = Class.extend(CRC.util.Observable, {

    initialize: function () {
        this._db = new CRC.controller.Database();
        this._db.addListener('productsLoaded', this._productsLoaded, this);

        this._db.loadProducts();

        this._shoppingCartLabel = new CRC.views.ShoppingCartLabel();
        this._shoppingCartLabel.addListener('goToCartClicked', this._goToCart, this);

        this._productDetail = new CRC.views.ProductDetailView();
        this._productDetail.addListener('addToCartClicked', this._addProductToCart, this);
        this._productDetail.addListener('goToCartClicked', this._revealCart, this);

        this._shoppingCart = new CRC.views.ShoppingCartView();
        this._shoppingCart.addListener('productRemoved', this._productRemovedFromCart, this);
        this._shoppingCart.addListener('submitClicked', this._submitOrder, this);
    },

    _productsLoaded: function(products) {
        var me = this;
        var itemList = $('.item-list');
        $.each(products, function(index, product) {

            var thumbView = new CRC.views.ProductThumbView(product);
            thumbView.addListener('addToCartClicked', me._addProductToCart, me);
            thumbView.addListener('productClicked', me._showProductDetail, me);
            thumbView.appendTo(itemList);
        });

        $('.opac').hover(function () {
            $(this).css('opacity', 1);
        }, function () {
            $(this).css('opacity', 0.9);
        });

        $('.main').fadeIn();
    },

    _addProductToCart: function(product) {
        this._shoppingCartLabel.increase();
        this._shoppingCart.addProduct(product);
    },

    _goToCart: function() {
        this._shoppingCart.update();
    },

    _revealCart: function() {
        this._shoppingCart.update();
        $('#cartModal').foundation('reveal', 'open');
    },

    _showProductDetail: function(product) {
        this._productDetail.update(product);
    },

    _productRemovedFromCart: function() {
        this._shoppingCartLabel.decrease();
        this._shoppingCart.update();
    },

    _submitOrder: function(order) {

        $.post('order.php', {
                order: order.getProducts(),
                number: order.getNumber(),
                forename: order.getFirstname(),
                surname: order.getSurname(),
                street: order.getStreet(),
                city: order.getCity(),
                postal: order.getPostal(),
                mail: order.getMail()
            }, function (response) {
                $('#cartModal').foundation('reveal', 'close');
                $('.alert-box.success').show().delay(2000).fadeOut();
        }).fail(function() {
            $('#cartModal').foundation('reveal', 'close');
            $('.alert-box.alert').show().delay(2000).fadeOut();
        });

        this._db.addDBOrder(order);
    }
});