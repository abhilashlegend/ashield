<?php


$container   = get_theme_mod( 'understrap_container_type' );

$product_obj = get_page_by_path( 'test-my-site', OBJECT, 'product' );

$product_id = $product_obj->ID;

get_header('second');

?>

<div class="<?php echo esc_attr( $container ); ?>" role="main" id="content" tabindex="-1">
	<div class="row mt-5">
		<div class="col-sm-12">
			<h1 class="">Does Your Website Work for People with Disabilities?</h1>
			<p class="tms-text">
            In honor of Global Accessibility Awareness Day (#GAAD) we are offering a preliminary report to find out if your site is accidently excluding people with disabilities. We have created a program to train disabled users to become testers and evaluate websites. This insight gives you firsthand knowledge of any difficulties disabled users will have on your site. We feel it is vitally important to include actual users of assistive technology in this process.
			</p>
			<p class="tms-text">
            As developers we were aware of accessibility and we also were aware that nobody every asked for it. Several years ago, we had our “Ah-Ha!” moment when a visually impaired client walked into our office. Once we made that human connection to the difficulties experienced, we radically changed directions. We have designed our Test My Site reports to give the raw and honest feedback from actual Assistive Technology users in hopes it triggers an “Ah-Ha” moment for others. Accessibility is more than simple regulatory compliance. 
			</p>
			<p class="tms-text">
			Also, as developers, when we shift to inclusive design and consider all users, we have found improvements for everyone. Websites simply become better.  Take advantage of this excellent deal while it is available. 	
			</p>
			<p class="tms-text">
			This report combines information from our Auditors as well as our User Testers. This provides the most comprehensive view of accessibility on your website. Your report will include details about actual violations on your site that you will be able to fix. It will also expose violations not typically found by computer-based scans. 	
			</p>
			<p>
				<a href="<?php echo get_bloginfo('url') . '/?add-to-cart=' . $product_id; ?>" class="btn tms-button">Test My Site</a>
			</p>
		</div>

		
	</div>

	<div class="row">
		<div class="col-sm-5">
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/man-with-desktop.jpg" alt="" />
		</div>
		<div class="col-sm-7 v-center">
			<div>
				<h1>Who’s Testing My Site?</h1>
				<p class="tms-text">
                Accessibility Shield created an On the Job Training program for users of Assistive Technology. This program allows us to recruit, train and employ disabled User Testers through Pennsylvania’s On the Job Training program. In addition to being testers for us, this apprenticeship opens new career paths, leads to other jobs in tech and business, and allows us to come together to support companies who agree that accessibility is important for everyone.
				</p>
			</div>	
		</div>	
	</div>	

	<div class="row mt-5">
		<div class="col-sm-12">
			<h2 class="tms-h2">Why Should I Test My Site?</h2>
			<p class="tms-text">Test My Site is a straightforward, easy way to start exploring the inclusiveness of your website. Here’s why we’re doing it:</p>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-sm-2">
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/site-search.png" alt="" />
		</div>
		<div class="col-sm-10 v-center">
			<p class="tms-text">WebAIM estimates 98.1% of the web's top home pages don't meet basic accessibility
				standards - and that's an automated scan which only accounts for 25% to 35% of
				potential accessibility failures.
			</p>
		</div>	
	</div>	

	<div class="row mt-4">
		<div class="col-sm-2">
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/bulb-glow.png" alt="" />
		</div>
		<div class="col-sm-10 v-center">
			<p class="tms-text">
				As awareness grows, people inevitably ask: "Well, where can I find someone with a real disability to test my site accessibility?" The answer is often "I don't know off the top of my head, I'll look into that for you."
			</p>
		</div>	
	</div>	

	<div class="row mt-4">
		<div class="col-sm-2">
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/users.png" alt="" />
		</div>
		<div class="col-sm-10 v-center">
			<p class="tms-text">
				Unemployment in the disability community has always been bad, and today, it's worse than ever. Test My Site is leveraging Accessibility Shield's "On the Job Training" program to directly recruit, mentor and help jobseekers with disabilities get hired to work in the accessibility field - and make sure they're well paid for any work they do. 
			</p>
		</div>	
	</div>	

	<div class="row mt-5">
		<div class="col-sm-12">
			<h1>What you get</h1>
			<h2 class="tms-h2">$100 Test My Site Report includes:</h2>
			<div class="mt-5 mb-5">
				<ul style="list-style-type: none">
					<li>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Evaluation of your website by both an Auditor and User Tester.</span></div>
					</li>
					<li>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Description of the highest-impact accessibility violations discovered</span></div>
					</li>
					<li>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Follow-up packet with additional user testing resources and information about our program</span></div>
					</li>
				</ul>
				
				
			
			</div>
			<h3 class="tms-h2">
					User Testers will:
			</h3>
			<div class="mt-5">
				<ul style="list-style-type: none;">
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Test your site for up to one hour</span></div></li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Follow a pre-defined testing script</span></div></li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Focus on overall ease of use</span></div></li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Focus on ability to navigate the site</span></div> </li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Review of blockers</span></div> </li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Review of forms (if applicable)</span></div></li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Review of Chat bots (if applicable)</span></div></li>
					<li><div class="chk-container"><span class="check-icon"></span><span class="chk-list-text">Manager review before sending report</span></div></li>
				</ul>
			</div>
			
		</div>
	</div>	

	<div class="row mt-2">
		<div class="col-sm-2">
			<img src="<?php echo get_stylesheet_directory_uri();?>/img/thank-you.png" alt="" />
		</div>
		<div class="col-sm-10 v-center">
			<div>
				<p class="tms-text">
					By purchasing a Test My Site Report, you are showing support for creating an inclusive digital world where everyone is on equal footing. We believe that is a good way to celebrate Global Accessibility Awareness Day and we hope you agree.
				</p>
				<p>
					<a href="<?php echo get_bloginfo('url') . '/?add-to-cart=' . $product_id; ?>" class="btn tms-button">Test My Site</a>
				</p>
			</div>
		</div>	

	</div>

	<div class="row mt-5 mb-4">
		<div class="col-sm-10 offset-sm-1 text-center">
			<p class="tms-note">
				This report is a preliminary assessment of one small section of your website. This report does not provide a comprehensive report of usability or adherence to government requirements under the Americans with Disabilities Act. The only way to understand the WCAG compliance of your site is to perform a full manual audit using the <a href="https://www.w3.org/WAI/test-evaluate/conformance/wcag-em/">methodologies defined by the W3C</a>. 
			</p>
		</div>	
	</div>	
</div>

</div>
</body>
<?php get_footer('second'); ?>