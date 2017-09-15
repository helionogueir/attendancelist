
$(document).ready(function () {
    $("form", this).each(function () {
        (new com_attendancelist_form_mask(this)).prepare();
    });
});