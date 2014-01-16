CRC.ns('CRC.views.Colorscroller');
CRC.views.Colorscroller = Class.extend({

	initialize: function(sectionHeight) {
		this._colors = [];
        this._sectionHeight = sectionHeight;
	},

	addColor: function(color) {
		this._colors.push($.Color(color));
	},

	onDocumentScroll: function(scrollPos) {
		var sectionIndex = Math.floor(scrollPos / this._sectionHeight);

		var colorA = this._colors[sectionIndex];
		if (sectionIndex == this._colors.length - 1) var colorB = colorA;
		else var colorB = this._colors[sectionIndex + 1];

		var relativeScrollPos = scrollPos - (sectionIndex * this._sectionHeight);
		var scrollPercentage = relativeScrollPos/this._sectionHeight;

		var newColor = this._calcTransitionColor(colorA, colorB, scrollPercentage);

		$('body').css({ backgroundColor: newColor });
	},

	_calcTransitionColor: function(a, b, percentage) {
		var newRed = a.red() + ( ( b.red() - a.red() ) * percentage );
		var newGreen = a.green() + ( ( b.green() - a.green() ) * percentage );
		var newBlue = a.blue() + ( ( b.blue() - a.blue() ) * percentage );
		return new $.Color( newRed, newGreen, newBlue );
	}
});
