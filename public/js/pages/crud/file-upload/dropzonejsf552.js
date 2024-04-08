"use strict";
var KTDropzoneDemo = {
    init: function() {
        $("#kt_dropzone_3").dropzone({
                // url: "https://keenthemes.com/scripts/void.php",
                paramName: "file",
                maxFiles: 10,
                maxFilesize: 10,
                addRemoveLinks: !0,
                // acceptedFiles: "image/*,application/pdf,.psd",
                accept: function(e, o) {
                    // "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
                }
            })
    }
};
KTUtil.ready((function() {
    KTDropzoneDemo.init()
}));