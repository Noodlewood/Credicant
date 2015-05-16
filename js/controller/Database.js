CRC.ns('CRC.controller.Database');
CRC.controller.Database = Class.extend(CRC.util.Observable, {

    initialize: function() {
        this._productsFilePath = "products.json";
        this._shoppingItems = [];

        this._loadProducts();
    },

    _loadProducts: function() {
        var me = this;
        $.getJSON(me._productsFilePath, function (data) {
            $.each(data.products, function (index, product) {
                me._shoppingItems.push(new CRC.model.Product(product));
            });

            me.fireEvent("productsLoaded", [me._shoppingItems]);
        });
    },

    getProducts: function() {
        return this._shoppingItems;
    },

    createDB: function() {
        $.ajax({
            url:"db.php",
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
            url:"db.php",
            data: {action: 'drop'},
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    },

    addDBProduct: function(product) {
        $.ajax({
            url:"db.php",
            data: {action: 'addProduct', product: product},
            type: 'post',
            success:function(result){
                console.log(result);
            }
        });
    }
});