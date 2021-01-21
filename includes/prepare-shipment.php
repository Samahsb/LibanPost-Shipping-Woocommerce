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
    $libanpost_number = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );
    $libanpost_sent = wc_get_order_item_meta( $order->get_id(), 'libanpost_sent_project', true );
    ?>
    <form action="#" method="POST">
    <div class="libanpost-main">
        <input <?php echo ( ! empty ( $libanpost_number ) ) ? 'disabled ' : '';?>class="button-primary prepare-shipment-btn" value="Prepare LibanPost Shipment" id="prepareShipmentBtn" size="24" onclick="showShipmentDetails()">
        <input type="text" id="libanpostOrderNumber" name="libanpostOrderNumber" disabled value="<?php echo ( ! empty( $libanpost_number ) )? $libanpost_number : 'No order number yet';?>">
        <input type="text" id="libanpostSentProject" name="libanpostSentProject" disabled value="<?php echo ( ! empty( $libanpost_sent ) )? 'Sent to LibanPost' : 'Not Sent to LibanPost';?>">
    </div>
	<div class="libanpost-overlay" id="libanpost_overlay">
		<div class="libanpost-shipment-creation">
			<span class="dashicons dashicons-no-alt" onclick="hideShipmentDetails()"></span>
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