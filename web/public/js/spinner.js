var SpinnerHelper;

$(function () {
    SpinnerHelper = function (el, size) {
        this.el = el;
        this.size = size || 'medium';
    };

    SpinnerHelper.prototype.start = function () {
        this.el.addClass('content-spinner-' + this.size);
    };

    SpinnerHelper.prototype.stop = function () {
        this.el.removeClass('content-spinner-' + this.size);
    };
});
