 /*!
 * JS FOR ELEGANCE SOCIAL NETWORK
 *
 * @Team author : Smart Xplorer (smartxplorer)
 * @Team author email: smartxplorerdev@gmail.com 
 *************************************************
 * Elegance - The Elegant Social Network Platform
 * Copyright (c) 2017 Elegant. All rights reserved.
 */

 var token = jQuery("#token_id").val();

current_color = $('.wizard-card').data('color');
full_color = true;

$(document).ready(function() {

    $('.fixed-plugin a, .fixed-plugin .badge').click(function(event) {
        // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
        if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
                event.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
        }
    });

    $('.fixed-plugin .badge').click(function() {

        $wizard = $('.wizard-card');
        $button_next = $('.wizard-card .wizard-footer').find('.pull-right :input');



        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        $wizard.fadeOut('fast', function() {

            $wizard.attr("data-color", new_color);
            $button_next.removeClass(converterColor(current_color)).addClass(converterColor(new_color));

            current_color = new_color;
            $wizard.fadeIn('fast');
        });
    });

    function converterColor(color) {
        switch (color) {
            case 'blue':
                return 'btn-info';
                break;
            case 'orange':
                return 'btn-warning';
                break;
            case 'purple':
                return 'btn-primary';
                break;
            case 'red':
                return 'btn-danger';
                break;
            case 'green':
                return 'btn-success';
                break;
        }
    }
});

$(document).on('change', '#image_upload_file', function() {
    var progressBar = $('.progressBar'),
        bar = $('.progressBar .bar'),
        percent = $('.progressBar .percent');

    $('#image_upload_form').ajaxForm({
        beforeSend: function() {
            progressBar.fadeIn();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function(html, statusText, xhr, $form) {
            obj = $.parseJSON(html);
            if (obj.status) {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
                $("#imgArea>img").prop('src', obj.image_medium);

                var img = obj.image_original;
                $.ajax({
                    type: "POST",
                    url: "../ajax/post",
                    data: {
                        status: '',
                        image: 'uploads/images/' + img,
                        cover_status: '0',
                        avatar_status: '1',
                        token: token
                    },
                    async: false,
                    success: function(data) {
                        //$('#wall-append').prepend(data);
                    }
                });

            } else {
                alert(obj.error);
            }
        },
        complete: function(xhr) {
            progressBar.fadeOut();
        }
    }).submit();

});


jQuery(document).ready(function() {
    jQuery('#finish').click(function() {
        var form_name = 'signup_form';
        var obj = jQuery(this);
        var success_sign = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Successful registration! Redirection in progress</div>";
        jQuery(this).attr("disabled", "disabled");
        jQuery(this).css('cursor', 'default');

        var str = jQuery("#" + form_name).serialize();
        var str = str;

        jQuery.ajax({
            type: "POST",
            url: "ajax/signup_data",
            data: str,
            cache: false,
            success: function(data) {
                var data = data.trim();
                //jQuery('ol#tupdate').html(data);
                if (data == "1") {
                    jQuery('ol#tupdate').html(success_sign);
                    var Timeout = setTimeout(
                        function() {
                            window.location.assign("user/active")
                        }, 1000);
                } else {
                    jQuery('ol#tupdate').html(data);
                    var form_name = jQuery(this).attr('title');
                    obj.attr("disabled", false);
                    obj.prop('value', 'Terminer');
                    obj.css('cursor', 'pointer');
                }

            }
        });
    });
});