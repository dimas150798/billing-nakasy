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

    public function EditPelangganSave()
    {
        $input = $this->input->post();

        $requiredFields = [
            'nama_customer',
            'start_date',
            'kode_customer',
            'name_pppoe',
            'password_pppoe',
            'phone_customer',
            'id_paket',
            'nama_area',
            'nama_sales',
            'email_customer',
            'alamat_customer'
        ];

        foreach ($requiredFields as $field) {
            $this->form_validation->set_rules($field, ucfirst(str_replace('_', ' ', $field)), 'required');
        }

        $this->form_validation->set_message('required', 'Masukkan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $data = [
                'DataPaket'  => $this->M_Paket->DataPaket(),
                'DataArea'   => $this->M_Area->DataArea(),
                'DataSales'  => $this->M_Sales->DataSales(),
                'DataPelanggan' => $this->M_Pelanggan->Edit_Pelanggan($input['id_customer']),
            ];

            $this->load->view('template/admin/V_Header');
            $this->load->view('template/admin/V_Sidebar');
            $this->load->view('admin/Data_Pelanggan/V_Edit_Pelanggan', $data);
            $this->load->view('template/admin/V_Get_Data');
            $this->load->view('template/admin/V_Footer');
            return;
        }

        // Ambil data paket
        $paket = $this->M_Paket->Check_Idpaket($input['id_paket']);

        // Ambil order_id dari pembayaran sebelumnya
        $payment = $this->M_SudahLunas->Check_Payment($input['name_pppoe']);

        // Update ke Mikrotik berdasarkan lokasi
        $mikrotikProfiles = [
            'Kraksaan' => 'connectKraksaaan',
            'Paiton'   => 'connectPaiton'
        ];

        if (isset($mikrotikProfiles[$input['kode_mikrotik']])) {
            $api = call_user_func($mikrotikProfiles[$input['kode_mikrotik']]);
            $api->comm('/ppp/secret/set', [
                ".id"     => $input['id_pppoe'],
                "name"    => $input['name_pppoe'],
                "password" => $input['password_pppoe'],
                "service" => "any",
                "profile" => $paket->nama_paket,
                "comment" => $input['deskripsi_customer'],
            ]);
            $api->disconnect();
        }

        // Data update pelanggan
        $dataPelanggan = [
            'id_customer'        => $input['id_customer'],
            'kode_customer'      => $input['kode_customer'],
            'phone_customer'     => $input['phone_customer'],
            'nama_customer'      => $input['nama_customer'],
            'id_paket'           => $input['nama_paket'],
            'nama_paket'         => $paket->nama_paket,
            'name_pppoe'         => $input['name_pppoe'],
            'password_pppoe'     => $input['password_pppoe'],
            'alamat_customer'    => $input['alamat_customer'],
            'email_customer'     => $input['email_customer'],
            'start_date'         => $input['start_date'],
            'nama_area'          => $input['nama_area'],
            'deskripsi_customer' => $input['deskripsi_customer'],
            'nama_sales'         => $input['nama_sales'],
            'updated_at'         => date('Y-m-d H:i:s'),
        ];

        $updateDataPayment = [
            'name_pppoe'    => $input['name_pppoe'],
            'gross_amount'  => $paket->harga_paket,
            'nama_paket'    => $paket->nama_paket
        ];

        $whereCustomer = ['id_customer' => $input['id_customer']];
        $wherePayment  = ['order_id' => $payment->order_id];

        $this->M_CRUD->updateData('data_customer', $dataPelanggan, $whereCustomer);
        $this->M_CRUD->updateData('data_pembayaran', $updateDataPayment, $wherePayment);
        $this->M_CRUD->updateData('data_pembayaran_history', $updateDataPayment, $wherePayment);

        $this->session->set_flashdata('Edit_icon', 'success');
        $this->session->set_flashdata('Edit_title', 'Edit Data Berhasil');

        redirect('admin/Data_Pelanggan/C_Data_Pelanggan');
    }
}
