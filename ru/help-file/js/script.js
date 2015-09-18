jQuery(function()
{
    var f = function(url)
    {
        jQuery.ajax({
            url: url,
            dataType: 'html'
        }).done(function(data)
        {
            jQuery('#side-body').html(data);

            jQuery('#left-side-menu li').removeClass('active');

            var a = jQuery('#left-side-menu a[href="#' + url + '"]').data('target');

            jQuery( a ).collapse('show');
            jQuery( a ).parents('li').addClass('active');
            
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
    }

    var hash = window.location.hash.replace("#", "");

    if (hash)
    {
        f( hash );
    }

    jQuery('#left-side-menu a').click(function()
    {
        var url = this.hash.replace("#", "");

        if (url)
        {
            f(url);
        }
    });
});