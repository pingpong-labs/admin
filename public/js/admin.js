(function() {
	
	$('.btn-form-delete').on('click', function(){
		var form = $(this).attr('data-form-id');
		if(confirm('Are you sure want to delete this data?'))
		{
			$(form).submit();
		}
		return false;
	});

})();