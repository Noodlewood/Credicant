CRC.ns('CRC.model.Product');
CRC.model.Product = Class.extend({

    initialize: function(productJSON) {
        this._id = productJSON.id;
        this._title = productJSON.title;
        this._price = productJSON.price;
        this._description = productJSON.desc;
        this._pictures = [];
        var me = this;
        $.each(productJSON.pictures, function(index, pic) {
            me._pictures.push(pic.src);
        })
    },

    getId: function() {
        return this._id;
    },

    getTitle: function() {
        return this._title;
    },

    getPrice: function() {
        return parseFloat(this._price);
    },

    getDescription: function() {
        return this._description;
    },

    getPictures: function() {
        return this._pictures;
    },

    getThumb: function() {
        return this._pictures[0];
    }
});