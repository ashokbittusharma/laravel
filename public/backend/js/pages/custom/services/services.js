"use strict";

jQuery(document).ready(function() {
//services categories start

	 $('#servicesCategories, #servicesListing').DataTable( {
        responsive: true
    } );

	 $("#saveServCat").on("click", function(){
	 	$("#addCategory").submit();
	 });

	 $("#addCategory").validate({
    // Specify validation rules
    rules: {
      category: "required"      
    },
 
    submitHandler: function(form) {
       $('#addCategory').ajaxSubmit({
            url: '/admin/booking/add-service-category', 
            type: "POST",     
            success: function(data) {
                if( data.status == 'success'){
                    swal.fire({
                            "title": "Success", 
                            "text": data.message, 
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        }).then(function() {
                            window.location = "/admin/booking/service-categories";
                          });
                  }else
                  {
                    swal.fire({
                            "title": "Error", 
                            "text": data.message, 
                            "type": "error",
                            "confirmButtonClass": "btn btn-warning"
                        });
                    return false;
                }
            },
            error: function(data){
              swal.fire({
                            "title": "Error", 
                            "text": data.message, 
                            "type": "error",
                            "confirmButtonClass": "btn btn-warning"
                        });
              return false;
              // Render the errors with js ...
            }
        });
    }
  });
//Edit service categories button

$(".editServCat").on("click", function(){
	var servCatID = $(this).attr('id');
	var getcolNumber = servCatID.split("editCat_");
	var colNumber = getcolNumber[1];

	//Hide visible contnet
	$(".visibleContent_"+colNumber).hide();
	$(".updateFields_"+colNumber).show();
});

//Edit service categories button

$(".updateCat").on("click", function(){
	var servCatID = $(this).attr('id');
	var getcolNumber = servCatID.split("updateServCatFields_");
	var colNumber = getcolNumber[1];

	//Hide visible contnet
	$("#serviceCat_"+colNumber).submit();

}); 

//cancel updates

$(".canelupdate").on("click", function(){
   var servCatID = $(this).attr('id');
   var getcolNumber = servCatID.split("cancelBtn_");
   var colNumber = getcolNumber[1];

   //Hide visible contnet
	$(".visibleContent_"+colNumber).show();
	$(".updateFields_"+colNumber).hide();

});
$('.SerCatupdateForm').each(function() {
	$(this).validate({
    // Specify validation rules
    rules: {
      category: "required"      
    },
 
    submitHandler: function(form) {
    	displayLoader();
       $(form).ajaxSubmit({
            url: '/admin/booking/update-service-category', 
            type: "POST",     
            success: function(data) {
            	hideLoader();
                if( data.status == 'success'){
                    swal.fire({
                            "title": "Success", 
                            "text": data.message, 
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        }).then(function() {
                            window.location = "/admin/booking/service-categories";
                          });
                  }else
                  {
                    swal.fire({
                            "title": "Error", 
                            "text": data.message, 
                            "type": "error",
                            "confirmButtonClass": "btn btn-warning"
                        });
                    return false;
                }
            },
            error: function(data){
              swal.fire({
                            "title": "Error", 
                            "text": data.message, 
                            "type": "error",
                            "confirmButtonClass": "btn btn-warning"
                        });
              return false;
              // Render the errors with js ...
            }
        });
    }
  });
});  

	$("body").on("click", ".deleteServeCat", function(){
    deleteServiceCategory($(this).attr('id'));
});
function deleteServiceCategory(serviceCat){
             swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to delete this service category?",
                    type: "info",
    
                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
    
                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function(result) {
                    if (result.value) {
                         displayLoader();
                        $.ajax({
                                  type: "POST",
                                  url: '/admin/booking/delete-service-category',
                                  data: {
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            serviceCat: serviceCat,
                                          },
                                  dataType: "json",
                                  success: function( data, textStatus, jQxhr ){
                                  	hideLoader();

                                            swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            type: 'success',
                                            buttonsStyling: false,
                                            confirmButtonText: "OK",
                                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                           }).then(function(isConfirm) {
                                            location.reload(true);
                                        })
                                }
                            });

                       

                        
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You have cancelled service category delete request!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
}
//services categories end


//Service start from here
ServicesPage.init();
$("#saveServCatBtn").on("click", function(){
  $("#addServiceForm").submit();
});
$("#updateService").on("click", function(){
  $("#editServiceForm").submit();
});


});



$("#service_avatar, #service_avatar_edit").change(function() {
      imagePreview(this);
});

var imagePreview = function(input){
	if (input.files && input.files[0]) {
    var reader = new FileReader();    
    reader.onload = function(e) {
      $('#service_avatar_preview, #service_avatar_edit_preview').attr('src', e.target.result);
      $('#services_avatar__cancel, #services_avatar_edit_cancel').css('display', 'block');
    }    
    reader.readAsDataURL(input.files[0]);
  }
}

$('#services_avatar__cancel, #services_avatar_edit_cancel').click(function(){
        $('#service_avatar, #service_avatar_edit').val('');
        $('#service_avatar_preview, #service_avatar_edit_preview').attr('src', '/backend/media/icons/svg/Design/Image.svg');
        $(this).css('display', 'none');
    });



