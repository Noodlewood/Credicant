CRC.ns('CRC.models.Section');
CRC.models.Section = Class.extend({

	initialize: function(content, naviBtn) {

		this._naviBtn = naviBtn;
		this._content = content;
		this._isActive = false;
	},

	_activate: function(percentage) {
		if (this._isActive) return;
		this._isActive = true;

		this._naviBtn.activate();
		if (this._content.fadeTextBarsIn) this._content.fadeTextBarsIn();
	},

	_deactivate: function() {
		if (!this._isActive) return;
		this._isActive = false;

		this._naviBtn.deactivate();
		if (this._content.fadeTextBarsOut) this._content.fadeTextBarsOut();
	}
});