$(function(e) {
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
	
	$("#btn-admission-search").on("click",function(e){

		e.preventDefault();
		var session_id  =  $("#session-id").val();
		var campus_id   =  $("#campus-id").val();
		var system_id   =  $("#system-id").val();
		var class_id    =  $("#class-id").val();
		var group_id    =  $("#group-id").val();
		var section_id  =  $("#section-id").val();
		
		$('#admission-listing-datatable').DataTable({
			ajax: {
				url: baseUrl+'/admission/listingBySessionSystemClassGroupSection',
				data: {
					session_id  :  session_id,
					campus_id   :  campus_id,
					system_id   :  system_id,
					class_id    :  class_id,
					group_id    :  group_id,
					section_id  :  section_id,
				},
			},
			columnDefs: [{
					"targets": 0,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input" type="checkbox" data-id="`+data.temporary_gr+`">
										</div>`;
						return checkbox;
					}
            	},
				{
					"targets": 1,
					"render": function (data) {
						return data.temporary_gr+' - '+data.temporary_gr;
					}
            	},
				{
					"targets": 6,
					"render": function (data) {
						var checkbox = `<div class="form-check">
											<input class="form-check-input" type="checkbox" data-id="`+data.temporary_gr+`">
										</div>`;
						return checkbox;
					}
            	}
			],
			columns: [
				{ data: null },
				{ data: null},
				{ data: 'last_name' },
				{ data: 'first_name' },
				{ data: 'gender' },
				{ data: 'admission_date' },
				{ data: null },
			],
		});
	});

	$('#modal-datatable').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );

	//______File-Export Data Table
	var table = $('#file-datatable').DataTable({
		buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});
	table.buttons().container()
	.appendTo( '#file-datatable_wrapper .col-md-6:eq(0)' );	

	//______Delete Data Table
	var table = $('#delete-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	}); 
    $('#delete-datatable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );

	//______Form Input Datatable 
	$('#form-input-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		},
		responsive: true,
		columnDefs: [{
			orderable: false,
			targets: [1,2,3]
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

	$('#form-input-datatable').on('draw.dt', function() {
		$('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one'
		});
	});

});

