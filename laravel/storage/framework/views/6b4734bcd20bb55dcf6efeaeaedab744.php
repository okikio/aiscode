<script>
	$('.toggle-password').click(function(){
	    $(this).children().toggleClass('fa-lock fa-unlock');
	    let input = $('.togglePassword').prev();
	    input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
	});
</script><?php /**PATH /var/www/html/iwin/resources/views/admin/customJs/admin.blade.php ENDPATH**/ ?>