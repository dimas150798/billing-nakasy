<!-- AJAX data pelanggan -->
<div id="data-url" data-url="<?= base_url('admin/Data_Pelanggan/C_Data_Pelanggan/GetDataAjax'); ?>"></div>

<!-- Edit Pelanggan-->
<div id="edit-url" data-url="<?= site_url('admin/Data_Pelanggan/C_Edit_Pelanggan/Edit_Pelanggan'); ?>"></div>

<!-- Alert Berhasil -->
<script>
    <?php if ($this->session->flashdata('Tambah_icon')) { ?>
        var toastMixin = Swal.mixin({
            toast: true,
            icon: '<?php echo $this->session->flashdata('Tambah_icon') ?>',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        toastMixin.fire({
            animation: true,
            title: '<?php echo $this->session->flashdata('Tambah_title') ?>'
        });

    <?php } ?>
</script>