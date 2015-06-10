$(document).ready(function() {
    $(document).foundation();
    CRC.Credicant.instance = new CRC.Credicant();
});

CRC.ns('CRC');
CRC.Credicant = Class.extend(CRC.util.Observable, {

    initialize: function () {
        this._activeSite = 'site-home';
        this._showContent(this._activeSite);

        this._db = new CRC.controller.Database();
        this._db.addListener('productsLoaded', this._productsLoaded, this);

        this._db.loadProducts();

        this._shoppingCartLabel = new CRC.views.ShoppingCartLabel();
        this._shoppingCartLabel.addListener('goTo', this._goTo, this);

        this._productDetail = new CRC.views.ProductDetailView();
        this._productDetail.addListener('addToCartClicked', this._addProductToCart, this);
        //this._productDetail.addListener('goTo', this._revealCart, this);
        this._productDetail.addListener('goTo', this._goTo, this);

        this._shoppingCart = new CRC.views.ShoppingCartView();
        this._shoppingCart.addListener('productRemoved', this._productRemovedFromCart, this);
        this._shoppingCart.addListener('ordered', this._submitOrder, this);

        this._navigation = new CRC.views.Navigation();
        this._navigation.addListener('goTo', this._goTo, this);

        this._blog = new CRC.controller.Blog();
        this._blog.addListener('blogPostsLoaded', this._blogPostsLoaded, this);

        //this._blog.loadPosts(-1);
        //this._blog.insertCommentForm();
    },

    _showContent: function(site) {
        $('#' + this._activeSite).hide();
        $('#' + site).show();

        this._activeSite = site;
    },

    _productsLoaded: function(products) {
        var me = this;
        var itemList = $('#site-shop');
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

    _blogPostsLoaded: function(posts) {
        console.log(posts);
        this._blogView = new CRC.views.BlogView(posts);
    },

    _goTo: function(site) {
        if (site == 'site-cart') {
            this._shoppingCart.update();
        }
        this._showContent(site);
    },

    _addProductToCart: function(product) {
        this._shoppingCartLabel.increase();
        this._shoppingCart.addProduct(product);
    },

    _revealCart: function() {
        this._shoppingCart.update();
        $('#cartModal').foundation('reveal', 'open');
    },

    _showProductDetail: function(product) {
        this._productDetail.update(product);
        this._showContent('site-detail');
    },

    _productRemovedFromCart: function() {
        this._shoppingCartLabel.decrease();
        this._shoppingCart.update();
    },

    _submitOrder: function(order) {
        this._db.addDBOrder(order);
    }
});