CRC.ns('CRC.views.Navibutton');
CRC.views.Navibutton = Class.extend({

	initialize: function() {
		this._element = $('<div></div>')
			.addClass('header-btn')
			.click($.proxy(this._onClick, this));

		this._scrollPos = 0;
	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	setScrollPos: function(scrollPos) {
		this._scrollPos = scrollPos;
	},

	setActiveStyle: function(style) {
		this._activeStyle = style;
	},

	_onClick: function() {
		this._element.addClass(this._activeStyle);
		$("html, body").animate({scrollTop: this._scrollPos + "px" });

	},

	activate: function() {
		this._element.addClass(this._activeStyle);
	},

	deactivate: function() {
		this._element.removeClass(this._activeStyle);
	}
});
