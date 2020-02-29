!function (t) {
    "use strict";

    function a() {
    }

    a.prototype.init = function () {
        t("#datepicker").datepicker(), t("#datepicker-inline").datepicker(), t("#datepicker-multiple").datepicker({
            numberOfMonths: 3,
            showButtonPanel: !0
        }), t("#datepicker").datepicker(), t("#datepicker-autoclose").datepicker({
            autoclose: !0,
            todayHighlight: !0
        }), t("#datepicker-multiple-date").datepicker({
            format: "mm/dd/yyyy",
            clearBtn: !0,
            multidate: !0,
            multidateSeparator: ","
        }), t("input#defaultconfig").maxlength({
            warningClass: "badge badge-info",
            limitReachedClass: "badge badge-warning"
        }), t("input#thresholdconfig").maxlength({
            threshold: 20,
            warningClass: "badge badge-info",
            limitReachedClass: "badge badge-warning"
        }), t("input#moreoptions").maxlength({
            alwaysShow: !0,
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-danger"
        }), t("input#alloptions").maxlength({
            alwaysShow: !0,
            warningClass: "badge badge-success",
            limitReachedClass: "badge badge-danger",
            separator: " out of ",
            preText: "You typed ",
            postText: " chars available.",
            validate: !0
        }), t("textarea#textarea").maxlength({
            alwaysShow: !0,
            warningClass: "badge badge-info",
            limitReachedClass: "badge badge-warning"
        }), t("input#placement").maxlength({
            alwaysShow: !0,
            placement: "top-left",
            warningClass: "badge badge-info",
            limitReachedClass: "badge badge-warning"
        })
    }, t.AdvancedForm = new a, t.AdvancedForm.Constructor = a
}(window.jQuery), function () {
    "use strict";
    window.jQuery.AdvancedForm.init()
}();
