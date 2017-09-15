
var com_attendancelist_validate = function (formObject) {

    this.validate = function () {
        var valid = false;
        if ($(formObject).is("form")) {
            var rowSet = new Array();
            $(".attendancelist-form-require", formObject).each(function () {
                rowSet[rowSet.length] = require(this);
            });
        }
        return isValid(rowSet);
    };

    function require(elementObject) {
        var data = prepareResponse(elementObject);
        if (data instanceof Object) {
            if ((null === data.value) || ("" === data.value)) {
                data.error = true;
            }
        }
        return data;
    }

    function prepareResponse(elementObject) {
        var response = null;
        if (undefined !== elementObject) {
            response = new Object({
                "element": elementObject,
                "label": $(elementObject).attr("data-label"),
                "value": $(elementObject).val(),
                "error": false
            });
        }
        return response;
    }

    function isValid(rowSet) {
        var valid = false;
        var messages = new Array();
        if (rowSet instanceof Object) {
            valid = true;
            for (var i = 0, row; (row = rowSet[i++]); ) {
                if (row.error) {
                    valid = false;
                    messages[messages.length] = row.label;
                }
            }
        }
        if (!valid) {
            alert(messages);
        }
        return valid;
    }
};