$(document).ready(function () {
    $('#myTable').DataTable();
});

// Delete row on delete button click
jQuery(document).ready(function () {
    jQuery("#myTable").on('click', '.dlt', function () {

        jQuery(this).closest('tr').remove();
    });
});

/* This method will delete a row */
function deleteRow(ele) {
    var table = document.getElementById('employee-table');
    var rowCount = table.rows.length;
    if (rowCount <= 1) {
        alert("There is no row available to delete!");
        return;
    }
    if (ele) {
        //delete specific row
        ele.parentNode.parentNode.remove();
    }
    else {
        //delete last row
        table.deleteRow(rowCount - 1);
    }
}
// --quotes page js----
// ---file uipload----
function myFunction() {
    var x = document.getElementById("myFile");

}
// ---file uipload----


// DataTable-page--All invoices--
$(document).ready(function () {
    $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [[1, 'asc']]
    });
});