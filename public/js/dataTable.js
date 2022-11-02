var dataTableParams = {
    element: "",
    url: "",
    columns: [],
    dataColumns: [],
    dataTableOptions: {}
};

/**** setting up default setting for every datatable ****/
$.extend(true, $.fn.dataTable.defaults, {
    pageLength: 50,
    lengthMenu: [
        [50, 100, 200],
        [50, 100, 200]
    ],
    processing: true,
    serverSide: true,
    searching: false,
    ordering: true,
    paging: true
});
/**** setting up default setting for every datatable ****/

/**** function to setup columns from server side data ****/
function setColumns(columns) {
    var setDataColumn = [];

    columns.forEach(column => {
        setDataColumn.push({ mData: column,  });
    });

    return setDataColumn;
}
/**** function to setup columns from server side data ****/

/**** function to render datatable takes an object, that must have following properties
 *  element          = class of element
 *  url              = url to fetch data
 *  columns          = used to render columns from ajax response
 *  dataColumns      = input's id to select for filter and data processing
 *  datatableoptions = to change any defaul property of datatable e.g want searching true send { searching:true }
 */
function makeDataTable(dataTableProps) {
    $(`.${dataTableProps.element}`).DataTable({
        deferRender: true,
        ...dataTableProps.dataTableOptions,
        ajax: {
            url: dataTableProps.url,
            cache: true,
            data: function(d) {
                dataTableProps.dataColumns.forEach(column => {
                    d[`${column}`] = $(`#${column}`).val();
                });
            }
        },
        aoColumns: setColumns(dataTableProps.columns),

        columnDefs: window.location.pathname == 'booking' ? [
            { "orderSequence": [ "desc", "asc" ], "targets": [ 0 ] },
            { "orderSequence": [ "desc", "asc" ], "targets": [ 6 ] },
        ] : [
            { "orderSequence": [ "desc", "asc" ], "targets": [ 0 ] },
        ],
        // exclude booking listing from id sorting, since booking is to be sorted on start time
        order: window.location.pathname != '/booking' ? [[ 0, "desc" ]] : [[6, "desc"]]
    });
}
/**** function to render datatable */

/*** Example to implement in index or file where you want to make datatable 
    
    var playersTable = { ...dataTableParams };
    playersTable.element = "players-datatable";
    playersTable.url = "/players";
    playersTable.columns = ["id", "name", "phone", "status", "action"];
    playersTable.dataColumns = ["booking_number"];
    makeDataTable(playersTable);

*/
