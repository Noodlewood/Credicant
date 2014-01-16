CRC.ns('CRC.views.Canvas');
CRC.views.Canvas = Class.extend('CRC.util.Observable', {

	initialize: function() {
		this._id = 'canvas';

		this._element = $('<canvas></canvas>')
			.click($.proxy(this._onClick, this))
			.attr('id', this._id);
	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	drawRect: function() {
		this._getContext2d().fillRect(50, 25, 150, 100);
	},

	_getContext2d: function() {
		if (!this._context) {
			this._context = document.getElementById(this._id).getContext("2d");
		}

		return this._context;
	},

	_onClick: function() {

		console.log(arguments);
		/*
		var context = this._getContext2d();
		context.fillStyle="red";
		context.fillRect(0,0,300,150);
		//context.clearRect(20,20,100,50);
		*/
	}
});
