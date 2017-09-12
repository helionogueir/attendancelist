
var com_attendancelist_feedback = new function () {
    this.category = new function () {
        this.html = new function () {
            this.addFilter = function (formObject, parent) {
                if ($(formObject).is("form")) {
                    var serialize = $(formObject).serialize();
                    parent = (undefined != parent) ? parent : '';
                    serialize += "&parent=" + parent;
                    jQuery.ajax({
                        async: true,
                        type: "post",
                        dataType: "html",
                        url: "/component/attendancelist/?view=category&task=filter",
                        data: serialize,
                        complete: function (event, XMLHttpRequest) {
                            if (("success" == XMLHttpRequest) && (undefined != event.responseText)) {
                                try {
                                    $(".attendancelist-categories", formObject)
                                } catch (err) {
                                    console.log(err);
                                }
                            }
                        }
                    });
                }
            };
        };
    };
};

$(document).ready(function () {
    $("form", this).each(function () {
        com_attendancelist_feedback.category.html.addFilter(this);
    });
});