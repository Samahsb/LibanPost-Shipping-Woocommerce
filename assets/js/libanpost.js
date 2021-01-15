function showShipmentDetails() {
    libanpost_overlay.style.display = "block";
}
function hideShipmentDetails() {
    libanpost_overlay.style.display = "none";
}
function libanPostAJAXRequest() {
    let d = new Date();
    let ms = d.getTime();
    jQuery.ajax({
        type: 'POST',
        url:'https://hemi.Libanpost.com/api/PKOrder?token=Token_Given&ERPCode=ERP',
        dataType: 'json',
        data: {
            "PK_Order": {
                "PERSON_FID": personFID.value,
                "ORDER_SPEED_ID": 1,
                "ORDER_TYPE_ID": 1,
                "ORDER_ENTITY_ID": 6,
                "REFERENCE_ID": referenceID.value,
                "ESTIMATED_NOOFITEMS": nbOfItems.value,
                "ESTIMATED_WEIGHT": 2,
                "ENTRY_DATE": ms,
                "EVTGMTDT": "\/Date(-62135596800000)\/",
                "EVTTRACKINGNODECD": "TN789",
                "ORDER_OCCURENCE_ID": 1,
                "ORDER_DATE": ms,
                "ORDER_STATUS": false,
                "NOTIFICATIONTYPECD": "NL"
            },
            "Lst_PK_ORDER_DETAILS": [{
                "REFERENCE_NO": referenceNb.value,
                "DEPOSITOR_FULLNAME": "Depositor Full Name",
                "DEPOSITOR_ADDRESS": "Lebanon",
                "DEPOSITOR_PHONENO": "",
                "CLIENT_FULLNAME": billingFullName.value,
                "CLIENT_ADDRESS": document.getElementById("address").value,
                "CLIENT_PHONENO": phoneNb.value,
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
                "CURRENCYCD": orderCurrency.value,
                "AMOUNT": orderAmount.value,
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