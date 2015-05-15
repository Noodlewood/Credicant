CRC.ns('CRC.views.ProductThumbView');
CRC.views.ProductThumbView = Class.extend(CRC.util.Observable, {

    initialize: function(product) {

        this.shopItemOuter = $('<a class="large-4 small-6 columns"  href="#" data-reveal-id="detailModal"></a>');
        var inner = $('<div class="shadow opac"></div>');
        var picture = $('<img class="item-pic" src="">');
        var title = $('<h5 class="item-title"></h5>');
        var keywords = $('<ul></ul>');
        var price = $('<h6 class="subheader item-price"></h6>');
        var panel = $('<div class="panel"></div>');
        var addBtn = $('<div class="plus-button shadow-small"></div>');

        $.each(product.getKeywords(), function(index, keyword) {
           $('<li></li>').text(keyword).appendTo(keywords);
        });

        this.shopItemOuter
            .append(inner)
            .append(addBtn);
        inner
            .append(picture)
            .append(panel);
        panel
            .append(title)
            .append(keywords)
            .append('&nbsp;€')
            .append(price);

        title.text(product.getTitle());
        price.text(product.getPrice());
        picture.attr('src', product.getThumb());

        var me = this;
        addBtn.click(function() {
            me.fireEvent('addToCartClicked', [product]);
            return false;
        });
        inner.click(function() {
            me.fireEvent('productClicked', [product]);
        })
    },

    appendTo: function(el) {
        this.shopItemOuter.appendTo(el);
    }
});