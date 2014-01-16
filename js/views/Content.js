CRC.ns('CRC.views.Content');
CRC.views.Content = Class.extend({

	initialize: function() {
		this._element = $('<div></div>')
			.addClass('content');
	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	append: function(child) {
		this._element.append(child);
	},

	setContent: function(html) {
		this._element.append(html);
	}
});
