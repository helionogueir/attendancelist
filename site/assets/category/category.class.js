
var com_attendancelist_category = new function () {
    var eventHandler = 'click keypress keyup';
    this.cleanSetTimeOut = new Object();
    this.prepare = function (formObject) {
        var selectors = new Array();
        var selectorname = "attendancelist-level-panel-";
        $("[class*='" + selectorname + "']", formObject).each(function () {
            var pattern = new RegExp('^(.*?)(' + selectorname + ')(\\d{1,})(.*?)$');
            var level = parseInt($(this).prop("class").replace(pattern, "$3"));
            selectors[level] = new Object({
                "content": $(".attendancelist-level-items", this),
                "search": $("input#search-" + level, this)
            });
            prepareFilter(selectors, level, formObject);
        });
    };
    var prepareFilter = function (selectors, level, formObject) {
        if ((undefined !== selectors[level]) && (undefined !== selectors[level].search) && (undefined !== selectors[level].content)) {
            selectors[level].search.each(function () {
                $(this).on(eventHandler, function () {
                    $("div", selectors[level].content).css("display", "none");
                    $(".attendancelist-level-loading", selectors[level].content).remove();
                    selectors[level].content.append("<p class='text-center attendancelist-level-loading'>...</p>");
                    window.clearTimeout(com_attendancelist_category.cleanSetTimeOut[level]);
                    com_attendancelist_category.cleanSetTimeOut[level] = window.setTimeout(function () {
                        filterItems(formObject, selectors, level);
                    }, 700);
                });
            });
            prepareFilterParent(selectors, level);
        }
    };
    var prepareFilterParent = function (selectors, levelcurrent) {
        if ((selectors instanceof Object) && (selectors[levelcurrent] instanceof Object)) {
            for (var level in selectors) {
                if (level != levelcurrent) {
                    selectors[level].search.each(function () {
                        $(this).on(eventHandler, function () {
                            selectors[levelcurrent].search.trigger('keypress');
                        });
                    });
                }
            }
        }
    };
    var filterItems = function (formObject, selectors, level) {
        if ($(formObject).is("form") && (selectors instanceof Object) && (undefined !== level)) {
            var serialize = $(formObject).serialize();
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
                            selectors[level].content.html(event.responseText);
                            prepareCheckboxParent(selectors, level);
                        } catch (err) {
                            console.log(err);
                        }
                    }
                }
            });
        }
    };
    var prepareCheckboxParent = function (selectors, levelcurrent) {
        if ((selectors instanceof Object) && (selectors[levelcurrent] instanceof Object)) {
            for (var level = (levelcurrent - 1); level <= 0; level--) {
                $("input.attendancelist-category-checkbox", selectors[level].content).each(function () {
                    $(this).on(eventHandler, function () {
                        selectors[levelcurrent].search.trigger('keypress');
                    });
                });
            }
        }
    };
};