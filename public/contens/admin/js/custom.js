//Success and Error Message Timeout Code Start
setTimeout(function() {
    $('.alert_success').slideUp(1000);
 },5000);

setTimeout(function() {
    $('.alert_error').slideUp(1000);
 },10000);


// soft delete Modal code start
 $(document).ready(function(){
	$(document).on("click", "#softDelete", function () {
		 var deleteID = $(this).data('id');
		 $(".modal_body #modal_id").val( deleteID );
	});

//   $(document).on("click", "#restore", function () {
// 		 var restoreID = $(this).data('id');
// 		 $(".modal_body #modal_id").val( restoreID );
// 	});

//   $(document).on("click", "#delete", function () {
// 		 var deleteID = $(this).data('id');
// 		 $(".modal_body #modal_id").val( deleteID );
// 	});
});

