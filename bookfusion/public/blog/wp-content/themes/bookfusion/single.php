<?php get_header() ?>
<!-- BEGIN MAIN CONTENT -->
<main class="main-content">

		<!-- Blog List -->
		<div class="tc-padding">
			<div class="container">
				<div class="row">

					<!-- Content -->
					<div class="col-lg-9 col-md-8">
						<!-- blog Detail -->
						<div class="single-blog-detail">
							<h2><?php the_title(); ?></h2>
							<div class="large-blog-img">
								<img src="assets/images/large-blog/img-01.jpg" alt="">
							</div>
							<div class="social-text">
								<ul class="social-icons">
				                	<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
				                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
				                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
				                </ul>
								<p><?php the_content(); ?></p>
								<p><?php the_content(); ?></p>
								<p><?php the_content(); ?></p>
							</div>
							<!-- BEGIN AUTHOR HERE -->
							<div class="blog-arthor">
								<img class="position-center-x" src="assets/images/blog-arthor/img-01.jpg" alt="">
								<div class="blog-arthor-detail">
									<h6><?php the_title(); ?></h6>
									<p><?php the_content(); ?></p>
									<ul class="social-icons">
					                	<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
					                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
					                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
					                </ul>
				                </div>
							</div>
							<!-- END AUTHRO HERE -->

						</div>
						<!-- blog Detail -->

						<!-- Related Blog -->
						<div class="related-events">

							<!-- Secondary heading -->
			        		<div class="sec-heading">
			        			<h3>You may also like this</h3>
			        		</div>
			        		<!-- Secondary heading -->

			        		<!-- Related Blog -->
							<div class="related-events-slider">
								<div class="item">
									<div class="grid-blog">
				    					<div class="grid-blog-img">
				    						<img src="assets/images/grid-blog/img-03.jpg" alt="">
				    					</div>
				    					<div class="product-detail blog-detail">
				    						<span class="date"><i class="fa fa-calendar"></i><?php get_the_date(); ?></span>
				    						<h5>How to writean eBook in 2015 and make</h5>
				    						<p><?php the_content(); ?></p>
				    						<div class="aurthor-detail">
				    							<span><img src="assets/images/book-aurthor/img-01.jpg" alt=""><?php the_title(); ?></span>
				    							<a class="add-wish" href="#"><i class="fa fa-share-alt"></i></a>
				    						</div>
				    					</div>
				    				</div>
								</div>
		    				</div>
		    				<!-- Related Blog -->
						</div>
						<!-- Related Blog -->

						<!-- Comments Holder -->
						<div class="comments-holder">

							<!-- Secondary heading -->
			        		<div class="sec-heading">
			        			<h3>People Comments</h3>
			        		</div>
			        		<!-- Secondary heading -->

			        		<!-- Comments -->
							<ul>
								<li>
									<img class="position-center-x" src="assets/images/commenter/img-01.jpg" alt="">
									<div class="comment">
										<h6>Lonut Zamfir<span>02 March 2016 </span></h6>
										<p>Etiam eros condimentum curabitur donec amet maecenas, morbi placerat etiam adipiscing libero erat facilisis, taciti congue mattis quam primis sed vivamus eu hendrerit habitasse per et aliquam aliquet adipiscing pharetra bibendum eget laoreet.iaculis inceptos primis senectus laoreet commodo venenatis tristique inceptos curabitur enim vitae.</p>
									</div>
								</li>
							</ul>
							<!-- Comments -->
						</div>
						<!-- Comments Holder -->

						<!-- Form -->
						<div class="form-holder">

							<!-- Secondary heading -->
			        		<div class="sec-heading">
			        			<h3>Leave Comments</h3>
			        		</div>
			        		<!-- Secondary heading -->

			        		<!-- Sending Form -->
			        		<form class="sending-form">
			        			<div class="row">
			        				<div class="col-sm-12">
					        			<div class="form-group">
					        				<textarea class="form-control" required="required" rows="5" placeholder="Text here..."></textarea>
					        				<i class="fa fa-pencil-square-o"></i>
					        			</div>
				        			</div>
				        			<div class="col-sm-6">
					        			<div class="form-group">
					        				<input class="form-control" required="required" placeholder="Full name">
					        				<i class="fa fa-user"></i>
					        			</div>
				        			</div>
				        			<div class="col-sm-6">
					        			<div class="form-group">
					        				<input class="form-control" required="required" placeholder="Subject">
					        				<i class="fa fa-align-left"></i>
					        			</div>
				        			</div>
				        			<div class="col-sm-6">
					        			<div class="form-group">
					        				<input class="form-control" required="required" placeholder="Email">
					        				<i class="fa fa-envelope"></i>
					        			</div>
				        			</div>
				        			<div class="col-sm-6">
					        			<div class="form-group">
					        				<input class="form-control" required="required" placeholder="Phone no.">
					        				<i class="fa fa-phone"></i>
					        			</div>
				        			</div>
				        			<div class="col-sm-12">
					        			<button class="btn-1 shadow-0 sm">send message</button>
				        			</div>
			        			</div>
			        		</form>
			        		<!-- Sending Form -->
						</div>
						<!-- Form -->
					</div>
					<!-- Content -->

					<!-- Aside -->
					<?php get_sidebar() ?>
					<!-- Aside -->
				</div>
			</div>
		</div>
		<!-- Blog List -->
	</main>
<!-- END MAIN CONTENT -->

<?php get_footer() ?>

	