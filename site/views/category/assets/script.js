
var com_attendancelist_category = function (formObject, limit) {
    alert(limit);
    var cleanSetTimeOut = new Object();
    var eventHandler = 'click keypress keyup';

    this.prepare = function () {
        var selectors = new Array();
        var selectorname = "attendancelist-category-";
        $("[class*='" + selectorname + "']", formObject).each(function () {
            var pattern = new RegExp('^(.*?)(' + selectorname + ')(\\d{1,})(.*?)$');
            var level = parseInt($(this).prop("class").replace(pattern, "$3"));
            selectors[level] = new Object({
                "content": $(".attendancelist-category-items", this),
                "search": $("input#category-search-" + level, this)
            });
            prepareFilter(selectors, level, formObject);
        });
    };

    function prepareFilter(selectors, level, formObject) {
        if ((undefined !== selectors[level]) && (undefined !== selectors[level].search) && (undefined !== selectors[level].content)) {
            selectors[level].search.each(function () {
                $(this).on(eventHandler, function () {
                    $("div", selectors[level].content).css("display", "none");
                    $(".attendancelist-category-items-loading", selectors[level].content).remove();
                    selectors[level].content.append("<p class='text-center attendancelist-category-items-loading'>...</p>");
                    window.clearTimeout(cleanSetTimeOut[level]);
                    cleanSetTimeOut[level] = window.setTimeout(function () {
                        filterItems(formObject, selectors, level);
                    }, 700);
                });
            });
            prepareFilterParent(selectors, level);
        }
    }

    function prepareFilterParent(selectors, levelcurrent) {
        if ((selectors instanceof Object) && (selectors[levelcurrent] instanceof Object)) {
            for (var level = (levelcurrent - 1); level >= 0; level--) {
                selectors[level].search.each(function () {
                    $(this).on(eventHandler, function () {
                        selectors[levelcurrent].search.trigger('keypress');
                    });
                });
            }
        }
    }

    function filterItems(formObject, selectors, level) {
        if ($(formObject).is("form") && (selectors instanceof Object) && (undefined !== level)) {
            var serialize = $(formObject).serialize();
            serialize += "&level=" + level;
            jQuery.ajax({
                async: true,
                type: "post",
                dataType: "html",
                url: "/?option=com_attendancelist&view=category",
                data: serialize,
                complete: function (event, XMLHttpRequest) {
                    if (("success" == XMLHttpRequest) && (undefined != event.responseText)) {
                        try {
                            selectors[level].content.html(event.responseText);
                            prepareCheckboxParent(selectors, level);
                            prepareLabelColor(selectors[level].content);
                        } catch (err) {
                            console.log(err);
                        }
                    }
                }
            });
        }
    }

    function prepareCheckboxParent(selectors, levelcurrent) {
        if ((selectors instanceof Object) && (selectors[levelcurrent] instanceof Object)) {
            for (var level = (levelcurrent - 1); level >= 0; level--) {
                $("input.attendancelist-category-input", selectors[level].content).each(function () {
                    $(this).on(eventHandler, function () {
                        selectors[levelcurrent].search.trigger('keypress');
                    });
                });
            }
        }
    }

    function prepareLabelColor(elementObject) {
        $("label.attendancelist-category-label", elementObject).on('click keypress keyup', function () {
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