"use strict";
// Class definition

var KTDatatableColumnRenderingDemo = function() {
	// Private functions

	// basic demo
	var demo = function() {

		//alert(CSRF_TOKEN);

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						//url: 'https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/datatables/demos/default.php',
						url: BASE_URL+'/asset-manager/admin/contractor-rating-table-any',
					},
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true
			},

			// layout definition
			layout: {
				scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: true, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
				delay: 400,
			},

			// columns definition
			columns: [
				{
					field: 'PQQ_ID',
					title: '#',
					sortable: 'asc',
					width: 0,
					type: 'number',
					selector: false,
					textAlign: 'center',
				}, {
					field: 'pqq_group',
					title: 'O',
					autoHide: false,
					width: 30,
					template: function(data) {

						var output = '';

						if (data.pqq_group == 'main') {

							if (data.num_sub_group == 1) {
							
								output = '<a href="'+data.num_sub_group+'" class="flaticon2-folder pqq-main group-'+data.num_sub_group+'"></a>';
							}
							else
							{
								output = '<a href="'+data.num_sub_group+'" class="open fas fa-minus pqq-main group-'+data.num_sub_group+'"></a>';
							}
						}

						return output;
					},
				}, {
					field: 'evaluation_on',
					title: 'Evaluation On',
					autoHide: false,
					width: 85,
					template: function(data) {

						var output = '';
						output = '<div class="kt-user-card-v2">\
									<button type="button" class="btn btn-outline-info btn-sm btn-p-xs td_'+data.contractor_id+'-'+data.pqq_category+' td_evaluation_on">'+data.evaluation_on+'</button>\
							</div>';

						return output;
					},
				}, {
					field: 'contractor_name',
					title: 'Contractor Name',
					autoHide: false,
					width: 190,
					template: function(data) {

						var output = '';
						
						if(data.contractor_name != '-') {
							output = '<div class="kt-user-card-v2 '+data.matrix_group+'">\
								<div class="kt-user-card-v2__pic">\
									<img src="'+BASE_URL+'/'+data.company_logo+'" alt="photo">\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.contractor_name + '</span><BR/>\
									<a class="kt-user-card-v2__email kt-link" href="JavaScript:Void(0);">PQQ Status: \
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill" style="padding: 0.5rem 0.5rem;">'+data.status+'</span></a>\
								</div>\
							</div>';
						}
						else
						{
							output = '<div class="kt-user-card-v2 '+data.matrix_group+'">\
								<div class="kt-user-card-v2__pic"></div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name"></span>\
								</div>\
							</div>';
						}

						return output;
					},
				}, {
					field: 'pqq_category',
					title: 'PQQ Category',
					autoHide: false,
					width: 130,
					template: function(row) {

						var pqq_category = {
							'mechanical_lump_sum': {'title': 'Mechanical Lump Sum (facilities)', 'class': 'kt-badge--brand'},
							'electrical_lump_sum': {'title': 'Electrical Lump Sum (facilities)', 'class': ' kt-badge--danger'},
							'pipeline_unit_price': {'title': 'Pipeline Unit Price (unit price to be solicited after qualification)', 'class': ' kt-badge--primary'},
							't_m_texas_mechanical': {'title': 'T&M in Texas mechanical', 'class': ' kt-badge--success'},
							't_m_texas_electrical': {'title': 'T&M in Texas electrical', 'class': ' kt-badge--info'},
							't_m_new_mexico_mechanical': {'title': 'T&M in New Mexico mechanical', 'class': ' kt-badge--danger'},
							't_m_new_mexico_electrical': {'title': 'T&M in New Mexico electrical', 'class': ' kt-badge--warning'},
						};

						//return '<span style="height: auto;border-radius: 1rem;" class="kt-badge ' + pqq_category[row.pqq_category].class + ' kt-badge--inline kt-badge--pill">' + pqq_category[row.pqq_category].title + '</span>';
						return '<h6 class="kt-font-primary matrix-cat-slug">'+pqq_category[row.pqq_category].title+'</h6>';
					},
				}, 
				
				{
					field: 'safety',
					title: '<matrix class="matrix-header">Safety</matrix><matrix class="matrix-weight">40</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 40,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_safety">'+row.safety+'</span>';
					},
				},

				{
					field: 'category_experience',
					title: '<matrix class="matrix-header">Cat. Exp.</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 42,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_category_experience">'+row.category_experience+'</span>';
					},
				}, 

				{
					field: 'operating_years',
					title: '<matrix class="matrix-header">Operating Years</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 60,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_operating_years">'+row.operating_years+'</span>';
					},
				}, 

				{
					field: 'pqq_submital',
					title: '<matrix class="matrix-header">PQQ Submital On Time Offered</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 55,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_pqq_submital">'+row.pqq_submital+'</span>';
					},
				}, 

				{
					field: 'permanent_employee_size',
					title: '<matrix class="matrix-header">Permanent Employee Size 3yr Avg</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 80,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_permanent_employee_size">'+row.permanent_employee_size+'</span>';
					},
				}, 

				{
					field: 'gnm',
					title: '<matrix class="matrix-header">GNM</matrix><matrix class="matrix-weight">10</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 32,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_gnm">'+row.gnm+'</span>';
					},
				}, 

				{
					field: 'credit_history',
					title: '<matrix class="matrix-header">Credit History</matrix><matrix class="matrix-weight">15</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 45,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_credit_history">'+row.credit_history+'</span>';
					},
				
				},
				{
					field: 'party_financial',
					title: '<matrix class="matrix-header">Party Financial</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 55,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_party_financial">'+row.party_financial+'</span>';
					},
				
				},
				{
					field: 'pqq_references',
					title: '<matrix class="matrix-header">PQQ References</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 65,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_pqq_references">'+row.pqq_references+'</span>';
					},
				
				},
				{
					field: 'resumes',
					title: '<matrix class="matrix-header">Resumes</matrix><matrix class="matrix-weight">5</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 55,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_resumes">'+row.resumes+'</span>';
					},
				
				},
				{
					field: 'combined_score',
					title: '<matrix class="matrix-header">Combined Score</matrix><matrix class="matrix-weight-1000">0/1000</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 60,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_combined_score kt-font-bolder">'+row.combined_score+'</span>';
					},
				
				},
				{
					field: 'weighted_score',
					title: '<matrix class="matrix-header">Weighted Score</matrix><matrix class="matrix-weight-1000">0/100%</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 60,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_weighted_score kt-font-bolder">'+row.weighted_score+'</span>';
					},
				
				},
				{
					field: 'overall_rating',
					title: '<matrix class="matrix-header">Overall Rating</matrix><matrix class="matrix-weight-1000">0/10</matrix>',
					type: 'number',
					textAlign: 'center',
					autoHide: false,
					width: 60,
					template: function(row) {
						return '<span class="td_'+row.contractor_id+'-'+row.pqq_category+' td_overall_rating kt-font-bolder">'+row.overall_rating+'</span>';
					},
				
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 52,
					overflow: 'visible',
					autoHide: false,
					template: function(data) {
						return '<a href="'+data.contractor_id+'/'+data.pqq_category+'" class="btn btn-sm btn-clean btn-icon btn-icon-md edit-matrix" title="Enter Rating">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="'+data.contractor_id+'/'+data.pqq_category+'" class="btn btn-sm btn-clean btn-icon btn-icon-md overall-rating-matrix" title="View User Ratings">\
								<i class="la la-star"></i>\
							</a>';
					},
				}],
		});

	    $('#kt_form_status').on('change', function() {
	      datatable.search($(this).val().toLowerCase(), 'pqq_category_slug');
	    });

	    $('#kt_form_type').on('change', function() {
	      datatable.search($(this).val().toLowerCase(), 'Type');
	    });

	    $('#kt_form_status, #kt_form_type').selectpicker();

	};

	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	
	KTDatatableColumnRenderingDemo.init();

});