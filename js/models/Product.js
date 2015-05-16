CRC.ns('CRC.model.Product');
CRC.model.Product = Class.extend({

    initialize: function(productJSON) {
        this._id = productJSON.id;
        this._title = productJSON.title;
        this._price = productJSON.price;
        this._description = productJSON.desc;
        this._keywords = [];
        if (productJSON.keywords) {
            this._keywords = productJSON.keywords;
        }
        this._pictures = productJSON.pictures;
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

    getKeywords: function() {
        return this._keywords;
    },

    getThumb: function() {
        return this._pictures[0];
    }
});