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
            libanpostLoader.style.display = "block";
        },
        success: function(msg) {
            document.getElementById("response").innerHTML = 'success';
            response.style.color = "green";
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                document.getElementById("response").innerHTML = 'Not connect. Verify Network';
                response.style.color = "red";
            } else if (jqXHR.status == 404) {
                document.getElementById("response").innerHTML = 'Requested page not found.';
                response.style.color = "red";
            } else if (jqXHR.status == 500) {
                document.getElementById("response").innerHTML = 'Internal Server Error.';
                response.style.color = "red";
            } else if (exception === 'parsererror') {
                document.getElementById("response").innerHTML = 'Requested JSON parse failed.';
                response.style.color = "red";
            } else if (exception === 'timeout') {
                document.getElementById("response").innerHTML = 'Time out error';
                response.style.color = "red";
            } else if (exception === 'abort') {
                document.getElementById("response").innerHTML = 'Ajax request aborted.';
                response.style.color = "red";
            } else {
                document.getElementById("response").innerHTML = 'Uncaught Error' + jqXHR.responseText;
                response.style.color = "red";
            }
        },
        timeout: 5000
    });
}