<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/Framework/Tools.php';

class Layout_View
{
	private $data;
	
	public function __construct($data)
	{
		$this->data = $data;
	}    
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param head 		(string) Is the head of the HTML structure
	 * @param header 	(string) Is the menu and logo section
	 * @param bodyType	(string) Is for CSS purposes
	 * @param body		(string) Content of the website
	 * 
	 */
	
	public function printHTMLPage($section)
    {
    ?>
	<!DOCTYPE html>
	<html class='wide wow-animation' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<meta charset="utf-8" />
			<meta name="format-detection" content="telephone=no"/>
    		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			
			<link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
		    <link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
		    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
		    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
		    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
		    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
		    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
		    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
		    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
		    <link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
		    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
		    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
		    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
		    
		    <meta name="msapplication-TileColor" content="#ffffff">
		    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		    <meta name="theme-color" content="#ffffff">
			<?php 
			switch ($section) {
				case 'mainSection':
					echo self::getHead();
				break;
				
				case 'byCategory':
					echo self::getCoverHead();
				break;
				
				case 'byCompany':
					echo self::getCompanyHead();
				break;
			
				case 'map':
					echo self::getMapHead();
				break;
				
				case 'videos':
					echo self::getVideosHead();
				break;
				
				case 'contact':
					echo self::getContactHead();
				break;
				
				case 'search':
					echo self::getSearchHead();
				break;
			
				case 'allEvents':
					echo self::getAllEventsHead();
				break;
				
				default:
				break;
			}
			?>
		</head>
		<body>
			<!-- Page-->
			<div class="page text-center">
			<?php 
			switch ($section) {
				case 'mainSection':
					echo self :: getIndexContent();
				break;
				
				case 'byCategory':
					echo self :: getCoverContent();
				break;
				
				case 'byCompany':
					echo self :: getCompanyContent();
				break;
				
				case 'map':
					echo self :: getMapContent();
				break;
				
				case 'videos':
					echo self :: getVideosContent();
				break;
				
				case 'contact':
					echo self :: getContactContent();
				break;
				
				case 'search':
					echo self :: getSearchContent();
				break;
				
				case 'allEvents':
					echo self :: getAllEventsContent();
				break;
				
				default:
				break;
			}

			echo self::getFooter(); 
			?>
			</div>
			<?php
			echo self::getCommonScripts();
			echo self::getGoogleAnalytics()
			?>
			<div id="getSize"><p>W: <span></span></p><p>H: <span></span></p></div>
		</body>
		<!-- Google Tag Manager --><noscript><iframe src="http://www.googletagmanager.com/ns.html?id=AIzaSyA_dZD_E9TbBfZeu3x-6vTpxOKOsHJ9pDI" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push( {'gtm.start': new Date().getTime(),event:'gtm.js'} );var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-N7VWVN');</script> <!-- End Google Tag Manager -->
	</html>
    <?php
    }
    
