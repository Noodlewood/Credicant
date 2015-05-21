CRC.ns('CRC.views.ShoppingCartLabel');
CRC.views.ShoppingCartLabel = Class.extend(CRC.util.Observable, {

    initialize: function() {
        var me = this;
        var el = $('#shoppingCartLabel');

        el.click(function() {
            me.fireEvent('goToCartClicked');
        });

        this._label = $(el.children()[0]);

        this._count = 0;
    },

    increase: function() {
        this._count++;
        this._updateText();
    },

    decrease: function() {
        this._count--;
        this._updateText();
    },

    _updateText: function() {
        if (this._count > 1) {
            this._label.text(this._count + " Waren im Korb");
        } else if (this._count == 1) {
            this._label.text(this._count + " Ware im Korb");
        } else if (this._count < 1) {
            this._label.text("Keine Waren im Korb");
        }
    }
});