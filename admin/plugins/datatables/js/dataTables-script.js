$(document).ready(function () {
	if ( $.fn.dataTable.isDataTable( '.dataTables-example' ) ) {
    table = $('.dataTables-example').DataTable();
	}
	else {
		table = $('.dataTables-example').DataTable( {
			 retrieve: true,
			"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
			buttons: [
			
			{
				extend: 'excelHtml5',
				exportOptions: {
					columns: ':visible'
				}
			},
			{
				extend: 'pdfHtml5',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4 ]
				}
			}
		]
		} );
	}
});