    /**
     * getMainHeader
     *
     * This function returns the headeer of the index, by now, it can
     * receive params like js and css
     *
     * @param NULL
     * @return string $header an html string
     *
     */
    public function getHead()
    {
        ob_start();
        ?>
		<title><?php echo $this->data['appInfo']['title']; ?></title>
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); 
		
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }
    
    public function getCommonDocuments()
    {
    	ob_start();
    	?>
    	<!-- Stylesheets-->
    	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=PT+Sans:400,700%7CMontserrat:400,700%7CPlayfair+Display:400,400i,700,700i,900,900i">
    	<link rel="stylesheet" href="/css/style.css">
    	<!--[if lt IE 10]>
    		<div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    		<script src="js/html5shiv.min.js"></script>
		<![endif]-->
    	<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-102785645-1', 'auto');
			ga('send', 'pageview');
		</script>
    	<?php 
    	$documents = ob_get_contents();
    	ob_end_clean();
    	return $documents; 
    }
    
    public function getCommonScripts()
    {
    	ob_start();
    	?>
    	<!-- Core Scripts -->
		<script src="/js/core.min.js"></script>
		<!-- Additional Functionality Scripts -->
		<script src="/js/script.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getGoogleAnalytics()
	{
		ob_start();
		?>
		<meta name="google-site-verification" content="tFCZlZaQ6vyx-sOA3eXsOShBvfdGPak5P04WnQXaed4" />
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-89493327-1', 'auto');
		  ga('send', 'pageview');
		
		</script>
		<?php 
		$google = ob_get_contents();
		ob_end_clean();
		return $google;
	}
    
    /**
     * getHeader
     * 
     * it's the top and main navigation menu
     * 
     * @return string
     */
    public function getIndexHeader()
	{
		ob_start();
		?>
		<!-- Page Header-->
        <header class="page-header">
            <!-- RD Navbar-->
			<div class="rd-navbar-wrap">
				<nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-md-stick-up-offset="46px" data-lg-stick-up-offset="46px" class="rd-navbar rd-navbar-classic">
					<div class="rd-navbar-top-panel-wrap">
						<div class="rd-navbar-top-panel">
							<div class="left-side">
								<!-- Contact Info-->
								<address class="contact-info text-left">
									<div class="reveal-inline-block">
										<a href="/" class="unit unit-lg-middle unit-horizontal unit-spacing-xxs">
											<span class="unit-left">
												<span class="icon icon-sm icon-primary icon-circle fa fa-flag text-bermuda"></span>
											</span>
											<span class="unit-body">		
												<span class="text-gray-lighter">English</span>
											</span>
										</a>
									</div>
									<div class="reveal-inline-block">
										<a href="/" class="unit unit-lg-middle unit-horizontal unit-spacing-xxs">
											<span class="unit-left">
												<span class="icon icon-sm icon-primary icon-circle mdi mdi-map text-bermuda"></span>
											</span>
											<span class="unit-body">		
												<span class="text-gray-lighter">Mapa</span>
											</span>
										</a>
									</div>
									<div class="reveal-inline-block">
										<a href="callto:984 100 7534" class="unit unit-middle unit-horizontal unit-spacing-xxs">
											<span class="unit-left">
												<span class="icon icon-sm icon-primary icon-circle mdi mdi-phone text-bermuda"></span>
											</span>
											<span class="unit-body">
												<span class="text-gray-lighter">984 100 7534</span>
											</span>
										</a>
									</div>
								</address>
							</div>
							<div class="right-side">
								<ul class="list-inline list-inline-2 list-primary">
									<li>
										<a href="https://www.facebook.com/<?php echo $this->data['appInfo']['facebook']; ?>/" target="_blank" class="icon icon-xs icon-circle fa fa-facebook text-gray-lighter"></a>
									</li>
									<li>
										<a href="https://twitter.com/<?php echo $this->data['appInfo']['twitter']; ?>" target="_blank" class="icon icon-xs icon-circle fa fa-twitter text-gray-lighter"></a>
									</li>
									<li>
										<a href="https://www.instagram.com/<?php echo $this->data['appInfo']['instagram']; ?>/" target="_blank" class="icon icon-xs icon-circle fa fa-instagram text-gray-lighter"></a>
									</li>
									<li>
										<a href="https://www.youtube.com/user/<?php echo $this->data['appInfo']['youtube']; ?>/" target="_blank" class="icon icon-xs icon-circle fa fa-youtube text-gray-lighter"></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="rd-navbar-inner">
						<!-- RD Navbar Panel-->
						<div class="rd-navbar-left-side">
							<div class="rd-navbar-panel">
								<!-- RD Navbar Toggle-->
								<button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle">
									<span></span>
								</button>
								<!-- RD Navbar Brand-->
								<div class="rd-navbar-brand">
									<a href="/" class="brand-name">
									<img src="/images/logo.png" width="202" height="56" alt="<?php echo $this->data['appInfo']['siteName']; ?>" class="img-responsive center-block"></a>
								</div>
								<!-- RD Navbar Toggle-->
								<button data-rd-navbar-toggle=".rd-navbar-search-wrap-fixed" class="rd-navbar-toggle-search-fixed veil-md reveal-tablet"></button>
								<!-- RD Navbar Toggle-->
								<button data-rd-navbar-toggle=".rd-navbar-top-panel" class="rd-navbar-collapse-toggle veil-lg reveal-md-inline-block">
									<span></span>
								</button>
							</div>
						</div>
						<div class="rd-navbar-right-side">
							<div class="rd-navbar-nav-wrap reveal-inline-block">
								<?php echo self::getTopMenu(); ?>
							</div>
							<!--RD Navbar Search-->
							<!-- 
							<div class="rd-navbar-search-wrap-fixed reveal-inline-block">
								<div class="rd-navbar-search-wrap">
									<div class="rd-navbar-search">
										<a data-rd-navbar-toggle=".rd-navbar-search" href="index.html#" class="rd-navbar-search-toggle">
											<span></span>
										</a>
										<form action="search-results.html" data-search-live="rd-search-results-live" method="GET" class="rd-search rd-navbar-search-custom">
											<div class="form-group">
												<label for="rd-navbar-search-form-input" class="form-label">Search</label>
												<input id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off" class="rd-navbar-search-form-input form-control form-control-gray-lightest">
												<button type="submit">
													<span class="icon icon-xs fa fa-search"></span>
												</button>
											</div>
											<div id="rd-search-results-live" class="rd-search-results-live veil reveal-lg-block"></div>
										</form>
									</div>
								</div>
							</div> -->
							<!-- RD Navbar Toggle-->
							<!--<button data-rd-navbar-toggle=".rd-navbar-search-wrap" class="rd-navbar-toggle-search veil reveal-md-inline-block veil-tablet"></button>-->
						</div>
					</div>
				</nav>
			</div>
		</header>
		<?php
		$header = ob_get_contents();
		ob_end_clean();
		return $header;
	}
	
	public function getCommonHeader()
	{
		ob_start();
		?>
		<!--For older internet explorer-->
	    <div class="old-ie"
	         style='background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;'>
	        <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
	            <img src="/images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
	                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
	        </a>
	    </div>
	    <!--END block for older internet explorer-->
	    <!--========================================================
	                              HEADER
	    =========================================================-->
	    <header class="page-header bg2">
	        <!-- RD Navbar -->
	        <div class="rd-navbar-wrap rd-navbar-wrap-1">
	            <nav class="rd-navbar" data-rd-navbar-lg="rd-navbar-static">
	                <div class="rd-navbar-inner">
	                    <!-- RD Navbar Panel -->
	                    <div class="rd-navbar-panel">
	                        <!-- RD Navbar Toggle -->
	                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar"><span></span></button>
	                        <!-- END RD Navbar Toggle -->
	                        <!-- RD Navbar Brand -->
	                        <div class="rd-navbar-brand">
	                            <a href="/" class=" text-white text-ubold" alt="<?php echo $this->data['appInfo']['siteName']; ?>">
	                                <span class="brand-name">Where to Go</span>
	                            </a>
	                        </div>
	                        <!-- END RD Navbar Brand -->
	                    </div>
	                    <!-- END RD Navbar Panel -->
	                    <div class="rd-navbar-nav-wrap">
	                    	<?php echo self::getTopMenu(); ?>
	                    </div>
	                </div>
	            </nav>
	        </div>
	        <!-- END RD Navbar -->
	    </header>
		
		<?php
		$header = ob_get_contents();
		ob_end_clean();
		return $header;
	}
	
	/**
	 * getTopMenu
	 *
	 * it returns the menu of the categories
	 *
	 * @return string
	 */
	public function getTopMenu()
	{
		ob_start();
		?>
		<!-- RD Navbar Nav-->
		<ul class="rd-navbar-nav">
			<li class="active"><a href="/">Inicio</a></li>
			<li><a href="entertainment.html">¿D&oacute;nde ir?</a>
				<!-- RD Navbar Dropdown-->
				<ul class="rd-navbar-dropdown">
					<?php
					foreach ($this->data['categories'] as $category)
					{
					?>
					<li>
						<a href="/<?php echo Tools::slugify($category['category_id']); ?>/<?php echo Tools::slugify($category['name']); ?>/"><?php echo $category['name']; ?></a>
					</li>
					<?php
					}
					?>
				</ul>
			</li>
			<li><a href="/eventos/">Eventos</a></li>
			<li><a href="/blog/">Blog</a></li>
			<li><a href="/mapa/">Mapa</a></li>
			<li><a href="/contacto/">Contacto</a></li>
		</ul>
		<!-- END RD Navbar Nav -->
		<?php
		$topBar = ob_get_contents();
		ob_end_clean();
		return $topBar;
	}
		
	/**
	 * getFooter
	 * 
	 * returns an string with the footer content, this includes categories, 
	 * location, contact info, and some description
	 * 
	 * @return string
	 */
	public function getFooter()
	{
		ob_start();
		?>
		<!-- Page Footer-->
        <footer class="page-footer bg-shark section-80 section-lg-top-120 section-lg-bottom-60">
            <div class="shell-wide">
                <div class="range range-xs-center inset-xl-left-75">
                    <div class="cell-xs-6 cell-sm-5 cell-lg-2 cell-xl-2 text-xl-right cell-lg-push-2">
                        <!-- List Marked-->
                        <ul class="list list-marked list-marked-white text-left inset-xl-left-75">
                        	<?php echo self :: getCategoriesFooter(); ?>
                        </ul>
                    </div>
                    <div class="cell-xs-6 cell-sm-5 cell-lg-2 cell-xl-2 text-xl-right offset-top-40 offset-xs-top-0 cell-lg-push-3">
                        <!-- List Marked-->
                        <ul class="list list-marked list-marked-white text-left inset-xl-left-100">
                            <?php echo self :: getLocationsFooter(); ?>
                        </ul>
                    </div>
                    
                    <div class="cell-xs-8 cell-sm-5 cell-lg-4 cell-xl-4 text-xl-center offset-top-40 offset-lg-top-0 cell-lg-push-1">
                        <p class="text-gray-lighter text-left inset-xl-right-140">Somos un medio digital con presencia en 
                            la Riviera Maya gracias a difusión y cobertura de eventos, así como por la creación de contenidos 
                            propios en materias audiovisual y textual en rubros como espectáculos, deportes, cultura, sociales 
                            y turismo.
                            <br>
                            Contamos con un grupo de personas calificadas en cada área que conforman un equipo especializado 
                            en comunicación y entretenimiento
                        </p>
                    </div>
                </div>
                <div class="range range-xs-center inset-xl-left-75 range-xs-middle range-xl-justify offset-xl-top-75">
                    <div class="cell-sm-3 cell-md-5 cell-lg-5 cell-xl-4 text-xl-center text-sm-left">
                        <a href="index.html" class="reveal-inline-block">
                            <img src="/images/logo-primary.png" width="202" height="56" alt="Where To Go Playa " class="img-responsive center-block">
                        </a>
                    </div>
                    <div class="cell-sm-7 cell-md-5 cell-lg-5 text-xl-center offset-top-40 offset-sm-top-0">
                        <p class="text-small inset-xl-right-175">&#169; 
                            <span id="copyright-year">
                            </span> <?php echo $this->data['appInfo']['siteName']; ?>
                            <br>
                            <a href="callto:info@wheretogo.com.mx" class="text-bermuda"> info@wheretogo.com.mx</a>
                        </p>
                        <!-- {%FOOTER_LINK}-->
                    </div>
                </div>
            </div>
        </footer>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();
        return $footer;
    }
    
    /**
     * getCategoriesFooter
     * 
     * return the categories, on li, for the footer
     * 
     * @return string
     */
    public function getCategoriesFooter()
    {
    	ob_start();
    	if($this->data['categories'])
    	{
    		foreach ($this->data['categories'] as $category)
    		{
    			?>
    		<li>
    		    <a href="/<?php echo $category['category_id']; ?>/<?php echo Tools::slugify($category['name']); ?>/" class="text-bermuda">
    		        <?php echo $category['name']; ?>
    		    </a>
    		    <div class="clear"></div>
    		</li>
    			<?php
    		}
    	}
    	$categories = ob_get_contents();
    	ob_end_clean();
    	return $categories;
    }
    
    /**
     * getLocationsFooter
     * 
     * returns an string with the locations on li
     * 
     * @return string
     */
    public function getLocationsFooter()
    {
    	ob_start();
    	if($this->data['locations'])
    	{
    		foreach ($this->data['locations'] as $location)
    		{
    			?>
    			<li>
    			    <a href="/location/<?php echo $location['location_id']; ?>/<?php echo Tools::slugify($location['name']); ?>/" class="text-bermuda">
    					<?php echo $location['name']; ?>
    				</a>
    				<div class="clr"></div>
    			</li>
    			<?php
    		}
    	}
        $locations_footer = ob_get_contents();
        ob_end_clean();
        return $locations_footer;
    }
    
    public function getIndexMap()
    {
    	ob_start();
    	?>
    	<!-- Contact Information-->
            <section>
                <div class="rd-google-map-wrap">
                    <div class="section-60 section-md-0 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Box-->
                        <div class="box-lg box-contacts bg-white text-left center-block shadow-drop">
                            <hr class="divider hr-left-0 bg-bermuda">
                            <div class="offset-top-15">
                                <h5>Contacto</h5>
                                <!-- Contact Info-->
                                <address class="contact-info offset-top-35 p">
				                    <!-- Unit-->
				                    <div class="unit unit-horizontal unit-spacing-xs">
				                      <div class="unit-left">
				                          <span class="icon icon-normal icon-sm icon-sm-variant-2 mdi mdi-map-marker text-primary"></span></div>
				                      <div class="unit-body"><a href="contacts.html" class="text-dove-gray">Playa del Carmen Quintana Roo, México.</a></div>
				                    </div>
				                    <!-- Unit-->
				                    <div class="unit unit-horizontal unit-spacing-xs offset-top-20">
				                      <div class="unit-left">
				                          <span class="icon icon-normal icon-sm icon-sm-variant-2 mdi mdi-calendar-clock text-primary"></span></div>
				                      <div class="unit-body">
				                        <p class="text-dove-gray"> 9:00am–9:00pm </p>
				                      </div>
				                    </div>
				                    <!-- Unit-->
				                    <div class="unit unit-horizontal unit-spacing-xs offset-top-20">
				                      <div class="unit-left">
				                        <div class="icon icon-normal icon-sm icon-sm-variant-2 mdi mdi-phone text-primary"></div>
				                      </div>
				                      <div class="unit-body"><a href="callto:984 100 7533" class="text-dove-gray">984 100 7533</a></div>
				                    </div>
				                    <!-- Unit-->
				                    <div class="unit unit-horizontal unit-spacing-xs offset-top-20">
				                      <div class="unit-left">
				                        <div class="icon icon-normal icon-sm icon-sm-variant-2 mdi mdi-email-outline text-primary"></div>
				                      </div>
				                      <div class="unit-body"><a href="mailto:info@wheretogo.com.mx" class="text-dove-gray">info@wheretogo.com.mx</a></div>
				                    </div>
				                  </address> 
                  			</div>
                        </div>
                    </div>
                    <!-- RD Google Map-->
                    <div data-zoom="15" data-x="-87.071270" data-y="20.647151" data-styles="[{&quot;featureType&quot;:&quot;landscape.natural&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;color&quot;:&quot;#e0efef&quot;}]},{&quot;featureType&quot;:&quot;poi&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;hue&quot;:&quot;#1900ff&quot;},{&quot;color&quot;:&quot;#c0e8e8&quot;}]},{&quot;featureType&quot;:&quot;road&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;lightness&quot;:100},{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;road&quot;,&quot;elementType&quot;:&quot;labels&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;transit.line&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;lightness&quot;:700}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#7dcdcd&quot;}]}]" class="rd-google-map rd-google-map__model">
                        <ul class="map_locations">
                            <li data-y="40.643180" data-x="-73.9874068">
                                <p>Playa Del carmen, Quintana Roo, México</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
    	<?php
    	$map = ob_get_contents();
    	ob_clean();
    	return $map;
    }
    
    /**
     * getIndexContent
     * 
     * returns the html for the index section, and only for the index section
     * 
     * @return string html code
     */
    public function getIndexContent()
    {
    	ob_start();
    	echo self :: getIndexHeader();
    	?>
    	<div class="swiper-container-wrap">
            <!-- Swiper-->
            <div data-height="" data-min-height="300px" data-simulate-touch="false" data-autoplay="5000"  class="swiper-container swiper-slider">
                <div class="swiper-wrapper">
					<?php 
					echo self::getSwipes();
					?>
                </div>
                <div class="shell-wide shell-wide-custom">
                    <div class="inset-lg-left-45 inset-xl-left-85">
                        <!-- Swiper Pagination-->
                        <div class="swiper-pagination swiper-pagination-bottom"></div>
                    </div>
                </div>
            </div>
            <div class="swiper-aside-right">
                <!-- List-->
                <ul class="list list-background-minsk list-0 text-center section-xs-top-60 section-sm-top-0">
					<li class="inset-xs-left-85 inset-xs-right-85 inset-sm-left-0 inset-sm-right-0">
                        <a href="atracciones-tours.html" class="box-sm bg-primary reveal-block">
                            <span class="fa fa-hand-peace-o custom-icon reveal-inline-block"></span>
                            <span class="text-bold text-white reveal-block">Atracciones</span>
                        </a>
                    </li>
                    <li class="inset-xs-left-85 inset-xs-right-85 inset-sm-left-0 inset-sm-right-0 offset-xs-top-30 offset-sm-top-0">
                        <a href="food.html" class="box-sm bg-primary reveal-block">
                            <span class="fa fa-coffee custom-icon reveal-inline-block"></span>
                            <span class="text-bold text-white reveal-block">Comida</span>
                        </a>
                    </li>
					<li class="inset-xs-left-85 inset-xs-right-85 inset-sm-left-0 inset-sm-right-0 offset-xs-top-30 offset-sm-top-0">
                        <a href="entertainment.html" class="box-sm bg-primary reveal-block">
                            <span class="fa fa-building-o custom-icon reveal-inline-block"></span>
                            <span class="text-bold text-white reveal-block">Hospedaje</span>
                        </a>
                    </li>
                    <li class="inset-xs-left-85 inset-xs-right-85 inset-sm-left-0 inset-sm-right-0 offset-xs-top-30 offset-sm-top-0">
                        <a href="parking.html" class="box-sm bg-primary reveal-block">
                            <span class="fa fa-university custom-icon reveal-inline-block"></span>
                            <span class="text-bold text-white reveal-block">Lugares P&uacute;blicos</span></a>
                    </li>
                    <li class="inset-xs-left-85 inset-xs-right-85 inset-sm-left-0 inset-sm-right-0 offset-xs-top-30 offset-sm-top-0">
                        <a href="parking.html" class="box-sm bg-primary reveal-block">
                            <span class="fa fa-ambulance custom-icon reveal-inline-block"></span>
                            <span class="text-bold text-white reveal-block">Servicios</span></a>
                    </li>
                    <li class="inset-xs-left-85 inset-xs-right-85 inset-sm-left-0 inset-sm-right-0 offset-xs-top-30 offset-sm-top-0">
                        <a href="shops.html" class="box-sm bg-primary reveal-block">
                            <span class="fa fa-shopping-bag custom-icon reveal-inline-block"></span>
                            <span class="text-bold text-white reveal-block">Tiendas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    	
    	<!-- Page Content-->
        <main class="page-content">
        
        	<!-- Items promoted -->
            <section class="section-80">
                <!-- List Inline-->
                <div class="range range-condensed range-xs-middle range-xs-center range-md-justify list-inline-dashed-lg">
                	<?php echo self :: getItemsPromoted(); ?>
                </div>
			</section>
			
			<!-- A Few Words About Audrey Mall-->
            <section class="section-90 section-md-120 bg-selago">
                <div class="inset-md-left-35 inset-xl-left-125 inset-md-right-35 inset-xl-right-125">
                    <div class="shell-wide shell-wide-custom">
                        <div class="range range-xs-center range-xs-middle range-xl-justify">
                            <div class="cell-sm-10 cell-lg-5 cell-xl-4 text-left">
                                <hr class="divider hr-md-left-0 bg-bermuda">
                                <div class="offset-top-20">
                                    <h3 class="text-center text-md-left"><?php echo $this->data['appInfo']['siteName']; ?></h3>
                                    <div class="offset-top-30">
                                        <p><?php echo $this->data['appInfo']['description']; ?></p>
                                    </div>

                                </div>
                            </div>
                            <div class="cell-sm-10 cell-lg-7 cell-xl-8 offset-top-60 offset-lg-top-0">
                                <div class="range range-xs-center range-sm-left range-md-center inset-xl-left-70">
                                    <div class="cell-sm-6 cell-md-4 offset-top-60 offset-sm-top-0">
                                        <span class="icon icon-lg icon-circle icon-white shadow-drop mdi mdi-music-note text-primary"></span>
                                        <div class="offset-top-25 offset-md-top-35 inset-xl-left-15 inset-xl-right-15">
                                            <h6>Events</h6>
                                            <hr class="divider divider-xs bg-bermuda offset-top-15">
                                            <p class="offset-top-15 offset-md-top-25">
                                            	<a class="muted-link"> Diviertete en los más bellos paruqes tematicos, disfruta de las maravillas de la Riviera Maya con inumerables tours.</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="cell-sm-6 cell-md-4">
                                        <span class="icon icon-lg icon-circle icon-white shadow-drop mdi mdi-comment text-primary"></span>
                                        <div class="offset-top-25 offset-md-top-35 inset-xl-left-15 inset-xl-right-15">
                                            <h6>Blog</h6>
                                            <hr class="divider divider-xs bg-bermuda offset-top-15">
                                            <p class="offset-top-15 offset-md-top-25"><a class="muted-link">Disfruta de la amplia varideda gastronómica en Playa del Carmen</a></p>
                                        </div>
                                    </div>
                                    <div class="cell-sm-6 cell-md-4 offset-top-60 offset-sm-top-0">
                                        <span class="icon icon-lg icon-circle icon-white shadow-drop mdi mdi-email text-primary"></span>
                                        <div class="offset-top-25 offset-md-top-35 inset-xl-left-15 inset-xl-right-15">
                                            <h6>Contacto</h6>
                                            <hr class="divider divider-xs bg-bermuda offset-top-15">
                                            <p class="offset-top-15 offset-md-top-25"><a class="muted-link">Diviertete en los más bellos paruqes tematicos, disfruta de las maravillas de la Riviera Maya con inumerables tours.</a></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
	        
			<!-- What we do 
	        <section class="well-xl-4 hr text-center text-sm-left">
	            <div class="container">
	                <h3 class="text-line-2 text-default-3">Pr&oacute;ximos eventos</h3>
	                <div class="row offset-4">
	                	<?php 
	                		//echo self::getIndexEvents();
	                	?>
	                </div>
	            </div>
	        </section> -->
	        <!-- END What we do -->

	        <!-- Clients choose us! 
	        <section class="well-xl-3 hr text-center text-sm-left">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-4 wow fadeInLeft">
	                        <h3 class="text-line-2 text-default-3">Facebook</h3>
	                        <?php //echo self :: getFacebookIndex(); ?>
	                    </div>
	                    <div class="col-md-4 wow fadeInLeft">
	                        <h3 class="text-line-2 text-default-3">Twitter</h3>
	                        <?php //echo self :: getTwitterIndex(); ?>
	                    </div>
	                    <div class="col-md-4 wow fadeInLeft">
	                        <h3 class="text-line-2 text-default-3">Videos</h3>
	                        <div class="row">
	                        	<?php //echo  self :: getVideosIndex(); ?>
	                        </div>
	                        <a class="btn btn-xs btn-primary-1" href="/videos/">Ver todos<span class="material-icons-chevron_right"></span></a>
	                    </div>
	                </div>
	            </div>
	        </section>-->
	        <!-- END Clients choose us! -->
	        
	        <!-- RD Google Map -->
	        <!-- <section>
	            <div class="rd-google-map">
	                <div id="google-map" class="rd-google-map__model" data-zoom="16" data-x="-87.069887"
	                     data-y="20.631863"></div>
	                <ul class="rd-google-map__locations">
	                	<?php 
	                	foreach ($this->data['companies_map'] as $company)
	                	{
	                		?>
	                	<li data-x="<?php echo $company['longitude']; ?>" data-y="<?php echo $company['latitude']; ?>">
	                		<div class="map-info-item">
	                			<div class="map-info-image">
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
								    	<img alt="<?php echo $name; ?>" src="/img-up/companies_pictures/logo/<?php echo $company['logo']; ?>">
								    </a>
	                			</div>
	                			<div class="map-info">
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
	                					<h4><?php echo $company['name']; ?></h4>
	                				</a>
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
	                					<?php echo trim(preg_replace('/\s+/', ' ',str_replace(array("'"), "",$company['seo_description']))); ?>
	                				</a>
	                			</div>
	                		</div>
	                    </li>
	                		<?php
	                	}
	                	?>
	                </ul>
	            </div>
	        </section> -->
	        <!-- END RD Google Map -->
	        <?php 
	        echo self::getMainCategoriesIndex();
	        echo self::getEventsIndex();
	        echo self::getBlogIndex();
	        echo self::getIndexMap();
	        ?>
		</main>
    	
		<?php
		$wideBody = ob_get_contents();
        ob_end_clean();
		return $wideBody;
    }
    
    public function getMainCategoriesIndex()
    {
    		ob_get_contents();
    		?>
    		<section class="section-80 section-md-0 bg-shark">
                <div class="range range-condensed range-xs-center">
					<div class="cell-xs-6 cell-sm-6 cell-lg-2 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Thumbnail Terry-->
                        <figure class="thumbnail-terry thumbnail-terry-modern">
                            <a href="food.html">
                                <img width="480" height="360" src="/images/steak-house.jpg" alt="Restaurantes Playa del Carmen">
                            </a>
                            <figcaption class="text-left">
                                <div class="figcaption-caption">
                                    <h4 class="thumbnail-terry-title text-spacing-40 text-uppercase">Atracciones y Tours</h4>
                                    <p class="thumbnail-terry-desc text-white-07 offset-top-5">
                                        Disfruta de una gran gama gastronómica
                                    </p>
                                </div>
                                <div class="thumbnail-terry-btn-wrap text-md-right offset-top-10 offset-md-top-0">
                                    <a href="food.html" class="btn btn-thumbnail-terry btn-rect btn-icon btn-icon-right btn-primary">
                                        <span class="icon icon-xs mdi mdi-arrow-right veil reveal-sm-inline-block"></span> Más
                                    </a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    
                    <div class="cell-xs-6 cell-sm-6 cell-lg-2 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Thumbnail Terry-->
                        <figure class="thumbnail-terry thumbnail-terry-modern">
                            <a href="food.html">
                                <img width="480" height="360" src="/images/steak-house.jpg" alt="Restaurantes Playa del Carmen">
                            </a>
                            <figcaption class="text-left">
                                <div class="figcaption-caption">
                                    <h4 class="thumbnail-terry-title text-spacing-40 text-uppercase">Comida y Bebida</h4>
                                    <p class="thumbnail-terry-desc text-white-07 offset-top-5">
                                        Disfruta de una gran gama gastronómica
                                    </p>
                                </div>
                                <div class="thumbnail-terry-btn-wrap text-md-right offset-top-10 offset-md-top-0">
                                    <a href="food.html" class="btn btn-thumbnail-terry btn-rect btn-icon btn-icon-right btn-primary">
                                        <span class="icon icon-xs mdi mdi-arrow-right veil reveal-sm-inline-block"></span> Más
                                    </a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
					
                    <div class="cell-xs-6 cell-sm-6 cell-lg-2 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Thumbnail Terry-->
                        <figure class="thumbnail-terry thumbnail-terry-modern">
                            <a href="food.html">
                                <img width="480" height="360" src="/images/steak-house.jpg" alt="Restaurantes Playa del Carmen">
                            </a>
                            <figcaption class="text-left">
                                <div class="figcaption-caption">
                                    <h4 class="thumbnail-terry-title text-spacing-40 text-uppercase">Hospedaje</h4>
                                    <p class="thumbnail-terry-desc text-white-07 offset-top-5">
                                        Disfruta de una gran gama gastronómica
                                    </p>
                                </div>
                                <div class="thumbnail-terry-btn-wrap text-md-right offset-top-10 offset-md-top-0">
                                    <a href="food.html" class="btn btn-thumbnail-terry btn-rect btn-icon btn-icon-right btn-primary">
                                        <span class="icon icon-xs mdi mdi-arrow-right veil reveal-sm-inline-block"></span> Más
                                    </a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="cell-xs-6 cell-sm-6 cell-lg-2 offset-top-40 offset-xs-top-0 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Thumbnail Terry-->
                        <figure class="thumbnail-terry thumbnail-terry-modern">
                            <a href="atracciones-tours.html">
                                <img width="480" height="360" src="/images/atracciones.jpg" alt="Atracciones Playa del Carmen">
                            </a>
                            <figcaption class="text-left">
                                <div class="figcaption-caption">
                                    <h4 class="thumbnail-terry-title text-spacing-40 text-uppercase">Lugares Publicos</h4>
                                    <p class="thumbnail-terry-desc text-white-07 offset-top-5">
                                        Tours, parques tematicos y más.
                                    </p>
                                </div>
                                <div class="thumbnail-terry-btn-wrap text-md-right offset-top-10 offset-md-top-0">
                                    <a href="atracciones-tours.html" class="btn btn-thumbnail-terry btn-rect btn-icon btn-icon-right btn-primary">
                                        <span class="icon icon-xs mdi mdi-arrow-right veil reveal-sm-inline-block"></span>Más
                                    </a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="cell-xs-6 cell-sm-6 cell-lg-2 offset-top-40 offset-md-top-0 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Thumbnail Terry-->
                        <figure class="thumbnail-terry thumbnail-terry-modern">
                            <a href="beach-clubs.html">
                                <img width="480" height="360" src="/images/beach-club.jpg" alt="Playa del Carmen Beach Club"></a>
                            <figcaption class="text-left">
                                <div class="figcaption-caption">
                                    <h4 class="thumbnail-terry-title text-spacing-40 text-uppercase">Servicios</h4>
                                    <p class="thumbnail-terry-desc text-white-07 offset-top-5">Disfruta de un día inolvidable</p>
                                </div>
                                <div class="thumbnail-terry-btn-wrap text-md-right offset-top-10 offset-md-top-0">
                                    <a href="beach-clubs.html" class="btn btn-thumbnail-terry btn-rect btn-icon btn-icon-right btn-primary">
                                        <span class="icon icon-xs mdi mdi-arrow-right veil reveal-sm-inline-block"></span>Más</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="cell-xs-6 cell-sm-6 cell-lg-2 offset-top-40 offset-md-top-0 inset-left-15 inset-right-15 inset-md-left-0 inset-md-right-0">
                        <!-- Thumbnail Terry-->
                        <figure class="thumbnail-terry thumbnail-terry-modern">
                            <a href="hoteles.html"><img width="480" height="360" src="/images/hoteles.jpg" alt=""></a>
                            <figcaption class="text-left">
                                <div class="figcaption-caption">
                                    <h4 class="thumbnail-terry-title text-spacing-40 text-uppercase">Tiendas</h4>
                                    <p class="thumbnail-terry-desc text-white-07 offset-top-5">Opciones de hospedaje </p>
                                </div>
                                <div class="thumbnail-terry-btn-wrap text-md-right offset-top-10 offset-md-top-0">
                                    <a href="hoteles.html" class="btn btn-thumbnail-terry btn-rect btn-icon btn-icon-right btn-primary">
                                        <span class="icon icon-xs mdi mdi-arrow-right veil reveal-sm-inline-block"></span>Más</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>

                </div>
            </section>
    		<?php
    		$categories = ob_get_contents();
    		ob_end_clean();
    		return $categories;
    }
    
    public function getEventsIndex()
    {
    		ob_start();
    		?>
    		<section class="section-80 section-md-120">
                <div class="inset-md-left-35 inset-xl-left-125 inset-md-right-35 inset-xl-right-125">
                    <div class="shell-wide shell-wide-custom">
                        <hr class="divider bg-bermuda">
                        <div class="offset-top-20">
                            <h1>Eventos en Playa del Carmen</h1>
                        </div>
                        <div class="range range-xs-center range-lg-left text-left offset-top-35 offset-md-top-60">
                            <div class="cell-md-6">
                                <!-- Unit-->
                                <div class="range range-xs-center range-lg-left">
                                    <div class="cell-sm-5 cell-md-10 cell-lg-5">
                                        <img src="/images/golf-para-todos-index-event.jpg" width="320" height="442" alt="Golf para Todos Mayakoba" class="img-responsive">
                                    </div>
                                    <div class="cell-sm-6 cell-md-10 cell-lg-6 offset-md-top-30 offset-lg-top-0">
                                        <!-- List Inline-->
                                        <ul class="list-inline list-inline-20">
                                            <li>
                                                <span class="icon icon-normal icon-sm mdi mdi-calendar text-bermuda text-middle"></span>
                                                <span class="text-middle inset-left-10">Junio 11</span>
                                            </li>
                                            <li><span class="icon icon-normal icon-sm mdi mdi-clock text-bermuda text-middle"></span>
                                                <span class="text-middle inset-left-10">1:00pm</span>
                                            </li>
                                        </ul>
                                        <div class="offset-top-25">
                                            <h5><a href="eventos-golf-para-todos.html">Golf Para Todos</a></h5>
                                        </div>
                                        <div class="offset-top-25">
                                            <p>Golf PARa Todos es un programa comunitario y educativo del OHL Classic at Mayakoba para toda la familia. Esta lleno de actividades divertidas que fomentan la participacion activa en el golf.
                                                <span class="veil-md reveal-lg-inline">
                                                     Facilita la integración del deporte en la comunidad al crear un vínculo con 
                                                    el evnto del PGA TOUR en México.
                                                </span>
                                            </p>
                                        </div>

                                        <div class="offset-top-25">
                                            <a href="eventos-golf-para-todos.html" class="btn btn-width-175 btn-primary-outline">Más Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cell-md-6 offset-top-50 offset-md-top-0">
                                <!-- Unit-->
                                <div class="range range-xs-center range-lg-left">
                                    <div class="cell-sm-5 cell-md-10 cell-lg-5">
                                        <img src="/images/corona-sunsets-index-event.jpg" width="320" height="442" alt="Corona sunsets Tulum" class="img-responsive">
                                    </div>
                                    <div class="cell-sm-6 cell-md-10 cell-lg-6 offset-md-top-30 offset-lg-top-0">
                                        <!-- List Inline-->
                                        <ul class="list-inline list-inline-20">
                                            <li>
                                                <span class="icon icon-normal icon-sm mdi mdi-calendar text-bermuda text-middle"></span>
                                                <span class="text-middle inset-left-10">Junio, 17</span>
                                            </li>
                                            <li><span class="icon icon-normal icon-sm mdi mdi-clock text-bermuda text-middle"></span>
                                                <span class="text-middle inset-left-10">8:00pm</span>
                                            </li>
                                        </ul>
                                        <div class="offset-top-25">
                                            <h5>
                                                <a href="eventos-corona-sunsets.html">Corona Sunsets</a>
                                            </h5>
                                        </div>
                                        <div class="offset-top-25">
                                            <p>En esta edición, Corona Sunsets, se convertirá en una experiencia desde la llegada al festival con transporte exclusivo para sus asistentes.
                                                <span class="veil-md reveal-lg-inline">saliendo desde: Playa del Carmen 
                                                    y Tulum para Corona Sunsets Tulum y desde: Nuevo Vallarta para 
                                                    Corona Sunsets San Pancho.
                                                </span>
                                            </p>
                                        </div>

                                        <div class="offset-top-25">
                                            <a href="eventos-corona-sunsets.html" class="btn btn-width-175 btn-primary-outline">Más Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="events.html" class="btn btn-width-200 btn-bermuda offset-top-35 offset-md-top-65">Ver Todos Los Eventos</a>
                    </div>
                </div>
            </section>
    		<?php
    		$events = ob_get_contents();
    		ob_end_clean();
    		return $events;
    }
    
    public function getBlogIndex()
    {
    		ob_get_contents();
    		?>
    		<section class="section-80 section-md-120 bg-selago">
                <div class="inset-md-left-35 inset-xl-left-125 inset-md-right-35 inset-xl-right-125">
                    <div class="shell-wide shell-wide-custom">
                        <hr class="divider bg-bermuda">
                        <div class="offset-top-20">
                            <h3>Últimas Noticias</h3>
                        </div>
                        <div class="range range-xs-center range-lg-left text-left offset-top-35 offset-md-top-60">


                            <div class="cell-sm-10 cell-md-6 cell-lg-4 cell-xl-5">
                                <!-- Post Box-->
                                <div class="post-box shadow-drop post-box-max-width-none reveal-block">
                                    <div class="post-box-img-wrap">
                                        <a href="cooking-school-lazcano.html" class="thumbnail-robben">
                                            <span class="thumbnail-robben-img-wrap post-box-top-radius">
                                                <img src="/images/cocina-pueblito.jpg" width="320" height="442" alt="Cooking School Mayakoba" class="img-responsive center-block post-box-top-radius">
                                            </span>
                                        </a>
                                    </div>
                                    <div class="post-box-caption post-box-bottom-radius bg-white">
                                        <a href="cooking-school-lazcano.html" class="label-custom-wrap reveal-inline-block">
                                            <span class="label-custom label-bermuda">Where To Go Playa</span>
                                        </a>
                                        <h5 class="offset-top-15">
                                            <a href="cooking-school-lazcano.html">
                                            De chismosos en la cocina de Mayakoba - Cooking School
                                            </a>
                                        </h5>
                                        <p class="offset-top-20">
                                            Hemos ignorado una máxima popular de las cocinas mexicanas que dice que “no se puede echar chisme mientras se preparan los tamales”. Aquí sí se puede pese a que no preparamos tamales. Y es que la clase de comida prehispánica que imparte la chef Mónica Lazcano se presta para que ...
                                        </p>
                                        <!-- List Inline-->

                                    </div>
                                </div>
                            </div>




                            <div class="cell-sm-10 cell-md-6 cell-lg-4 cell-xl-3 offset-top-30 offset-md-top-5">
                                <div class="post-box shadow-drop post-box-max-width-none reveal-block">

                                    <div class="post-box-img-wrap">
                                        <a href="bronco-en-playa-del-carmen.html" class="thumbnail-robben">
                                            <span class="thumbnail-robben-img-wrap post-box-top-radius">
                                                <img src="/images/bronco-en-playa.jpg" width="320" height="442" alt="Where to go playa" class="img-responsive center-block post-box-top-radius">
                                            </span>
                                        </a>
                                    </div>

                                    <div class="post-box-caption post-box-top-radius post-box-bottom-radius bg-white">
                                        <a href="bronco-en-playa-del-carmen.html" class="label-custom-wrap reveal-inline-block">
                                            <span class="label-custom label-bermuda">Where To Go Playa</span>
                                        </a>
                                        <h5 class="offset-top-15">
                                            <a href="bronco-en-playa-del-carmen.html">
                                            Bronco, un sonido que no pasa de moda.
                                            </a>
                                        </h5>
                                        <p class="offset-top-20">Contentos por saber que están a escasos minutos de presenciar el concierto de Bronco, fans del grupo se preguntan y apuestan entre sí en torno a la canción que abrirá la presentación.
                                        </p>
                                        <!-- List Inline-->

                                    </div>
                                </div>

                            </div>



                            <div class="cell-sm-10 cell-md-6 cell-lg-4 cell-xl-3 offset-top-30 offset-md-top-5">
                                <div class="post-box shadow-drop post-box-max-width-none reveal-block">

                                    <div class="post-box-img-wrap">
                                        <a href="cooking-school-reposteria.html" class="thumbnail-robben">
                                            <span class="thumbnail-robben-img-wrap post-box-top-radius">
                                                <img src="/images/cocina-pueblito-karen.jpg" width="320" height="442" alt="Where to go playa" class="img-responsive center-block post-box-top-radius">
                                            </span>
                                        </a>
                                    </div>

                                    <div class="post-box-caption post-box-top-radius post-box-bottom-radius bg-white">
                                        <a href="cooking-school-reposteria.html" class="label-custom-wrap reveal-inline-block">
                                            <span class="label-custom label-bermuda">Where To Go Playa</span>
                                        </a>
                                        <h5 class="offset-top-15">
                                            <a href="cooking-school-reposteria.html">
                                            La repostería, un sorpresivo aprendizaje
                                            </a>
                                        </h5>
                                        <p class="offset-top-20">Contentos por saber que están a escasos minutos de presenciar el concierto de Bronco, fans del grupo se preguntan y apuestan entre sí en torno a la canción que abrirá la presentación.
                                        </p>
                                        <!-- List Inline-->

                                    </div>
                                </div>

                            </div>
                        </div>
                        <a href="noticias.html" class="btn btn-width-200 btn-primary offset-top-35 offset-md-top-65">Ver Todas las noticias</a> </div>
                </div>
            </section>
    		<?php
    		$blog = ob_get_contents();
    		ob_end_clean();
    		return $blog;
    }
    
	/**
	 * getSwipes
	 * 
	 * returns the sliders for the mainSection
	 * 
	 * @return string
	 */    	
	public function getSwipes()
	{
		ob_start();
		if ($this->data['mainSliders'])
		{
			foreach($this->data['mainSliders'] as $a)
			{
				$link = 'javascript:void(0)';
				if ($a['link'])
				$link = $a['link'];
				?>
				<div data-slide-bg="<?php echo $this->data['appInfo']['url']; ?>/media/sliders/front/<?php echo $a['name']; ?>" class="swiper-slide">
					<div class="swiper-slide-caption">
						<div class="inset-lg-left-35 inset-xl-left-125">
							<div class="shell-wide shell-wide-custom">
								<div class="range range-xs-center range-lg-left text-lg-left">
									<div class="cell-sm-10 cell-lg-7">
										<div class="reveal-inline-block text-top inset-left-10">
                                        	<h1><?php echo $a['title']; ?></h1>
                                        </div>
										<div class="reveal-inline-block text-top offset-top-10 offset-sm-top-15 inset-left-10">
											<h4 class="text-white"><?php echo $a['promos']; ?></h4>
										</div>
										
										<div class="offset-top-20">
											<?php 
				                            if ($a['link'])
				                            {
				                            	?>
											<a href="<?php echo $a['link']; ?>" class="btn btn-width-165 btn-bermuda">Leer m&aacute;s</a>
												<?php 
				                            }
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
			}
		}
		$slides = ob_get_contents();
		ob_end_clean();
		return $slides;
	}
    
	/**
	 * getVideosIndex
	 * 
	 * return the list of videos for the main section
	 * 
	 * @return string
	 */
	public function getVideosIndex()
	{
		ob_start();
		foreach ($this->data['lastTwoVideos'] as $video)
		{
			echo self::getIndexItemVideo($video);
		}
		$videolist = ob_get_contents();
		ob_end_clean();
		return $videolist;
	}
    
	/**
	 * getIndexItemVideo
	 * 
	 * return only one item for the main section videos, it's different from the 
	 * other videos
	 * 
	 * @return string
	 */
	public function getIndexItemVideo($video)
	{
		ob_start();
		$image = str_replace('2.jpg', 'mqdefault.jpg', $video['image']);
		?>
		<div class="item-video col-sm-6 col-lg-12 col-xs-12">
			<div class="thumb"> 
				<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" data-lightbox="iframe">
					<img src="<?php echo $image; ?>" 
							alt="<?php $video['title']; ?>"
							/>
				</a>
			</div>
			<div class="clr"></div>
			<a href="http://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>"
					target="_blank" 
					class="title swipebox-video">
				<?php echo $video['title']; ?>
			</a>
			<div class="clr"></div>
		</div>
		<?php	    
		$items = ob_get_contents();
		ob_end_clean();
		return $items;
	}
	
	/**
	 * getFacebookIndex
	 * 
	 * return the facebook bar for the index
	 * 
	 * @return string
	 */
	public function getFacebookIndex()
	{
		ob_start();
		?>
		<div id="fb-box-container">
		
		
			<div class="fb-page" 
			data-href="https://www.facebook.com/<?php echo $this->data['appInfo']['facebook']; ?>/" 
			data-tabs="timeline" 
			data-width="380" 
			data-height="470" 
			data-small-header="true" 
			data-adapt-container-width="true"
			 data-hide-cover="false" 
			 data-show-facepile="true">
				 <blockquote cite="https://www.facebook.com/wheretogoplayadelcarmen/" class="fb-xfbml-parse-ignore">
				 	<a href="https://www.facebook.com/wheretogoplayadelcarmen/">Where to GO Playa del Carmen</a>
				 </blockquote>
			 </div>
		</div>
		<?php 
		$facebookIndex = ob_get_contents();
		ob_end_clean();
		return $facebookIndex;
	}
    
	/**
	 * getTwitterIndex
	 * 
	 * returns the html for the twitter on the index
	 * 
	 * @return string
	 */
	public function getTwitterIndex()
	{
		ob_start();
		?>
		<div id="twitter-container">
		    <div class="clr"></div>
		    <div id="twitter">
			    <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/<?php $this->data['appInfo']['facebook']; ?>" data-widget-id="373534020283273216">
			    	Tweets by @<?php echo $this->data['appInfo']['facebook']; ?>
			    </a>
				<script>
					!function(d,s,id){
						var js,
						fjs=d.getElementsByTagName(s)[0],
						p=/^http:/.test(d.location)?'http':'https';
						if(!d.getElementById(id))
						{
							js=d.createElement(s);
							js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);
						}
					}(document,"script","twitter-wjs");
				</script>
		    </div><!-- /Twitter -->
	    </div>
        <?php
        $twitter_box = ob_get_contents();
        ob_end_clean();
        return $twitter_box;
    }
	
	/**
	 * getItemsPromoted
	 * 
	 * return the four manPromoted companies for show at the main section
	 * 
	 * @return string
	 */
    public function getItemsPromoted()
    {
    	ob_start();
    	foreach ($this->data['mainPromoted'] as $company)
    	{
    	?>
		
			<div class="cell-xs-5 cell-md-4 cell-lg-2 offset-top-60 offset-lg-top-0">
				<a href="/company/<?php echo $company['category_id']; ?>/<?php echo Tools::slugify($company['category_name']); ?>/<?php echo $company['company_id']; ?>/<?php echo Tools::slugify($company['name']); ?>/" class="reveal-inline-block">
					<!-- <p><?php echo $company['name']; ?></p> -->
					<?php
            			if (!$company['logo'])
            			{
            			?>
            			<img src="images/default_item_front.jpg" 
            			    alt="<?php echo $company['name']; ?>"
    			        />
            			<?php
            			}
            			else
            			{
            			?>
    			        <img src="<?php echo $this->data['appInfo']['url']; ?>/media/companies/logo/<?php echo $company['logo']; ?>" width="180" height="69" alt="<?php echo $company['name']; ?>" class="img-responsive center-block img-semi-transparent">
            			<?php
            			}
            		?>
				</a>
			</div>
    	<?php
    	}
    	$items = ob_get_contents();
    	ob_end_clean();
    	return $items;
    }
    
    /**
	 * getItemsPromoted
	 * 
	 * return the four manPromoted companies for show at the main section
	 * 
	 * @return string
	 */
    public function getIndexEvents()
    {
    	ob_start();
    	if ($this->data['events'])
    	foreach ($this->data['events'] as $company)
    	{
    	?>
    		<div class="col-md-3 col-sm-6 wow fadeInLeft">
    			<h3><?php echo Tools::formatMYSQLToFront($company['date']); ?></h3>
    			<?php
            		if (!$company['logo'])
            		{
            		?>
            		<img class="img-responsive" src="images/default_item_front.jpg" 
							alt="<?php echo $company['name']; ?>"
    			        	/>
            			<?php
            			}
            			else
            			{
            			?>
            			<img src="img-up/companies_pictures/logo/<?php echo $company['logo']; ?>" 
            			    alt="<?php echo $company['name']; ?>"
    			        />
            			<?php
            			}
            		?>
				<h4 class="event-title"><a href="index.html#"><?php echo $company['name']; ?></a></h4>
				<p class="offset-7 inset-2">
					<?php echo $company['description']; ?>
				</p>
				<!-- <a class="btn btn-xs btn-primary-1" href="/company/<?php echo $company['category_id']; ?>/<?php echo Tools::slugify($company['category_name']); ?>/<?php echo $company['company_id']; ?>/<?php echo Tools::slugify($company['name']); ?>/">Leer m&aacute;s <span class="material-icons-chevron_right"></span></a> -->
			</div>
    	<?php
    	}
    	$items = ob_get_contents();
    	ob_end_clean();
    	return $items;
    }
    
    
    
    /**
     * getCoverHead
     * 
     * returns the header content for the view of categories and subcategories
     * 
     * @param string $css
     * @param string $js
     * @return string
     */
    public function getCoverHead()
    {
    	ob_start();
    	?>
		<title><?php echo $this->data['categoryInfo']['name']; ?> <?php echo $this->data['subcategoryInfo']['name']; ?> | <?php echo $this->data['appInfo']['title']; ?> </title>
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>, <?php echo $this->data['categoryInfo']['name'].' '.$this->data['subcategoryInfo']['name']; ?>" />
		<?php
		if (isset($this->data['categoryInfo']['description']))
		{
			if (isset($subcategory['description']))
			{
			?>
		<meta name="description" content="<?php echo $subcategory['description']; ?>">
			<?php
			}
			else
			{
			?>
		<meta name="description" content="<?php echo $this->data['categoryInfo']['description']; ?>">
			<?php
			}
		}
		else
		{
		?>
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<?php
		}
		?>	
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
		<?php
		$head = ob_get_contents();
		ob_end_clean();
		return $head;
	}   
	
	/**
	 * getCoverContent
	 * 
	 * it's basically the grid for the cover section
	 * 
	 * @return string
	 */
	public function getCoverContent()
	{
		ob_start();
		echo self::getCommonHeader();
		?>
		<!--========================================================
                              CONTENT
    	=========================================================-->
	    <main class="page-content">
	    	<?php echo self::getGridCompanies(); ?>
        </main>
		<?php
		$coverBody = ob_get_contents();
		ob_end_clean();
		return $coverBody;
	}
	
	/**
	 * getGridCompanies
	 * 
	 * companies grid, depending of category, subcategory or location
	 * 
	 * @return string
	 */
	
	public function getGridCompanies()
	{
		ob_start();
		?>
		<!-- Index list -->
        <section class="text-center">
			<?php
			if (isset($this->data['categoryInfo']))
			{
			?>
			<h3>
				<a href="/<?php echo $this->data['categoryInfo']['category_id'].'/'.Tools::slugify($this->data['categoryInfo']['name']); ?>/">
					<?php echo $this->data['categoryInfo']['name']; ?> en <?php echo $this->data['appInfo']['location']; ?>
				
				<?php 
				if(isset($this->data['subcategoryInfo']))
				{
					?>
					 / <?php echo $this->data['subcategoryInfo']['name']; ?>
					<?php
				}
				?>
				</a>
			</h3>
			<div class="clr"></div>
			<h4><?php echo $this->data['appInfo']['siteName']; ?></h4>
			<?php	
			}

			if (isset($this->data['locationInfo']['name']))
			{
			?>
			<h3>
				<a href="/location/<?php echo $this->data['locationInfo']['location_id'].'/'.Tools::slugify($this->data['locationInfo']['name']); ?>/">
					<?php echo $this->data['locationInfo']['name']; ?>
				</a>
			</h3>
				
			<div class="clr"></div>
			<h4><?php echo $this->data['appInfo']['siteName']; ?></h4>
			<?php	
			}
			?>
			<ul class="row row-no-gutter index-list">
			<?php
			foreach ($this->data['companies'] as $company)
			{
				?>
				<li class="col-md-3 col-sm-3">
					<?php 
						/*if ($c['closed'] == 1) 
						{
							?>
						<div class="closed">closed</div>
							<?php 
						}*/
 
						$link = '';
						if (isset($this->data['subcategoryInfo'])) 
						{
							$link = "/company/".$company['category_id']."/".Tools::slugify($company['category'])."/".$this->data['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['subcategoryInfo']['name'])."/".$company['company_id']."/".Tools::slugify($company['name'])."/";
						} else if (isset($this->data['section']) == 'allEvents' && isset($this->data['events'])) {
							$link = "/events/".$company['company_id']."/".Tools::slugify($company['company_name'])."/".Tools::slugify($c['date'])."/".$c['event_id']."/".Tools::slugify($c['name'])."/"; 
						} else {
							$link = "/company/".$company['category_id']."/".Tools::slugify($company['category'])."/".$company['company_id']."/".Tools::slugify($company['name'])."/";
						}
						?>
					<?php if (isset($company['date'])) { ?><div class="date"><?php echo Tools::formatMYSQLToFront($c['date']); ?></div><?php } ?>
					<div class="img-box">
						<a href="<?php echo $link; ?>">
	            		<?php
	            			if (!$company['logo'])
	            			{
	            			?>
	            			<img src="/images/default_item_front.jpg" 
	            			    alt="<?php echo $company['name']; ?>"
	    			        />
	            			<?php
	            			}
	            			else
	            			{
	            			?>
	            			<img src="/img-up/companies_pictures/logo/<?php echo $company['logo']; ?>" 
	            			    alt="<?php echo $company['name']; ?>"
	    			        />
	            			<?php
	            			}
	            		?>
            			</a>
    				</div>
					<h4><?php echo $company['name']; ?></h4>
					<p>
						<?php echo $company['description']; ?>
					</p>
					<a class="btn btn-xs btn-primary-1" href="<?php echo $link; ?>">Leer m&aacute;s <span class="material-icons-chevron_right"></span></a>
				</li>
				<?php
			}
			?>
			</ul>
		</section>
		<?php
		$gridCompanies = ob_get_contents();
		ob_end_clean();
		return $gridCompanies;
	}
	
	/**
	 * getMenuLeft
	 * 
	 * this is the menu that shows the subcategories
	 * 
	 * @return string
	 */
	public function getMenuLeft()
	{
		ob_start();
		?>
		<div id="menu-left">
			<?php
			if ($this->data['subcategories'])
			{
			?>	
			<div id="subcategories_list">
				<ul>
					<?php					
					foreach ($this->data['subcategories'] as $s)
					{ 
					?>
					<li>
						<a href="/<?php echo $this->data['categoryInfo']['category_id'].'/'.Tools::slugify($this->data['categoryInfo']['name']).'/'.$s['subcategory_id'].'/'.Tools::slugify($s['name']); ?>/">
							<?php echo $s['name']; ?>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}
			 
			if ($this->data['locationInfo'])
			{
			?>	
			<div id="subcategories_list">
				<ul>
					<?php					
					foreach ($this->data['categories'] as $c)
					{ 
					?>
					<li>
						<a href="/<?php echo $c['category_id'].'/'.Tools::slugify($c['name']); ?>/">
							<?php echo $c['name']; ?>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}
		
			if ($this->data['section'] == 'other')
			{
			?>
			<div id="subcategories_list" class="other-option-menu">
				<ul>
					<?php					
					foreach ($this->data['categories'] as $c)
					{ 
					?>
					<li>
						<a href="/<?php echo $c['category_id'].'/'.Tools::slugify($c['name']); ?>/">
							<?php echo $c['name']; ?>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}

			if ($this->data['section'] == 'allEvents' && $this->data['events'])
			{
				?>
			<div id="subcategories_list" class="other-option-menu">
				<ul>
				<?php 
				foreach ($this->data['events'] as $years)
				{
					?>
					<li class="year">
					<?php echo $years['year']; ?>
						<ul class="month">
						<?php 
						foreach ($years['months'] as $months)
						{
							?>
							<li>
							<?php echo $months['month']; ?>
								<ul class="day">
								<?php 
								foreach ($months['events'] as $events)
								{
									?>
									<li>
										&raquo; 
										<a href="/events/<?php echo $events['belong_company']; ?>/<?php echo Tools::slugify($events['company_name']); ?>/<?php echo Tools::slugify($events['date']); ?>/<?php echo $events['company_id']; ?>/<?php echo Tools::slugify($events['name']); ?>/">
											<?php echo $events['name']; ?>
										</a>
									</li>
									<?php
								}
								?>
								</ul>
							</li>
							<?php
						}
						?>
						</ul>
					</li>
					<?php
				}
				?>
				</ul>
			</div>
				<?php
			}
			?>
		</div>
		<?php
		$menuLeft = ob_get_contents();
		ob_end_clean();
		return $menuLeft;
	}
	
	/**
	 * getCompanyHead
	 * 
	 * Returns the header for th company section, the script on it it's for the maps
	 * which i cannot embeb in a diferent js document, by now, btw.
	 * 
	 * @return string
	 */
	public function getCompanyHead()
	{
		ob_start();
		?>
		<title><?php echo $this->data['company']['seo']['title']; ?> | <?php echo $this->data['appInfo']['title']; ?></title>
		<meta name="keywords" content="<?php echo $this->data['company']['seo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['company']['seo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
		<?php
		if (is_numeric($this->data['company']['general']['latitude']) && is_numeric($this->data['company']['general']['longitude']))
		{
			if ($this->data['company']['general']['latitude'] !=  0 && $this->data['company']['general']['longitude'] != 0)
			{
			?>
			<?php
			}
		}

        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }
	
    
    /**
     * getCompanyContent
     * 
     * this section returs the content for the map section, it is a listing pins 
     * of all the companies that has their location 
     * 
     * @return string
     */
	public function getCompanyContent()
	{
		ob_start();
		echo self::getCommonHeader();
		?>
		<?php echo self :: getCompanyArticle(); ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	/**
	 * getCompanyArticle
	 * 
	 * returns the left section of the company, is where the slider, content and
	 * gallery are located
	 * 
	 * @return string
	 */
	public function getCompanyArticle()
	{
		ob_start();
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/mx_MX/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		  $('.messageBody').attr('color', '#fff');
		}(document, 'script', 'facebook-jssdk'));</script>
		<!--========================================================
                              CONTENT
	    =========================================================-->
	    <main class="page-content">
		    <!-- Blog -->
	        <section class="well-xl-15 hr text-center text-sm-left">
	            <div class="container">
	                <h3 class="text-line-2 text-default-3"><?php echo $this->data['company']['general']['name']; ?></h3>
	                <p class="views">
						<span>
							<?php echo $this->data['company']['general']['category_name']; ?>
							<?php 
							if ($this->data['company']['subcategoryInfo'])
							{
								echo " / ".$this->data['company']['subcategoryInfo']['name'];
							}
							
							if (isset($this->data['event']['detail']))
							{
								echo Tools::formatMYSQLToFront($this->data['event']['detail']['date']);
								if ($this->data['event']['detail']['date'].' hrs')
									echo ' / '.Tools::formatHourMYSQLToFront($this->data['event']['detail']['time']);
							}
							?> 
						</span>
					</p>
	                
	                <ul class="list-2">
	                    <li>
	                    	<section>
					            <!-- Swiper -->
					            <div class="swiper-container swiper-slider" data-height="45%" data-min-height="200px" data-autoplay="false" data-loop="true">
					                <div class="swiper-wrapper text-center">
				                	<?php			
									if ($this->data['company']['sliders'])
									{
										foreach($this->data['company']['sliders'] as $s)
										{
										?>
										<div class="swiper-slide" data-slide-bg="/img-up/companies_pictures/sliders/<?php echo $s['slider']; ?>" alt="<?php echo $this->data['company']['general']['name']; ?>" title="<?php echo $this->data['company']['general']['name']; ?>"></div>
										<?php
										}
									}
									?>
					                </div>
					                <!-- Slider Navigation -->
					                <div class="swiper-button-prev"></div>
					                <div class="swiper-button-next"></div>
					            </div>
					            <!-- END Swiper -->
					        </section>
	                        <h4><?php echo $this->data['company']['general']['name']; ?></h4>
	                        <div>
	                            <!-- <time datetime="2011-11"><span class="fa fa-calendar"></span><a href="index-4.html#">June 13, 2016</a>
	                            </time> -->
	                            <?php if ($this->data['company']['social']['facebook']){ ?><p><span class="fa-facebook-square"></span><a href="https://www.facebook.com/<?php echo $this->data['company']['social']['facebook']; ?>" target="_blank">Facebook</a></p><?php } ?>
	                            <?php if ($this->data['company']['social']['tuit_url']){ ?><p><span class="fa-twitter"></span><a href="https://twitter.com/<?php echo $this->data['company']['social']['tuit_url']; ?>" target="_blank">Twitter</a></p><?php } ?>
	                            <?php if ($this->data['company']['social']['tripadvisor']){ ?><p><span class="fa-tripadvisor"></span><a href="https://www.tripadvisor.com/<?php echo $this->data['company']['social']['tripadvisor']; ?>" target="_blank">Tripadvisor</a></p><?php } ?>
	                            <?php if ($this->data['company']['general']['website']){ ?><p><span class="fa-globe"></span><a href="<?php echo $this->data['company']['general']['website']; ?>" target="_blank">Website</a></p><?php } ?>
	                            <?php 
	                            foreach ($this->data['company']['emails'] as $email)
	                            {
	                            	?>
	                            <p><span class="fa-at"></span><a href="mailto:<?php echo $email['e_mail']; ?>" target="_blank"><?php echo $email['e_mail']; ?></a></p>
	                            	<?php
	                            }
	                            ?>
	                            <?php 
	                            foreach ($this->data['company']['phones'] as $phone)
	                            {
	                            	?>
	                            <p><span class="fa-phone"></span><a href="tel:<?php echo $phone['telephone']; ?>" target="_blank"><?php echo $phone['telephone']; ?></a></p>
	                            	<?php
	                            }
	                            ?>
	                        </div>
	                        
	                        <p><?php echo stripslashes($this->data['company']['general']['description']); ?></p>
	                    </li>
	                </ul>
	            </div>
	        </section>
	        <!-- END Blog -->
	        <!-- Marketing services -->
	        <section class="well-xl-7 text-center text-md-left">
	            <div class="container">
	                <div class="row offset-6" data-lightbox="gallery" >
	                	<?php
						foreach($this->data['company']['gallery'] as $g)
						{
						?>
							<div class="col-md-3 col-sm-6 wow fadeInLeft">
								<a href="/img-up/companies_pictures/original/<?php echo $g['picture']; ?>"  data-lightbox="image" class="thumb thumb-size">
		                        	<img width="270" height="268" alt="<?php echo $this->data['company']['general']['name']; ?>" src="/img-up/companies_pictures/galery/<?php echo $g['picture']; ?>">
		                        	<span class="thumb__overlay"></span>
		                        </a>
		                    </div>
						<?php
						}
						?>
	                </div>
	            </div>
	        </section>
	        
	        <!-- What we do -->
	        <section class="well-xl-4 hr text-center text-sm-left">
	            <div class="container">
	                <div class="row offset-6">
	                	<div class="col-md-4 col-sm-6 offset-2">
	                        <?php 
							if ($this->data['company']['subcategoryInfo'])
							{
								$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$this->data['company']['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['company']['subcategoryInfo']['name'])."/";
								?>
							<ul class="marked-list">
								<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="<?php echo $link; ?>">
									<h4><?php echo $this->data['company']['subcategoryInfo']['name']; ?></h4>
								</a>
								<?php
								foreach ($this->data['companies'] as $c)
								{
									$link = "/company/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$this->data['company']['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['company']['subcategoryInfo']['name'])."/".$c['company_id']."/".Tools::slugify($c['name'])."/";
								?>
								<li><a href="<?php echo $link; ?>"><?php echo $c['name']; ?></a></li>
								<?php 
								}
								?>
							</ul>
								<?php
							}
							?>
							
							<?php 
							if ($this->data['subcategories'])
							{
								$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/";
								?>
							<ul class="marked-list">
								<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="<?php echo $link; ?>">
									<h4><?php echo $this->data['company']['general']['category_name']; ?></h4>
								</a>
								<?php
								foreach ($this->data['subcategories'] as $s)
								{
									$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$s['subcategory_id']."/".Tools::slugify($s['name'])."/";
								?>
								<li><a href="<?php echo $link;?>"><?php echo $s['name']; ?></a></li>
								<?php 
								}
								?>
							</ul>
								<?php
							}
							?>
	                    </div>
	                	
	                    <div class="col-md-4 col-sm-6 offset-8">
	                        <img width="270" height="268" alt="" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']; ?>">
	                        <h4><a href="index.html#">Cont&aacute;cto</a></h4>
	                        <p class="offset-7 inset-2">
	                            <?php echo stripslashes($this->data['company']['seo']['description']); ?>
	                        </p>
	                        <br />
	                        <?php if ($this->data['company']['general']['website']){ ?><p><span class="fa-globe"></span> <a href="<?php echo $this->data['company']['general']['website']; ?>" target="_blank"><?php echo $this->data['company']['general']['website']; ?></a></p><?php } ?>
                            <?php 
                            foreach ($this->data['company']['emails'] as $email)
                            {
                            	?>
                            <p><span class="fa-at"></span> <a href="mailto:<?php echo $email['e_mail']; ?>" target="_blank"><?php echo $email['e_mail']; ?></a></p>
                            	<?php
                            }
                            ?>
                            <?php 
                            foreach ($this->data['company']['phones'] as $phone)
                            {
                            ?>
                            <p><span class="fa-phone"></span> <a href="tel:<?php echo $phone['telephone']; ?>" target="_blank"><?php echo $phone['telephone']; ?></a></p>
                            <?php
                            }
	                        ?>
	                    </div>
	                    <?php
						if ($this->data['company']['social']['facebook'])
						{
						?>
	                    <div class="col-md-4 col-sm-6 wow fadeInLeft">
							<div class="fb-like-box" id="facebook-companies" data-href="http://www.facebook.com/<?php echo $this->data['company']['social']['facebook']; ?>"
									data-width="300" data-height="400" data-show-faces="true"
									data-colorscheme="dark" style="background-color: #373737;" 
									data-stream="true" data-show-border="false" data-header="false">
							</div>
	                    </div>
	                    <?php	
						}
						?>
	                </div>
	            </div>
	        </section>
	        <!-- END What we do -->
	        
	        <!-- END Marketing services -->
	    	<?php
			if (is_numeric($this->data['company']['general']['latitude']) && is_numeric($this->data['company']['general']['longitude']))
			{
				if ($this->data['company']['general']['latitude'] !=  0 && $this->data['company']['general']['longitude'] != 0)
				{
			?>
	    	<!-- RD Google Map -->
	        <section>
	            <div class="rd-google-map">
	                <div id="google-map" class="rd-google-map__model" data-zoom="18" data-x="<?php echo $this->data['company']['general']['longitude']; ?>"
	                     data-y="<?php echo $this->data['company']['general']['latitude']; ?>"></div>
	                <ul class="rd-google-map__locations">
	                	<li data-x="<?php echo $this->data['company']['general']['longitude']; ?>" data-y="<?php echo $this->data['company']['general']['latitude']; ?>">
	                		<div class="map-info-item">
	                			<div class="map-info-image">
	                				<a href="/company/<?php echo $this->data['company']['general']['category'].'/'.Tools::slugify($this->data['company']['general']['category_name']).'/'.$this->data['company']['general']['company_id'].'/'.Tools::slugify($this->data['company']['general']['name']).'/'; ?>">
								    	<img alt="<?php echo $name; ?>" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']; ?>">
								    </a>
	                			</div>
	                			<div class="map-info">
	                				<a href="/company/<?php echo $this->data['company']['general']['category'].'/'.Tools::slugify($this->data['company']['general']['category_name']).'/'.$this->data['company']['general']['company_id'].'/'.Tools::slugify($this->data['company']['general']['name']).'/'; ?>">
	                					<h4><?php echo $this->data['company']['seo']['title']; ?></h4>
	                				</a>
	                				<a href="/company/<?php echo $this->data['company']['general']['category'].'/'.Tools::slugify($this->data['company']['general']['category_name']).'/'.$this->data['company']['general']['company_id'].'/'.Tools::slugify($this->data['company']['general']['name']).'/'; ?>">
	                					<?php echo trim(preg_replace('/\s+/', ' ',str_replace(array("'"), "",$this->data['company']['seo']['description']))); ?>
	                				</a>
	                			</div>
	                		</div>
	                    </li>
	                </ul>
	            </div>
	        </section>
	        <!-- END RD Google Map -->
	        <?php 
				}
			}
			?>
		</main>
		<?php
		$article = ob_get_contents();
		ob_end_clean();
		return $article;
	}
	
	/**
	 * getSideBar
	 * 
	 * is the right section of the company content, where is the logo, networks, contact
	 * and others... 
	 * 
	 * @return string
	 */
	public function getSideBar()
	{
		ob_start();
		?>
		<aside class="tip-sidebar">
			<div class="user-box">
				<div class="team-box" >
					<div class="image-top">
						<img alt="<?php echo $this->data['company']['general']['name']; ?>" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']; ?>" />
					</div>
				</div>
				<p class="bio">
					<?php echo $this->data['company']['seo']['title']; ?>
				</p>
				<p class="bio">
					<?php echo stripslashes($this->data['company']['seo']['description']); ?>
				</p>
			</div><!-- /user-box -->
			<div class="side-btm">
				<?php 
				if ($this->data['events'])
				{
					?>
				<div class="events-list">
					<h3>Events</h3>
					<ul>
					<?php 
					foreach ($this->data['events'] as $years)
					{
						?>
						<li class="year">
						<?php echo $years['year']; ?>
							<ul class="month">
							<?php 
							foreach ($years['months'] as $months)
							{
								?>
								<li>
								<?php echo $months['month']; ?>
									<ul class="day">
									<?php 
									foreach ($months['events'] as $events)
									{
										?>
										<li>&raquo; 
											<a href="/events/<?php echo $events['company_id']; ?>/<?php echo Tools::slugify($events['name']); ?>/<?php echo Tools::slugify($events['date']); ?>/<?php echo $events['event_id']; ?>/<?php echo Tools::slugify($events['name']); ?>/">
												<?php echo $events['name']; ?>
											</a>
										</li>
										<?php
									}
									?>
									</ul>
								</li>
								<?php
							}
							?>
							</ul>
						</li>
						<?php
					}
					?>
					</ul>
				</div>
					<?php
				}
				?>
				
				<h3>Networks</h3>
				<ul class="side-bar-list side-bar-networks">
					<div class="clr"></div>
					
					<nav class="social-networks-box">
						<ul>
							<?php 
							if ($this->data['company']['social']['facebook'])
							{
								?>
							<li>
								<a href="http://www.facebook.com/<?php echo $this->data['company']['social']['facebook']; ?>/" target="_blank">
									<img src="/images/facebook.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Facebook">
								</a>
							</li>
								<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['social']['tuit_url'])
							{
								?>
							<li>
								<a href="http://www.twitter.com/<?php echo $this->data['company']['social']['tuit_url']; ?>/" target="_blank">
									<img src="/images/twitter.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Twitter">
								</a>
							</li>
								<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['social']['youtube'])
							{
								?>
							<li>
								<a href="http://www.youtube.com/user/<?php echo $this->data['company']['social']['facebook']; ?>/" target="_blank">
									<img src="/images/youtube.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Youtube">
								</a>
							</li>
								<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['social']['pinterest'])
							{
								?>
							<li>
								<a href="http://www.pinterest.com/<?php echo $this->data['company']['social']['pinterest']; ?>/" target="_blank">
									<img src="/images/pinterest.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Pinterest">
								</a>
							</li>
								<?php 
							}
							?>

							<?php 
							if ($this->data['company']['social']['instagram'])
							{
								?>
							<li>
								<a href="http://instagram.com/<?php echo $this->data['company']['social']['instagram']; ?>/" target="_blank">
									<img src="/images/instagram.png" alt="<?php echo $this->data['company']['general']['name']; ?> - Instagram">
								</a>
							</li>
								<?php 
							}
							?>
							
							<div class="clr"></div>
						</ul>
					</nav>
				
					<div class="clr"></div>
					<?php
					if ($this->data['company']['social']['facebook'])
					{
					?>
					<div class="fb-like-box" id="facebook-companies" data-href="http://www.facebook.com/<?php echo $this->data['company']['social']['facebook']; ?>"
							data-width="244" data-height="350" data-show-faces="true"
							data-colorscheme="dark" style="background-color: #373737;" 
							data-stream="true" data-show-border="false" data-header="false">
					</div>
					<?php	
					}
					?>
				</ul>
				<div class="team-box">
					<div class="image-top">
						<img alt="<?php echo $this->data['company']['seo']['title']; ?>" src="/img-up/companies_pictures/sliders/<?php echo $this->data['company']['lastSlider']; ?>">
					</div>
					<div class="content">
						<h4>Contact Info</h4>
						<?php 
						foreach ($this->data['company']['emails'] as $e)
						{
						?>
						<p><?php echo $e['e_mail']; ?></p>
						<?php
						}
							    						
						foreach ($this->data['company']['phones'] as $p)
						{
						?>
						<a href="tel:<?php echo $p['telephone']; ?>" ><?php echo $p['telephone']; ?></a>
						<div class="clr"></div>
						<?php
						}
						?>
						
						<a href="<?php echo $this->data['company']['general']['website']; ?>" target="_blank" >
							<?php echo $this->data['company']['general']['website']; ?>
						</a>
						<div class="clr"></div>
					</div>
				</div>
				
				<?php 
				if ($this->data['company']['subcategoryInfo'])
				{
					$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$this->data['company']['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['company']['subcategoryInfo']['name'])."/";
					?>
				<ul class="companies-list">
					<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="<?php echo $link; ?>">
						<?php echo $this->data['company']['subcategoryInfo']['name']; ?>
					</a>
					<?php
					foreach ($this->data['companies'] as $c)
					{
						$link = "/company/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$this->data['company']['subcategoryInfo']['subcategory_id']."/".Tools::slugify($this->data['company']['subcategoryInfo']['name'])."/".$c['company_id']."/".Tools::slugify($c['name'])."/";
					?>
					<li><a href="<?php echo $link; ?>">&raquo; <?php echo $c['name']; ?></a></li>
					<?php 
					}
					?>
				</ul>
					<?php
				}
				?>
				
				<?php 
				if ($this->data['subcategories'])
				{
					$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/";
					?>
				<ul class="companies-list">
					<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="<?php echo $link; ?>">
						<?php echo $this->data['company']['general']['category_name']; ?>
					</a>
					<?php
					foreach ($this->data['subcategories'] as $s)
					{
						$link = "/".$this->data['company']['general']['category']."/".Tools::slugify($this->data['company']['general']['category_name'])."/".$s['subcategory_id']."/".Tools::slugify($s['name'])."/";
					?>
					<li><a href="<?php echo $link;?>">&raquo; <?php echo $s['name']; ?></a></li>
					<?php 
					}
					?>
				</ul>
					<?php
				}
				?>
				
				<?php 
				if ($this->data['categories'])
				{
					?>
				<ul class="companies-list">
					<a class="feature-jobs track" data-action="upgrade team" data-from="protip page" href="/">
						Find more
					</a>
					<?php
					foreach ($this->data['categories'] as $c)
					{
						$link = "/".$c['category_id']."/".Tools::slugify($c['name'])."/";
					?>
					<li><a href="<?php echo $link;?>">&raquo; <?php echo $c['name']; ?></a></li>
					<?php 
					}
					?>
				</ul>
					<?php
				}
				?>
			</div> <!-- /side-btm -->
		</aside><!-- right side -->
		<?php
		$sideBar = ob_get_contents();
		ob_end_clean();
		return $sideBar;
	}
	
    /**
     * getMapHead
     * 
     * is the head section for the maps, it also generates an script for the map 
     * array, and calls the globe.
     * 
     * @return string
     */        
	public function getMapHead()
	{
		ob_start();
		?>
		
		<title><?php echo $this->data['appInfo']['title']; ?> | Map of the companies</title>
		
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }	
	
    /**
     * getMapContent
     * 
     * it returns the HTML string for the map section
     * 
     * @return string
     */
    public function getMapContent()
    {
    	ob_start();
    	echo self::getCommonHeader();
    	?>
    	<main class="page-content">
    		<!-- About us -->
	        <section class="well-xl">
	            <div class="container text-center">
	                <h2 class="text-line"><?php echo $this->data['appInfo']['siteName']; ?></h2>
	                <p class="$default-7 font-size-1 offset-1">
	                    <?php echo $this->data['appInfo']['description']; ?>
	                </p>
	            </div>
	        </section>
	        <!-- END About us -->
    		<!-- RD Google Map -->
	        <section>
	            <div class="rd-google-map">
	                <div id="google-map" class="rd-google-map__model" data-zoom="16" data-x="-87.069887"
	                     data-y="20.631863"></div>
	                <ul class="rd-google-map__locations">
	                	<?php 
	                	foreach ($this->data['companies'] as $company)
	                	{
	                		?>
	                	<li data-x="<?php echo $company['longitude']; ?>" data-y="<?php echo $company['latitude']; ?>">
	                		<div class="map-info-item">
	                			<div class="map-info-image">
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
								    	<img alt="<?php echo $name; ?>" src="/img-up/companies_pictures/logo/<?php echo $company['logo']; ?>">
								    </a>
	                			</div>
	                			<div class="map-info">
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
	                					<h4><?php echo $company['name']; ?></h4>
	                				</a>
	                				<a href="/company/<?php echo $company['category'].'/'.Tools::slugify($company['category_name']).'/'.$company['company_id'].'/'.Tools::slugify($company['name']).'/'; ?>">
	                					<?php echo trim(preg_replace('/\s+/', ' ',str_replace(array("'"), "",$company['seo_description']))); ?>
	                				</a>
	                			</div>
	                		</div>
	                    </li>
	                		<?php
	                	}
	                	?>
	                </ul>
	            </div>
	        </section>
	        <!-- END RD Google Map -->
    	</main>
    	<?php
    	$coverBody = ob_get_contents();
    	ob_end_clean();
    	return $coverBody;
    }
    
    /**
     * getVideosHead
     *
     * is the head section for the videos
     *
     * @return string
     */
    public function getVideosHead()
    {
    	ob_start();
    	?>
    	<title><?php echo $this->data['appInfo']['title']; ?> | Videos</title>
    	
    	<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
    	<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
    	<meta property="og:type" content="website" /> 
    	<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
    	<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
    	<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
    	<?php echo self::getCommonDocuments(); ?>
    	<?php echo self::getGoogleAnalytics(); ?>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }	
	
    /**
     * getVideosContent
     *
     * it's basically the grid for the videos section
     *
     * @return string
     */
    public function getVideosContent()
    {
    	ob_start();
    	echo self::getCommonHeader();
    	?>
    	<main class="page-content">
    		<?php echo self :: getVideos(); ?>
    	</main>
    	<?php
    	$coverBody = ob_get_contents();
    	ob_end_clean();
    	return $coverBody;
   	}
    
   	/**
   	 * getVideos
   	 * 
   	 * return an array with all the videos published, ASC order
   	 * 
   	 * @return string
   	 */
	public function getVideos()
	{
		ob_start();
		?>
		<!-- Recent news -->
        <section class="well-xl-7 text-center text-md-left">
            <div class="container">
                <h3 class="text-line-3 text-center"><?php echo $this->data['appInfo']['siteName']; ?></h3>
                <div class="row offset-6">
                	<?php 
					foreach ($this->data['videos'] as $video)
					{
						$image = str_replace('2.jpg', 'mqdefault.jpg', $video['image']);
					?>
                    <div class="col-md-3 wow fadeInLeft video-box">
                    	<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" data-lightbox="iframe">
                        	<img width="370" height="328" alt="" src="<?php echo $image; ?>">
                        </a>
                        <h4 class="offset-19"><a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" data-lightbox="iframe"><?php echo $video['title']; ?></a></h4>
                        <p class="offset-20 font-size-5">
                            <?php echo $video['content']; ?>
                        </p>
                    </div>
                    <?php 
					}
                    ?>
                </div>
            </div>
        </section>
        <!-- END Recent news -->
		<?php	    
		$videos = ob_get_contents();
		ob_end_clean();
		return $videos;
	}

	/**
	 * getVideosHead
	 *
	 * is the head section for the videos
	 *
	 * @return string
	 */
	public function getContactHead()
	{
		ob_start();
		?>
    	<title><?php echo $this->data['appInfo']['title']; ?> | Contact</title>
    	
    	<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
    	<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
    	<meta property="og:type" content="website" /> 
    	<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
    	<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
    	<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
    	<?php echo self::getCommonDocuments(); ?>
    	<?php echo self::getGoogleAnalytics(); ?>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }
    
    /**
     * getContactContent
     *
     * it's basically the grid for the contact section
     *
     * @return string
     */
    public function getContactContent()
    {
    	ob_start();
    	?>
       	<?php echo self :: getBackground(); ?>	
       	<div id="main-grid" class='inside cf'>
       		<div class="main-wrapper-bg" style="">
       			<?php echo self :: getMenuLeft(); ?>
       			<?php echo self :: getContactForm(); ?>
       		</div>
       		<div class="clear"></div>
       	</div>
       	<?php
       	$coverBody = ob_get_contents();
       	ob_end_clean();
       	return $coverBody;
    }
	
    /**
     * getContactForm
     * 
     * the contact form
     * 
     * @return string
     */
    public function getContactForm()
    {
    	ob_start();
    	?>
        <div id="main_contents">
			<h1>
				<a href="/videos/">
					Contact Us
				</a>
			</h1>
			<div class="clr"></div>
			<h3><?php echo $this->data['appInfo']['siteName']; ?></h3>
			
			<div class="clr"></div>
    		<div id="contact_box">
    			<form id="contact-form">
					<div class="success-message">Contact form submitted! <strong>We will be in touch soon.</strong></div>
					<div class="wrapper">
						<label class="name">
							<input id="name" type="text" placeholder="Name*:" data-constraints="@Required @JustLetters" />
							<span class="empty-message">*This field is required.</span>
							<span class="error-message">*This is not a valid name.</span>
						</label>
						<label class="email">
							<input id="email" type="text" placeholder="Email*:" data-constraints="@Required @Email" />
							<span class="empty-message">*This field is required.</span>
							<span class="error-message">*This is not a valid email.</span>
						</label>
						<label class="phone">
							<input id="phone" type="text" placeholder="Phone:" data-constraints="@Required @JustNumbers"/>
							<span class="empty-message">*This field is required.</span>
							<span class="error-message">*This is not a valid phone.</span>
						</label>
					</div>
					<label class="message">
						<textarea id="message" placeholder="Message:" data-constraints='@Required @Length(min=20,max=999999)'></textarea>
						<span class="empty-message">*This field is required.</span>
						<span class="error-message">*The message is too short.</span>
					</label>
					<div  class="form_btns">
						<a href="/#" data-type="reset" class="more_btn">clear</a>
						<a href="/#" data-type="submit" class="more_btn">submit</a>
					</div>  
					<div class="clr"></div>
				</form>
    		</div>
    	</div><!-- main sections -->
    	<div class="clr"></div>
        <?php
       	$contactForm = ob_get_contents();
       	ob_end_clean();
    	return $contactForm;
    }
    
	/**
	 * getSearchHead
	 *
	 * is the head section for the videos
	 *
	 * @return string
	 */
	public function getSearchHead()
	{
		ob_start();
		?>
    	<title><?php echo $this->data['appInfo']['title']; ?> | Search</title>
    	
    	<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
    	<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
    	<meta property="og:type" content="website" /> 
    	<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
    	<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
    	<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
    	<?php echo self::getCommonDocuments(); ?>
    	<?php echo self::getGoogleAnalytics(); ?>
        <?php
        $head = ob_get_contents();
        ob_end_clean();
        return $head;
    }

    /**
     * getCompanyContent
     *
     * this section returs the content for the map section, it is a listing pins
     * of all the companies that has their location
     *
     * @return string
     */
    public function getSearchContent()
    {
    	ob_start();
    	?>
    	<?php echo self :: getBackground(); ?>	
		<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
				<?php echo self :: getMenuLeft(); ?>
				<?php echo self :: getSearchResults(); ?>
			</div>
			<div class="clear"></div>
		</div>
    	<?php
    	$content = ob_get_contents();
    	ob_end_clean();
    	return $content;
    }
    
    /**
     * returns the box content for the results found
     * @return string
     */
	public function getSearchResults()
	{
		ob_start();
        ?>
        <div id="main_contents">
			<h1 style="text-align: left; line-height: 28px;">
				<span>Results for "<?php echo $this->data['searchData']['term']; ?>"</span>
			</h1>
			
			<div class="clr"></div>
			<h3 style="text-align: left;"><?php echo $this->data['appInfo']['siteName']; ?></h3>
		<?php
		if($this->data['companies'])
		{
		?>
			<div id="companies-grid" class='inside cf '>
				<ul class='protips-grid cf'>
				<?php
				foreach($this->data['companies'] as $item)
				{
					echo self::getResItem($item, $this->data['searchData']['term']);
				}
				?>			
				</ul>
			</div>
			
			<div class="clear"></div>
			
			<!-- <div id="pagination">
			<?php
			$nItems = 10;
			$from 	= $this->data['dataSearch']['from'];
			?>
                <ul class="pgn01 grey">
					<?php
					for ($i = 0; $i<=floor($total/$nItems); $i++)
					{
						if (($from/$nItems) == $i)
						{
						?>
						<li class="current">
							<span>
								<?php echo $i+1; ?>
							</span>
						</li>					
						<?php
						}
						else
						{
						?>
						<li>
							<a href="/search/in-all/site/<?php echo Tools::slugify($term).'/'.($nItems*$i); ?>">
								<?php echo $i+1; ?>
							</a>
						</li>
						<?php
						}
					}
					?>
                </ul>
			</div> -->
			<!-- /pagination -->
		<?php
		}
		else
		{
		?>
			<div class="clr"></div>
			<h3 style="text-align: center; color: darkred; margin-top: 50px;"> No results for this term.</h3>
		<?php	
		}
		?>	
        </div><!-- main sections -->
		<div class="clr"></div>
        <?php
        $videolist = ob_get_contents();
        ob_end_clean();
        return $videolist;
	}
	
	/**
	 * items for the search result
	 * @param unknown $r
	 * @param unknown $term
	 * @return string
	 */
	public function getResItem($r, $term)
	{
		ob_start();
		$description 	= strip_tags($r['description']);
		$title 			= $r['name'];
		
		$size 			= strlen($description);
		$pos 			= stripos($description, $term);
		$show 			= '';
		$sizeTerm 		= strlen($term);
		
		if ($pos > -1)
		{
			$preEnd 		= $pos + $sizeTerm;
			$beforeTerm 	= substr($description, 0, $pos - 1);
			$indexSpaces 	= explode(' ', $beforeTerm);;
			$lastWord 		= end($indexSpaces);
			$longLastWord 	= strlen($lastWord);
			$start 			= $pos - $longLastWord;
			$lastLong 		= 150 - $sizeTerm - $longLastWord;
			$end 			= $preEnd + $lastLong;
			$show 			= substr($description, $start - 1, $lastLong);
			$realTerm 		= substr($description, $pos, $sizeTerm);
			$show 			= str_replace($realTerm, '<strong>'.$realTerm.'</strong>', $show);
		}
		else
		{
			$show 			= substr($description, 0, 150);
		}

		$posTitle = stripos($title, $term);
		
		if ($posTitle > -1)
		{
			$realTermTitle 	= substr($title, $posTitle, $sizeTerm);
			$title 			= str_replace($realTermTitle, '<strong>'.$realTermTitle.'</strong>', $title);	
		}
		$link = "/company/".$r['category']."/".Tools::slugify($r['category_name'])."/".$r['company_id']."/".Tools::slugify($r['name'])."/";
		?>
		<li>
			<article class='protip'>
				<header>
					<div class="img-cover">	
					<?php 
					if ($r['logo'])
					{
					?>
						<a href="<?php echo $link; ?>" class="title hyphenate track x-mode-popup" data-action="view protip" data-from="mini protip">
							<img src="/img-up/companies_pictures/logo/<?php echo $r['logo']; ?>" 
								alt="<?php echo $r['name']; ?>" class="protip_li_img"/>
						</a>
					<?php
					}
					else
					{
					?>
						<a href="<?php echo $link; ?>" class="title hyphenate track x-mode-popup" data-action="view protip" data-from="mini protip">
							<img src="/images/default_item_front.jpg" 
								alt="<?php echo $r['name']; ?>"  class="protip_li_img"/>
						</a>
					<?php
					}
					?>
					</div>
				</header>
				<a href="<?php echo $link; ?>"  class="title hyphenate track x-mode-popup" data-action="view protip" data-from="mini protip" >
					<?php echo $title; ?>
				</a>
				<footer class='cf search-tile'>
						<?php echo $show.' ...'; ?>
				</footer>
			</article>
		</li>
		
		<?php
		$item = ob_get_contents();
		ob_end_clean();
		return $item;
	}
	
	/**
	 * getEventsHead
	 *
	 * is the head section for the videos
	 *
	 * @return string
	 */
	public function getAllEventsHead()
	{
		ob_start();
		?>
		<title><?php echo $this->data['appInfo']['title']; ?> | Events</title>
			    	
		<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
		<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
		<meta property="og:type" content="website" /> 
		<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
		<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
		<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
		<?php echo self::getCommonDocuments(); ?>
		<?php echo self::getGoogleAnalytics(); ?>
		    		
		<?php
		$head = ob_get_contents();
		ob_end_clean();
		return $head;
	}
	
	/**
	* getCompanyContent
	*
	* this section returs the content for the map section, it is a listing pins
	* of all the companies that has their location
	*
	* @return string
	*/
	public function getAllEventsContent()
	{
		ob_start();
		?>
		<?php echo self :: getBackground(); ?>	
		<div id="main-grid" class='inside cf'>
			<div class="main-wrapper-bg" style="">
				<?php echo self :: getMenuLeft(); ?>
				<?php echo self :: getGridCompanies(); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}	
	
}
