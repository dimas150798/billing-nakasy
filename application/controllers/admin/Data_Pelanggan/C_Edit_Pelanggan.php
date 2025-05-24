<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Edit_Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Mencegah caching agar tidak bisa kembali ke halaman setelah logout
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

        if ($this->session->userdata('email') == null) {
            $this->session->set_flashdata('BelumLogin_icon', 'error');
            $this->session->set_flashdata('BelumLogin_title', 'Login Terlebih Dahulu');
            redirect('C_FormLogin');
        }
    }

    public function Edit_Pelanggan($id_customer)
    {
        $data['Data_Pelanggan']  = $this->M_Pelanggan->Edit_Pelanggan($id_customer);
        $data['DataPaket']      = $this->M_Paket->DataPaket();
        $data['DataArea']       = $this->M_Area->DataArea();
        $data['DataSales']      = $this->M_Sales->DataSales();

        $this->load->view('template/admin/V_Header');
        $this->load->view('template/admin/V_Sidebar');
        $this->load->view('template/admin/V_Get_Data');
        $this->load->view('admin/Data_Pelanggan/V_Edit_Pelanggan', $data);
        $this->load->view('template/admin/V_Footer');
    }

    public function Edit_PelangganSave()
    {
        // Mengambil data post pada view
        $id_pppoe               = $this->input->post('id_pppoe');
        $id_pppoe_paiton        = $this->input->post('id_pppoe_paiton');
        $id_customer            = $this->input->post('id_customer');
        $kode_customer          = $this->input->post('kode_customer');
        $phone_customer         = $this->input->post('phone_customer');
        $nama_customer          = $this->input->post('nama_customer');
        $id_paket               = $this->input->post('nama_paket');
        $name_pppoe             = $this->input->post('name_pppoe');
        $password_pppoe         = $this->input->post('password_pppoe');
        $alamat_customer        = $this->input->post('alamat_customer');
        $email_customer         = $this->input->post('email_customer');
        $start_date             = $this->input->post('start_date');
        $nama_area              = $this->input->post('nama_area');
        $deskripsi_customer     = $this->input->post('deskripsi_customer');
        $nama_sales             = $this->input->post('nama_sales');
        $kode_mikrotik          = $this->input->post('kode_mikrotik');
        $kode_mikrotik_paiton   = $this->input->post('kode_mikrotik_paiton');

        $GetDataPaket           = $this->M_Paket->Check_Idpaket($id_paket);
        $price_paket            = $GetDataPaket->harga_paket;
        $nama_paket             = $GetDataPaket->nama_paket;

        $name_pppoe_session     = $this->input->post('name_pppoe_session');

        $Check_Payment          = $this->M_SudahLunas->Check_Payment($name_pppoe_session);

        $Order_ID               = $Check_Payment->order_id;

        $updateDataPayment = array(
            'name_pppoe'    => $name_pppoe,
            'gross_amount'  => $price_paket,
            'nama_paket'    => $nama_paket
        );

        $namePPPOE_session = array(
            'order_id'       => $Order_ID
        );

        // Menyimpan data pelanggan ke dalam array
        $dataPelanggan = array(
            'id_customer'       => $id_customer,
            'kode_customer'     => $kode_customer,
            'phone_customer'    => $phone_customer,
            'nama_customer'     => $nama_customer,
            'id_paket'          => $id_paket,
            'nama_paket'        => $nama_paket,
            'name_pppoe'        => $name_pppoe,
            'password_pppoe'    => $password_pppoe,
            'alamat_customer'   => $alamat_customer,
            'email_customer'    => $email_customer,
            'start_date'        => $start_date,
            'nama_area'         => $nama_area,
            'deskripsi_customer' => $deskripsi_customer,
            'nama_sales'        => $nama_sales,
            'updated_at'        => date('Y-m-d H:i:s', time())
        );

        // Kondisi update menggunakan id_customer
        $idCustomer = array(
            'id_customer'       => $id_customer
        );

        // Memanggil mysql dari model
        $data['Data_Pelanggan']  = $this->M_Pelanggan->Edit_Pelanggan($id_customer);
        $data['DataPaket']      = $this->M_Paket->DataPaket();
        $data['DataArea']       = $this->M_Area->DataArea();
        $data['DataSales']      = $this->M_Sales->DataSales();

        // Rules form validation
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('kode_customer', 'Kode Customer', 'required');
        $this->form_validation->set_rules('name_pppoe', 'Name PPPOE', 'required');
        $this->form_validation->set_rules('password_pppoe', 'Password PPPOE', 'required');
        $this->form_validation->set_rules('phone_customer', 'Phone Customer', 'required');
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required');
        $this->form_validation->set_rules('nama_area', 'Nama Area', 'required');
        $this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');
        $this->form_validation->set_rules('email_customer', 'Email Customer', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin/V_Header');
            $this->load->view('template/admin/V_Sidebar');
            $this->load->view('template/admin/V_Get_Data');
            $this->load->view('admin/Data_Pelanggan/V_Edit_Pelanggan', $data);
            $this->load->view('template/admin/V_Footer');
        } else {
            // Edit Pelanggan Ke Mikrotik

            $api = Connect_Paiton();
            $api->comm('/ppp/secret/set', [
                ".id" => $id_pppoe,
                "name" => $name_pppoe,
                "password" => $password_pppoe,
                "service" => "any",
                "profile" => $nama_paket,
                "comment" => $deskripsi_customer,
            ]);
            $api->disconnect();

            $this->M_CRUD->updateData('data_customer', $dataPelanggan, $idCustomer);

            // Update data pembayaran apabila name pppoe update
            $this->M_CRUD->updateData('data_pembayaran', $updateDataPayment, $namePPPOE_session);
            $this->M_CRUD->updateData('data_pembayaran_history', $updateDataPayment, $namePPPOE_session);

            // Notifikasi Login Berhasil
            $this->session->set_flashdata('Edit_icon', 'success');
            $this->session->set_flashdata('Edit_title', 'Edit Data Berhasil');

            redirect('admin/Data_Pelanggan/C_Data_Pelanggan');
        }
    }
}
