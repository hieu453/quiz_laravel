function datatable(tableId, modalId, url, searchIndividual = []) {
    const ids = [];

    let table = new DataTable(tableId, {
        language: {
            info: 'Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ bản ghi',
            emptyTable: 'Không có bản ghi nào',
            zeroRecords: 'Không tìm thấy bản ghi nào',
            lengthMenu: '_MENU_ bản ghi',
            infoFiltered: ' Tìm trong _MAX_ bản ghi',
            infoEmpty: '',
        },
        initComplete: function () {
            this.api()
                .columns()
                .every(function () { // lặp qua các cột của bảng
                    // kiểm tra xem nếu cột hiện tại nằm trong các cột muốn tìm (searchIndividual) thì hiển thị ô tìm kiếm
                    if (searchIndividual.includes(this[0][0])) {
                        let column = this;
                            let title = column.footer().textContent;

                            // Create input element
                            let input = document.createElement('input');
                            input.placeholder = title;
                            column.footer().replaceChildren(input);

                            // Event listener for user input
                            input.addEventListener('keyup', () => {
                                if (column.search() !== this.value) {
                                    column.search(input.value).draw();
                                }
                            });
                    }
                })
            console.log(this.api().columns()[0].length)
        },
        // columns: columnsSetting,
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
           },
           {
                orderable: false,
                targets: -1
           }
        ],
        layout: {
            topEnd: null,
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
                    // {
                    //     extend: 'excel',
                    //     text: 'Xuất file Excel',
                    //     exportOptions: {
                    //         columns: exportColumns
                    //     },
                    //     className: 'btn btn-outline-primary'
                    // },
                    // {
                    //     extend: 'pdf',
                    //     text: 'Xuất file PDF',
                    //     exportOptions: {
                    //         columns: exportColumns
                    //     },
                    //     className: 'btn btn-outline-success'
                    // },
                ],
                pageLength: {},
            },
        },
        select: true,
    })


    table.button().disable();

    table.on('select', () => {
        table.button().enable();
        table.button().text(`Xoá nhiều bản ghi: ${table.rows({ selected: true }).count()}`);
    })

    table.on('deselect', () => {
        if (table.rows({ selected: true }).count()) {
            table.button().text(`Xoá nhiều bản ghi: ${table.rows({ selected: true }).count()}`);
        } else {
            table.button().text(`Xoá nhiều bản ghi: ${table.rows({ selected: true }).count()}`);
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
