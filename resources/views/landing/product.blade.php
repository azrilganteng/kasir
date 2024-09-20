
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Single Product</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="top-nav-bar">
	<div class="search-box">
		<i class="fa fa-bars" id="menu-btn" onclick="openmenu()"></i>
		<i class="fa fa-times" id="close-btn" onclick="closemenu()"></i>
		<a href="index.html"><h5 class="logo">ECommerce Website</h5></a>
		<input type="text" class="form-control">
		<span class="input-group-text"><i class="fa fa-search"></i></span>
	</div>
	<div class="menu-bar">
		<ul>
			<li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Cart</a></li>
			<li><a href="#">Sign Up</a></li>
			<li><a href="#">Log In</a></li>
		</ul>
	</div>
</div>

<!-- Single Product -->
<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div id="product-slider" class="carousel slide carousel-fade" data-ride="carousel">
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="img/product-1.jpg" class="d-block w-100">
				    </div>
				    <div class="carousel-item">
				      <img src="img/product-2.jpg" class="d-block w-100">
				    </div>
				    <div class="carousel-item">
				      <img src="img/product-3.jpg" class="d-block w-100">
				    </div>
				    <a class="carousel-control-prev" href="#product-slider" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#product-slider" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				  </div>
				  
				</div>
			</div>

			<div class="col-md-7">
				<p class="new-arrival text-center">NEW</p>
				<h2>Men T Shirts VNock - Blue Color</h2>
				<p>Product Code : IRSC2020</p>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star-half-o"></i>
				<p class="price">USD $15.00</p>
				<p><b>Availability:</b> In Stock</p>
				<p><b>Condition:</b> New</p>
				<p><b>Brand:</b> XYZ Company</p>
				<label>Quantity: </label>
				<input type="text" value="1">
				<button type="button" class="btn btn-primary">Add to Cart</button>
			</div>

		</div>
	</div>
</section>


<!-- product descripsion -->
<section class="product-description">
	<div class="container">
		<h6>Product</h6>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit distinctio ab, perspiciatis facilis sed hic animi cupiditate, voluptatum aliquam sint pariatur necessitatibus tenetur numquam excepturi earum modi non quas placeat, repellendus, suscipit similique voluptatibus iste. Dicta vel perferendis officiis minima.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit distinctio ab, perspiciatis facilis sed hic animi cupiditate, voluptatum aliquam sint pariatur necessitatibus tenetur numquam excepturi earum modi non quas placeat, repellendus, suscipit similique voluptatibus iste. Dicta vel perferendis officiis minima.</p>
		<hr>
	</div>

<div class="container">
		<div class="title-box">
			<h2>Smiliar</h2>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="product-top">
					<img src="img/product-1.jpg" alt="">
					<div class="overlay-right">
						<button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Card"><i class="fa fa-shopping-cart"></i></button>
					</div>
				</div>
				<div class="product-botton text-center">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
						<h3>Fitness Watch</h3>
						<h5>$40.00</h5>
				</div>
			</div>

			<div class="col-md-3">
				<div class="product-top">
					<img src="img/product-2.jpg" alt="">
					<div class="overlay-right">
						<button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Card"><i class="fa fa-shopping-cart"></i></button>
					</div>
				</div>
				<div class="product-botton text-center">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
						<h3>Fitness Watch</h3>
						<h5>$40.00</h5>
				</div>
			</div>

			<div class="col-md-3">
				<div class="product-top">
					<img src="img/product-3.jpg" alt="">
					<div class="overlay-right">
						<button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Card"><i class="fa fa-shopping-cart"></i></button>
					</div>
				</div>
				<div class="product-botton text-center">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
					<i class="fa fa-star-o"></i>
						<h3>Fitness Watch</h3>
						<h5>$40.00</h5>
				</div>
			</div>

			<div class="col-md-3">
				<div class="product-top">
					<img src="img/product-4.jpg" alt="">
					<div class="overlay-right">
						<button type="button" class="btn btn-secondary" title="Quick Shop"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Wishlist"><i class="fa fa-heart-o"></i></button>
						<button type="button" class="btn btn-secondary" title="Add to Card"><i class="fa fa-shopping-cart"></i></button>
					</div>
				</div>
				<div class="product-botton text-center">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o"></i>
						<h3>Fitness Watch</h3>
						<h5>$40.00</h5>
				</div>
			</div>
			
		</div>
	</div>
</section>

<!-- Footer -->
<section class="footer">
	<div class="container text-center">
		<div class="row">
			<div class="col-md-3">
				<h1>Useful Links</h1>
				<p>Privasy Policy</p>
				<p>Terms of Use</p>
				<p>Return Policy</p>
				<p>Discount Coupons</p>
			</div>
			<div class="col-md-3">
				<h1>Company</h1>
				<p>About Us</p>
				<p>Contact Us</p>
				<p>Career</p>
				<p>Affiliate</p>
			</div>
			<div class="col-md-3">
				<h1>Follow Us On</h1>
				<p><i class="
					fa fa-facebook-official"></i> Facebook</p>
				<p><i class="fa fa-youtube-play"></i> Youtube</p>
				<p><i class="fa fa-linkedin"></i> Linkedin</p>
				<p><i class="fa fa-twitter"></i> Twitter</p>
			</div>
			<div class="col-md-3 footer-image">
				<h1>Download App</h1>
					<img src="img/aplikasi-logo.jpg" alt="">
			</div>
		</div>
		<hr>
		<p class="copyright">Mode with <i class="fa fa-heart-o"></i> by Ridho Surya</p>
	</div>
</section>


<script>
	function openmenu() {
		document.getElementById('side-menu').style.display = 'block';
		document.getElementById('menu-btn').style.display = 'none';
		document.getElementById('close-btn').style.display = 'block';
	}
	function closemenu() {
		document.getElementById('side-menu').style.display = 'none';
		document.getElementById('menu-btn').style.display = 'block';
		document.getElementById('close-btn').style.display = 'none';
	}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

</body>
</html>