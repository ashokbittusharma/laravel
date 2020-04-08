"use strict";
// Class definition

var KTAppUserListDatatable = function() {

    // variables
    var datatable;

    // init
    var init = function() {
        // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable

        datatable = $('#employeeList').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        //url: 'http://localhost/ashok/api.php',
                        url: '/admin/employees/employees-detail',
                        method: 'POST',
                        params: {
                                  _token: $('meta[name="csrf-token"]').attr('content'),
                                },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch'),
                delay: 400,
            },

            // columns definition
            columns: [{
                field: 'RecordID',
                title: '#',
                sortable: false,
                width: 20,
                selector: {
                    class: 'kt-checkbox--solid'
                },
                textAlign: 'center',
            }, {
                field: "AgentName",
                title: "Employee",
                width: 200,
                // callback function support for column rendering
                template: function(data, i) {
                    var number = 4 + i;
                    while (number > 12) {
                        number = number - 3;
                    }
                    var user_img = '100_' + number + '.jpg';

                    /*var pos = KTUtil.getRandomInt(0, 5);
                    var position = [
                        'Developer',
                        'Designer',
                        'CEO',
                        'Manager',
                        'Architect',
                        'Sales'
                    ];*/

                    var output = '';
                    var usertagimg = '';
                    if(data.avatar){
                        usertagimg = '<img src="'+data.avatar+'" alt="photo">';
                    }else{
                          usertagimg = '<div class="kt-badge kt-badge--xl kt-badge--warning">'+data.nameTag+'</div>';
                    }
                   // if (number > 5) {
                        output = '<div class="kt-user-card-v2">\
                                <div class="kt-user-card-v2__pic">'+usertagimg+'</div>\
                                <div class="kt-user-card-v2__details">\
                                <a href="/admin/employees/edit/'+data.eid+'" class="kt-user-card-v2__name">' + data.name + '</a>\
                                </div>\
                            </div>';
                   /* } else {
                        var stateNo = KTUtil.getRandomInt(0, 6);
                        var states = [
                            'success',
                            'brand',
                            'danger',
                            'success',
                            'warning',
                            'primary',
                            'info'
                        ];
                        var state = states[stateNo];

                        output = '<div class="kt-user-card-v2">\
                                <div class="kt-user-card-v2__pic">\
                                    <div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.CompanyAgent.substring(0, 1) + '</div>\
                                </div>\
                                <div class="kt-user-card-v2__details">\
                                    <a href="#" class="kt-user-card-v2__name">' + data.CompanyAgent + '</a>\
                                    <span class="kt-user-card-v2__desc">' + position[pos] + '</span>\
                                </div>\
                            </div>';
                    }*/

                    return output;
                }
            }, {
                field: 'email',
                title: 'Email',
                template: function(row) {
                    return row.email;
                },
            }, /*{
                field: 'ShipDate',
                title: 'Ship Date',
                type: 'date',
                format: 'MM/DD/YYYY',
            },*/ {
                field: "phone",
                title: "Phone",
                width: 'auto',
                autoHide: false,
                // callback function support for column rendering
                template: function(data, i) {
                   // var number = i + 1;
                    /*while (number > 5) {
                        number = number - 3;
                    }*/
                    /*var img = number + '.png';

                    var skills = [
                        'Angular, React',
                        'Vue, Kendo',
                        '.NET, Oracle, MySQL',
                        'Node, SASS, Webpack',
                        'MangoDB, Java',
                        'HTML5, jQuery, CSS3'
                    ];*/

                    var output = '\
                        <div class="kt-user-card-v2">\
                        <div class="kt-user-card-v2__details">\
                                <a href="#" class="kt-user-card-v2__name">' + (data.phone) ? data.phone : "-" + '</a>\
                            </div>\
                        </div>';

                    return output;
                }
            }, /*{
                field: "Status",
                title: "Status",
                width: 100,
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        1: {
                            'title': 'Pending',
                            'class': ' btn-label-brand'
                        },
                        2: {
                            'title': 'Processing',
                            'class': ' btn-label-danger'
                        },
                        3: {
                            'title': 'Success',
                            'class': ' btn-label-success'
                        },
                        4: {
                            'title': 'Delivered',
                            'class': ' btn-label-success'
                        },
                        5: {
                            'title': 'Canceled',
                            'class': ' btn-label-warning'
                        },
                        6: {
                            'title': 'Done',
                            'class': ' btn-label-danger'
                        },
                        7: {
                            'title': 'On Hold',
                            'class': ' btn-label-warning'
                        }
                    };
                    return '<span class="btn btn-bold btn-sm btn-font-sm ' + status[row.Status].class + '">' + status[row.Status].title + '</span>';
                }
            }, {
                width: 110,
                field: 'Type',
                title: 'Type',
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        1: {'title': 'Online', 'state': 'danger'},
                        2: {'title': 'Retail', 'state': 'primary'},
                        3: {'title': 'Direct', 'state': 'success'},
                    };
                    return '<span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.Type].state + '">' +
                            status[row.Type].title + '</span>';
                },
            },*/ {
                field: "Actions",
                width: 80,
                title: "Actions",
                sortable: false,
                autoHide: false,
                overflow: 'visible',
                template: function(data, i) {
                    return '\
                            <div class="dropdown">\
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                    <i class="flaticon-more-1"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                    <ul class="kt-nav">\
                                        <!--<li class="kt-nav__item">\
                                            <a href="#" class="kt-nav__link">\
                                                <i class="kt-nav__link-icon flaticon2-expand"></i>\
                                                <span class="kt-nav__link-text">View</span>\
                                            </a>\
                                        </li>-->\
                                        <li class="kt-nav__item">\
                                            <a href="/admin/employees/edit/'+data.eid+'" class="kt-nav__link">\
                                                <i class="kt-nav__link-icon flaticon2-contract"></i>\
                                                <span class="kt-nav__link-text">Edit</span>\
                                            </a>\
                                        </li>\
                                        <li class="kt-nav__item">\
                                            <a href="javascript:void(0)" data-user="'+data.eid+'"  class="kt-nav__link deleteuser">\
                                                <i class="kt-nav__link-icon flaticon2-trash"></i>\
                                                <span class="kt-nav__link-text">Delete</span>\
                                            </a>\
                                        </li>\
                                        <!--<li class="kt-nav__item">\
                                            <a href="#" class="kt-nav__link">\
                                                <i class="kt-nav__link-icon flaticon2-mail-1"></i>\
                                                <span class="kt-nav__link-text">Export</span>\
                                            </a>\
                                        </li>-->\
                                    </ul>\
                                </div>\
                            </div>\
                        ';
                },
            }]
        });
    }

    // search
    var search = function() {
        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });
    }

    // selection
    var selection = function() {
        // init form controls
        //$('#kt_form_status, #kt_form_type').selectpicker();

        // event handler on check and uncheck on records
        datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function(e) {
            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
            var count = checkedNodes.length; // selected records count

            $('#kt_subheader_group_selected_rows').html(count);
                
            if (count > 0) {
                $('#kt_subheader_search').addClass('kt-hidden');
                $('#kt_subheader_group_actions').removeClass('kt-hidden');
            } else {
                $('#kt_subheader_search').removeClass('kt-hidden');
                $('#kt_subheader_group_actions').addClass('kt-hidden');
            }
        });
    }

    // fetch selected records
    var selectedFetch = function() {
        // event handler on selected records fetch modal launch
        $('#kt_datatable_records_fetch_modal').on('show.bs.modal', function(e) {
            // show loading dialog
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function() {
                loading.hide();
            }, 1000);
            
            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();
            });

            // populate selected IDs
            var c = document.createDocumentFragment();
                
            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }

            $(e.target).find('#kt_apps_user_fetch_records_selected').append(c);
        }).on('hide.bs.modal', function(e) {
            $(e.target).find('#kt_apps_user_fetch_records_selected').empty();
        });
    };

    // selected records status update
    var selectedStatusUpdate = function() {
        $('#kt_subheader_group_actions_status_change').on('click', "[data-toggle='status-change']", function() {
            var status = $(this).find(".kt-nav__link-text").html();

            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();
            });

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to update " + ids.length + " selected records status to " + status + " ?",
                    type: "info",
    
                    confirmButtonText: "Yes, update!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
    
                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function(result) {
                    if (result.value) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'Your selected records statuses have been updated!',
                            type: 'success',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        })
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records statuses have not been updated!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
            }
        });
    }

    // selected records delete
    var selectedDelete = function() {
        $('#kt_subheader_group_actions_delete_all').on('click', function() {
            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();
            });

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    text: "Are you sure to delete " + ids.length + " selected records ?",
                    type: "danger",

                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-brand"
                }).then(function(result) {
                    if (result.value) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'Your selected records have been deleted! :(',
                            type: 'success',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        })
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records have not been deleted! :)',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
            }
        });     
    }

    var updateTotal = function() {
        datatable.on('kt-datatable--on-layout-updated', function () {
            //$('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
        });
    };

    return {
        // public functions
        init: function() {
         
            init();
            search();
            selection();
            selectedFetch();
            selectedStatusUpdate();
            selectedDelete();
            //updateTotal();
        },
    };
}();

// On document ready
KTUtil.ready(function() {
     if($('#employeeList').length ){
    KTAppUserListDatatable.init();
}
});

$("body").on("click", ".deleteuser", function(){
    deleteCustomerUser($(this).data('user'));
});
function deleteCustomerUser(user){
             swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to delete this user?",
                    type: "info",
    
                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
    
                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function(result) {
                    if (result.value) {

                        $.ajax({
                                  type: "POST",
                                  url: '/admin/customers/delete',
                                  data: {
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            user: user,
                                          },
                                  dataType: "json",
                                  success: function( data, textStatus, jQxhr ){
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
                            text: 'You have cancelled user delete request!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
}