
var com_attendancelist_category = new function () {
    var classNameLevel = "attendancelist-level-";
    var setContent = function (formObject, level, html) {
        html = (undefined !== html) ? html : $("<p class='text-center'>...<p>");
        $("." + classNameLevel + level + " .attendancelist-category-items", formObject).each(function () {
            $(this).html(html);
        });
    }
    this.cleanSetTimeOut = null;
    this.prepare = function (formObject) {
        $("[class*='" + classNameLevel + "']", formObject).each(function () {
            var pattern = new RegExp('^(.*?)(' + classNameLevel + ')(\\d{1,})(.*?)$');
            var level = $(this).prop("class").replace(pattern, "$3");
            $("input#" + classNameLevel + level, formObject).each(function () {
                $(this).on('click change keyup', function () {
                    var value = $(this).val();
                    setContent(formObject, level);
                    window.clearTimeout(com_attendancelist_category.cleanSetTimeOut);
                    com_attendancelist_category.cleanSetTimeOut = window.setTimeout(function () {
                        com_attendancelist_category.html.filter(formObject, value, parseInt(level));
                    }, 700);
                });
            });
        });
    };
    this.html = new function () {
        this.filter = function (formObject, search, level) {
            if ($(formObject).is("form") && (undefined !== search) && (undefined !== level)) {
                var serialize = $(formObject).serialize();
                serialize += "&search=" + search;
                serialize += "&level=" + level;
                jQuery.ajax({
                    async: true,
                    type: "post",
                    dataType: "html",
                    url: "/component/attendancelist/?view=category&task=filter",
                    data: serialize,
                    complete: function (event, XMLHttpRequest) {
                        if (("success" == XMLHttpRequest) && (undefined != event.responseText)) {
                            try {
                                setContent(formObject, level, event.responseText);
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