$(document).ready(function(){
	// Ensure login button is enabled on page load
	$('.save').prop('disabled', false).removeAttr('disabled');
	
	$(".login-as").click(function(){
		var uname = jQuery(this).data('username');
		var password = jQuery(this).data('password');
		jQuery('#iusername').val(uname);
		jQuery('#ipassword').val(password);
	});
	
	$("#hrm-form").submit(function(e){
		$('.save').prop('disabled', true);
		$('.saveinfo').removeClass('ft-unlock');
		$('.saveinfo').addClass('fa spinner fa-refresh');
	/*Form Submit*/
	e.preventDefault();
	var obj = $(this), action = obj.attr('name'), redirect_url = obj.data('redirect'), form_table = obj.data('form-table'),  is_redirect = obj.data('is-redirect');
	$.ajax({
		type: "POST",
		url: e.target.action,
		data: obj.serialize()+"&is_ajax=1&form="+form_table,
		cache: false,
		dataType: 'json',
		success: function (JSON) {
			if (JSON.error != '') {
				toastr.error(JSON.error);
				$('.save').prop('disabled', false);
				$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
				$('.saveinfo').addClass('ft-unlock');
				$('.saveinfo').removeClass('fa spinner fa-refresh');
			} else {
				toastr.success(JSON.result);
				$('.save').prop('disabled', false);
				$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
				$('.saveinfo').addClass('ft-unlock');
				$('.saveinfo').removeClass('fa spinner fa-refresh');
				if(is_redirect==1) {
					window.location = site_url+'admin/dashboard?module=dashboard';
				}
			}
		},
		error: function(xhr, status, error) {
			console.error('AJAX Error:', status, error, 'Status:', xhr.status, 'Response:', xhr.responseText);
			
			// Re-enable button on error - MUST happen first
			$('.save').prop('disabled', false).removeAttr('disabled');
			$('.saveinfo').addClass('ft-unlock');
			$('.saveinfo').removeClass('fa spinner fa-refresh');
			
			// Try to parse error response
			var errorMsg = 'An error occurred. Please try again.';
			try {
				if (xhr.responseText) {
					var response = JSON.parse(xhr.responseText);
					if (response.error) {
						errorMsg = response.error;
					}
				}
			} catch(e) {
				// If response is not JSON, show specific error based on status
				if (xhr.status === 500) {
					errorMsg = 'Server error (500). The database may not be configured. Please check your database connection.';
				} else if (xhr.status === 404) {
					errorMsg = 'Login endpoint not found (404).';
				} else if (xhr.status === 0) {
					errorMsg = 'Network error. Please check your connection.';
				}
			}
			
			// Show error message
			if (typeof toastr !== 'undefined') {
				toastr.error(errorMsg);
			} else {
				alert(errorMsg);
			}
		}
	});
	});
});