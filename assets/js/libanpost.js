function showShipmentDetails() {
    libanpost_overlay.style.display = "block";
}
function hideShipmentDetails() {
    libanpost_overlay.style.display = "none";
}
let d = new Date();
let ms = d.getTime();
function submitLibanPostProject() {

    let clsItems = [];

    for (i = 0; i < dataItems.length; i++) {
        let item = {'PO_DETAILS_FID':dataItems[i]['libanpost-nb']};
        clsItems.push(item);
    }

    let projectData = {
        "Cls_PKOrder": {
            "PERSON_FID": erpCode.value,
            "ORDER_SPEED_ID": 1,
            "ORDER_TYPE_ID": 1,
            "ORDER_ENTITY_ID": 6,
            "REFERENCE_ID": "Order reference ID",
            "ESTIMATED_NOOFITEMS": 1,
            "ESTIMATED_WEIGHT": 2,
            "ENTRY_DATE": "\/Date("+ ms +")\/",
            "EVTGMTDT": "\/Date(-62135596800000)\/",
            "EVTTRACKINGNODECD": "TN790",
            "ORDER_OCCURENCE_ID": 1,
            "ORDER_DATE": "\/Date("+ ms +")\/",
            "ORDER_STATUS": false,
            "NOTIFICATIONTYPECD": "NL"
        },
        "Cls_Items": clsItems
    };
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        dataType: 'json',
        data: {
            action: 'libanpost_send_project',
            dataItems: dataItems,
            orderData: projectData,
        },
        beforeSend:function() {
            libanpost_loader_submit_project.style.display = "block";
            document.getElementById("projectResponse").innerHTML = '';
        },
        success: function(data) {
            if(data.ErrorCode == 0) {
                projectResponse.style.color = "green";
            } else {
                projectResponse.style.color = "red";
            }
            document.getElementById("projectResponse").innerHTML = data.ErrorDescription;
        },
        complete: function() {
            libanpost_loader_submit_project.style.display = "none";
        },
        error: function (jqXHR, exception) {
            let msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect. Verify Network';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found.';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error.';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error' + jqXHR.responseText;
            }
            document.getElementById("projectResponse").innerHTML = msg;
            projectResponse.style.color = "red";
        },
    });
}
function libanPostAJAXRequest() {
    let orderData = {
        "PK_Order": {
            "PERSON_FID": personFID.value,
            "ORDER_SPEED_ID": 1,
            "ORDER_TYPE_ID": 1,
            "ORDER_ENTITY_ID": 6,
            "REFERENCE_ID": referenceID.value,
            "ESTIMATED_NOOFITEMS": nbOfItems.value,
            "ESTIMATED_WEIGHT": 2,
            "ENTRY_DATE": "\/Date("+ ms +")\/",
            "EVTGMTDT": "\/Date(-62135596800000)\/",
            "EVTTRACKINGNODECD": "TN789",
            "ORDER_OCCURENCE_ID": 1,
            "ORDER_DATE": "\/Date("+ ms +")\/",
            "ORDER_STATUS": false,
            "NOTIFICATIONTYPECD": "NL"
        },
        "Lst_PK_ORDER_DETAILS": [{
            "REFERENCE_NO": referenceNb.value,
            "DEPOSITOR_FULLNAME": depositorName.value,
            "DEPOSITOR_ADDRESS": depositorAddress.value,
            "DEPOSITOR_PHONENO": phoneNb.value,
            "CLIENT_FULLNAME": billingFullName.value,
            "CLIENT_ADDRESS": document.getElementById("address").value,
            "CLIENT_PHONENO": phoneNb.value,
            "ESTIMATED_WEIGHT": 1,
            "VEHICLE_TYPE_ID": 1,
            "PREF_VISIT_DATE_FROM": "\/Date("+ ms +")\/",
            "PREF_VISIT_DATE_TO": "\/Date("+ ms +")\/",
            "EVTGMTDT": "\/Date("+ ms +")\/",
            "ITEM_DESC": " ",
            "Notes": notes.value
        }],
        "Lst_PK_ORDER_DETAILS_CHARGES": [{
            "FEESID": 0,
            "CURRENCYCD": orderCurrency.value,
            "AMOUNT": parseInt(orderAmount.value),
            "PAYMENTMODEID": 1
        }]
    };

    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        dataType: 'json',
        data: {
            action: 'libanpost_send_order',
            orderData: orderData,
        },
        beforeSend:function() {
            libanpostLoader.style.display = "block";
            document.getElementById("response").innerHTML = '';
        },
        success: function(data) {
            if(data.ErrorCode == 0) {
                response.style.color = "green";
                libanpostOrderNumber.value = "Order Nb: " + data.OrderNbr;
                prepareShipmentBtn.disabled = true;
                createShipmentBtn.disabled = true;
            } else {
                response.style.color = "red";
            }
            document.getElementById("response").innerHTML = data.ErrorDescription;
        },
        complete: function() {
            libanpostLoader.style.display = "none";
        },
        error: function (jqXHR, exception) {
            let msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect. Verify Network';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found.';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error.';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error' + jqXHR.responseText;
            }
            document.getElementById("response").innerHTML = msg;
            response.style.color = "red";
        },
    });
}
(function($){
    $(document).ready(function(){
        $('.post-type-shop_order .page-title-action').after( '<a href="/wp-admin/admin.php?page=submit-libanpost-project" id="request-libanpost-shipment" class="page-title-action">Submit Libanpost Project</a>' )
    });
})(jQuery);

function removeOrder(orderID) {
    let i, j;
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        dataType: 'json',
        data: {
            action: 'libanpost_project_remove_order',
            orderID: orderID,
        },
        beforeSend:function() {
                    document.getElementById('libanpost_loader_remove_btn_'+orderID).style.display = "inline-block";
        },
        success: function(response) {
            for(i=0; i<dataItems.length; i++) {
                if(response.data == dataItems[i]['id']) {
                    document.getElementById('libanpost_loader_remove_btn_'+orderID).style.display = "none";
                    delete dataItems[i];
                    for(j = i; j < dataItems.length; j++) {
                        dataItems[j] = dataItems[j+1];
                    }
                    dataItems.length = dataItems.length - 1;
                    document.getElementById('order-'+response.data).style.display = 'none';
                }
            }
        },
    })
}