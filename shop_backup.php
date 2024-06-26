<?php
require_once('connection.php');

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
	$status = $_SESSION['status'];
	$status_code = $_SESSION['status_code'];

	// เคลียร์ค่า session
	unset($_SESSION['status']);
	unset($_SESSION['status_code']);

	$current_url = $_SERVER['REQUEST_URI'];

	// แสดงหน้าต่างข้อความแจ้งเตือน
	echo "<script>alert('$status');</script>";
	echo "<script>window.location.href = '$current_url';</script>";
	exit();
}
if (isset($_GET['prd_serch'])) {
	$searchTerm = mysqli_real_escape_string($proj_connect, $_GET['prd_serch']);
	$product_query = "SELECT * FROM bk_prd_product WHERE prd_name LIKE '%$searchTerm%'
	AND prd_show = 1 AND prd_qty > 0
	ORDER BY prd_id ;
	";
} else {
	$product_query = "SELECT * FROM bk_prd_product
					WHERE prd_show = 1 AND prd_qty > 0
					ORDER BY prd_id ;
					";
}
$product_result = mysqli_query($proj_connect, $product_query) or die(mysqli_connect_error());


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
	<?php
	require_once('head.php');
	?>
	<script>
		// เมื่อโหลดหน้าเสร็จสิ้น
		window.addEventListener('load', function() {
			// ตรวจสอบว่ามี query parameters ใน URL หรือไม่
			if (window.location.search.length > 0) {
				// พบ query parameters ใน URL
				// รีดิเร็ก URL โดยไม่รวม query parameters
				window.history.replaceState({}, document.title, window.location.pathname);
			}
		});
	</script>
</head>

