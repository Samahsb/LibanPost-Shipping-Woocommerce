<?php

/**
 * adding prepare LibanPost shipment button
 */
function libanpost_woocommerce_admin_order_data_after_order_details( $wccm_before_checkout ) {
	?>
	<div class="libanpost-btn prepare-shipment-btn" onclick="showShipmentDetails()"> Prepare LibanPost Shipment </div>
	<div class="libanpost-overlay" id="libanpost_overlay">
		<div class="libanpost-shipment-creation">
			<span class="dashicons dashicons-no-alt" onclick="hideShipmentDetails()"></span>
            <fieldset class="libanpost-fieldset">
                <legend>PK Order</legend>
                <div>
                    <label>PERSON FID</label>
                    <input type="text">
                </div>
                <div>
                    <label>ORDER SPEED ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>ORDER TYPE ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>ORDER ENTITY ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>REFERENCE ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>ESTIMATED NO OF ITEMS</label>
                    <input type="text">
                </div>
                <div>
                    <label>ESTIMATED WEIGHT</label>
                    <input type="text">
                </div>
                <div>
                    <label>ENTRY DATE</label>
                    <input type="text">
                </div>
                <div>
                    <label>EVT GMT DT</label>
                    <input type="text">
                </div>
                <div>
                    <label>EVT TRACKING NO DECD</label>
                    <input type="text">
                </div>
                <div>
                    <label>ORDER OCCURENCE ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>ORDER DATE</label>
                    <input type="text">
                </div>
                <div>
                    <label>ORDER STATUS</label>
                    <input type="text">
                </div>
                <div>
                    <label>NOTIFICATION TYPE CD</label>
                    <input type="text">
                </div>
            </fieldset>
            <fieldset class="libanpost-fieldset">
                <legend>PK Order Details</legend>
                <div>
                    <label>REFERENCE NO</label>
                    <input type="text">
                </div>
                <div>
                    <label>DEPOSITOR FULLNAME</label>
                    <input type="text">
                </div>
                <div>
                    <label>DEPOSITOR ADDRESS</label>
                    <input type="text">
                </div>
                <div>
                    <label>DEPOSITOR PHONE NO</label>
                    <input type="text">
                </div>
                <div>
                    <label>CLIENT FULLNAME</label>
                    <input type="text">
                </div>
                <div>
                    <label>CLIENT ADDRESS</label>
                    <input type="text">
                </div>
                <div>
                    <label>CLIENT PHONENO</label>
                    <input type="text">
                </div>
                <div>
                    <label>ESTIMATED WEIGHT</label>
                    <input type="text">
                </div>
                <div>
                    <label>VEHICLE TYPE ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>PREF VISIT DATE FROM</label>
                    <input type="text">
                </div>
                <div>
                    <label>PREF VISIT DATE TO</label>
                    <input type="text">
                </div>
                <div>
                    <label>EVTGMT DT</label>
                    <input type="text">
                </div>
                <div>
                    <label>ITEM DESC</label>
                    <input type="text">
                </div>
                <div>
                    <label>Notes</label>
                    <input type="text">
                </div>
            </fieldset>
            <fieldset class="libanpost-fieldset">
                <legend>PK Order Details Charges</legend>
                <div>
                    <label>FEES ID</label>
                    <input type="text">
                </div>
                <div>
                    <label>CURRENCY CD</label>
                    <input type="text">
                </div>
                <div>
                    <label>AMOUNT</label>
                    <input type="text">
                </div>
                <div>
                    <label>PAYMENT MODE ID</label>
                    <input type="text">
                </div>
            </fieldset>
            <div class="create-shipment">
                <div class="libanpost-ajax-response">
                    <div id="response"></div>
                    <div class="libanpost-loader" id="libanpostLoader"></div>
                </div>
                <div class="libanpost-btn" onclick="libanPostAJAXRequest()"> Create Shipment </div>
            </div>
		</div>
	</div>
	<?php
//    $order = wc_get_order();
//    var_dump($order->get_billing_first_name());
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'libanpost_woocommerce_admin_order_data_after_order_details', 10, 1 );
