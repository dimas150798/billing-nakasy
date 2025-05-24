<?php

class M_Pelanggan extends CI_Model
{
    // Menampilkan Data Pelanggan
    public function DataPelanggan($kode_mikrotik)
    {
        $query   = $this->db->query("SELECT id_customer, kode_customer, phone_customer, nama_customer, name_pppoe, nama_paket, start_date
            FROM data_customer

            WHERE kode_mikrotik = '$kode_mikrotik'
    
            GROUP BY name_pppoe
            ORDER BY name_pppoe ASC");

        return $query->result_array();
    }

    // Menampilkan Total Pelanggan Keseluruhan
    public function Total_Pelanggan($kode_mikrotik)
    {
        $query   = $this->db->query("SELECT name_pppoe 
        FROM data_customer 
        WHERE stop_date is null AND kode_mikrotik = '$kode_mikrotik'
        GROUP BY name_pppoe
        ORDER BY name_pppoe ASC");

        return $query->num_rows();
    }

    // Menampilkan Total Pelanggan Baru
    public function Pelanggan_Baru($Tahun, $Bulan)
    {
        $query   = $this->db->query("SELECT name_pppoe, start_date
        FROM data_customer 

        WHERE YEAR(start_date) = '$Tahun' AND MONTH(start_date) = '$Bulan'

        GROUP BY name_pppoe
        ORDER BY name_pppoe ASC");

        return $query->num_rows();
    }

    // Check data pelanggan
    public function CheckDuplicatePelanggan($Name_PPPOE)
    {
        $this->db->select('nama_customer, id_pppoe, name_pppoe');
        $this->db->where('name_pppoe', $Name_PPPOE);

        $this->db->limit(1);
        $result = $this->db->get('data_customer');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data pelanggan invoice 
    public function CheckDuplicateCode($code_invoice)
    {
        $this->db->select('order_id, name_pppoe');
        $this->db->where('order_id', $code_invoice);

        $this->db->limit(1);
        $result = $this->db->get('data_pembayaran');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function Edit_Pelanggan($id_customer)
    {
        $query   = $this->db->query("SELECT id_customer, kode_customer, phone_customer, 
            latitude, longitude, nama_customer, id_paket, nama_paket, name_pppoe, 
            password_pppoe, id_pppoe, id_pppoe_paiton, alamat_customer, email_customer, 
            start_date, stop_date, nama_area, deskripsi_customer, nama_sales, disabled, 
            disabled_paiton, kode_mikrotik

            FROM data_customer

            WHERE id_customer = '$id_customer'");

        return $query->result_array();
    }
}
