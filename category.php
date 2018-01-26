<?php
/**
 * The template for displaying Category pages
 *
 */
get_header(); ?>
	<div id="primary" class="category-<?=get_queried_object_id();?> category site-content">
		<div class="container">
			<div class="row" role="main">
				<div class="col-md-8">
						<?php 	
						$category = $wp_query->get_queried_object();
						
						$paged = ( get_query_var('paged') ? get_query_var('paged') : 1);
						$query = array(
							'cat' => get_queried_object_id(),
							'post_type' => 'post',
							'paged' => $paged, 
						);
						query_posts( $query );						
						if (have_posts()){
							?>
						<header class="category-header">
							<h1 class="category-title"><?php echo $category->name; ?></h1>
						</header>
						<?php						
							while(have_posts()){ 
								the_post();
								?>
									<div class="category-lists">
										<div class="row">
											<div class="col-md-3">
												<?php if(has_post_thumbnail()){?>
													<?php echo '<img title="'.get_the_title().'" alt="'.get_the_title().'" class="img-fluid wp-post-image" src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" width="100%" height="auto" />';?>
												<?php }else{
													echo '<img class="img-fluid" src="//placehold.it/171x180" draggable="false" alt="No Image" title="No Image" />';
												} ?>
											</div>
											<div class="col-md-9">
												<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
												<span class="date-posted"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo get_the_date(); ?></span>
												<br/>
												<p><?php echo substr(get_the_excerpt(), 0,200) ;?>...</p>
												<div class="archieve-action">
													<a class="btn btn-primary" href="<?php echo get_the_permalink(); ?>"><span class="glyphicon glyphicon-search"></span> Read more</a>
												</div>
											</div>
										</div>
									</div>
								<?php
							} 
							wp_reset_query();
							echo '<div class="pagination">'.rocketPage().'</div>';
						?>
						<?php }else{ // end of the condition. ?>
							<h3>No posts to show.</h3>
						<?php } // end of the else. ?>
				</div><!-- .col-md-8 -->
				<div class="col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- .col-md-4 -->
			</div><!--.row -->
		</div><!-- .container-->
	</div><!-- .primary -->
<?php get_footer(); ?> 