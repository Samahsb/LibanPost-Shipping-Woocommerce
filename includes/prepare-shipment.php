<?php

/**
 * adding prepare LibanPost shipment button
 */
function libanpost_woocommerce_admin_order_data_after_order_details( $wccm_before_checkout ) {
    $order = wc_get_order();
    $billing_fname = $order->get_billing_first_name();
    $billing_lname = $order->get_billing_last_name();
    $order_id = $order->get_id();
    $order_currency = $order->get_currency();
    $order_total = $order->get_total();
    $client_phonenb = $order->get_billing_phone();
    $total_quantity = $order->get_item_count();
    $billing_address1 =  $order->get_billing_address_1();
    $billing_address2 =  $order->get_billing_address_2();
    $billing_city = $order->get_billing_city();
    $order_date = $order->order_date;
    $order_status  = $order->get_status();
    ?>
    <input style="display: none" type="text" id="token" value="<?php echo get_option("wc_settings_tab_token") ?>">
	<div class="libanpost-btn prepare-shipment-btn" onclick="showShipmentDetails()"> Prepare LibanPost Shipment </div>
	<div class="libanpost-overlay" id="libanpost_overlay">
		<div class="libanpost-shipment-creation">
			<span class="dashicons dashicons-no-alt" onclick="hideShipmentDetails()"></span>
            <form action="#">
                <fieldset class="libanpost-fieldset">
                    <legend>PK Order</legend>
                    <div>
                        <label>PERSON FID</label>
                        <input type="text" id="personFID" value="<?php echo get_option("wc_settings_tab_erpcode") ?>">
                    </div>
                    <div>
                        <label>REFERENCE ID</label>
                        <input type="text" id="referenceID" value="<?php echo $order_id ?>">
                    </div>
                    <div>
                        <label>ESTIMATED NO OF ITEMS</label>
                        <input type="text" id="nbOfItems" value="<?php echo $total_quantity ?>">
                    </div>
                    <div>
                        <label>ENTRY DATE</label>
                        <input type="text" value="<?php echo $order_date ?>">
                    </div>
                    <div>
                        <label>ORDER DATE</label>
                        <input type="text" value="<?php echo $order_date ?>">
                    </div>
                </fieldset>
                <fieldset class="libanpost-fieldset">
                    <legend>PK Order Details</legend>
                    <div>
                        <label>REFERENCE NO</label>
                        <input type="text" id="referenceNb" value= "<?php echo $order_id ?>">
                    </div>
                    <div>
                        <label>DEPOSITOR FULLNAME</label>
                        <input type="text" id="depositorName" value= "<?php echo $billing_fname. ' ' .$billing_lname ?>">
                    </div>
                    <div>
                        <label>DEPOSITOR ADDRESS</label>
                        <input type="text" id="depositorAddress" value="Lebanon">
                    </div>
                    <div>
                        <label>DEPOSITOR PHONE NO</label>
                        <input type="text" value="<?php echo $client_phonenb ?>">
                    </div>
                    <div>
                        <label>CLIENT FULLNAME</label>
                        <input type="text" id="billingFullName" value= "<?php echo $billing_fname. ' ' .$billing_lname ?>" >
                    </div>
                    <div>
                        <label>CLIENT PHONENO</label>
                        <input type="text" id="phoneNb" value="<?php echo $client_phonenb ?>">
                    </div>
                    <div>
                        <label>Notes</label>
                        <input type="text" id="notes">
                    </div>
                    <div class="libanpost-textarea">
                        <label>CLIENT ADDRESS</label>
                        <textarea rows="2" id="address"><?php echo $billing_city. ' ' . $billing_address1. ' ' .$billing_address2 ?></textarea>
                    </div>
                </fieldset>
                <fieldset class="libanpost-fieldset">
                    <legend>PK Order Details Charges</legend>
                    <div>
                        <label>CURRENCY CD</label>
                        <input type="text" id="orderCurrency" value= "<?php echo $order_currency ?>">
                    </div>
                    <div>
                        <label>AMOUNT</label>
                        <input type="text" id="orderAmount" value=" <?php echo $order_total ?>">
                    </div>
                </fieldset>
            </form>
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
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'libanpost_woocommerce_admin_order_data_after_order_details', 10, 1 );
