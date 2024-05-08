<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>
<!-- footer-top-start -->
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-top-menu bb-2">
                    <nav>
                        <ul>
                            <li><a href="index.php">หน้าแรก</a></li>
                            <li><a href="contactus.php">ติดต่อผู้ดูแล</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer-top-start -->
<!-- footer-mid-start -->
<!-- <div class="footer-mid ptb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-footer br-2 xs-mb">
                            <div class="footer-title mb-20">
                                <h3>Products</h3>
                            </div>
                            <div class="footer-mid-menu">
                                <ul>
                                    <li><a href="about.html">About us</a></li>
                                    <li><a href="#">Prices drop </a></li>
                                    <li><a href="#">New products</a></li>
                                    <li><a href="#">Best sales</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-footer br-2 xs-mb">
                            <div class="footer-title mb-20">
                                <h3>Our company</h3>
                            </div>
                            <div class="footer-mid-menu">
                                <ul>
                                    <li><a href="contact.html">Contact us</a></li>
                                    <li><a href="#">Sitemap</a></li>
                                    <li><a href="#">Stores</a></li>
                                    <li><a href="register.html">My account </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-footer br-2 xs-mb">
                            <div class="footer-title mb-20">
                                <h3>Your account</h3>
                            </div>
                            <div class="footer-mid-menu">
                                <ul>
                                    <li><a href="contact.html">Addresses</a></li>
                                    <li><a href="#">Credit slips </a></li>
                                    <li><a href="#"> Orders</a></li>
                                    <li><a href="#">Personal info</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="single-footer mrg-sm">
                    <div class="footer-title mb-20">
                        <h3>STORE INFORMATION</h3>
                    </div>
                    <div class="footer-contact">
                        <p class="adress">
                            <span>My Company</span>
                            Your address goes here.
                        </p>
                        <p><span>Call us now:</span> 0123456789</p>
                        <p><span>Email:</span> demo@example.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- footer-mid-end -->
<!-- footer-bottom-start -->
<div class="footer-bottom">
    <div class="container">
        <div class="row bt-2">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="copy-right-area">
                    <p>&copy; 2022 <strong> Koparion </strong> Mede by <a href="https://hasthemes.com/" target="_blank"><strong>HasThemes</strong></a></p>
                </div>
            </div>
            <!-- <div class="col-lg-6 col-md-6 col-12">
                <div class="payment-img text-end">
                    <a href="#"><img src="img/1.png" alt="payment" /></a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- footer-bottom-end -->