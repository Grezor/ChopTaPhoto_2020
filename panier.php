<?php
require_once '../Ecommerce_Bootstrap/include/_header.php';
//var_dump($_SESSION);
if (isset($_GET['del'])) {
	$panier->del($_GET['del']);
}
?>



<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
	<div class="container">
		<h2 class="title-page">Shopping cart</h2>
	</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
	<div class="container">

		<div class="row">
			<main class="col-md-9">
				<div class="card">

					<table class="table table-borderless table-shopping-cart">
						<thead class="text-muted">
							<tr class="small text-uppercase">
								<th scope="col">Produits</th>
								<th scope="col" width="120">Quantité</th>
								<th scope="col" width="120">Prix</th>
								<th scope="col" width="120">Prix TVA</th>
								<th scope="col" class="text-right" width="200"> </th>
							</tr>
						</thead>
						<tbody>
							<?php

							$ids = array_keys($_SESSION['panier']);
							if (empty($ids)) {
								$products = [];
							} else {
								$products = $DB->query('SELECT * FROM products WHERE id IN (' . implode(',', $ids) . ')');
							}
							foreach ($products as $product) :
								?>
								<tr>
									<td>


										<figure class="itemside">
											<div class="aside"><img src="images/shop/<?= $product['id']; ?>.jpg" class="img-sm"></div>
											<figcaption class="info">
												<a href="#" class="title text-dark"><?= $product['name'] ?></a>
												<p class="text-muted small">Size: XL, Color: blue, <br> Brand: Gucci</p>
											</figcaption>
										</figure>
									</td>
									<td>
										<!-- <select class="form-control">
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
										</select> -->
										<span><?= $_SESSION['panier'][$product['id']]; ?></span>
									</td>
									<td>
										<div class="price-wrap">
											<var class="price"><?= $product['price']; ?>€</var>
											<small class="text-muted"> $315.20 each </small>
										</div> <!-- price-wrap .// -->
									</td>
									<td>
										<var class="price"><?= number_format($product['price'] * 1.196, 2, ',', ' ') ?>€</var>
									</td>
									<td class="text-right">
										<a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
										<a href="panier.php?delPanier=<?= $product['id']; ?>" class="btn btn-light">Supprimer</a>
									</td>
								</tr>
							<?php endforeach; ?>

						</tbody>
					</table>

					<div class="card-body border-top">
						<a href="#" class="btn btn-primary float-md-right"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
						<a href="#" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
					</div>
				</div> <!-- card.// -->

				<div class="alert alert-success mt-3">
					<p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
				</div>

			</main> <!-- col.// -->
			<aside class="col-md-3">
				<div class="card mb-3">
					<div class="card-body">
						<form>
							<div class="form-group">
								<label>Have coupon?</label>
								<div class="input-group">
									<input type="text" class="form-control" name="" placeholder="Coupon code">
									<span class="input-group-append">
										<button class="btn btn-primary">Apply</button>
									</span>
								</div>
							</div>
						</form>
					</div> <!-- card-body.// -->
				</div> <!-- card .// -->
				<div class="card">
					<div class="card-body">
						<dl class="dlist-align">
							<dt>Total prix:</dt>
							<dd class="text-right">
								<?= number_format($panier->total(), 2, ',', ' ') ?> €</dd>
						</dl>
						<dl class="dlist-align">
							<dt>Discount:</dt>
							<dd class="text-right">USD 658</dd>
						</dl>
						<dl class="dlist-align">
							<dt>Total:</dt>
							<dd class="text-right  h5"><strong>$1,650</strong></dd>
						</dl>
						<hr>
						<p class="text-center mb-3">
							<img src="images/misc/payments.png" height="26">
						</p>

					</div> <!-- card-body.// -->
				</div> <!-- card .// -->
			</aside> <!-- col.// -->
		</div>

	</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y">
	<div class="container">
		<h6>Payment and refund policy</h6>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right">
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->



</body>

</html>