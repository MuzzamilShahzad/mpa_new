$(function (e) {
	var baseUrl = $(".base-url").val();
	'use strict'
	//______Basic Data Table
	$('#basic-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});


	//______Responsive Data Table
	$('#responsive-datatable').DataTable({
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	admissingListing();

	$("#btn-admission-search").on("click", function (e) {

		e.preventDefault();
		admissingListing();

	});

	function admissingListing() {

		var session_id = $("#session-id").val();
		var campus_id = $("#campus-id").val();
		var system_id = $("#system-id").val();
		var class_id = $("#class-id").val();
		var group_id = $("#group-id").val();
		var section_id = $("#section-id").val();

		$('#admission-listing-datatable').DataTable({
			destroy: true,
			searchable: false,
			ajax: {
				url: baseUrl + '/admission/listingBySessionSystemClassGroupSection',
				data: {
					session_id: session_id,
					campus_id: campus_id,
					system_id: system_id,
					class_id: class_id,
					group_id: group_id,
					section_id: section_id,
				},
			},
			columnDefs: [
				{
					orderable: false,
					targets: [0, 8]
				},
				{
					"targets": 0,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input chkbox-select-admission" type="checkbox" data-id="`+ data.id + `">
										</div>`;
						return checkbox;
					}
				},
				{
					"targets": 1,
					"render": function (data) {
						return data.temporary_gr + ' / ' + data.gr;
					}
				},
				{
					"targets": 4,
					"render": function (data) {
						var data = JSON.parse(data);
						return data.name;
					}
				},
				{
					"targets": 5,
					"render": function (data) {
						return data.campus + ' ( ' + data.system + ' ) ';
					}
				},
				{
					"targets": 6,
					"render": function (data) {

						var class_group = data.class;

						if (data.group !== '' && data.group !== null) {
							class_group += ' ( ' + data.group + ' ) '
						}
						return class_group;
					}
				},
				{
					"targets": 8,
					"render": function (data) {
						var checkbox = `<i class="fas fa-check" id="btn-view-admission" data-id="` + data.id + `" title="View"></i> |
										<i class="fas fa-edit" id="btn-edit-admission" data-id="`+ data.id + `" title="Edit"></i> |
						 				<i class="fas fa-trash" id="btn-delete-admission" data-id="`+ data.id + `" title="Delete"></i>`;
						return checkbox;
					}
				},
			],
			order: [[1, 'asc']],
			columns: [
				{ data: null },
				{ data: null },
				{ data: 'first_name' },
				{ data: 'last_name' },
				{ data: 'father_details' },
				{ data: null },
				{ data: null },
				// { data: 'section' },
				{ data: 'admission_date' },
				{ data: null },
			],
		});
	}

	$(document).on('click', ".chkbox-select-all-admission", function () {
		if ($('.chkbox-select-all-admission').is(':checked')) {
			$('.checkBox').prop('checked', true);

			$('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#promote-student-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='promote'> Promote </button>");
		} else {
			$('.checkBox').prop('checked', false);
			$('#promote').remove();
		}
	});

	$(document).on('click', ".chkbox-select-admissio", function () {
		var check_box = $('.chkbox-select-admissio').length;
		var checked_check_box = $('.chkbox-select-admissio:checked').length;

		if (check_box == checked_check_box) {
			$('.chkbox-select-all-admission').prop('checked', true);
		} else {
			$('.chkbox-select-all-admission').prop('checked', false);
		}

		if (checked_check_box == 0) {
			$('#promote').remove();
		} else {
			var promote_btn = $('#promote').length;

			if (promote_btn == 0) {
				$('.table-heading').after("&nbsp;&nbsp;<button data-bs-target='#promote-student-modal' data-bs-toggle='modal' class='btn btn-sm btn-primary' id='promote'> Promote </button>");
			}
		}
	});

	$(document).on('click', '#btn-delete-admission', function () {

		var admission_id = $(this).data('id');
		var url = baseUrl + '/admission/delete';

		swal.fire({

			icon: 'warning',
			title: 'Are you sure?',
			html: 'You want to <b>delete</b> this record',
			showCancelButton: true,
			showCloseButton: true,
			cancelButtonText: 'Cancel',
			confirmButtonText: 'Yes, Delete',
			cancelButtonColor: '#d33',
			confirmButtonColor: '#556ee6',
			allowOutsideClick: false

		}).then(function (result) {

			if (result.value) {

				$.ajax({
					url: url,
					type: 'DELETE',
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					data: { admission_id: admission_id },
					dataType: "json",
					success: function (response) {
						if (response.status == false) {
							message = {
								icon: 'error',
								title: 'Oops...',
								text: response.message,
							};
						} else {
							message = {
								icon: 'success',
								title: 'Success',
								text: response.message,
							}
						}
					},

					error: function () {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Some thing went wrong please contact to Administrator!',
						})
					},

					complete: function () {

						admissingListing();

						Swal.fire({
							icon: message.icon,
							title: message.title,
							text: message.text,
						})
					}
				});
			}
		});
	});

	registrationListing();

	$("#btn-registration-search").on("click", function (e) {

		e.preventDefault();
		registrationListing();

	});

	function registrationListing() {

		var session_id = $("#session-id").val();
		var campus_id = $("#campus-id").val();
		var system_id = $("#system-id").val();
		var class_id = $("#class-id").val();
		var group_id = $("#group-id").val();

		$('#registraion-listing-datatable').DataTable({
			destroy: true,
			searchable: false,
			ajax: {
				url: baseUrl + '/student/registration/listingBySessionSystemClassGroup',
				data: {
					session_id: session_id,
					campus_id: campus_id,
					system_id: system_id,
					class_id: class_id,
					group_id: group_id,
				},
			},
			columnDefs: [
				// {	orderable: false,
				// 	targets: [0,8]
				// },
				{
					"targets": 0,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input chkbox-select-admission" type="checkbox" data-id="`+ data.id + `">
										</div>`;
						return checkbox;
					}
				},
				// {
				// 	"targets": 1,
				// 	"render": function (data) {
				// 		return data.registration_id;
				// 	}
				// },
				{
					"targets": 4,
					"render": function (data) {
						var data = JSON.parse(data);
						return data.name;
					}
				},
				{
					"targets": 5,
					"render": function (data) {
						return data.campus + ' ( ' + data.system + ' ) ';
					}
				},
				{
					"targets": 6,
					"render": function (data) {

						var class_group = data.class;

						if (data.group !== '' && data.group !== null) {
							class_group += ' ( ' + data.group + ' ) '
						}
						return class_group;
					}
				},
				{
					"targets": 7,
					"render": function (data) {
						var checkbox = `<i class="fas fa-check" id="btn-view-registration" data-id="` + data.id + `" title="View"></i> |
										<i class="fas fa-edit" id="btn-edit-registration" data-id="`+ data.id + `" title="Edit"></i> |
						 				<i class="fas fa-trash" id="btn-delete-registration" data-id="`+ data.id + `" title="Delete"></i>`;
						return checkbox;
					}
				},
			],
			order: [[1, 'asc']],
			columns: [
				{ data: null },
				{ data: 'registration_id' },
				{ data: 'first_name' },
				{ data: 'last_name' },
				{ data: 'father_details' },
				{ data: null },
				{ data: null },
				{ data: null },
			],
		});
	}

	$(document).on('click', ".select-all-registration", function () {

		if ($('.select-all-registration').is(':checked')) {
			$('.select-registration').prop('checked', true);
		} else {
			$('.select-registration').prop('checked', false);
		}
	});

	$(document).on('click', ".select-registration", function () {

		var check_box = $('.select-registration').length;
		var checked_check_box = $('.select-registration:checked').length;

		if (check_box == checked_check_box) {
			$('.select-all-registration').prop('checked', true);
		} else {
			$('.select-all-registration').prop('checked', false);
		}
	});


	$(document).on('click', '#btn-delete-regisration', function () {

		var regisration_id = $(this).data('id');
		var url = baseUrl + '/regisration/delete';

		swal.fire({

			icon: 'warning',
			title: 'Are you sure?',
			html: 'You want to <b>delete</b> this record',
			showCancelButton: true,
			showCloseButton: true,
			cancelButtonText: 'Cancel',
			confirmButtonText: 'Yes, Delete',
			cancelButtonColor: '#d33',
			confirmButtonColor: '#556ee6',
			allowOutsideClick: false

		}).then(function (result) {

			if (result.value) {

				$.ajax({
					url: url,
					type: 'DELETE',
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					data: { regisration_id: regisration_id },
					dataType: "json",
					success: function (response) {
						if (response.status == false) {
							message = {
								icon: 'error',
								title: 'Oops...',
								text: response.message,
							};
						} else {
							message = {
								icon: 'success',
								title: 'Success',
								text: response.message,
							}
						}
					},

					error: function () {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Some thing went wrong please contact to Administrator!',
						})
					},

					complete: function () {

						admissingListing();

						Swal.fire({
							icon: message.icon,
							title: message.title,
							text: message.text,
						})
					}
				});
			}
		});
	});

	$('#modal-datatable').DataTable({
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function (row) {
						var data = row.data();
						return 'Details for ' + data[0] + ' ' + data[1];
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: 'table'
				})
			}
		}
	});

	//______File-Export Data Table
	var table = $('#file-datatable').DataTable({
		buttons: ['copy', 'excel', 'pdf', 'colvis'],
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	table.buttons().container()
		.appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

	//______Delete Data Table
	var table = $('#delete-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	$('#delete-datatable tbody').on('click', 'tr', function () {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	$('#button').click(function () {
		table.row('.selected').remove().draw(false);
	});

	//______Form Input Datatable 
	$('#form-input-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		},
		responsive: true,
		columnDefs: [{
			orderable: false,
			targets: [1, 2, 3]
		}]

	});

	//______Select2 
	$('.select2').select2({
		minimumResultsForSearch: Infinity
	});


	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'All categories',
		width: '100%'
	});

	$('#form-input-datatable').on('draw.dt', function () {
		$('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one'
		});
	});

});

