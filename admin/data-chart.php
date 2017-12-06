<?php
	include 'config.php';

	$sql = "select
			month(list_order.tgl_order) as bulan,
			sum(list_order.berat*layanan.biaya_layanan) as total_transaksi


			from
			list_order 
			inner join pegawai on pegawai.id_pegawai = list_order.id_pegawai
			inner join layanan on layanan.id_layanan = list_order.id_layanan

			where status like 'selesai' and year(tgl_order) = year(curdate())

			group by month(list_order.tgl_order)";
	
	$query = mysqli_query($conn,$sql);
	$rows = array();
	//$rows['name'] = 'Total Transaksi';
	$rows['name'][] = 'Total<br>Transaksi (Rp)';
	while($data= mysqli_fetch_array($query)) {
		$rows['data'][] = $data['total_transaksi'];
	}


	$result = array();
	array_push($result,$rows);
	print json_encode($result, JSON_NUMERIC_CHECK);

?> 
