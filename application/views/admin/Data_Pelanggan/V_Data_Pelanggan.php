     <!-- Content wrapper -->
     <div class="content-wrapper">

         <!-- Content -->
         <div class="container-xxl flex-grow-1 container-p-y">
             <div class="row">
                 <div class="col-12">
                     <div class="card mb-3">

                         <div class="card-body">

                             <!-- Header -->
                             <div class="row">
                                 <div class="col-12">
                                     <div class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center p-3 bg-white mb-3">
                                         <h3 class="mb-2 mb-md-0">Data Pelanggan</h3>
                                         <div class="d-flex flex-wrap align-items-center gap-2">
                                             <div class="btn-group">
                                                 <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                     <i class="bi bi-box-arrow-down me-1"></i> Export & Import
                                                 </button>
                                                 <ul class="dropdown-menu">
                                                     <li><a class="dropdown-item" href="#">Export as Excel</a></li>
                                                     <li><a class="dropdown-item" href="<?php echo base_url('admin/Data_Pelanggan/C_Import_Pelanggan') ?>">Import as Excel</a></li>
                                                 </ul>
                                             </div>
                                             <a href="<?= base_url('admin/Data_Pelanggan/C_Tambah_Pelanggan') ?>" class="btn btn-primary">
                                                 <i class="bi bi-plus-lg me-1"></i> Tambah
                                             </a>

                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <!-- Tabel -->
                             <table id="mytable" class="table table-bordered responsive nowrap" style="width:100%">
                                 <thead class="table-light">
                                     <tr>
                                         <th class="text-center">No</th>
                                         <th>Nama Customer</th>
                                         <th>Name PPPOE</th>
                                         <th class="text-center">Telepon</th>
                                         <th class="text-center">Nama Paket</th>
                                         <th class="text-center">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <!-- Your table body content goes here -->
                                 </tbody>
                             </table>
                         </div>


                     </div>
                 </div>
             </div>
         </div>

     </div>