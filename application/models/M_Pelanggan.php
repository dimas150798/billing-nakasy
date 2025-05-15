<?php

class M_Pelanggan extends CI_Model
{
    // Menampilkan Data Pelanggan
    public function DataPelanggan()
    {
        $query   = $this->db->query("SELECT client.id, client.code_client, client.phone, client.name, client.id_paket, 
            client.name_pppoe, client.password_pppoe, client.id_pppoe, client.address, client.email, 
            DAY(client.start_date) as tanggal, client.start_date, client.stop_date, client.id_area, client.description, client.id_sales, client.disabled,
            area.name as nama_area, area.nama_dp, sales.name as nama_sales, paket.name as nama_paket, area.nama_dp
            
            FROM client
            
            LEFT JOIN area ON client.id_area = area.id
            LEFT JOIN sales ON client.id_sales = sales.id
            LEFT JOIN paket ON client.id_paket = paket.id

            WHERE client.stop_date IS NULL 
            
            GROUP BY client.name_pppoe
            ORDER BY client.name_pppoe ASC");

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
