<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 20/06/2018
	 * Time: 20:58
	 */


	?>

@extends('extends.base')

@section('title', 'Home')

@section('page-id', 'home')

@section('content')


		<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BabyDunk Web Development</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/css/app.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<header id="header">
	<nav id="nav-bar">
		<div id="nav">
			<div class="logo">
				<a href="/responsivewebdesign/BuildAProductLandingPage/" ><img src="{{ASSETS_IMAGES_PATH_URL}}cylinder-code-2-logo300x250.png" id="header-img"></a>
			</div>
			<div class="home">
				<a class="nav-link" href="#triCard">Get Started</a>
			</div>
			<div class="sales">
				<a class="nav-link" href="#sales-div">Sales</a>
			</div>
			<div class="contact">
				<a class="nav-link" href="#contact-div">Contact</a>
			</div>
		</div>
	</nav>
	<nav id="nav-bar-small">
		<div id="nav-bar-navi">
			<span id="nav-show-menu" class="fas fa-bars"></span>
			<div class="logo">
				<a href="/responsivewebdesign/BuildAProductLandingPage/"><img src="{{ASSETS_IMAGES_PATH_URL}}cylinder-code-2-logo300x250.png" class="header-img"></a>
			</div>
			<div id="nav-small">
				<div class="home"><a class="nav-link" href="#triCard">Get Started</a></div>
				<div class="sales"><a class="nav-link" href="#sales-div">Sales</a></div>
				<div class="contact"><a class="nav-link" href="#contact-div">Contact</a></div>
			</div>
		</div>
	</nav>
	<video autoplay loop poster="{{ASSETS_IMAGES_PATH_URL}}laptop1625.JPG" id="video">
		<source src="{{ASSETS_IMAGES_PATH_URL}}aptop1625.mp4" type="video/mp4">
		Your browser does not support the video tag.
	</video>

	<div id="business">
		<div id="inner-bus">
			<h1 id="title">BabyDunk Web Development</h1>
			<form action="https://freecodecamp.com/email-submit" id="form">
				<label for="email">Get Important Info About Our Products</label>
				<input type="email" required name="email" id="email" placeholder="Enter Your Email Address">
				<input type="submit" id="submit" value="Submit!">
			</form>
		</div>

	</div>

	<div class="attention">
		<p id="description">Specialist programmer,  coding in a variety of different languages from Javascript, PHP, SASS, CCS3, HTML5</p>
	</div>
