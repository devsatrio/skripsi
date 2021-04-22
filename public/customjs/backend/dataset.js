
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/data-dataset',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'kode', name: 'kode' },
            { data: 'nama', name: 'nama' },
            {
                render: function (data, type, row) {
                    if(row['keterangan']=='N'){
                        return '<span class="badge badge-danger">Minat Rendah</span>';
                    }else{
                        return '<span class="badge badge-success">Minat Tinggi</span>';
                    }
                },
                "className": 'text-center',
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                render: function (data, type, row) {
                    return '<a href="/dataset/' + row['id'] + '/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a> <button class="btn btn-danger" onclick="hapusdata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>'
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
        ],
        pageLength: 50,
        lengthMenu: [[50, 100, 200], [50, 100, 200]]
    });

});

function hapusdata(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat di pulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/dataset/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        }
    })
}
window.hapusdata = hapusdata;