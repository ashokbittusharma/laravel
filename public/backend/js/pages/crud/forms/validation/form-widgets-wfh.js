// Class definition

var KTFormWidgets = function () {
    // Private functions
    var validator;

    var initWidgets = function() {
        // datepicker
        $('#kt_datepicker').datepicker({
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        // datetimepicker
        $('#kt_datetimepicker').datetimepicker({
            pickerPosition: 'bottom-left',
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii:ss'
        });

        $('#kt_datetimepicker').change(function() {
            validator.element($(this));
        });

        // datetimepicker
        $('.kt_datetimepicker_wfh').datetimepicker({
            pickerPosition: 'bottom-left',
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii:ss'
        });

        $('.kt_datetimepicker_wfh').change(function() {
            validator.element($(this));
        });

        // timepicker
        $('#kt_timepicker').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: true
        });

        // daterangepicker
        $('#kt_daterangepicker').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            var input = $('#kt_daterangepicker').find('.form-control');
            
            input.val( start.format('YYYY/MM/DD') + ' / ' + end.format('YYYY/MM/DD'));
            validator.element(input); // validate element
        });

        // bootstrap switch
        $('[data-switch=true]').bootstrapSwitch();


        $('[data-switch=true]').on('switchChange.bootstrapSwitch', function() {
            validator.element($(this)); // validate element
        });

        // bootstrap select
        $('#kt_bootstrap_select').selectpicker();
        $('#kt_bootstrap_select').on('changed.bs.select', function() {
            validator.element($(this)); // validate element
        });

        // select2
        $('#kt_select2').select2({
            placeholder: "Select a state",
        });
        $('#kt_select2').on('select2:change', function(){
            validator.element($(this)); // validate element
        });

        // typeahead
        /*var countries = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: 'https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/typeahead/countries.json'
        });

        $('#kt_typeahead').typeahead(null, {
            name: 'countries',
            source: countries
        });*/

        $('#kt_typeahead').bind('typeahead:select', function(ev, suggestion) {
            validator.element($('#kt_typeahead')); // validate element
        });
    }
    
    var initValidation = function () {
        validator = $( "#add_event_form" ).validate({
            // define validation rules
            rules: {
                title: {
                    required: true,
                },
                start_date: {
                    required: true,
                    date: true,
                },
                end_date: {
                    required: true,
                    date: true,
                },
                location: {
                    required: true,
                },
                featured_image: {
                    required: true,
                },
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
                var alert = $('#kt_form_1_msg');
                alert.removeClass('kt--hide').show();
                KTUtil.scrollTo('m_form_1_msg', -200);
            },

            submitHandler: function (form) {

                /*Date validation*/
                var add_event_form = $(".add_event_form input[name='start_date']").val();
                var end_date = $(".add_event_form input[name='end_date']").val();

                if (add_event_form == '') {
                    toastr.error("Please select the start date.");
                    return false;
                }

                if (end_date == '') {
                    toastr.error('Please select the end date.');
                    return false;
                }

                console.log(add_event_form + ' ' + end_date);

                if (new Date(add_event_form) > new Date(end_date)) { 
                
                    toastr.error('End date must be greater than the start date');
                    return false;
                }
                form[0].submit(); // submit the form
            }
        });       
    }

    return {
        // public functions
        init: function() {
            initWidgets(); 
            initValidation();
        }
    };
}();

jQuery(document).ready(function() {    
    KTFormWidgets.init();
});