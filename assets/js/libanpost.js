function showShipmentDetails() {
    libanpost_overlay.style.display = "block";
}
function hideShipmentDetails() {
    libanpost_overlay.style.display = "none";
}
function libanPostAJAXRequest() {
    // const http = new XMLHttpRequest();
    // http.onload = function () {
    //     const response = document.getElementById("response");
    //     response.innerHTML = this.responseText;
    // }
    // http.open("POST", "https://hemi.libanpost.com/api/PKOrder?token=Token_Given&ERPCode=ERP");
    // http.send();

    jQuery.ajax({

        type: 'POST',
        url:'https://hemi.libanpost.com/api/PKOrder?token=Token_Given&ERPCode=ERP',

        beforeSend:function() {
            //loader()
        },
        success: function(msg) {
            alert('success');
            },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect. Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        },
        timeout: 5000
    });
}