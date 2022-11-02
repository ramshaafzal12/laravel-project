// delete record from listing
function deleteRecord(url, type, method = 'DELETE') {
    new Swal(
        {
            title: "Are you sure?",
            text: "You want to delete this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }
    ).then(({ isConfirmed }) => {
        if (isConfirmed) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-Token": $('meta[name="_token"]').attr('content'),
                },
            });
            $.ajax({
                url: url,
                type: method,
                async: false,
                success: function (response) {
                    if (response.status) {
                        var table = $(`.${type.toLowerCase()}s-datatable`).DataTable();
                        if(type == 'Ranker') {
                            messageText = 'Deleting this ranker will still keep the user as a Player in system.';
                        }
                        else {
                            messageText = `${type} deleted successfuly`;
                        }
                        Swal.fire(
                            "Deleted!",
                            messageText,
                            "success"
                        );
                        table.ajax.reload();
                    } else {
                        Swal.fire("Delete!", "Request failed.", "error");
                    }
                },
            });
        } else {
            console.log(isConfirmed);
        }
    })
};