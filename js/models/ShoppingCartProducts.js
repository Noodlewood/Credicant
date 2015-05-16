CRC.ns('CRC.model.ShoppingCartProducts');
CRC.model.ShoppingCartProducts = Class.extend({

    initialize: function() {
        this._shoppingItems = [];
    },

    getProducts: function() {
        return this._shoppingItems;
    },

    getJSONProducts: function() {
        var products = [];
        $.each(this._shoppingItems, function(index, item) {
            products.push({
                'count': item.count,
                'title': item.product.getTitle(),
                'price': item.product.getPrice()
            })
        });

        return products;
    },

    add: function(product) {
        var flag = false;
        $.each(this._shoppingItems, function(index, item) {
            if (item.id == product.getId()) {
                item.count += 1;
                flag = true;
            }
        });
        if (!flag) {
            this._shoppingItems.push({
                id: product.getId(),
                product: product,
                count: 1
            })
        }
    },

    remove: function(product, callback) {
        var me = this;
        $.each(this._shoppingItems, function(index, item) {

            if (item.id == product.getId()) {
                item.count -= 1;
                if (item.count < 1) {
                    var i = me._shoppingItems.indexOf(item);
                        if(i != -1) {
                            me._shoppingItems.splice(i, 1);
                        }
                }
                callback(true);
            }
        });
        console.log(this._shoppingItems)
    },

    getSum: function() {
        var sum = 0;
        $.each(this._shoppingItems, function(index, item) {
            sum += (item.count * item.product.getPrice());

        });

        return sum.toFixed(2);
    }

});