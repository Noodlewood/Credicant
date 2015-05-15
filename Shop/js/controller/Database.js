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
    }
});