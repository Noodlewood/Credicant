CRC.ns('CRC.model.Product');
CRC.model.Product = Class.extend({

    initialize: function(title, price, desc, keywords, pictures, id) {

        this._id = id;
        this._title = title;
        this._price = price;
        this._description = desc;
        this._keywords = [];
        this._pictures = [];
        if (keywords) {
            this._keywords = keywords;
        }
        if (pictures) {
            this._pictures = pictures;
        }
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