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
    $libanpost_number = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );
    $libanpost_sent = wc_get_order_item_meta( $order->get_id(), 'libanpost_project_id', true );
    $mouhafaza = get_post_meta( $order->get_id(), 'billing_mouhafaza', true );
    $caza = get_post_meta( $order->get_id(), 'billing_caza', true );
    ?>
    <form action="#" method="POST">
    <div class="libanpost-main">
        <input <?php echo ( ! empty ( $libanpost_number ) ) ? 'disabled ' : '';?>class="button-primary prepare-shipment-btn" value="Prepare LibanPost Shipment" id="prepareShipmentBtn" size="24" onclick="showShipmentDetails()">
        <input type="text" id="libanpostOrderNumber" name="libanpostOrderNumber" disabled value="<?php echo ( ! empty( $libanpost_number ) )? 'Order Nb: ' . $libanpost_number : 'No LibanPost Order Nb';?>">
        <input type="text" id="libanpostSentProject" name="libanpostSentProject" disabled value="<?php echo ( ! empty( $libanpost_sent ) )? 'Project ID: ' . $libanpost_sent : 'Not in LibanPost Project';?>">
    </div>
	<div class="libanpost-overlay" id="libanpost_overlay">
		<div class="libanpost-shipment-creation">
			<span class="dashicons dashicons-no-alt" onclick="hideShipmentDetails()"></span>
                <fieldset class="libanpost-fieldset">
                    <legend>Pick Up Order</legend>
                    <div class="hidden">
                        <label>Person FID</label>
                        <input type="text" id="personFID" value="<?php echo get_option("wc_settings_tab_erpcode") ?>">
                    </div>
                    <div>
                        <label>Reference ID (Order ID)</label>
                        <input type="text" id="referenceID" disabled value="<?php echo $order_id ?>">
                    </div>
                    <div>
                        <label>Number of Items</label>
                        <input type="text" id="nbOfItems" disabled value="<?php echo $total_quantity ?>">
                    </div>
                </fieldset>
                <fieldset class="libanpost-fieldset">
                    <legend>Pick Up Order Details</legend>
                    <div class="hidden">
                        <label>Depositor Fullname</label>
                        <input type="text" id="depositorName" value="<?php echo get_option("wc_settings_tab_api_name") ?>">
                    </div>
                    <div class="hidden">
                        <label>Depositor Phone number</label>
                        <input type="text" id="depositorPhoneNb" value="<?php echo get_option("wc_settings_tab_api_phone_nb") ?>">
                    </div>
                    <div class="hidden">
                        <label>Depositor Address</label>
                        <textarea rows="2" id="depositorAddress"><?php echo get_option("wc_settings_tab_api_address") ?></textarea>
                    </div>

                    <div>
                        <label>Client Full Name</label>
                        <input type="text" id="billingFullName" value= "<?php echo $billing_fname. ' ' .$billing_lname ?>" >
                    </div>
                    <div>
                        <label>Client Phone Number</label>
                        <input type="text" id="phoneNb" value="<?php echo $client_phonenb ?>">
                    </div>
                    <div class="full-width">
                        <label>Client Address</label>
                        <textarea rows="4" id="address"><?php echo $mouhafaza . ' - ' . $caza . ' - ' . $billing_city . ' - ' . $billing_address1 . ' - ' . $billing_address2;?></textarea>
                    </div>
                    <div class="full-width">
                        <label>Notes</label>
                        <input type="text" id="notes">
                    </div>
                </fieldset>
                <fieldset class="libanpost-fieldset">
                    <legend>Pick Up Order Charges</legend>
                    <div>
                        <label>Amount</label>
                        <input type="text" id="orderAmount" value="<?php echo $order_total ?>">
                    </div>
                    <div>
                        <label>Currency</label>
                        <input type="text" id="orderCurrency" disabled value="<?php echo $order_currency ?>">
                    </div>
                </fieldset>
            <div class="create-shipment">
                <div class="libanpost-ajax-response">
                    <div id="response"></div>
                    <div class="libanpost-loader" id="libanpostLoader"></div>
                </div>
                <input type="button" class="button-primary create-shipment-btn" value="Create Shipment" id="createShipmentBtn" onclick="libanPostAJAXRequest()">
            </div>
		</div>
	</div>
    </form>
    <?php
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'libanpost_woocommerce_admin_order_data_after_order_details', 10, 1 );