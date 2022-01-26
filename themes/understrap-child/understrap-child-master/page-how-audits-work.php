<?php

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper page how-audits-work-page" id="page-wrapper" role="main">

	<div id="content">

<div class="haw-bg">
		<div class="container">
				<div class="row" >
					<div class="col-sm-12">
						<h1>How does a manual compliance audit work ?</h1>
						<div>
							<span class="uline-a"></span>
							<span class="uline-b"></span>
							<span class="uline-c"></span>		
						</div>
						<div class="haw-desc">
							The Manual Compliance Audit should be conducted by certified professionals. These individuals are skilled developers who are expert in WCAG standards and the Assistive Technology used by the disabled. Our testers are certified through the <a href="#">International Association for Accessibility Professionals*</a>. They perform tests using 5 device combinations:
						</div>
						<div class="mt-2">
						<a class="haw-smlink pt-3" href="https://www.accessibilityassociation.org">*www.accessibilityassociation.org</a>
						</div>
					</div>
				</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 haw-pts">
				<ul class="div-com-pts">
					<li><span class="shield-bullet"></span>JAWS on Chrome</li>
					<li><span class="shield-bullet"></span>NVDA on Firefox</li>
					<li><span class="shield-bullet"></span>Voiceover on Safari</li>
					<li><span class="shield-bullet"></span>Talkback on Android</li>
					<li><span class="shield-bullet"></span>Voiceover on iOS</li>
				</ul>

				<img class="hiw-fig img-fluid" src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>hiw-fig.png ?>" alt="" />

				<div class="col-sm-5 px-0"> Testers visit various sections of the website to test for compliance. They perform test cases, which are frequent paths traveled by users to ensure the areas of heaviest traffic are evaluated.</div>
				<div class="col-sm-12 px-0">
					They evaluate the HTML code of the site, looking for the appropriate tags, structure and elements that allow for accessibility.
				</div>

			</div>
		</div> <!-- End of row -->

		<div class="row mt-5">
			<div class="col-sm-12">
				<h2 class="haw-section-title">Does every page of my site need to be tested ?</h2>
				<div class="uline-cnt mb-2">
					<span class="uline-a"></span>
					<span class="uline-b"></span>
					<span class="uline-c"></span>		
				</div>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-sm-8">
				This is a common question, especially when dealing with larger sites. The only way to ensure complete ADA compliance is to test each page of a site. However, industry standards allow for a few different approaches to Manual Compliance Audits. <br />
				For example, if a site has 200,000 pages it will require considerable effort to test each page. In these cases testers will evaluate the site prior to beginning the audit. They will look for common elements across the site, such as page templates. One template may be used for hundreds of pages. If that is the case the tester will be able to evaluate
			</div>

			<div class="col-sm-4">
				<img class="img-fluid" src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>pc-scan.png ?>" alt="" />
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-sm-12">
				<h2 class="haw-section-title">How much does a manual compliance audit cost ?</h2>
				<div class="uline-cnt mb-2">
					<span class="uline-a"></span>
					<span class="uline-b"></span>
					<span class="uline-c"></span>		
				</div>

				
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="mt-4">Costs for a Manual Compliance Audit depend on the size, complexity and quality of a site, as well as the skill and efficiency of the testers conducting the audit. We evaluate each site at the start of a project to determine the effort required to conduct a Manual Compliance Audit. Our testers are certified through the IAAP, average more than 15 years of professional development experience and work efficiently. We provide a flat hourly rate for the service. Any company offering to provide a full compliance audit for a fixed cost without evaluating the front and backend of a site is either inexperienced or providing low-quality work. This is technical work which must be performed manually. Code must be evaluated prior to quoting the project. There are no shortcuts.</div>
			</div>	
		</div>

		<div class="row mt-5">
			<div class="col-sm-8">
				<h2 class="haw-section-title">Whats included ?</h2>
				
				
				<ul class="div-com-pts">
					<li><span class="tick-bullet"></span> Representative Sample of Site Tested on 5 Device Combinations</li>
					<li><span class="tick-bullet"></span> List of Current WCAG Violations</li>
					<li><span class="tick-bullet"></span> Conformance Level of Current Violations (A, AA, AAA, 508)</li>
					<li><span class="tick-bullet"></span> Definitions of Violations</li>
					<li><span class="tick-bullet"></span> Location of Violations Within HTML</li>
					<li><span class="tick-bullet"></span> Techniques For Remediation</li>
					<li><span class="tick-bullet"></span> Blueprint for Remediation</li>
					<li><span class="tick-bullet"></span> Recommended Priorities, Strategy & Course of Action</li>
					<li><span class="tick-bullet"></span> Voluntary Product Accessibility Template (VPAT - For Section 508 Only)</li>
				</ul>
				
				
			</div>
			<div class="col-sm-4">
					<img class="img-fluid" src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>checklist.png ?>" alt="" />
			</div>
		</div>


	</div>

</div>

</div> <!-- ENd of wrapper -->

<?php get_footer(); ?>