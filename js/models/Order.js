CRC.ns('CRC.model.Order');
CRC.model.Order = Class.extend({

    initialize: function(firstname, surname, street, city, postal, mail, products, number) {
        this._number = number;
        this._firstname = firstname;
        this._surname = surname;
        this._street = street;
        this._city = city;
        this._postal = postal;
        this._mail = mail;
        this._products = [];
        if (products) {
            this._products = products;
        }
    },

    getNumber: function() {
      return this._number;
    },

    getFirstname: function() {
        return this._firstname;
    },

    getSurname: function() {
        return this._surname;
    },

    getStreet: function() {
        return this._street;
    },

    getCity: function() {
        return this._city;
    },

    getPostal: function() {
        return this._postal;
    },

    getMail: function() {
        return this._mail;
    },

    getProducts: function() {
        return this._products;
    }
});