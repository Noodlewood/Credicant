CRC.ns('CRC.controller.Database');

//var DB_PATH = '/credicant/db.php';
var DB_PATH = '/shop/db.php';

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
            action: 'getProducts'
        }, function (data) {
            $.each($.parseJSON(data), function (index, product) {
                products.push(new CRC.model.Product(product.title, product.price, product.description, product.keywords, product.pictures, product.p_id));
            });
            me.fireEvent("productsLoaded", [products]);
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
                    orders.push(new CRC.model.Order(order.firstname, order.surname, order.street, order.city, order.postal, order.mail, order.products, order.o_id));
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
        $.ajax({
            url: DB_PATH,
            data: {action: 'drop'},
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    },

    recreateDB: function() {
        var me = this;

        $.ajax({
            url: DB_PATH,
            data: {action: 'recreate'},
            type: 'post',
            success:function(result){
                me.fireEvent("productChanged");
                console.log(result);
            }
        });
    },

    addDBProduct: function(product) {
        var me = this;

        $.post(DB_PATH, {
            action: 'addProduct',
            title: product.getTitle(),
            price: product.getPrice(),
            keywords: product.getKeywords(),
            desc: product.getDescription(),
            pictures: product.getPictures()
        }, function () {
            me.fireEvent("productChanged");
            $('.alert-box.success').show().delay(2000).fadeOut();
        }).fail(function() {
            $('.alert-box.alert').show().delay(2000).fadeOut();
        });
    },

    deleteDBProduct: function(product) {
        var me = this;

        $.post(DB_PATH, {
            action: 'deleteProduct',
            p_id: product.getId()
        }, function() {
            me.fireEvent("productChanged");
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
                city: order.getCity(),
                postal: order.getPostal(),
                mail: order.getMail(),
                products: order.getProducts()
            },
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    }
});