var ServicesPage = function(){

	var formValidation = function(){

}
var deleteService = function(){
		$("body").on("click", ".deleteService", function(){
    deleteServiceById($(this).attr('id'));
});
function deleteServiceById(serviceID){
             swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to delete this service?",
                    type: "info",
    
                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
    
                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function(result) {
                    if (result.value) {
                         displayLoader();
                        $.ajax({
                                  type: "POST",
                                  url: '/admin/booking/services/delete',
                                  data: {
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            serviceID: serviceID,
                                          },
                                  dataType: "json",
                                  success: function( data, textStatus, jQxhr ){
                                  	hideLoader();

                                            swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            type: 'success',
                                            buttonsStyling: false,
                                            confirmButtonText: "OK",
                                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                           }).then(function(isConfirm) {
                                            location.reload(true);
                                        })
                                }
                            });

                       

                        
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You have cancelled service category delete request!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
   }
}

//image upload

 return {
    init:function(){
    	formValidation();
    	deleteService();
    $("#addServiceForm").validate({
	    // Specify validation rules
	    rules: {
	      service_name: "required",
	      service_category: "required",
	      service_duration : "required"
	    },
	    // Specify validation error messages
	    messages: {
	      service_name: "Please enter your service name",
	      service_category: "Please select a service category",
	      service_duration : "Please select a service duration."
	     
	    },
   
	    submitHandler: function(form) {
	      displayLoader();
	       $('#addServiceForm').ajaxSubmit({
	            url: '/admin/booking/services/add', 
	            type: "POST",     
	            success: function(data) {
	              hideLoader();
	                if( data.status == 'success'){
	                    swal.fire({
	                            "title": "Success", 
	                            "text": data.message, 
	                            "type": "success",
	                            "confirmButtonClass": "btn btn-secondary"
	                        }).then(function() {
	                            window.location = "/admin/booking/services";
	                          });
	                  }else
	                  {
	                    swal.fire({
	                            "title": "Error", 
	                            "text": data.message, 
	                            "type": "error",
	                            "confirmButtonClass": "btn btn-warning"
	                        });
	                    return false;
	                }
	            },
	            error: function(data){
	              swal.fire({
	                            "title": "Error", 
	                            "text": data.message, 
	                            "type": "error",
	                            "confirmButtonClass": "btn btn-warning"
	                        });
	              return false;
	              // Render the errors with js ...
	            }
	        });
	    }
    });

    $("#editServiceForm").validate({
	    // Specify validation rules
	    rules: {
	      service_name: "required",
	      service_category: "required",
	      service_duration : "required"
	    },
	    // Specify validation error messages
	    messages: {
	      service_name: "Please enter your service name",
	      service_category: "Please select a service category",
	      service_duration : "Please select a service duration."
	     
	    },
   
	    submitHandler: function(form) {
	      displayLoader();
	       $('#editServiceForm').ajaxSubmit({
	            url: '/admin/booking/services/edit', 
	            type: "POST",     
	            success: function(data) {
	              hideLoader();
	                if( data.status == 'success'){
	                    swal.fire({
	                            "title": "Success", 
	                            "text": data.message, 
	                            "type": "success",
	                            "confirmButtonClass": "btn btn-secondary"
	                        }).then(function() {
	                            window.location = "/admin/booking/services";
	                          });
	                  }else
	                  {
	                    swal.fire({
	                            "title": "Error", 
	                            "text": data.message, 
	                            "type": "error",
	                            "confirmButtonClass": "btn btn-warning"
	                        });
	                    return false;
	                }
	            },
	            error: function(data){
	              swal.fire({
	                            "title": "Error", 
	                            "text": data.message, 
	                            "type": "error",
	                            "confirmButtonClass": "btn btn-warning"
	                        });
	              return false;
	              // Render the errors with js ...
	            }
	        });
	    }
    });
    }
 };
}();


//edit service


$(document).ready(function(){
	$(".editServiceBtn").on("click", function(){
		 var serviceID = $(this).data('service');
		 displayLoader();
            $.ajax({
                      type: "POST",
                      url: '/admin/booking/services/get-editing-service',
                      data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                serviceID: serviceID,
                              },
                      dataType: "json",
                      success: function( result, textStatus, jQxhr ){
                      	hideLoader();
						if( result.status == 'success'){
		                    $('#editServiceModal').modal('show');
			                   if( result.serviceData.cat_img ){
			                   	$("#serviceEdit").val(result.serviceData.id);
			                   	$("#service_name_edit").val(result.serviceData.name);
			                   	$("#service_category_edit").val(result.serviceData.catID);
			                   	$("#service_duration_edit").val(result.serviceData.duration);
			                   	$("#service_price_edit").val(result.serviceData.price);
			                   	$("#service_btb_edit").val(result.serviceData.btb);
			                   	$("#service_bta_edit").val(result.serviceData.bta);
			                   	$("#note_edit").val(result.serviceData.description);
			                   	if(result.serviceData.payment_onsite == 'yes'){
                                    $("#service_paymentoption_onsite_edit").prop("checked", true);
			                   	}else{
                                    $("#service_paymentoption_onsite_edit").prop("checked", false);
			                   	}
                                 if(result.serviceData.payment_stripe == 'yes'){
                                    $("#service_paymentoption_stripe_edit").prop("checked", true);
			                   	}else{
                                    $("#service_paymentoption_stripe_edit").prop("checked", false);
			                   	}

			                   	$("#service_avatar_edit_preview").attr('src', '/backend/media/services/'+result.serviceData.cat_img)
			                   } 
		                    
		                  }else
		                  {
		                    swal.fire({
		                            "title": "Error", 
		                            "text": result.message, 
		                            "type": "error",
		                            "confirmButtonClass": "btn btn-warning"
		                        });
		                    return false;
		                }
                    }
                });
	});
});