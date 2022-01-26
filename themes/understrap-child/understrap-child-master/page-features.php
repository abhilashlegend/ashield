<?php

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper page feature-page" id="page-wrapper" role="main">

	<div id="content">

		<div class="feature-hero">
			
			<div class="container">
				<div class="row" >
					
					<div class="col-sm-12 v-center">
						
						<div class="feature-hero-text">
							<h1> ASx System </h1>
							<h1> Accessibility Project Management</h1>
							<h2> By developers, for developers</h2>
						</div>

					</div>

				</div>
			</div>
			
			<div class="feature-buttons">
				<a class="feature-request-demo-btn" href="<?php echo get_site_url(null, '/schedule-demo/'); ?>">Request a demo</a>

				<a class="feature-report-btn" href="<?php echo get_site_url(null, '/free-scan/'); ?>">Get a free Report</a>
			</div>

		</div> <!-- ENd of feature hero -->

		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<div class="row feature-first-row">

				<div class="col-sm-3 feature-asx-logo">
					
					<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>asx-logo.png" alt="" />

				</div>

				<div class="col-sm-9">
					
					<h2 class="mt-2">The ASx system was born...</h2>

					<p>out of necessity. To this day many accessibility companies still work using  Excel sheets or worse and they only give you the amount and type of violations, not the specific locations. Instead they expect you to use one of the free tools to do that yourself. The Asx system crawls your site, identifies all links on the site then analyzes them using the most common open source accessibility tools to find and point out the violations. Beyond that we also look for the identity common violations across the site that indicate templates making for quick and easy remediations that quickly fix issues. <br />
						The ASx system has many other features like the ability to record manual tests, generate reports, filter violations to make quick work of remediations,add users with various roles, assign tasks and create user journeys just to name a few of the things it can do.
					</p>

				</div>
			</div>

			<div class="row mt-5">

				<div class="col-sm-12">
					
					<div class="card-deck">
					  <div class="card blue-card">
					  	<div class="text-center">
					    	<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>feature-calender-icon.png" height="146" width="156" alt="">
						</div>
					    <div class="card-body">
					      <h3 class="card-title">Automated, scheduled scanning</h3>
					      <p class="card-text">
					      	The system is designed to automatically rescan the sites on a set schedule so you are always protected. This also establishes a history that can be used to validate your efforts on remediation. Trendlines are available on the dashboard to quickly see the status of any project - perfect for busy project managers.
					      </p>
					      
					    </div>
					  </div>

					  <div class="card green-card">
					  	<div class="text-center">
					    <img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>scan-behind-logins.png" width="" height="146" alt="">
						</div>
					    <div class="card-body">
					      <h3 class="card-title">Scan <br /> behind logins</h3>
					      <p class="card-text">
					      	Our system is able to be configured to scan behind a login with a client supplied username and password. Now portal and private systems can be auto-scanned - increasing the ease and which you can remediate your projects and tracking the progress.
					      </p>
					      
					    </div>
					  </div>

					  <div class="card white-card">
					  	<div class="text-center">
					    	<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>auto-crawling.png" alt="">
					    </div>
					    <div class="card-body">
					      <h3 class="card-title">Auto Crawling for complete scanning </h3>
					      <p class="card-text">
					      	Our system will index and crawl your site making a list of pages to audit. Pages can be added manually and pages can be ignored giving you full control over what and how much is scanned.
					      </p>
					      
					    </div>
					  </div>
					</div>

				</div> <!-- ENd of col-sm-12 -->

			</div> <!-- End of row -->

			<div class="row mt-5 feature-third-row">
				<div class="col-sm-6">
					<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>work-flow.png" alt="">
				</div>
				<div class="col-sm-6 v-center">
					<div>
						<h2>Multiple Accessibility Engines to get the best of all worlds</h2>
						<p>Once we have your site indexed, we proceed to audit the pages using multiple open source accessibility engines. Since all the engines have their limitations, we use several to ensure we catch as many violations as any automated system can. We save these violations into the system where they can be viewed, sorted, tasked out, exported and reported on. The violations are assigned a severity and priority number and information like the CSS selector, outer HTML, WCAG violations and associated techniques are attached. All of this is available from our platform. 
						</p>
					</div>
				</div>
			</div>	<!-- ENd of row -->


			<div class="row feature-fourth-row">
				<div class="col-sm-6 green-box">
					<h3>Powerful filters to find the <br /> data you need quickly</h3>
					<p>The system employ's a powerful set of filters that let you make short work of accessibility problems. Filter by WCAG definitions for example and assign different parts of the remediation to the teams best suited for the work. Since the platform's launch we have increased the speed of remediations by almost 400% due to our continuing advancement of our filters and their applications to the projects.
					</p>	
				</div>
				<div class="col-sm-6 white-box">
					<h3>Multiple projects, multiple <br /> companies, one system!</h3>
					<p>Projects are organized by company and users can be assigned to companies and projects giving complete control over who sees what. You can filter through projects to quickly find what you need, when you need it.
					</p>

				</div>
			</div> <!-- end of row -->
			<div class="row">
				<div class="col-sm-6 white-box">
					<h3>Manual test integration</h3>
					<p>
						Since auto scanning tools are limited, we've added the ability to add any number of violations to the system. We record the testing criteria, page location, WCAG definitions and much more. This information can them be generated into a report by a click of a button in our system or view using the powerful filters. Testers can quickly and easily pass this information to developers to allow fast and effective remediations.
					</p>

				</div>
				<div class="col-sm-6 green-box">
					<h3>WCAG 2.1 AAA Support</h3>
					<p>The ASx system was built around WCAG 2.1 AAA standards and can be used for WCAG 2.1, WCAG 2.0 and Section 508 projects. Of course, this means it's perfect for the EN 549 301 and other international standards that are based on WCAG. Each project can be configured to show just the standard you want such as WCAG 2.1 A and AA. The system is upgradable so you won't be waiting when the new standards are launched.
					</p>
				</div>
			</div> <!-- End of row -->

		</div>

		<div class="feature-fifth-row">
			<div class="bullet-box">
				
						<div class="bullet-cont">
							<h3>Unlimited Users, <br /> finite control</h3>
							<p class="mt-3">Add as many users as you like and assign roles from a common viewer to a system administrator to control what they can see and do. Then associate them with projects and companies to further control what they see and do allowing you incredible control over the system. Clients, developers, testers, project managers, administrators all have their place and their abilities within the system.
							</p>
						</div>
					
			</div>
			<div class="feature-diagram">
				<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>work-flow-2.png" alt="">
				
			</div>
		</div>

		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<div class="row feature-last-row">
			
			<div class="col-sm-12">
					
					<div class="card-deck">
					  <div class="card blue-card">
					  	<div class="text-center">
					    	<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>task-notes.png"  alt="">
						</div>
					    <div class="card-body">
					      <h3 class="card-title">Tasks and notes</h3>
					      <p class="card-text">
					      	Every Page and every violation can be made into a task and assigned to another user. Task can also be created in the task area for anything you possibly could need. These tasks can be tracked and followed up on by project managers to ensure that the project runs smoothly and efficiently. Like Tasks, Notes are available through the system to help keep track of all aspects of your accessibility projects
					      </p>
					      
					    </div>
					  </div>

					  <div class="card green-card">
					  	<div class="text-center">
					    <img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>active-development.png"  alt="">
						</div>
					    <div class="card-body">
					      <h3 class="card-title">Active development</h3>
					      <p class="card-text">
					      	The ASx system is being actively developed and maintained to stay on the leading edge of accessibility testing, remediation and project management. Our senior software engineer has over 25 years of design and development. We actively take feedback from our clients and integrate the best suggestions to ensure the best product for all.
					      </p>
					      
					    </div>
					  </div>

					  <div class="card white-card">
					  	<div class="text-center">
					    	<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>reports-exports.png" alt="">
					    </div>
					    <div class="card-body">
					      <h3 class="card-title">Reports and exports </h3>
					      <p class="card-text">
					      	The ASx system can export information in formatted PDF reports to share with developers, clients and manager as well as in CSV files for integration into many other systems. Reports have fully customizable cover pages, headers and footers. CSV exports use the power of our filtering system to export the data you need. 
					      </p>
					      
					    </div>
					  </div>
					</div>

				</div> <!-- ENd of col-sm-12 -->

			</div> <!-- End of row -->
			
		</div>

	</div> <!-- ENd of content -->

</div> <!-- ENd of wrapper -->

<?php get_footer(); ?>