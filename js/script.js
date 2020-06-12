$(document).ready(function() {
	$('#mahasiswa').DataTable({
		"lengthMenu": [5, 10, 20, 30, 50, 100],
		"columnDefs" : [
			{
				"searchable" : false,
				"orderable" : false,
				"targets" : [0,1,6],

			}

		]
	});

// $('#select_all').click(function() {
//   if(this.checked) {
//     $('.check').each(function() {
//       this.checked = true;
//     });
//   } else {
//     $('.check').each(function() {
//       this.checked = false;
//     });
//   }
// });

// $('.check').click(function() {
//   if($('.check:checked').length == $('.check').length) {
//     $('#select_all').prop('checked', true);
//   } else {
//     $('#select_all').prop('checked', false);
//   }
// });


});