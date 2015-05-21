CRC.ns('CRC.controller.Database');

var DB_PATH = '/credicant/db.php';

CRC.controller.Database = Class.extend(CRC.util.Observable, {

    initialize: function() {

    },

    loadProducts: function() {
        var me = this;
        var products = [];
        /*
        $.getJSON(me._productsFilePath, function (data) {
            $.each(data.products, function (index, product) {
                me._products.push(new CRC.model.Product(product));
            });

            me.fireEvent("productsLoaded", [me._products]);
        });
        */

        $.post(DB_PATH, {
            action: 'getShoppingCartProducts'
        }, function (data) {
            $.each($.parseJSON(data), function (index, product) {
                products.push(new CRC.model.Product(product.title, product.price, product.description, product.keywords, product.pictures, product.p_id));
            });
            me.fireEvent("productsLoaded", [products]);
        }).fail(function() {
        });
    },


    loadOrders: function() {
        var me = this;
        var orders = [];
        $.ajax({
            url: DB_PATH,
            data: {
                action: 'getOrders'
            },
            type: 'post',
            success:function(result){
                $.each($.parseJSON(result), function (index, order) {
                    orders.push(new CRC.model.Order(order.firstname, order.surname, order.street, order.city, order.postal, order.mail, order.products));
                });
                me.fireEvent("ordersLoaded", [orders]);
            }
        });
    },

    createDB: function() {
        $.ajax({
            url: DB_PATH,
            data: {action: 'create'},
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    },

    dropDB: function() {
        var me = this;
        $.ajax({
            url: DB_PATH,
            data: {action: 'drop'},
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    },

    addDBProduct: function(product) {
        $.post(DB_PATH, {
            action: 'addProduct',
            title: product.getTitle(),
            price: product.getPrice(),
            keywords: product.getKeywords(),
            desc: product.getDescription(),
            pictures: product.getPictures()
        }, function () {
            $('.alert-box.success').show().delay(2000).fadeOut();
        }).fail(function() {
            $('.alert-box.alert').show().delay(2000).fadeOut();
        });
    },

    addDBOrder: function(order) {
        $.ajax({
            url: DB_PATH,
            data: {
                action: 'addOrder',
                firstname: order.getFirstname(),
                surname: order.getSurname(),
                street: order.getStreet(),
                postal: order.getPostal(),
                mail: order.getMail(),
                products: order.getProductIds()
            },
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    }
});