function datatable(tableId, modalId, url, columnsSetting, exportColumns = [1,2,3,4,5]) {
    const ids = [];

    let table = new DataTable(tableId, {
        columns: columnsSetting,
        columnDefs: [
            {
                orderable: false,
                // render ra ô select ở cột 0 (cột đầu tiên)
                render: DataTable.render.select(),
                targets: 0,
            },
           {
                width: '20%',
                targets: 3
           }
        ],
        layout: {
            topStart: {
                buttons: [
                    {
                        text: 'Xoá nhiều bản ghi: 0',
                        className: 'btn btn-outline-danger',
                        attr: {
                            'data-bs-toggle': "modal",
                            'data-bs-target': modalId
                        },
                        action: function () {
                            const data = table.rows({ selected: true }).data();

                            data.each((item) => {
                                // push id of each item into ids array
                                ids.push(item[1])
                            })
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Xuất file Excel',
                        exportOptions: {
                            columns: exportColumns
                        },
                        className: 'btn btn-outline-primary'
                    },
                    {
                        extend: 'pdf',
                        text: 'Xuất file PDF',
                        exportOptions: {
                            columns: exportColumns
                        },
                        className: 'btn btn-outline-success'
                    },
                ]
            }
        },
        select: true,
    })


    table.button().disable();

    table.on('select', () => {
        table.button().enable();
        table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
    })

    table.on('deselect', () => {
        if (table.rows({ selected: true }).count()) {
            table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
        } else {
            table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
            table.button().disable();
        }
    })

    // Ajax call to delete records
    $('#delete-record').on('click', () => {
        const checkedRow = table.rows({ selected: true }).data();

        if (checkedRow.length === 0) {
            alert('Vui lòng nếu xóa 1 bản ghi thì chỉ nhấn nút delete là được!')
        }

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                // if the length of ids = 0, then send current selected row's id, else send an array of ids
                // for testing
                // console.log(checkedRow[0][1])
                ids: ids.length === 0 ? checkedRow[0][1] : ids
            },
            success: function (data) {
                table.rows({ selected: true }).remove().draw();
                table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
                table.button().disable();

                $(modalId).modal('hide');

                Toastify({
                    text: "Đã xóa các bản ghi!",
                    close: true,
                    duration: 2000
                }).showToast();
            },
        })
    })
}
