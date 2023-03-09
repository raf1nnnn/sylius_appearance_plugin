(function ($) {
    'use strict';

    $.fn.extend({
        previewSocialMediaUploadedImage: function (root) {
            $(root + ' input[type="file"]').each(function () {
                $(this).change(function () {
                    displaySocialMediaUploadedImage(this);
                });
            });

            $(root + ' [data-form-collection="add"]').on('click', function () {
                var self = $(this);

                setTimeout(function () {
                    self.parent().find('.column:last-child input[type="file"]').on('change', function () {
                        displaySocialMediaUploadedImage(this);
                    });
                }, 500);
            });
        }
    });

    function displaySocialMediaUploadedImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = $(input).parent().siblings('.image');
                if (image.length > 0) {
                    image.attr('src', e.target.result);
                } else {
                    var img = $('<img class="ui small bordered image"/>');
                    img.attr('src', e.target.result);
                    $(input).parent().before(img);
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
})(jQuery);

(function ($) {
    $(document).ready(function () {
        $(document).previewSocialMediaUploadedImage('.dotit-image')
    });
})(jQuery);
