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
			<fieldset>
				<legend>Billing Account</legend>
				<input type="text">
			</fieldset>
            <fieldset>
                <legend>Billing Account</legend>
                <input type="text">
            </fieldset>
            <div class="create-shipment">
                <div class="libanpost-ajax-response" id="response">
                    <div class="libanpost-loader" id="libanpostLoader"></div>
                </div>
                <div class="libanpost-btn" onclick="libanPostAJAXRequest()"> Create Shipment </div>
            </div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'libanpost_woocommerce_admin_order_data_after_order_details', 10, 1 );
