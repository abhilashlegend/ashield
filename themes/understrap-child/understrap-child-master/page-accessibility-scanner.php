<?php

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

$args = array(
    'method' => 'POST',
    'timeout' => 99000,
    'headers'  => array(
        'Content-type: application/x-www-form-urlencoded'
    ),
    'sslverify' => false,
    'body' => array(
        'postUri' => 'http://www.afshaconsult.com/'
    )
);

$api_response = wp_remote_post('http://165.227.191.103:8081/postPa11y', $args);




$status = $api_response['response']['code'];

$data = json_decode($api_response['body']);

$issues = $data->issues;

$total_issues = count($data->issues);


?>

<div class="wrapper page accessibility-scanner-page" id="page-wrapper">

	

	<div class="<?php echo esc_attr( $container ); ?>" role="main" id="content" tabindex="-1">
		<div class="row" >
			<div class="col-md-12">
				<h1>Accessibility Scanner</h1>

				<?php 
					if($status == 200) {
				?>			

				<p><strong>Result for URL :</strong> <?php echo $data->pageUrl; ?> </p>

				<p><strong>Page title :</strong> <?php echo $data->documentTitle; ?> </p>

				<p><strong><?php echo $total_issues; ?></strong> errors found on page. </p>

				<h2 class="mt-2">Issue Details</h2>

				<?php 
				foreach($issues as $issue) {
			
				?>	
					<ul>
						<li><strong>Violation :</strong> <?php echo $issue->message; ?></li>
						<ul>
							<li><strong>CSS :</strong> <?php echo $issue->selector; ?></li>
							<li><strong>HTML :</strong> <?php echo $issue->context; ?></li>
							<li><strong>Code :</strong> <?php echo $issue->code; ?></li>
						</ul>
					</ul>
				<?php	
				}
				
					
				?>
			<?php } else { ?>
					<p>
						<h2>Error: </h2>

					</p>	
			<?php } ?>	

				<p><a href="<?php echo get_site_url(null, '/contact-us/'); ?>">Contact Us</a> for more information</p>

			</div>
		</div>


	</div>

</div> <!-- End of wrapper -->

?>

<?php get_footer(); ?>