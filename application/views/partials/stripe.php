<form action="/orders/add_order" method="POST" id='stripe_form'>
  	<script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	    data-key="pk_test_TsFSAKZLulrG483VcpHU0vVP"
	    data-amount="<?=$sum*100?>"
	    data-name="Stripe.com"
	    data-description="Widget"
	    data-image="/img/documentation/checkout/marketplace.png"
    	data-locale="auto">
  	</script>
</form>