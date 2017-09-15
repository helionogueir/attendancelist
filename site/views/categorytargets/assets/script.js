
var com_attendancelist_categorytargets = function (formObject) {

    var delay = 500;
    var cleanSetTimeOut = null;
    var eventHandler = 'click keypress keyup';

    this.prepare = function () {
        if ($(formObject).is("form")) {
            $("[class*='attendancelist-categorytargets']", formObject).each(function () {
                var categorytargets = this;
                $(".attendancelist-categorytargets-items", this).each(function () {
                    var item = this;
                    $("input#categorytargets-search", categorytargets).on(eventHandler, function () {
                        var search = this;
                        $("div", item).css("display", "none");
                        $(".attendancelist-categorytargets-items-loading", item).remove();
                        $(item).append("<p class='text-center attendancelist-categorytargets-items-loading'>...</p>");
                        window.clearTimeout(cleanSetTimeOut);
                        cleanSetTimeOut = window.setTimeout(function () {
                            filterItems(item, search);
                        }, delay);
                    }).each(function () {
                        prepareCategoriesSearch(this);
                    });
                });
            });
        }
    };

    function filterItems(item, search) {
        var serialize = $(formObject).serialize();
        jQuery.ajax({
            async: true,
            type: "post",
            dataType: "html",
            url: "/?option=com_attendancelist&view=categorytargets",
            data: serialize,
            complete: function (event, XMLHttpRequest) {
                if (("success" == XMLHttpRequest) && (undefined != event.responseText)) {
                    try {
                        $(item).html(event.responseText);
                        window.clearTimeout(cleanSetTimeOut);
                        cleanSetTimeOut = window.setTimeout(function () {
                            prepareCategoriesCheckbox(search);
                            prepareLabelColor(item);
                        }, delay);
                    } catch (err) {
                        console.log(err);
                    }
                }
            }
        });
    }

    function prepareCategoriesSearch(search) {
        if ($(search).is("input")) {
            var selector = $(".attendancelist-category", formObject);
            $("input.attendancelist-category-search", selector).each(function () {
                $(this).on(eventHandler, function () {
                    $(search).trigger('click');
                });
            });
        }
    }

    function prepareCategoriesCheckbox(search) {
        if ($(search).is("input")) {
            var selector = $(".attendancelist-category .attendancelist-category-items", formObject);
            $("input.attendancelist-categorytargets-input", selector).each(function () {
                $(this).on(eventHandler, function () {
                    $(search).trigger('click');
                });
            });
        }
    }

    function prepareLabelColor(item) {
        $("label.attendancelist-categorytargets-label", item).on('click keypress keyup', function () {
            var label = this;
            $(label).find("input.attendancelist-categorytargets-input").each(function () {
                if ($(this).prop("checked")) {
                    $(label).addClass("attendancelist-categorytargets-label-checked");
                } else {
                    $(label).removeClass("attendancelist-categorytargets-label-checked");
                }
            });
        });
    }

};