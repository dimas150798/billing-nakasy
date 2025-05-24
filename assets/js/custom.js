// Datatables AJAX
$(document).ready(function() {
    var url = $('#data-url').data('url');  // Ambil URL dari data-url div

    $('#mytable').DataTable({
        "autoFill": true,
        "pagingType": 'numbers',
        "searching": true,
        "paging": true,
        "stateSave": true,
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": url,  // Gunakan URL yang sudah diambil
        },
    });
});

// Edit Data Sweetalert2
function EditDataPelanggan(parameter_id) {
    // Ambil URL dari elemen data-url
    var editUrl = document.getElementById('edit-url').getAttribute('data-url');
    
    Swal.fire({
        title: 'Yakin Melakukan Edit Data ?',
        text: "Data yang diedit tidak akan kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Edit Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gabungkan URL dan parameter_id
            window.location.href = editUrl + '/' + parameter_id;
        }
    });
}


// Initialize Select2 for nama_paket
$('#nama_paket').each(function() {
    $(this).select2({
        placeholder: 'Pilih Paket :',
        theme: 'bootstrap-5',
        dropdownParent: $(this).parent(),
    });
});

// Initialize Select2 for nama_sales
$('#nama_sales').each(function() {
    $(this).select2({
        placeholder: 'Pilih Sales / Penagih :',
        theme: 'bootstrap-5',
        dropdownParent: $(this).parent(),
    });
});

// Initialize Select2 for nama_area
$('#nama_area').each(function() {
    $(this).select2({
        placeholder: 'Pilih ODP / Area:',
        theme: 'bootstrap-5',
        dropdownParent: $(this).parent(),
    });
});