<body class="shop">
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<!-- Add your site or application content here -->
	<!-- header-area-start -->
	<header>
		<?php
		require_once('header.php');
		?>
	</header>
	<!-- header-area-end -->
	<?php
	$sql_script = "SELECT * FROM bk_set_banner WHERE bnn_show = 1
                                    ORDER BY CASE WHEN bnn_order = 0 THEN 1 ELSE 0 END, bnn_order;
                                    ";
	$bnn_result = mysqli_query($proj_connect, $sql_script) or die(mysqli_connect_error());

	if (mysqli_num_rows($bnn_result) > 0) { // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
	?>
		<!-- slider-area-start -->
		<div class="slider-area mt-30">
			<div class="container">
				<div class="slider-active owl-carousel">
					<?php
					while ($bnn_row_result = mysqli_fetch_assoc($bnn_result)) { // วนลูปแสดงข้อมูลที่ได้จากการ query
					?>
						<a href="<?= $bnn_row_result['bnn_link'] ?>">
							<div class="single-slider slider-hm4-1 pt-154 pb-154 bg-img" style="height: 500px; widht: 100%; background-image:url(bnn_image/<?= $bnn_row_result['bnn_image'] ?>);">
								<div class="row">
									<div class="col-md-12">
										<div class="slider-content-3 slider-animated-1 pl-100">
										</div>
									</div>
								</div>
							</div>
						</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<!-- slider-area-end -->
	<?php
	}
	?>
	<!-- breadcrumbs-area-start -->
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="index.php">หน้าแรก</a></li>
							<li><a href="#" class="active">หนังสือทั้งหมด</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- breadcrumbs-area-end -->
	<!-- shop-main-area-start -->
	<div class="shop-main-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-12 col-12 order-lg-1 order-2 mt-sm-50 mt-xs-40">
					<div class="shop-left">
						<?php
						// คำสั่ง SQL เพื่อดึงข้อมูลสำนักพิมพ์และจำนวนสินค้าที่เชื่อมโยง
						$publisherQuery = "SELECT 
						bk_prd_publisher.publ_id, 
						bk_prd_publisher.publ_name, 
						COUNT(bk_prd_product.prd_id) AS product_count
					FROM 
						bk_prd_publisher
					LEFT JOIN 
						bk_prd_product ON bk_prd_publisher.publ_id = bk_prd_product.publ_id
					INNER JOIN 
						bk_prd_type ON bk_prd_product.pty_id = bk_prd_type.pty_id
					WHERE 
						bk_prd_product.prd_show = 1 AND bk_prd_type.pty_show = 1
					GROUP BY 
						bk_prd_publisher.publ_id, bk_prd_publisher.publ_name
					";

						// ทำการ execute SQL query
						$publisherResult = mysqli_query($proj_connect, $publisherQuery) or die(mysqli_error($proj_connect));

						if (mysqli_num_rows($publisherResult) > 0) {
						?>
							<div class="left-title mb-20">
								<h4>สำนักพิพม์</h4>
							</div>
							<div class="left-menu mb-30">
								<ul>
									<?php
									while ($row = mysqli_fetch_assoc($publisherResult)) {
										$publisherName = $row['publ_name'];
										$productCount = $row['product_count'];

										if ($productCount > 0) {
									?>
											<li><a href="shop.php?prd_filter=<?= urlencode("SELECT *
FROM bk_prd_product
WHERE prd_show = 1
AND prd_qty > 0
AND pty_id IN (SELECT pty_id FROM bk_prd_type WHERE pty_show = 1)
AND publ_id = " . $row['publ_id'] . "
ORDER BY prd_id
") ?>"><?php echo $publisherName; ?><span>(<?php echo $productCount; ?>)</span></a></li>
									<?php
										}
									}
									?>
								</ul>
							</div>
						<?php
						}
						?>


						<?php
						$promotionQuery = "SELECT bk_promotion.prp_id, bk_promotion.prp_name, COUNT(bk_prd_promotion.ppm_id) AS product_count
FROM bk_promotion
LEFT JOIN bk_prd_promotion ON bk_promotion.prp_id = bk_prd_promotion.prp_id
GROUP BY bk_promotion.prp_id, bk_promotion.prp_name;
";

						// ทำการ execute SQL query
						$promotionResult = mysqli_query($proj_connect, $promotionQuery) or die(mysqli_error($proj_connect));

						if (mysqli_num_rows($promotionResult) > 0) {
						?>
							<div class="left-title mb-20">
								<h4>โปรโมชัน</h4>
							</div>
							<div class="left-menu mb-30">
								<ul>
									<?php
									while ($row = mysqli_fetch_assoc($promotionResult)) {
										$promotionId = $row['prp_id'];
										$promotionName = $row['prp_name'];
										$productCount = $row['product_count'];

										// เพิ่มเงื่อนไขเพื่อตรวจสอบ product_count
										if ($productCount > 0) {
									?>
											<li><a href="shop.php?prd_filter=<?= urlencode("SELECT * FROM bk_prd_product op INNER JOIN bk_prd_promotion pp ON op.prd_id = pp.prd_id WHERE pp.prp_id = '$promotionId';") ?>"><?php echo $promotionName; ?><span>(<?php echo $productCount; ?>)</span></a></li>
									<?php
										}
									}
									?>
								</ul>
							</div>
						<?php
						}
						?>

						<?php
						$typeQuery = "SELECT t.pty_id, t.pty_name, COUNT(p.prd_id) AS product_count
						FROM bk_prd_type t
						LEFT JOIN bk_prd_product p ON t.pty_id = p.pty_id AND p.prd_show = 1
						WHERE t.pty_show = 1
						GROUP BY t.pty_id, t.pty_name
						ORDER BY t.pty_id;
						";
						$typeResult = mysqli_query($proj_connect, $typeQuery) or die(mysqli_error($proj_connect));

						if (mysqli_num_rows($typeResult) > 0) {
						?>
							<div class="left-title mb-20">
								<h4>ประเภท</h4>
							</div>
							<div class="left-menu mb-30">
								<ul>
									<?php
									while ($row = mysqli_fetch_assoc($typeResult)) {
										$typeId = $row['pty_id'];
										$typeName = $row['pty_name'];
										$productCount = $row['product_count'];
										if ($productCount > 0) {
									?>
											<li><a href="shop.php?prd_filter=<?= urlencode("SELECT * FROM bk_prd_product WHERE prd_show = 1 AND prd_qty > 0 AND pty_id = " . $typeId . " ORDER BY prd_id") ?>"><?php echo $typeName; ?><span>(<?php echo $productCount; ?>)</span></a></li>
									<?php
										}
									}
									?>
								</ul>
							</div>
						<?php
						}
						?>


					</div>
				</div>

				<div class="col-lg-9 col-md-12 col-12 order-lg-2 order-1">

					<div class="section-title-5 mb-30">
						<h2>หนังสือทั้งหมด</h2>
					</div>
					<div class="toolbar mb-30">
					</div>
					<!-- tab-area-start -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="th">
							<div class="row">
								<?php
								if (isset($_GET['prd_filter'])) {
									$product_query = $_GET['prd_filter'];
								} else {
									$product_query = "SELECT p.*
									FROM bk_prd_product p
									JOIN bk_prd_type t ON p.pty_id = t.pty_id
									WHERE p.prd_show = 1 
										AND p.prd_qty > 0 
										AND t.pty_show = 1
									ORDER BY p.prd_id;
									";
								}
								$product_result = mysqli_query($proj_connect, $product_query) or die(mysqli_connect_error());
								if (mysqli_num_rows($product_result) > 0) {
									while ($product_row = mysqli_fetch_assoc($product_result)) {
								?>
										<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
											<!-- single-product-start -->
											<div class="product-wrapper mb-40">
												<div class="product-img">
													<a href="product-details.php?prd_id=<?php echo base64_encode($product_row['prd_id']); ?>">
														<img src="prd_img/<?php echo $product_row['prd_img']; ?>" alt="book" class="primary" />
													</a>
													<!-- ตรวจสอบโปรโมชั่น -->
													<?php
													$product_promotion_query = "SELECT bk_promotion.* 
												FROM bk_promotion
												JOIN bk_prd_promotion ON bk_promotion.prp_id = bk_prd_promotion.prp_id
												WHERE bk_prd_promotion.prd_id = " . $product_row['prd_id'];
													$product_promotion_result = mysqli_query($proj_connect, $product_promotion_query) or die(mysqli_connect_error());
													//$product_promotion_row = mysqli_fetch_assoc($product_promotion_result);

													$discount_percentage = 0;
													if ($product_promotion_result) {
														while ($promotion_row = mysqli_fetch_assoc($product_promotion_result)) {
															$discount_percentage += $promotion_row['prp_discount'];
														}

														mysqli_free_result($product_promotion_result);
													}
													?>
													<div class="product-flag">
														<ul>
															<?php if ($discount_percentage > 0) { ?>
																<li><span class="discount-percentage"><?php echo '-' . round($discount_percentage, 0) . '%'; ?></span></li>
															<?php } ?>
														</ul>
													</div>
												</div>
												<?php
												$cmm_query = "SELECT * FROM bk_prd_comment WHERE cmm_show = 1 AND prd_id =" . $product_row['prd_id'];
												$cmm_result = mysqli_query($proj_connect, $cmm_query) or die(mysqli_connect_error());

												$total_ratings = 0;
												$total_reviews = 0;

												while ($cmm_row = mysqli_fetch_assoc($cmm_result)) {
													// นับ rating ทั้งหมด
													$total_ratings += $cmm_row['cmm_rating'];

													// นับจำนวนรีวิว
													$total_reviews++;
												}

												// คำนวณ rating เฉลี่ย
												$average_rating = ($total_reviews > 0) ? round($total_ratings / $total_reviews, 1) : 0;
												?>
												<div class="product-details text-center">
													<div class="product-rating">
														<ul>
															<?php
															// ถ้าไม่มี rating ให้แสดง <li><a><i class="fa fa-star text-warning"></i></a></li> ทั้งหมด
															if ($total_reviews === 0) {
																for ($i = 1; $i <= 5; $i++) {
																	echo '<li><a><i class="fa fa-star text-warning"></i></a></li>';
																}
															} else {
																// แสดง cmm_rating เฉลี่ย
																for ($i = 1; $i <= 5; $i++) {
																	if ($i <= $average_rating) {
																		echo '<li><a><i class="fa fa-star text-warning"></i></a></li>';
																	} else {
																		echo '<li><a><i class="fa fa-star"></i></a></li>';
																	}
																}
															}
															?>
														</ul>
													</div>
													<h4><a><?php echo $product_row['prd_name']; ?></a></h4>
													<div class="product-price">
														<ul>
															<?php if ($discount_percentage > 0) { ?>
																<li>฿<?php echo number_format(($product_row['prd_price'] - ($discount_percentage % $product_row['prd_price'])), 2); ?></li>
																<li class="old-price">฿<?php echo $product_row['prd_price']; ?></li>
															<?php } else { ?>
																<li>฿<?php echo number_format($product_row['prd_price'], 2); ?></li>
															<?php } ?>
														</ul>
													</div>
												</div>
												<div class="product-link">
													<div class="product-button">
														<a href="product-details.php?prd_id=<?php echo base64_encode($product_row['prd_id']); ?>" title="Add to cart"><i class="fa fa-shopping-cart"></i>รายละเอียด</a>
													</div>
													<div class="add-to-link">
														<ul>
															<li><a href="product-details.php?prd_id=<?php echo base64_encode($product_row['prd_id']); ?>" title="Details"><i class="fa fa-external-link"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<!-- single-product-end -->
										</div>
								<?php
									}
								} else {
									// ถ้าไม่มีข้อมูลแสดงข้อความนี้
									echo '<p>ไม่พบข้อมูลสินค้าที่ตรงที่ค้นหา</p>';
								}
								?>

							</div>
						</div>
						<div class="tab-pane fade" id="list">
							<!-- single-shop-start -->
							<div class="single-shop mb-30">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-12">
										<div class="product-wrapper-2">
											<div class="product-img">
												<a href="#">
													<img src="img/product/3.jpg" alt="book" class="primary" />
												</a>
											</div>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-12">
										<div class="product-wrapper-content">
											<div class="product-details">
												<div class="product-rating">
													<ul>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
													</ul>
												</div>
												<h4><a href="#">Crown Summit</a></h4>
												<div class="product-price">
													<ul>
														<li>$36.00</li>
														<li class="old-price">$38.00</li>
													</ul>
												</div>
												<p>The sporty Joust Duffle Bag can't be beat - not in the gym, not on the luggage carousel, not anywhere. Big enough to haul a basketball or soccer ball and some sneakers with plenty of room to spare,... </p>
											</div>
											<div class="product-link">
												<div class="product-button">
													<a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												<div class="add-to-link">
													<ul>
														<li><a href="product-details.html" title="Details"><i class="fa fa-external-link"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- tab-area-end -->
					<!-- pagination-area-start -->
					<div class="pagination-area mt-50">
						<!-- <div class="list-page-2">
							<p>Items 1-9 of 11</p>
						</div>
						<div class="page-number">
							<ul>
								<li><a href="#" class="active">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#" class="angle"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div> -->
					</div>
					<!-- pagination-area-end -->
				</div>
			</div>
		</div>
	</div>
	<!-- shop-main-area-end -->
	<!-- footer-area-start -->
	<footer>
		<?php
		require_once('footer.php');
		?>
	</footer>
	<!-- footer-area-end -->
	<!-- Modal -->
	<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-5 col-sm-5 col-xs-12">
							<div class="modal-tab">
								<div class="product-details-large tab-content">
									<div class="tab-pane active" id="image-1">
										<img src="img/product/quickview-l4.jpg" alt="" />
									</div>
									<div class="tab-pane" id="image-2">
										<img src="img/product/quickview-l2.jpg" alt="" />
									</div>
									<div class="tab-pane" id="image-3">
										<img src="img/product/quickview-l3.jpg" alt="" />
									</div>
									<div class="tab-pane" id="image-4">
										<img src="img/product/quickview-l5.jpg" alt="" />
									</div>
								</div>
								<div class="product-details-small quickview-active owl-carousel">
									<a class="active" href="#image-1"><img src="img/product/quickview-s4.jpg" alt="" /></a>
									<a href="#image-2"><img src="img/product/quickview-s2.jpg" alt="" /></a>
									<a href="#image-3"><img src="img/product/quickview-s3.jpg" alt="" /></a>
									<a href="#image-4"><img src="img/product/quickview-s5.jpg" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-12">
							<div class="modal-pro-content">
								<h3>Chaz Kangeroo Hoodie3</h3>
								<div class="price">
									<span>$70.00</span>
								</div>
								<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet.</p>
								<div class="quick-view-select">
									<div class="select-option-part">
										<label>Size*</label>
										<select class="select">
											<option value="">S</option>
											<option value="">M</option>
											<option value="">L</option>
										</select>
									</div>
									<div class="quickview-color-wrap">
										<label>Color*</label>
										<div class="quickview-color">
											<ul>
												<li class="blue">b</li>
												<li class="red">r</li>
												<li class="pink">p</li>
											</ul>
										</div>
									</div>
								</div>
								<form action="#">
									<input type="number" value="1" />
									<button>Add to cart</button>
								</form>
								<span><i class="fa fa-check"></i> In stock</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal end -->






	<!-- all js here -->
	<!-- jquery latest version -->
	<script src="js/vendor/jquery-1.12.4.min.js"></script>


	<!-- bootstrap js -->
	<script src="js/bootstrap.min.js"></script>
	<!-- owl.carousel js -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- meanmenu js -->
	<script src="js/jquery.meanmenu.js"></script>
	<!-- wow js -->
	<script src="js/wow.min.js"></script>
	<!-- jquery.parallax-1.1.3.js -->
	<script src="js/jquery.parallax-1.1.3.js"></script>
	<!-- jquery.countdown.min.js -->
	<script src="js/jquery.countdown.min.js"></script>
	<!-- jquery.flexslider.js -->
	<script src="js/jquery.flexslider.js"></script>
	<!-- chosen.jquery.min.js -->
	<script src="js/chosen.jquery.min.js"></script>
	<!-- jquery.counterup.min.js -->
	<script src="js/jquery.counterup.min.js"></script>
	<!-- waypoints.min.js -->
	<script src="js/waypoints.min.js"></script>
	<!-- plugins js -->
	<script src="js/plugins.js"></script>
	<!-- main js -->
	<script src="js/main.js"></script>
</body>

</html>