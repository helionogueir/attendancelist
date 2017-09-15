
var com_attendancelist_validate = function (formObject) {

    this.validate = function () {
        if ($(formObject).is("form")) {
            var rowSet = new Array();
            $(".attendancelist-form-require", formObject).each(function () {
                rowSet[rowSet.length] = validateRequire(this);
            });
            $(".attendancelist-form-require-checkbox", formObject).each(function () {
                rowSet[rowSet.length] = validateRequireCheckbox(this);
            });
            /*$(".attendancelist-form-date", formObject).each(function () {
             rowSet[rowSet.length] = validateDate(this);
             });
             $(".attendancelist-form-time-24", formObject).each(function () {
             rowSet[rowSet.length] = validateTime24(this);
             });*/
        }
        return isValid(rowSet);
    };

    function prepareResponse(elementObject) {
        var response = null;
        if (undefined !== elementObject) {
            response = new Object({
                "element": elementObject,
                "label": $(elementObject).attr("data-label"),
                "error": false
            });
        }
        return response;
    }

    function isValid(rowSet) {
        var valid = false;
        var message = attendancelist.message["validate:response:invalid"] + "\n";
        if (rowSet instanceof Object) {
            valid = true;
            for (var i = 0, row; (row = rowSet[i++]); ) {
                if (row.error) {
                    valid = false;
                    message += "\n- " + row.label;
                }
            }
        }
        if (!valid) {
            alert(message);
        }
        return valid;
    }

    function validateRequire(elementObject) {
        var data = prepareResponse(elementObject);
        if (data instanceof Object) {
            var value = $(elementObject).val();
            if ((null === value) || ("" === value)) {
                data.error = true;
            }
        }
        return data;
    }

    function validateRequireCheckbox(divObject) {
        var data = prepareResponse(divObject);
        if (data instanceof Object) {
            data.error = true;
            $("input[type=checkbox]:checked", divObject).each(function () {
                data.error = false;
            });
        }
        return data;
    }

    function validateDate(elementObject) {
        var data = prepareResponse(elementObject);
        if (data instanceof Object) {
            var value = $(elementObject).val();
            var pattern = /^(\d{2})\/(\d{2})\/(\d{4})$/;
            if (!pattern.test(value)) {
                data.error = true;
            }
        }
        return data;
    }

    function validateTime24(elementObject) {
        var data = prepareResponse(elementObject);
        if (data instanceof Object) {
            var value = $(elementObject).val();
            var pattern = /^(\d{2})\:(\d{2})$/;
            if (!pattern.test(value)) {
                data.error = true;
            }
        }
        return data;
    }
};