
var com_attendancelist_category = function (formObject, level, limit, locked) {

    var delay = 500;
    var cleanSetTimeOut = new Object();
    var eventHandler = 'click keypress keyup';

    this.prepare = function () {
        if ($(formObject).is("form")) {
            $("[class*='attendancelist-category-" + level + "']", formObject).each(function () {
                var category = this;
                $(".attendancelist-category-items", this).each(function () {
                    var item = this;
                    $("input#category-search-" + level, category).on(eventHandler, function () {
                        var search = this;
                        $("div", item).css("display", "none");
                        $(".attendancelist-category-items-loading", item).remove();
                        $(item).append("<p class='text-center attendancelist-category-items-loading'>...</p>");
                        window.clearTimeout(cleanSetTimeOut[level]);
                        cleanSetTimeOut[level] = window.setTimeout(function () {
                            filterItems(item, search);
                        }, delay);
                    }).each(function () {
                        prepareFilterParent(this);
                    });
                });
            });
        }
    };

    function filterItems(item, search) {
        var serialize = $(formObject).serialize();
        serialize += "&level=" + level;
        serialize += "&limit=" + limit;
        serialize += "&locked=" + locked;
        jQuery.ajax({
            async: true,
            type: "post",
            dataType: "html",
            url: "/?option=com_attendancelist&view=category",
            data: serialize,
            complete: function (event, XMLHttpRequest) {
                if (("success" == XMLHttpRequest) && (undefined != event.responseText)) {
                    try {
                        $(item).html(event.responseText);
                        window.clearTimeout(cleanSetTimeOut[level]);
                        cleanSetTimeOut[level] = window.setTimeout(function () {
                            prepareCheckboxParent(search);
                            prepareLabelColor(item);
                        }, delay);
                    } catch (err) {
                        console.log(err);
                    }
                }
            }
        });
    }

    function prepareFilterParent(search) {
        if ($(search).is("input")) {
            for (var lv = (level - 1); lv >= 0; lv--) {
                $(".attendancelist-category input#category-search-" + lv, formObject).each(function () {
                    $(this).on(eventHandler, function () {
                        $(search).trigger('keypress');
                    });
                });
            }
        }
    }

    function prepareCheckboxParent(search) {
        if ($(search).is("input")) {
            for (var lv = (level - 1); lv >= 0; lv--) {
                var selector = $(".attendancelist-category-" + lv + " .attendancelist-category-items", formObject);
                $("input.attendancelist-category-input", selector).each(function () {
                    $(this).on(eventHandler, function () {
                        $(search).trigger('click');
                    });
                });
            }
        }
    }

    function prepareLabelColor(item) {
        $("label.attendancelist-category-label", item).on('click keypress keyup', function () {
            var label = this;
            $(label).find("input.attendancelist-category-input").each(function () {
                if ($(this).prop("checked")) {
                    $(label).addClass("attendancelist-category-label-checked");
                } else {
                    $(label).removeClass("attendancelist-category-label-checked");
                }
            });
        });
    }

};