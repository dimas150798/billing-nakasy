<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                © <?= date('Y') ?> <a href="#" target="_blank" class="footer-link fw-bolder">Billing Nakasy</a>. All rights reserved.
            </div>
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div> <!-- Content wrapper -->
</div> <!-- / Layout page -->
</div> <!-- / Layout wrapper -->

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Core JS -->
<script src="<?php echo base_url(); ?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/menu.js"></script>

<!-- Vendors JS -->
<script src="<?php echo base_url(); ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dashboards-analytics.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JS dataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/af-2.5.1/r-2.4.0/datatables.min.js">
</script>

<!-- Ajax Show Data Pelanggan -->
<script>
    $(document).ready(function() {
        $('#mytable').DataTable({
            "autoFill": true,
            "pagingType": 'numbers',
            "searching": true,
            "paging": true,
            "stateSave": true,
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "<?= base_url('admin/Data_Pelanggan/C_Data_Pelanggan/GetDataAjax'); ?>",
            },
        })
    })
</script>


</body>

</html>