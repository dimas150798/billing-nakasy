<?php

class M_Pelanggan extends CI_Model
{
    // Menampilkan Data Pelanggan
    public function DataPelanggan()
    {
        $query   = $this->db->query("SELECT id_customer, kode_customer, phone_customer, nama_customer, name_pppoe, nama_paket, start_date
            FROM data_customer
    
            GROUP BY name_pppoe
            ORDER BY name_pppoe ASC");

        return $query->result_array();
    }

    // Menampilkan Total Pelanggan Keseluruhan
    public function Total_Pelanggan()
    {
        $query   = $this->db->query("SELECT name_pppoe 
        FROM data_customer 
        WHERE stop_date is null
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
}
