CRC.ns('CRC.views.Navigation');
CRC.views.Navigation = Class.extend(CRC.util.Observable, {

    initialize: function() {
        var me = this;

        this._navItems = $('.top-bar').find('li');
        this._navItems.click(function() {
            me._changeActiveStatus($(this));
            me.fireEvent('goTo', [$(this).attr('ref')]);
        });
    },

    _changeActiveStatus: function(el) {
        this._navItems.removeClass('active');
        el.addClass('active');
    }
});