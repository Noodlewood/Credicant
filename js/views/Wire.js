CRC.ns('CRC.views.Wire');
CRC.views.Wire = Class.extend({

	initialize: function() {

		this._element = $('<div></div>')
			.css('border', '1px solid black')
			.attr('id', 'kineticStageDiv');


	},

	appendTo: function(parent) {
		parent.append(this._element);
	},

	setKineticStage: function() {
		var stage = new Kinetic.Stage({
			container: 'kineticStageDiv',
			width: 1000,
			height: 300
		});

		this.anchorLayer = new Kinetic.Layer();

		this.quad = {
			start: this.buildAnchor(150, 0),
			control: this.buildAnchor(150, 150),
			end: this.buildAnchor(50, 100)
		};

		stage.add(this.anchorLayer);
		this.drawCurves();

		var drawCurvesFn = this.drawCurves;
		this.anchorLayer.on('beforeDraw', function() {
			drawCurvesFn();
		});
	},

	ApplyUnitaryVerletIntegration: function (item, ellapsedTime, gravity, pixelsPerMeter) {
		item.x = 2 * item.x - item.old_x; // No acceleration here
		item.y = 2 * item.y - item.old_y + gravity * ellapsedTime * ellapsedTime * pixelsPerMeter;
	},

	ApplyUnitaryDistanceRelaxation: function (item, from, targettedLength) {
		var dx = item.x - from.x;
		var dy = item.y - from.y;
		var dstFrom = Math.sqrt(dx * dx + dy * dy);

		if (dstFrom > targettedLength && dstFrom != 0 ) {
			item.x -= (dstFrom - targettedLength) * (dx / dstFrom) * 0.5;
			item.y -= (dstFrom - targettedLength) * (dy / dstFrom) * 0.5;
		}
	},

	buildAnchor: function(x, y) {
		var anchor = new Kinetic.Circle({
			x: x,
			y: y,
			radius: 20,
			stroke: '#666',
			fill: '#ddd',
			strokeWidth: 2,
			draggable: true
		});

		this.anchorLayer.add(anchor);
		return anchor;
	},

	drawCurves: function() {
		var context = this.anchorLayer.getContext();
		var quad = this.quad;

		context.clear();

		context.beginPath();
		context.moveTo(quad.start.attrs.x, quad.start.attrs.y);
		context.quadraticCurveTo(quad.control.attrs.x, quad.control.attrs.y, quad.end.attrs.x, quad.end.attrs.y);
		context.setAttr('strokeStyle', 'red');
		context.setAttr('lineWidth', 4);
		context.stroke();
	}
});
