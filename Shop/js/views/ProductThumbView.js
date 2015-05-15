CRC.ns('CRC.views.ProductThumbView');
CRC.views.ProductThumbView = Class.extend(CRC.util.Observable, {

    initialize: function(product) {

        this.shopItemOuter = $('<a class="large-4 small-6 columns"  href="#" data-reveal-id="detailModal"></a>');
        var shopItemInner = $('<div class="shadow opac"></div>');
        var shopItemPicture = $('<img class="item-pic" src="">');
        var shopItemDescription = $('<div class="item-desc"></div>');
        var shopItemTitle = $('<h5 class="item-title"></h5>');
        var shopItemValue = $('<h6 class="subheader item-price"></h6>');
        var shopItemPanel = $('<div class="panel"></div>');
        var shopItemAdd = $('<div class="plus-button shadow-small"></div>');

        this.shopItemOuter.append(shopItemInner)
            .append(shopItemAdd);
        shopItemInner.append(shopItemPicture)
            .append(shopItemDescription)
            .append(shopItemPanel);
        shopItemPanel.append(shopItemTitle)
            .append('&nbsp;€')
            .append(shopItemValue);

        shopItemTitle.text(product.getTitle());
        shopItemValue.text(product.getPrice());
        shopItemPicture.attr('src', product.getThumb());
        shopItemDescription.text(product.getDescription());

        var me = this;
        shopItemAdd.click(function() {
            me.fireEvent('addToCartClicked', [product]);
            return false;
        });
        shopItemInner.click(function() {
            me.fireEvent('productClicked', [product]);
        })
    },

    appendTo: function(el) {
        this.shopItemOuter.appendTo(el);
    }
});