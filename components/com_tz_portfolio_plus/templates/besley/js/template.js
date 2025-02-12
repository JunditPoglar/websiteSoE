var besley = function (param, rwidth, rheight) {
    jQuery(document).ready(function () {
        jQuery("#portfolio").tzPortfolioPlusIsotope({
            "params": param,
            "mainElementSelector": "#tpPortfolio",
            afterColumnWidth: function (colCount, colWidth) {
                jQuery('#portfolio .element').map(function () {
                    var colHeight = (colWidth * rheight) / rwidth;
                    console.log(param);
                    jQuery(this).find('.TzArticleMedia').height(colHeight);
                    if (jQuery(this).hasClass('tz_feature_item')) {
                        jQuery(this).width(colWidth * 2).find('.TzArticleMedia').height(colHeight * 2 + 40);
                    }
                });
            },
            afterImagesLoaded: function () {
                jQuery('.besleylightbox').remove();
                besley_lightbox();
            }
        });
    });
}