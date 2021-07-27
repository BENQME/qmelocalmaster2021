
  <div class="container">
  <?php //print_r($form_data) ?>
  <?php /*?> <div class="row">
      <div class="col-md-12"><pre id="token_response"></pre></div>
    </div><?php */?>
    <div class="row" style="padding:20px 0">
      <div class="col-md-4">
      <div class="card">
      <div class="card-header" style="font-size:18px; font-weight:700">Review and Pay</div>
      <?php $user_info2 = $this->session->userdata('form_dataa'); ?>
      <?php echo $price  =$user_info2->price ?>
      <?php 
	 //print_r($form_data); die;
	
	  if($form_data){
		  ?>
          <div class="card-body">
          <?php 
		   unset($form_data['submit']);
		   $_price = $form_data['price'];
		   $price =$_price*100;
		    unset($form_data['price']);
			foreach($form_data as $key=>$u_data){
				$mail_html .='<strong style="text-transform: capitalize; margin-bottom:15px">'.str_replace('_',' ',$key).': </strong>'.$u_data.'<br>';
			} 
			
			echo $mail_html;
			?>
             </div>
             <div class="card-footer">
             <button class="btn btn-primary" id="payment_btn" onclick="pay(<?php echo $price ?>)">$<?php echo $_price ?> for 3 months</button>
             </div>
		<?php 
		} ?>
       
       </div>
      </div>
      
    </div>
</div>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
  
<script type="text/javascript">
  
  function pay(amount) {
    var handler = StripeCheckout.configure({
      key: '<?php echo $this->config->item('stripe_key');?>',
      locale: 'auto',
      token: function (token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log('Token Created!!');
        console.log(token)
        $('#token_response').html(JSON.stringify(token));
  
        $.ajax({
          url:"<?php echo base_url('payment/payment_post') ?>",
          method: 'post',
          data: { tokenId: token.id, amount: amount },
          dataType: "json",
          success: function( response ) {
            console.log(response.data);
			window.location.href="<?php echo base_url('payment/payment_success?req=') ?>"+JSON.stringify(response.data)
           // $('#token_response').append( '<br />' + JSON.stringify(response.data));
          }
        })
      }
    });
   
    handler.open({
      name: '<?php echo site_info() ?>',
      description: '',
      amount: amount
    });
  }
</script>