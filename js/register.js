$(function () {

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change');
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change');
    }

    $('#register-form').validator();

    $('#register-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "../api/register.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#register-form').find('.messages').html(alertBox);
                        $('#register-form')[0].reset();
                        grecaptcha.reset();
                    }
                }
            });
            return false;
        }
    })
});
