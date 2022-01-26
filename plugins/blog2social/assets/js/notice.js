jQuery(document).on('click', '.b2s-hide-notice-area', function () {
    var area = jQuery(this).attr('data-area-class');
    jQuery('.'+area).hide();
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            'action': 'b2s_notice_hide',   
            'b2s_security_nonce': jQuery('#b2s_security_nonce').val()
        },
        success: function (data) {
        }
    });
});


