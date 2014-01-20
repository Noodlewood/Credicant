$(document).ready(function() {
	CRC.Credicant.instance = new CRC.Credicant();
});

CRC.ns('CRC');
CRC.Credicant = Class.extend(CRC.util.Observable, {
	
	initialize: function() {
		this._sectionHeight = window.innerHeight;
		this._isAnimation = false;

		var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";

		if (document.attachEvent)
			document.attachEvent("on"+mousewheelevt, this._onMouseWheel);
		else if (document.addEventListener)
			document.addEventListener(mousewheelevt, this._onMouseWheel, false);

		this._bodyHeight = 0;
		this.credicant = $('.credicant');
		this.header = new CRC.views.Header();

		this._colorscroller = new CRC.views.Colorscroller(this._sectionHeight);
        this.addListener('documentScroll', this._colorscroller.onDocumentScroll, this._colorscroller);

		this.header.appendTo(this.credicant);
		this.header.moveIn();

		$(document).scroll($.proxy(this._onDocumentScroll, this));

		var logo = $('<div></div>')
			.addClass('logo-big');
		this.addSection(logo, '#000000');

		var text = new CRC.views.content.FadeTextWithImage('beans-shadow', this._sectionHeight);
		this.addSection(text, '#ff3500');
		text.addTextBar("Lorem Ipsum", "right", 50);
		text.addTextBar("Lorem Ipsum", "left", 150);
		text.addTextBar("Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,", "left", 200);

		var logo3 = $('<div></div>')
			.addClass('logo-big')
		this.addSection(logo3, '#086fa1');

		var logo4 = $('<div></div>')
			.addClass('logo-big')
		this.addSection(logo4, '#6ce155');

    },

	addSection: function(content, bgColor, btnStyle) {

        var naviBtn = new CRC.views.Navibutton();
        this.header.appendButton(naviBtn);
        if (btnStyle) naviBtn.setActiveStyle(btnStyle);
        naviBtn.setScrollPos(this._bodyHeight);

		var section = new CRC.views.Section(content, naviBtn, this._sectionHeight);
		section.appendTo(this.credicant);

        this._colorscroller.addColor(bgColor);

		this.addListener('documentScroll', section.onDocumentScroll, section);

		this._bodyHeight += this._sectionHeight;
		$('body').css('min-height', this._bodyHeight+"px");
	},

	_onDocumentScroll: function(e) {
		var scrollTop = $(e.currentTarget).scrollTop();
		this.fireEvent('documentScroll', [scrollTop]);
	},

	_onMouseWheel: function(e) {
		e.preventDefault();
		if (this._isAnimation) return;

		var e = window.event || e; // old IE support
		var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
		var currentPos = $("html, body").scrollTop();
		var newPos = currentPos + (-delta * window.innerHeight);
		this._isAnimation = true;

		$("html, body").animate({
			scrollTop: newPos + "px"
		}, 250, $.proxy(function() {
			this._isAnimation = false;
		}, this));
	}
});