CRC.ns('CRC.views.Header');
CRC.views.Header = Class.extend({

	initialize: function() {
		this._element = $('<header></header>')
			.addClass('header');

		this._buttonHolder = $('<div></div>')
			.addClass('header-btn-holder')
			.appendTo(this._element);

		$(window).resize($.proxy(this._centerButtonHolder, this));
	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	append: function(child) {
		this._element.append(child);
	},

	moveIn: function() {
		this._element.animate({
			top: 0
		}, 1000);
	},

	appendButton: function(navibutton) {
		if (!this._activateFirstBtn) {
			this._activateFirstBtn = true;
			navibutton.activate();
		}

		navibutton.appendTo(this._buttonHolder);
		this._centerButtonHolder();
	},

	_centerButtonHolder: function() {
		this._buttonHolder.css('left', this._element.width()/2 - this._buttonHolder.width()/2)
	}
});
