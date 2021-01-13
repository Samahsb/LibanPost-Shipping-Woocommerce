function showShipmentDetails() {
    libanpost_overlay.style.display = "block";
}
function hideShipmentDetails() {
    libanpost_overlay.style.display = "none";
}
function libanPostAJAXRequest() {
    jQuery.ajax({
        type: 'POST',
        url:'https://hemi.libanpost.com/api/PKOrder?token=Token_Given&ERPCode=ERP',
        dataType: 'json',
        data: {
            "PK_Order": {
                "PERSON_FID": "C????",
                "ORDER_SPEED_ID": 1,
                "ORDER_TYPE_ID": 1,
                "ORDER_ENTITY_ID": 6,
                "REFERENCE_ID": "Order reference ID",
                "ESTIMATED_NOOFITEMS": 1,
                "ESTIMATED_WEIGHT": 2,
                "ENTRY_DATE": "\/Date(1555577215404)\/",
                "EVTGMTDT": "\/Date(-62135596800000)\/",
                "EVTTRACKINGNODECD": "TN789",
                "ORDER_OCCURENCE_ID": 1,
                "ORDER_DATE": "\/Date(1555577215404)\/",
                "ORDER_STATUS": false,
                "NOTIFICATIONTYPECD": "NL"
            },
            "Lst_PK_ORDER_DETAILS": [{
                "REFERENCE_NO": "Tracking reference ID",
                "DEPOSITOR_FULLNAME": "Depositor Full Name",
                "DEPOSITOR_ADDRESS": "Lebanon",
                "DEPOSITOR_PHONENO": "",
                "CLIENT_FULLNAME": "Customer Name",
                "CLIENT_ADDRESS": "Customer address",
                "CLIENT_PHONENO": "01629629",
                "ESTIMATED_WEIGHT": 1,
                "VEHICLE_TYPE_ID": 1,
                "PREF_VISIT_DATE_FROM": "\/Date(1555577215404)\/",
                "PREF_VISIT_DATE_TO": "\/Date(1555577215404)\/",
                "EVTGMTDT": "\/Date(1555577215404)\/",
                "ITEM_DESC": " ",
                "Notes": " "
            }],
            "Lst_PK_ORDER_DETAILS_CHARGES": [{
                "FEESID": 0,
                "CURRENCYCD": "LBP",
                "AMOUNT": 100000,
                "PAYMENTMODEID": 1
            }]
        },
        beforeSend:function() {
            libanpostLoader.style.display = "block";
            document.getElementById("response").innerHTML = '';
        },
        success: function(data) {
            if(data.ErrorCode == 0) {
                response.style.color = "green";
            } else {
                response.style.color = "red";
            }
            document.getElementById("response").innerHTML = data.ErrorDescription;
        },
        complete: function() {
            libanpostLoader.style.display = "none";
        },
        error: function (jqXHR, exception) {
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
    });
}