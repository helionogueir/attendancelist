
var com_attendancelist_form_mask = function (formObject) {

    this.prepare = function () {
        if ($(formObject).is("form")) {
            $(".attendancelist-form-date", formObject).each(function () {
                prepareDate(this);
            });
            $(".attendancelist-form-time-24", formObject).each(function () {
                prepareTime(this);
            });
        }
    };

    function prepareDate(elementObject) {
        if ($(elementObject).is('input[type="text"]')) {
            $(elementObject).bind("click change keypress keyup", function () {
                var value = $(this).val();
                value = value.replace(/\D/g, "");
                value = value.replace(/^(\d{2})+(\d{2})+(\d{4})$/, "$1/$2/$3");
                $(this).val(value);
            });
        }
    }

    function prepareTime(elementObject) {
        if ($(elementObject).is('input[type="text"]')) {
            $(elementObject).bind("click change keypress keyup", function () {
                var value = $(this).val();
                value = value.replace(/\D/g, "");
                value = value.replace(/^(\d{2})+(\d{2})$/, "$1:$2");
                $(this).val(value);
            });
        }
    }

};