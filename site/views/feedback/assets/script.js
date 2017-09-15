var com_attendancelist_feedback = function (formObject) {

    this.save = function () {
        ;
        if ($(formObject).is("form") && (new com_attendancelist_validate(formObject)).validate()) {
            var serialize = $(formObject).serialize();
            jQuery.ajax({
                async: true,
                type: "post",
                dataType: "html",
                url: "/?option=com_attendancelist&view=feedback&task=save",
                data: serialize,
                complete: function (event, XMLHttpRequest) {
                    if (("success" == XMLHttpRequest) && (undefined != event.responseText)) {
                        try {
                            var response = jQuery.parseJSON(event.responseText);
                            switch (response.code) {
                                case 200:
                                    window.location.replace("/?option=com_attendancelist&view=page");
                                    break;
                                default :
                                    alert(response.message);
                                    break;
                            }
                        } catch (err) {
                            console.log(err);
                        }
                    }
                }
            });
        }
    }

};

$(document).ready(function () {
    $("form", this).each(function () {
        (new com_attendancelist_form_mask(this)).prepare();
    });
});