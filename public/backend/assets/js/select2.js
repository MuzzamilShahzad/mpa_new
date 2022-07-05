jQuery(function () {
	$('.select2').select2({
		placeholder: 'Select',
		searchInputPlaceholder: 'Search',
		width: '100%',
		allowClear: true
	});
	$('.campusSelect2').select2({
		placeholder: 'Select Campus',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.sessionSelect2').select2({
		placeholder: 'Select Session',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.classSelect2').select2({
		placeholder: 'Select Class',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.sectionSelect2').select2({
		placeholder: 'Select Section',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.genderSelect2').select2({
		placeholder: 'Select Gender',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.categorySelect2').select2({
		placeholder: 'Select Category',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.bloodSelect2').select2({
		placeholder: 'Select Blood Group',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.houseSelect2').select2({
		placeholder: 'Select School House',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});
	$('.currentSelect2').select2({
		placeholder: 'Select Current Area',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});

	$('.permanentSelect2').select2({
		placeholder: 'Select permanent Area',
		searchInputPlaceholder: 'Search',
		width: '100%'
	});

	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'All categories',
		width: '100%'
	});

	function formatState(state) {
		if (!state.id) { return state.text; }
		var $state = $(
			'<span><img src="backend/assets/plugins/flag-icon-css/flags/4x3/' + state.element.value.toLowerCase() +
			'.svg" class="img-flag" /> ' +
			state.text + '</span>'
		);
		return $state;
	};

	$(".select2-flag-search").select2({
		templateResult: formatState,
		templateSelection: formatState,
		escapeMarkup: function (m) { return m; }
	});

	$('.select2').on('click', () => {
		let selectField = document.querySelectorAll('.select2-search__field')
		selectField.forEach((element, index) => {
			element.focus();
		})
	});

	// $('.testGroup').select2({
	//     placeholder:'Select Test Group',
	//     tags:true,
	// }).on('select2:close', function(){
	//     var element = $(this);

	// 	alert('You want to save');

	//     console.log(element);
	//     console.log(element.val());

	// 	// $(this).remove();

	// 	// $('.testGroup').select2();

	// 	// var new_category = $.trim(element.val());

	//     // if(new_category != '')
	//     // {
	//     //   $.ajax({
	//     //     url:"add.php",
	//     //     method:"POST",
	//     //     data:{category_name:new_category},
	//     //     success:function(data)
	//     //     {
	//     //       if(data == 'yes')
	//     //       {
	//     //         element.append('<option value="'+new_category+'">'+new_category+'</option>').val(new_category);
	//     //       }
	//     //     }
	//     //   })
	//     // }

	// });

});
