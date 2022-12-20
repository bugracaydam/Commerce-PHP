<?php include 'header.php' ?>

<div class="container">

	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
		</div>
	</div>
	<div class="title-bg">
		<div class="title">Alışveriş Sepetim</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>Remove</th>
					<th>Ürün Resim</th>
					<th>Ürün ad</th>
					<th>Ürün Kodu</th>
					<th>Adet</th>
					<th>Toplam Fiyat</th>
				</tr>
			</thead>
			<tbody>


				<?php 
				$kullanici_id=$kullanicicek['kullanici_id'];
				$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
				$sepetsor->execute(array(
					'id' => $kullanici_id
					));

				while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

					$urun_id=$sepetcek['urun_id'];
					$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
					$urunsor->execute(array(
						'urun_id' => $urun_id
						));

					$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

					//echo $topla=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
					?>
					
				<?php

				if ($_GET['sepetsil']=="ok") {
					$sil=$db->prepare("DELETE from sepet where sepet_id=:sepet_id");
					$kontrol=$sil->execute(array(
					'sepet_id' => $_GET['sepet_id']
				));

				if ($kontrol) {

		
					Header("Location:../eticarets/sepet.php?durum=ok");

				} else {

					Header("Location:../eticarets/sepet.php?durum=no");
					}

				}?>

					<tr>
						<td><center><a href="../eticarets/sepet.php?sepet_id=<?php echo $sepetcek['sepet_id']; ?>&sepetsil=ok"><button type="submit" name="sepetsil" class="btn btn-default btn-red btn-sm">Sil</button></a></center></td>


						<?php
								$urun_id=$uruncek["urun_id"];
								$urunfoto=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id");
								$urunfoto->execute(array(
									'urun_id' => $urun_id
								));

								$urunfotoce=$urunfoto->fetch(PDO::FETCH_ASSOC);

								 ?>
						<td><img src="<?php echo $urunfotoce['urunfoto_resimyol'] ?>" width="100" alt=""></td>
						<td><?php echo $uruncek['urun_ad'] ?></td>
						<td><?php echo $uruncek['urun_id'] ?></td>
						<td><form><input type="text" class="form-control quantity" value="<?php echo $sepetcek['urun_adet'] ?>"></form></td>
						<td><?php echo $uruncek['urun_fiyat'] ?></td>
					</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6">


			</div>
			<div class="col-md-3 col-md-offset-3">
				<div class="subtotal-wrap">
					<!--<div class="subtotal">
						<<p>Toplam Fiyat : $26.00</p>
						<p>Vat 17% : $54.00</p>
					</div>-->
					<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo $toplam_fiyat ?> TL</span></div>
					<div class="clearfix"></div>
					<a href="odeme" class="btn btn-default btn-yellow">Ödeme Sayfası</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>

	<?php include 'footer.php' ?>