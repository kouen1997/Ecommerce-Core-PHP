<br><br><br><br>
<footer class="text-center" id="footer">&copy; 2017 Norman - Bryan - Shawn - Sheena</footer>
	
	<!-- eto yung para mag pop up pag click ng buy -->

	<script>

		function buy(id){
		var data={"id" : id};
		jQuery.ajax({
		url : '/ejventerprises/include/detailsmodal.php',
		method : "POST",
		data : data,
		success : function(data){
      jQuery('body').append(data);
      jQuery('#buy-modal').modal('toggle');
    },
    error : function(){
      alert("Something went wrong!");
    }
  });
}
function update_cart(mode,edit_id,edit_size){
var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
jQuery.ajax({
url : '/ejventerprises/admin/parsers/update_cart.php',
method: "post",
data : data,
success: function(){location.reload();},
error: function(){alert("Something went wrong");},
});
}
	function add_to_cart(){
jQuery('#modal_errors').html("");
var size = jQuery('#size').val();
var quantity = jQuery('#quantity').val();
var available = jQuery('#available').val();
var error = '';
var data = jQuery('#add_product_form').serialize();
if(size == '' || quantity == '' || quantity == 0){
error += '<p class="text-danger text-center">Choose a size and Quantity</p>';
jQuery('#modal_errors').html(error);
return;
}else if(quantity > available){
error += '<p class="text-danger text-center">There are only '+available+' available</p>';
jQuery('#modal_errors').html(error);
return;
}else{
jQuery.ajax({
url: '/ejventerprises/admin/parsers/add_cart.php',
method: 'post',
data: data,
success: function(){
location.reload();
},
error:function(){alert("Something Went wrong");}
});
}
}

	</script>
	 
	
	
	
	
</body>
</html>
