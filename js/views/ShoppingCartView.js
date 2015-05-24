CRC.ns('CRC.views.ShoppingCartView');
CRC.views.ShoppingCartView = Class.extend(CRC.util.Observable, {

    initialize: function() {
        this._products = new CRC.model.ShoppingCartProducts();

        var me = this;
        $("#order").submit(function() {
            me.fireEvent('submitClicked', [me._createOrder()]);
            event.preventDefault();
        })
    },

    update: function() {
        var cartModalItems = $('#cartItems');
        cartModalItems.empty();
        var me = this;

        if (this._products.getProducts().length < 1) {
            cartModalItems.append($('<div></div>').text('Keine Waren im Korb').css('text-align', 'center'));
            return;
        }

        $.each(this._products.getProducts(), function (index, item) {
                var row = $('<div></div>').addClass("row");
                var outer = $('<div></div>').addClass("small-12 columns item-margin");
                var title = $('<div></div>').addClass("small-4 columns").text(item.count + " x " + item.product.getTitle());
                var value = $('<div></div>').addClass("small-6 columns align-right").text(me._getItemSum(item.count, item.product.getPrice()) + " €");
                var deleteBtn = $('<div></div>').addClass("remove-from-cart small-2 minus-button columns shadow-small")
                    .click(function() {
                        me.removeProduct(item.product);
                    });

                outer.append(deleteBtn);
                outer.append(title);
                outer.append(value);
                row.append(outer);
                cartModalItems.append(row);
        });

        cartModalItems.append($('<hr />'));
        var row = $('<div></div>').addClass("row");
        var outer = $('<div></div>').addClass("large-12 columns");
        var title = $('<div></div>').addClass("large-6 columns").text("Summe:");
        var value = $('<div></div>').addClass("sum large-6 columns align-right").text(this._products.getSum() + " €");

        outer.append(title);
        outer.append(value);
        row.append(outer);
        cartModalItems.append(row);

        row = $('<div></div>').addClass("row");
        title = $('<div></div>').addClass("large-12 columns small-text text-right").text("keine MwSt Ausweiß gem. § 19 UStG");
        outer.append(title);
        row.append(outer);
        cartModalItems.append(row);

        row = $('<div></div>').addClass("row");
        title = $('<a href="#" data-reveal-id="shippingModal"></a>').addClass("large-12 columns small-text text-right").text("zzgl. 5,90€ Versandkosten");
        outer.append(title);
        row.append(outer);
        cartModalItems.append(row);
    },

    addProduct: function(product) {
        this._products.add(product);
    },

    removeProduct: function(product) {
        var me = this;

        this._products.remove(product, function(success) {
            if (success) {
                me.fireEvent('productRemoved');
            }
        });
    },

    _getItemSum: function(count, price) {
        var sum = count * price;
        return sum.toFixed(2);
    },

    _createOrder: function() {
        var forenameField = $("input[name='forename']");
        var surnameField = $("input[name='surname']");
        var streetField = $("input[name='street']");
        var cityField = $("input[name='city']");
        var postalField = $("input[name='postal']");
        var mailField = $("input[name='mail']");

        var forename = forenameField.val();
        var surname = surnameField.val();
        var street = streetField.val();
        var city = cityField.val();
        var postal = postalField.val();
        var mail = mailField.val();

        return new CRC.model.Order(forename, surname, street, city, postal, mail, this._products.getJSONProducts());
    }
});