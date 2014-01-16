CRC.ns('CRC.views.content.FadeTextWithImage');
CRC.views.content.FadeTextWithImage = Class.extend({

	initialize: function(style, height) {
		this._element = $('<div></div>')
			.addClass(style)
			.css('height', height);

	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	append: function(child) {
		this._element.append(child);
	},

	height: function() {
		return this._element.height();
	},

	addTextBar: function(text, side, topPos) {
		if (!side) side = 'left';

		var textBar = $('<div></div>')
			.addClass('textbar')
			.addClass('textbar-' + side)
			.css('top', topPos)
			.text(text)
			.appendTo(this._element);
	},

	css: function(style) {
		this._element.css(style);
	},

	fadeTextBarsIn: function() {
		this._element.children('.textbar-left').animate({
			left: 0
		});
		this._element.children('.textbar-right').animate({
			right: 0
		});
	},

	fadeTextBarsOut: function() {
		this._element.children('.textbar-left').animate({
			left: -500
		});
		this._element.children('.textbar-right').animate({
			right: -500
		});
	},
});
