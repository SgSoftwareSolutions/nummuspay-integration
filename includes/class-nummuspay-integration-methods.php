<?php
add_action( 'woocommerce_thankyou', 'nummuspay_checkout', 20 );
if (!function_exists( 'nummuspay_checkout' )) {
    function nummuspay_checkout($order_id) {
        if ($order_id > 0) {
            $order = wc_get_order($order_id);
            if ($order instanceof WC_Order) {
                ?>
                <script>$ = jQuery.noConflict(true);</script>
                <script src="https://api.nummuspay.com/Content/js/v1/nummuspay.js"></script>
                <script type="text/javascript">
                    var orderData = <?php echo json_encode($order->get_data()) ?>;
                    Nummuspay.Checkout({
                        merchantUniqueID: orderData.number,
                        publicCheckoutPageID: <?php echo get_option('YOUR_CHECKOUT_PAGE_ID_FROM_NUMMUSPAY'); ?>,
                        currency: orderData.currency,
                        amount: orderData.total,
                        tax: 0,
                        firstName: orderData.billing.first_name,
                        lastName: orderData.billing.last_name,
                        email: orderData.billing.email,
                        company: orderData.billing.company,
                        phone: orderData.billing.phone,
                        billingAddress1: orderData.billing.address_1,
                        billingAddress2: orderData.billing.address_2,
                        billingCountry: orderData.billing.country,
                        billingState: orderData.billing.state,
                        billingCity: orderData.billing.city,
                        billingZip: orderData.billing.postcode
                    });
                </script>
                <?php
            }
        }
    }
}

function myplugin_register_options_page() {
  add_options_page('Nummuspay Integration', 'Nummuspay Integration', 'manage_options', 'nummuspay-integration', 'myplugin_option_page'); 
}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_option_page()
{

	if(isset($_POST['NUMMUSPAYSubmit'])){
		update_option('YOUR_CHECKOUT_PAGE_ID_FROM_NUMMUSPAY',$_POST['NUMMUSPAYValue']);
	}
	?>
		<h1>Nummuspay Integration </h1>
		<div class="numpaydiv">
			<form method="POST">
				<div class="numpaydiv">YOUR CHECKOUT PAGE ID FROM NUMMUSPAY:<br><input type="text" name="NUMMUSPAYValue" value="<?php echo get_option('YOUR_CHECKOUT_PAGE_ID_FROM_NUMMUSPAY'); ?>"></div>
				<div class="numpaydiv"><input type="submit" name="NUMMUSPAYSubmit" value="Insert"></div>
			</form>
		</div>
		<style>
			div.numpaydiv{
				padding: 5px;
			}
		</style>
	<?php
	
}