</header>
<main>
	<div class="container">
		<div id="triCard">
			<div class="card">
				<div class="cardTitle">
					<h3>High Quality Readable Code</h3>
				</div>
				<div class="cardImg">
					<i class="fas fa-5x fa-chart-line"></i>
				</div>
				<div class="cardDes">
					<p>All code is finished to a high standard and commented for easy navigation.</p>
				</div>
			</div>
			<div class="card">
				<div class="cardTitle">
					<h3>Value For Money</h3>
				</div>
				<div class="cardImg">
					<i class="fas fa-5x fa-piggy-bank"></i>
				</div>
				<div class="cardDes">
					<p>With our competitive rates, you would be a fool to miss out.</p>
				</div>
			</div>
			<div class="card">
				<div class="cardTitle">
					<h3>Top Class Support</h3>
				</div>
				<div class="cardImg">
					<i class="fas fa-5x fa-life-ring"></i>
				</div>
				<div class="cardDes">
					<P>We will always be around to support with our superb aftercare</P>
				</div>
			</div>
		</div><!-- End of tri box div -->

		<div id="cubed">
			<div class="cubedImg">
				<img src="{{ASSETS_IMAGES_PATH_URL}}beverage-3157395_1280.jpg" alt="Turn your dream into a reality" title="Turn your dream into a reality">
				<span class="cubedText">Dreams</span>
			</div>
			<div class="cubedImg">
				<img src="{{ASSETS_IMAGES_PATH_URL}}men-1979261_1280.jpg" alt="We'll put everything we have into bring your dream to life" title="We'll put everything we have into bring your dream to life">
				<span class="cubedText">Everything</span>
			</div>
			<div class="cubedImg">
				<img src="{{ASSETS_IMAGES_PATH_URL}}work-731198_1280.jpg" alt="Professional and Dedicated" title="Professional and Dedicated">
				<span class="cubedText">Dedicated</span>
			</div>
			<div class="cubedImg">
				<img src="{{ASSETS_IMAGES_PATH_URL}}digital-marketing-1433427_1280.jpg" alt="Increase your revenue of any kind" title="Increase your revenue of any kind">
				<span class="cubedText">Increased</span>
			</div>
		</div><!-- End of image cube -->

		<div id="sales-div">
			<div id="cubeFlip">
				<div class="cardArea">
					<div class="card">
						<div class="cardface cardface--front card1">
							<div class="slantTitle">
								<span class="clickIt">Click For More Info</span>
							</div>
							<div class="slantBody">
								<h3>Managed</h3>

								<ul>
									<li>Peace of Mind</li>
									<li>Safe &amp; Secure</li>
									<li>Professional</li>
									<li>Monthly Fees</li>
								</ul>
							</div>


							<div class="tallSlant"></div>

						</div>
						<div class="cardface cardface--back">
							<div class="cardflip-back">
								<h3>Fully Managed</h3>
								<p>Let us take care of all the workings of the website from building your site from the ground up, to SEO, To server and distribution</p>

								<ol>
									<li>Worry Free</li>
									<li>Constantly Monitored</li>
									<li>Safe &amp; Secure</li>
									<li>SEO - Seen in all the Search engines</li>
									<li>24/7 Support</li>
								</ol>

								<div class=" cardPrice">
									<p>Starting at <span>£30</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cardArea">
					<div class="card">
						<div class="cardface cardface--front card2">
							<div class="slantTitle">
								<span class="clickIt">Click For More Info</span>
							</div>
							<div class="slantBody">
								<h3>Standalone</h3>
								<ul>
									<li>Peace of Mind</li>
									<li>Safe &amp; Secure</li>
									<li>Professional</li>
									<li>One-off Payment</li>
								</ul>
							</div>
							<div class="tallSlant"></div>
						</div>
						<div class="cardface cardface--back">
							<div class="cardflip-back">
								<h3>Standalone </h3>
								<p>Let us build and design your dream website and have the freedom to host with your favourite hosting platform, also have the freedom to modify  when you see fit.</p>

								<ol>
									<li>Freedom To Edit</li>
									<li>One-off Payment</li>
									<li>Safe &amp; Secure</li>
									<li>Full control</li>
									<li>Easy Code Navigation</li>
								</ol>

								<div class="cardPrice">
									<p>Starting at <span>£200</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cardArea">
					<div class="card">
						<div class="cardface cardface--front card3">
							<div class="slantTitle">
								<span class="clickIt">Click For More Info</span>
							</div>
							<div class="slantBody">
								<h3>Expand</h3>

								<ul>
									<li>Peace of Mind</li>
									<li>Safe &amp; Secure</li>
									<li>Professional</li>
									<li>Monthly Fees</li>
								</ul>
							</div>
							<div class="tallSlant"></div>
						</div>
						<div class="cardface cardface--back">
							<div class="cardflip-back">
								<h3>Expand Your Current Code</h3>
								<p>We can expand your current code in an efficient and secure way, no down time and fully tailored to your needs</p>

								<ol>
									<li>Tailored To Your Wishes</li>
									<li>Pay-off Payment</li>
									<li>Safe &amp; Secure</li>
									<li>Full Control</li>
									<li>Easy Code Navigation</li>
								</ol>

								<div class="cardPrice">
									<p>Starting at <span>POA</span></p>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div><!-- End of sales div -->

		<div id="contact-div">
			<div id="conWindow">
				<div class="controlend">
					<h2>Contact Us!</h2>

					<ul>
						<li><a href="#" id="conPhone" data-navid="conPhone"><i class="fa fa-phone"></i> Telephone</a></li>
						<li><a href="#" id="conEmail" data-navid="conEmail"><i class="fa fa-envelope-open-text "></i> Email</a></li>
						<li><a href="#" id="conChat" data-navid="conChat"><i class="fa fa-comments"></i> Chat</a></li>
						<li><a href="#" id="conFAQ" data-navid="conFAQ"><i class="fa fa-question-circle "></i> FAQ</a></li>
					</ul>
					<small>* We do not share any info provided to third parties</small>
				</div>
				<div class="businessend">
					<div class="conPanel conHome"><h3>Contact Options</h3>
						<p>We have a number of ways to for you to make contact.</p>
						<p>you can also check our FAQ to see if you have a common question that's already been answered</p>
						<p>Select your preference from the side panel</p>
					</div>
					<div class="conPanel conPhone">
						<h3>Phone Us!</h3>
						<p>Our phone service is only available while someone is in the office</p>
						<p>Our number is <a href="tel:02855555555" >02855555555</a>,  if you can't reach the office please leave a message or try a different contact option</p>
					</div>
					<div class="conPanel conEmail">
						<h3>Email Us!</h3>
						<form method="POST" action="" enctype="">
							<div class="form-content">
								<label for="cName"><i class="fa fa-user"></i> What's your name?</label>
								<input type="text" name="cName" id="cName" value="" placeholder="Enter a contact name" />
							</div>
							<div class="form-content">
								<label for="cEmail"><i class="fa fa-envelope"></i> What's your email address?</label>
								<input type="email" name="cEmail" id="cEmail" value="" placeholder="Enter a contact email" />
							</div>
							<div class="form-content">
								<label for="cNumber"><i class="fa fa-phone"></i> What's your phone number?</label>
								<input type="number" name="cNumber" id="cNumber" value="" placeholder="Enter a contact phone number" />
							</div>
							<div class="form-content">
								<label for="cMessage"><i class="fa fa-comment"></i> Enter your query here</label>
								<textarea name="cMessage" id="cMessage" placeholder="Write in as much detail what we can help you with!"></textarea>
							</div>
							<div class="form-content">
								<div></div>
								<button type="submit" name="submit" id="cSubmit" value="Submit!"><i class="fa fa-paper-plane"></i> Submit!</button>
							</div>
						</form>

					</div>
					<div class="conPanel conChat">
						<h3>Chat With Us!</h3>
						<p>Let us take care of all the workings of the website from building your site from the ground up, to SEO, To server and distribution</p>

						<ol>
							<li>Worry Free</li>
							<li>Constantly Monitored</li>
							<li>Safe &amp; Secure</li>
							<li>SEO - Seen in all the Search engines</li>
						</ol>
					</div>
					<div class="conPanel conFAQ">
						<h3>FAQ</h3>
						<p>Commonly asked questions that might save you some time.</p>

						<div class="qBorder">
							<div class="faqQ"><span>Q. </span>What you build me a custom website with SEO in mind?</div>
							<div class="faqA"><span>A. </span>Yes all websites we build have SEO in mind. we aim to your you page on the front page</div>
						</div>
						<div class="qBorder">
							<div class="faqQ"><span>Q. </span>What you build me a custom website with SEO in mind</div>
							<div class="faqA"><span>A. </span>Yes all websites we build have SEO in mind. we aim to your you page on the front page</div>
						</div>
						<div class="qBorder">
							<div class="faqQ"><span>Q. </span>What you build me a custom website with SEO in mind</div>
							<div class="faqA"><span>A. </span>Yes all websites we build have SEO in mind. we aim to your you page on the front page</div>
						</div>
						<div class="qBorder">
							<div class="faqQ"><span>Q. </span>What you build me a custom website with SEO in mind</div>
							<div class="faqA"><span>A. </span>Yes all websites we build have SEO in mind. we aim to your you page on the front page</div>
						</div>
					</div>
				</div>
			</div>

		</div> <!-- End of contact div -->

	</div><!-- End of container div -->
</main>
<script src="assets/script/app.js"></script>
</body>
</html>


    <!-- /.row -->

@endsection
