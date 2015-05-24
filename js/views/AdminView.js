CRC.ns('CRC.views.AdminView');
CRC.views.AdminView = Class.extend(CRC.util.Observable, {

    initialize: function(orders, products) {
        this.update(orders, products)
    },

    update: function(orders, products) {
        this._createOrdersList(orders);
        this._createProductDeleteList(products);
    },

    _createOrdersList: function(orders) {
        var me = this;
        var list = $('#ordersList');
        list.empty();

        $.each(orders, function(index, order) {
            var row = $('<tr></tr>');
            $('<td></td>').text(order.getNumber()).appendTo(row);
            $('<td></td>').text(order.getFirstname()).appendTo(row);
            $('<td></td>').text(order.getSurname()).appendTo(row);
            $('<td></td>').text(order.getStreet()).appendTo(row);
            $('<td></td>').text(order.getCity()).appendTo(row);
            $('<td></td>').text(order.getPostal()).appendTo(row);
            $('<td></td>').text(order.getMail()).appendTo(row);
            row.append(me._getProductColumn(order.getProducts()));
            row.append(me._getTotalSumColumn(order.getProducts()));
            list.append(row);
        });
    },

    _createProductDeleteList: function(products) {
        var me = this;
        var list = $('#productDeleteList');
        list.empty();

        $.each(products, function(index, product) {
            var row = $('<tr></tr>');
            $('<td></td>').text(product.getTitle()).appendTo(row);
            row.append(me._getProductDeleteButtonColumn(product));
            list.append(row);
        });
    },

    _getProductColumn: function(products) {
        var column = $('<td></td>');
        $.each(products, function(index, orderProduct) {
            column.append($('<div></div>').text(orderProduct.count + "x " + orderProduct.product.title))
        });

        return column;
    },

    _getTotalSumColumn: function(products) {
        var sum = 0;
        $.each(products, function(index, orderProduct) {
            sum += (orderProduct.count * orderProduct.product.price);
        });

        return $('<td></td>').text(sum);
    },

    _getProductDeleteButtonColumn: function(product) {
        var me = this;
        var column = $('<td></td>');
        var button = $('<button></button>')
            .addClass('primary alert tiny')
            .text('LÖSCHEN')
            .click(function() {
                CRC.Credicant.instance.deleteProduct(product);
            });

        return column.append(button);
    }
});