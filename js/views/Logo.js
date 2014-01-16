CRC.ns('CRC.views.Logo');
CRC.views.Logo = Class.extend('CRC.util.Observable', {

	initialize: function() {
	   this._element = $('<div></div>')
		   .hover($.proxy(this._onHoverIn, this),$.proxy(this._onHoverOut, this))
		   .addClass('logo')

	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	_onHoverIn: function() {
		this._element.animate({
			rotate: '180deg'
		})
	},

	_onHoverOut: function() {
		this._element.animate({
			rotate: '0'
		})
	}
});
