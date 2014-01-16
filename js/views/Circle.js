CRC.ns('CRC.views.Circle');
CRC.views.Circle = Class.extend('CRC.util.Observable', {

	initialize: function() {
	   this._element = $('<div></div>')
		   .addClass('circle-white');
	},

	appendTo: function(parent) {
		parent.append(this._element);
	}
});
