<?php
  //memulai menggunakan mpdf
  // Tentukan path yang tepat ke mPDF
  //define('_MPDF_PATH','mpdf/'); // Tentukan folder dimana anda menyimpan folder mpdf
  include "mpdf60/mpdf.php"; // Arahkan ke file mpdf.php didalam folder  "mpdf60/mpdf.php"df
  $mpdf=new mPDF('utf-8', 'A5', 5, 'arial'); // Membuat file mpdf baru
  ob_start(); 
  include_once "config.php";
  $id_order   = $_GET['id_order'];

  $query = "SELECT 
          list_order.no_nota,
          customer.nama as nama_pelanggan,
          customer.email,
          customer.alamat,
          customer.no_telp,
          list_order.tgl_order,
          layanan.nama_layanan,
          list_order.berat,
          layanan.biaya_layanan,
          list_order.bayar,
          pegawai.nama as nama_petugas

          from 
          list_order
          inner join pegawai on pegawai.id_pegawai = list_order.id_pegawai
          inner join customer on customer.id_customer = list_order.id_user
          inner join layanan on layanan.id_layanan = list_order.id_layanan


          WHERE id_order = '$id_order'"; 
    $sql = mysqli_query($conn, $query); 
    $data = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $data['no_nota']; ?></title>
    <link rel="stylesheet" href="css/style.css" media="all" />
  </head>
  <body>
    <div id="header" class="clearfix">
      <div id="logo">
        <!-- <img src="logo.png"> -->
      </div>
      <h1><?php echo $data['no_nota'];?></h1>
      <div id="company" class="clearfix">
        <div>Laundry Care</div>
        <div>IT EEPIS</div>
        <div>(62) 982-2812</div>
        <div><a href="mailto:contact@laundrycare.id">mailto:contact@laundrycare.id</a></div>
      </div>
      <div id="project">
        <div><span>NAMA PELANGGAN</span> <?php echo $data['nama_pelanggan'];?></div>
        <div><span>ALAMAT</span> <?php echo $data['alamat'];?></div>
        <div><span>EMAIL</span> <a href="<?php echo $data['email'];?>"><?php echo $data['email'];?></a></div>
        <div><span>NO. TELP</span> <?php echo $data['no_telp'];?></div>
        <div><span>TANGGAL TRANSAKSI</span> <?php echo $data['tgl_order'];?></div>
      </div>
    </div>
    <div id="main">
      <table>
        <thead>
          <tr>
            
            <th class="desc">NAMA LAYANAN</th>
            <th>HARGA</th>
            <th>BERAT</th>
            <th>TOTAL HARGA</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc"><?php echo $data['nama_layanan'];?></td>
            <td class="unit"><?php echo number_format($data['biaya_layanan']);?></td>
            <td class="qty"><?php echo $data['berat'];?></td>
            <td class="total"><?php echo number_format($data['berat']*$data['biaya_layanan']);?></td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="total"></td>
          </tr>
          <tr>
            <td colspan="3">Bayar</td>
            <td class="total"><?php echo number_format($data['bayar']);?></td>
          </tr>
          <tr>
            <td colspan="3" class="grand total">Kembali</td>
            <td class="grand total"><?php echo number_format($data['bayar']-($data['berat']*$data['biaya_layanan']));?></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>Keterangan</div>
        <div class="notice">Bilamana ada kehilangan atau barang rusak, silakan menghubungi kami melalui email maksimal 1x24 setelah barang diterima</div>
      </div>
    </div>
  </body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output(".pdf" ,'I');
exit;
?>