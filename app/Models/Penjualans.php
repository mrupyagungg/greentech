<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// jika ingin menggunakan query biasa
use Illuminate\Support\Facades\DB;

class Penjualans extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $fillable = ['no_transaksi', 'id_customer', 'tgl_transaksi', 'tgl_expired', 'total_harga','status'];

    // Definisikan relasi dengan model Keranjang
    public function keranjang()
    {
        return $this->hasMany('App\Models\Keranjang', 'no_transaksi', 'no_transaksi');
    }

    // untuk melihat data barang
    public static function getBarang()
    {
        // query ke tabel barang
        $sql = "SELECT * FROM barang";
        $barangs = DB::select($sql);
        return $barangs;
    }

    // untuk melihat data barang berdasarkan id
    public static function getBarangId($id)
    {
        $sql = "SELECT * FROM barang WHERE id = ?";
        $barangs = DB::select($sql,[$id]);
        return $barangs;
    }

    public static function viewKeranjang($id_customer){
        $sql = "SELECT  a.no_transaksi,
                        c.nama_barang,
                        c.image,
                        c.harga_jual,
                        b.tgl_transaksi,
                        b.tgl_expired,
                        b.jml_barang,
                        b.total,
                        a.status,
                        b.id as id_penjualan_detail
                FROM penjualans a
                JOIN penjualan_detail b
                ON (a.no_transaksi=b.no_transaksi)
                JOIN barangs c 
                ON (b.id_barang = c.id)
                WHERE a.id_customer = ? AND a.status 
                not in ('selesai','expired','siap_bayar','konfirmasi_bayar')";
        $barangs = DB::select($sql,[$id_customer]);
        return $barangs;
    }

    public static function tes(){
        $penjualan = new Penjualan;
        $faktur = $penjualan->getInvoiceNumber();
        return $faktur;
    }

    // dapatkan nomor faktur yang baru
    public static function getInvoiceNumber(){
        $sql = "SELECT SUBSTRING(IFNULL(MAX(no_transaksi),'FK-0000'),4)+0 AS no 
                FROM penjualans";
        $barangs = DB::select($sql);
        foreach($barangs as $b):
            $urutan = $b->no;
        endforeach;

        // pembentukan nomor faktur
        $urutan = $urutan + 1;
        $str = (string)$urutan;
        //menambahkan 0 di samping kiri angka
        $no  = str_pad($str,4,"0",STR_PAD_LEFT); 
        $faktur = 'FK-'.$no;
        return $faktur;
    }

    public static function inputPenjualan($id_customer,$total_harga,$id_barang,$jml_barang,$harga_jual,$total){
        
        // instansiasi obyek
        $penjualan = new Penjualans;
        // query apakah ada di keranjang
        // query kode perusahaan
        $sql = "SELECT COUNT(*) as jml 
                FROM penjualans 
                WHERE id_customer = ? 
                AND status not in ('expired','selesai','siap_bayar','konfirmasi_bayar')";
        $barang = DB::select($sql,[$id_customer]);
        foreach($barang as $b):
            $jml = $b->jml;
        endforeach;

        // jika jumlahnya 0 maka buat nomor transaksi baru
        // ['no_transaksi','id_customer','tgl_transaksi','tgl_expired','total_harga','status'];
        if($jml==0){

            // dapatkan nomor faktur terakhir cth format FK-0004
            $faktur = $penjualan->getInvoiceNumber();

            // masukkan ke tabel induk dulu yaitu di tabel penjualan
            // baru ke tabel anaknya penjualan_detail
            
            $date = date('Y-m-d H:i:s');
            //tambahkan 3 hari untuk expired datenya dari tanggal sekarang
            $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); 
            DB::table('penjualans')->insert([
                'no_transaksi' => $faktur,
                'id_customer' => $id_customer,
                'tgl_transaksi' => $date,
                'tgl_expired' => $date_plus_3,
                'total_harga' => $total_harga,
                'status' => 'pesan' //isinya 'pesan','expired','selesai','siap_bayar','konfirmasi_bayar'
            ]);

            // masukkan ke tabel detail_penjualan
            DB::table('penjualan_detail')->insert([
                'no_transaksi' => $faktur,
                'id_barang' => $id_barang,
                'harga_jual' => $harga_jual,
                'jml_barang' => $jml_barang,
                'total' => $total,
                'tgl_transaksi' => $date,
                'tgl_expired' => $date_plus_3
            ]);

            // update stok di tabel barang menjadi berkurang
            // dapatkan stok dulu
            $penjualan = new Penjualans;
            $stok = $penjualan->getStock($id_barang);
            $stok_akhir = $stok - $jml_barang;
            $affected = DB::table('barangs')
              ->where('id', $id_barang)
              ->update(['stok' => $stok_akhir]);
			  
			// tambahkan ke status transaksi
            DB::table('status_transaksi')->insert([
                'no_transaksi' => $faktur,
                'id_customer' => $id_customer,
                'status' => 'pesan',
                'waktu' => now(),
            ]);
			
        }else{
            // jika sudah ada nomor fakturnya
            // 1. update transaksi yang masih menggantung ke expired jika di tabel detail sudah expired semua
            //    dapatkan max tgl expired
            $sql = "SELECT no_transaksi,MAX(tgl_expired) as mak_expired 
                    FROM penjualan_detail WHERE  
                    no_transaksi IN 
                    (
                        SELECT no_transaksi
                        FROM penjualans
                        WHERE id_customer = ? 
                        AND status NOT IN ('selesai','expired','siap_bayar','konfirmasi_bayar')
                    ) 
                    GROUP BY no_transaksi
                   ";
            $barangs = DB::select($sql,[$id_customer]);
            foreach($barangs as $b):
                $mak_expired = $b->mak_expired;
                $no_transaksi = $b->no_transaksi;
            endforeach;

            // update ke tabel transaksi expirednya menjadi expired terlama dari detail penjualan
            $affected = DB::table('penjualans')
              ->where('no_transaksi', $no_transaksi)
              ->update(['tgl_expired' => $mak_expired]);

            // jika mak expired sudah melewati masa sekarang
            // maka lakukan update status pesanan menjadi 'expired'
            $date = date('Y-m-d H:i:s');
            if($date>$mak_expired){
                // update status menjadi expired
                    $affected = DB::table('penjualans')
                ->where('no_transaksi', $no_transaksi)
                ->update(['status' => 'expired']);

                // kembalikan stok
                $sql = "SELECT id_barang,jml_barang 
                        FROM penjualan_detail 
                        WHERE  no_transaksi = ?
                    ";
                $barang = DB::select($sql,[$no_transaksi]);
                foreach($barang as $b):
                    $id_barang = $b->id_barang;
                    $jml_barang_lama = $b->jml_barang;
                    // query stok
                    // kembalikan stok
                    $stok = $penjualan->getStock($id_barang);
                    $stok_akhir = $stok + $jml_barang_lama;
                    $affected = DB::table('barang')
                    ->where('id', $id_barang)
                    ->update(['stok' => $stok_akhir]);
                endforeach;

                // buat nomor faktur baru dan masukkan ke tabel
                // dapatkan nomor faktur terakhir cth format FK-0004
                $faktur = $penjualan->getInvoiceNumber();
				
				// tambahkan ke status transaksi
                DB::table('status_transaksi')->insert([
                    'no_transaksi' => $no_transaksi,
                    'id_customer' => $id_customer,
                    'status' => 'expired',
                    'waktu' => now(),
                ]);
	

                // masukkan ke tabel induk dulu yaitu di tabel penjualan
                
                $date = date('Y-m-d H:i:s');
                $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); //tambahkan 3 hari untuk expired datenya
                DB::table('penjualans')->insert([
                    'no_transaksi' => $faktur,
                    'id_customer' => $id_customer,
                    'tgl_transaksi' => $date,
                    'tgl_expired' => $date_plus_3,
                    'total_harga' => $total_harga,
                    'status' => 'pesan' //isinya pesan, selesai, expired
                ]);

                // masukkan ke tabel detail_penjualan
                DB::table('penjualan_detail')->insert([
                    'no_transaksi' => $faktur,
                    'id_barang' => $id_barang,
                    'harga_jual' => $harga_jual,
                    'jml_barang' => $jml_barang,
                    'total' => $total,
                    'tgl_transaksi' => $date,
                    'tgl_expired' => $date_plus_3
                ]);

                // update stok di tabel barang menjadi berkurang
                // dapatkan stok dulu
                $stok = $penjualan->getStock($id_barang);
                $stok_akhir = $stok - $jml_barang;
                $affected = DB::table('barang')
                ->where('id', $id_barang)
                ->update(['stok' => $stok_akhir]);
                // akhir buat nomor faktur baru
				
				// tambahkan ke status transaksi
                DB::table('status_transaksi')->insert([
                    'no_transaksi' => $faktur,
                    'id_customer' => $id_customer,
                    'status' => 'pesan',
                    'waktu' => now(),
                ]);

            }else{
                // belum mencapai masa expired, maka
                // tambahkan total belanja ke tabel penjualan_detail
                // cek untuk id barang yang sama, maka tidak usah tambah lagi, 
                // tapi cukup jml belanjanya diupdate
                // selain itu masukkan lagi ke penjualan detail
                // 1. cek apakah yg diinputkan adalah id barang yang sudah ada di keranjang atau tidak
                $sql = "SELECT id_barang,jml_barang,no_transaksi FROM penjualan_detail
                        WHERE  
                        no_transaksi IN 
                        (
                            SELECT no_transaksi
                            FROM penjualans
                            WHERE id_customer = ? AND status NOT IN ('selesai','expired','siap_bayar','konfirmasi_bayar')
                        ) AND id_barang = ?
                        ";
                $barangs = DB::select($sql,[$id_customer,$id_barang]);
                $cek = 0;
                foreach($barangs as $b):
                    $id_barang_tabel = $b->id_barang;
                    $jml_barang_tabel = $b->jml_barang;
                    $no_transaksi_tabel = $b->no_transaksi;
                    $cek = 1;
                    // tambahkan jml barangnya dan tamnbahkan masa expirednya
                    $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); //tambahkan 3 hari untuk expired datenya
                    $jml_barang_akhir = $jml_barang + $jml_barang_tabel;
                    $total_tagihan  = $harga_jual * $jml_barang_akhir;
                    $affected = DB::table('penjualan_detail')
                    ->where('no_transaksi','=', $no_transaksi_tabel)
                    ->where('id_barang', '=',$id_barang_tabel)
                    ->update(['jml_barang' => $jml_barang_akhir,'total'=> $total_tagihan,
                              'tgl_transaksi' => $date_plus_3
                             ]);

                    // dapatkan stok dulu
                    $stok = $penjualan->getStock($id_barang);
                    $stok_akhir = $stok - $jml_barang;
                    $affected = DB::table('barang')
                    ->where('id', $id_barang)
                    ->update(['stok' => $stok_akhir]);

                endforeach;

                // jika nilai variabel cek == 0 maka ini adalah inputan baru
                if($cek==0){
                    // 
                    // buat nomor faktur baru dan masukkan ke tabel
                    // dapatkan nomor faktur terakhir cth format FK-0004
                    $sql = "SELECT max(no_transaksi) as no_transaksi  FROM penjualans
                            WHERE id_customer = ? AND status NOT IN ('selesai','expired','siap_bayar','konfirmasi_bayar')
                           ";
                    $barangs  = DB::select($sql,[$id_customer]);
                    foreach($barangs as $b):
                        $no_transaksi = $b->no_transaksi;
                    endforeach;

                    $sql = "SELECT total_harga  FROM penjualans
                            WHERE no_transaksi = ? 
                           ";
                    $barangs = DB::select($sql,[$no_transaksi]);
                    foreach($barangs as $b):
                        $total_harga_lama = $b->total_harga;
                    endforeach;

                    // $total_harga_lama = $b->total_harga;
                    // masukkan ke tabel induk dulu yaitu di tabel penjualan
                    $total_harga_baru = $total_harga+$total_harga_lama;
                    $date = date('Y-m-d H:i:s');
                    $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); //tambahkan 3 hari untuk expired datenya
                    // update total harga di penjualan karena sudah ditambah item baru
                    $affected = DB::table('penjualans')
                    ->where('no_transaksi', $no_transaksi)
                    ->update(
                                [   'tgl_expired' => $date_plus_3,
                                    'total_harga'=> $total_harga_baru, 
                                ]
                            );

                    // masukkan ke tabel detail_penjualan
                    DB::table('penjualan_detail')->insert([
                        'no_transaksi' => $no_transaksi,
                        'id_barang' => $id_barang,
                        'harga_jual' => $harga_jual,
                        'jml_barang' => $jml_barang,
                        'total' => $total,
                        'tgl_transaksi' => $date,
                        'tgl_expired' => $date_plus_3
                    ]);

                    // update stok di tabel barang menjadi berkurang
                    // dapatkan stok dulu
                    $stok = $penjualan->getStock($id_barang);
                    $stok_akhir = $stok - $jml_barang;
                    $affected = DB::table('barang')
                    ->where('id', $id_barang)
                    ->update(['stok' => $stok_akhir]);
                    // akhir buat nomor faktur baru
                    
                }
            }
        }
        
    }

    // lihat stok barang
    public static function getStock($id_barang)
    {
        $sql = "SELECT stok FROM barang WHERE id = ?";
        $barangs = DB::select($sql,[$id_barang]);
        
        // Inisialisasi variabel $stok dengan nilai default
        $stok = 0;
    
        // Pastikan ada hasil yang ditemukan sebelum melakukan iterasi
        if(!empty($barangs)) {
            foreach($barangs as $b):
                $stok = $b->stok;
            endforeach;
        }
    
        return $stok;
    }

    // untuk menghapus data penjualan detail
    public static function hapuspenjualandetail($id_penjualan_detail){
        // dapatkan nomor transaksi dulu
        $sql = "SELECT  no_transaksi
                FROM penjualan_detail
                WHERE id = ? ";
        $transaksi = DB::select($sql,[$id_penjualan_detail]);
        foreach($transaksi as $b):
            $no = $b->no_transaksi;
        endforeach;

        // hapus datanya
        $sql = "DELETE FROM penjualan_detail WHERE id = ?";
        $nrd = DB::delete($sql,[$id_penjualan_detail]);

        
        // hitung total harga dari jml di penjualan detail
        $sql = "SELECT  SUM(total) as ttl
                FROM penjualan_detail
                WHERE no_transaksi = ? ";
        $total = DB::select($sql,[$no]);
        foreach($total as $b):
            $ttl = $b->ttl;
        endforeach;
        
        // update total harga di tabel penjualan
        $affected = DB::table('penjualan')
          ->where('no_transaksi', $no)
          ->update(['total_harga' => $ttl]);
    }
    
    // kembalikan stok
    public static function kembalikanstok($id_penjualan_detail){
        $penjualan = new Penjualan;
        $sql = "SELECT jml_barang,id_barang FROM penjualan_detail WHERE id = ?";
        $barangs = DB::select($sql,[$id_penjualan_detail]);
        foreach($barangs as $b):
            $jml_barang = $b->jml_barang;
            $id_barang = $b->id_barang;
        endforeach;

        $stok = $penjualan->getStock($id_barang);
        $stok_akhir = $stok + $jml_barang;
        $affected = DB::table('barang')
          ->where('id', $id_barang)
          ->update(['stok' => $stok_akhir]);
    }
    
    
    // dapatkan jumlah barang
    public static function getJmlBarang($id_customer){
        $sql = "SELECT count(*) as jml FROM penjualan_detail 
                WHERE no_transaksi IN 
                (SELECT no_transaksi FROM penjualan 
                 WHERE id_customer = ? AND status 
                 NOT IN ('expired','hapus','siap_bayar','konfirmasi_bayar','selesai')
                )";
        $barangs = DB::select($sql,[$id_customer]);
        foreach($barangs as $b):
            $jml = $b->jml;
        endforeach;
        return $jml;
    }

    public static function getJmlInvoice($id_customer){
        $sql = "SELECT count(*) as jml FROM penjualan 
                WHERE status = 'siap_bayar' AND id_customer = ?";
        $barangs = DB::select($sql,[$id_customer]);
        foreach($barangs as $b):
            $jml = $b->jml;
        endforeach;
        return $jml;
    }
}