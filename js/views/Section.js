CRC.ns('CRC.views.Section');
CRC.views.Section = Class.extend({

	initialize: function(content, naviBtn, height) {
		this._element = $('<div></div>')
			.addClass('section')
			.height(height)

        this._height = height;
        this._content = content;
        this._naviBtn = naviBtn;
        this._content.appendTo(this._element);
        this._sectionData = new CRC.models.Section(content, naviBtn)
	},

	appendTo: function(parent) {
		parent.append(this._element);

        var index = parent.children('.section').length - 1;

        this._setStartPos(this._height, index);
        this._setEndPos(this._height, index);
	},

    onDocumentScroll: function(scrollPos) {
        if (!this._sectionData || !this._startPos) return;

        var percentage = this._getPercentage(scrollPos, this._height);

        if (this._startPos <= scrollPos && scrollPos < this._endPos) {
            this._sectionData._activate(percentage);
        } else {
            this._sectionData._deactivate();
        }
    },

    _getPercentage: function(currentPos, sectionHeight) {
        var start = sectionHeight * this._index;
        var end = start + sectionHeight;
        return (currentPos - start) / (end - start);
    },

    _setStartPos: function(height, index) {
        this._startPos = height * index;
    },

    _setEndPos: function(height, index) {
        this._endPos = (height * index) + height;
    }
});
