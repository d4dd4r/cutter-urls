$(function() {
    var $form = $('form'),
        $inputFrom = $form.find('input[type=text]').first(),
        $inputTo = $form.find('#uriResult'),
        spinner = new SpinnerHelper($('.container').first());

    var urlValidate = function(url) {
        if (!url) {
            addAlertStyle($inputFrom);
            return false;
        }

        // var pattern = /(http|ftp|https):\/\/[\w-]+(\.[\w-]{2,5})([\w.,@?^=%&amp;:\/~‌​+#-]*[\w@?^=%&amp;\/‌​~+#-])?/gi;
        var pattern = /(http|https):\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/gi;
        var res = Boolean (pattern.exec(url));

        if (!res) addAlertStyle($inputFrom);
        return res;
    };

    var addAlertStyle = function($el) {
        $el.addClass('alert');
    };

    var ajaxSaveAndGetUrl = function(url) {
        return $.ajax({
            url: '/cutter-url/save-url',
            method: 'post',
            data: { url: url },
            beforeSend: function() {
                spinner.start();
            },
            complete: function() {
                spinner.stop();
            },
            success: function(data) {
                if (data) data = JSON.parse(data);
                if (data.status !== 'success') {
                    return alert('something went wrong.');
                }

                var baseUrl = window.location.origin;
                var urlCompressed = data.data.urlCompressed;
                var path = baseUrl + '/' + urlCompressed;
                $inputTo.val(path);
            },
            error: function(err) {
                console.log(err);
            }
        });
    };

    var submitFormHandler = function(e) {
        e.preventDefault();

        var url = $inputFrom.val();
        if (!urlValidate(url)) return;

        ajaxSaveAndGetUrl(url);
    };

    var showTooltip = function($el) {
        $el.addClass('tooltip');
        setTimeout(function() {
            $el.removeClass('tooltip');
        }, 2000);
    };

    var copyToClipboard = function() {
        var $that = $(this);

        $that.select();
        document.execCommand("copy");
        showTooltip($that);
    };

    $(document).on('submit', 'form', submitFormHandler);
    $(document).on('click', '#uriResult', copyToClipboard);
    $(document).on('focus', 'input[type=text]:not(#uriResult)', function() {
        if ($(this).hasClass('alert')) $inputFrom.removeClass('alert');
    });
});
