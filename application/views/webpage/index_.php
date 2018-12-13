<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Youth And Beauty Clinic</title>
  <link href="<?php echo base_url().'assets/';?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/';?>css/animate.min.css" rel="stylesheet"> 
  <link href="<?php echo base_url().'assets/';?>css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/';?>css/lightbox.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/';?>css/main.css" rel="stylesheet">
  <link id="css-preset" href="<?php echo base_url().'/assets/';?>css/presets/preset4.css" rel="stylesheet">
  <link href="<?php echo base_url().'/assets/';?>css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<body>

  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

  <header id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
		<?php $nos = 1; foreach($slider as $row){ ?>
        <div class="item <?php if($nos == 1){ echo 'active'; }?>" style="background-image: url(<?php echo base_url().'upload/img/'.$row->file_name; $nos++?>)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig"><span> <?php echo $row->title; ?></span></h1>
            <p class="animated fadeInRightBig"><?php echo $row->desc; ?></p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="#services">Start now</a>
          </div>
        </div>
		<?php } ?>
      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->
    <div class="main-nav">
      <div class="container" >
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <h1><img class="img-responsive" src="<?php echo base_url().'assets/';?>images/logo.png" alt="logo"></h1>
          </a>   
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>                 
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll active"><a href="#home">Home</a></li>
            <li class="scroll"><a href="#services">Profile Clinic</a></li> 
            <li class="scroll"><a href="#about-us">Treatment</a></li>                     
            <li class="scroll"><a href="#portfolio">Before After</a></li>
            <!--<li class="scroll"><a href="#team">Team</a></li>-->
            <li class="scroll"><a href="#blog">Gallery</a></li>
            <li class="scroll"><a href="#testy">Testimony</a></li>       
            <li class="scroll"><a href="#contact">Contact Us</a></li>       
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  <section id="services">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Youth and Beauty Clinic</h2>
			by dr. Gaby Syerly<br/>
			Beauty is You
          </div>
        </div> 
      </div>
      <div class="our-services"> 
        <div class="row">
		<?php foreach($profile as $rowProf){ ?>
          <div class="col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">              
			  <a href="#B"><img class="img-responsive img-circle" src="<?php echo base_url().'upload/img/'.$rowProf->file_name;?>" alt="" style="width:500px"></a>
            <div class="service-info">
              <h3 class="text-center"><a href="#b"><?php echo $rowProf->title; ?></a></h3>
              <?php echo $rowProf->desc;?>
            </div>
          </div>
		<?php } ?>
        </div>
      </div>
    </div>
  </section><!--/#services-->
  <section id="about-us" class="parallax">
    <div class="container">
      <div class="row">
            <h2 class="text-center">YB's Media</h2>
        <div class="col-sm-6 text-center" >
          <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="embed-responsive embed-responsive-4by3">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3wS7yAW2U7o"></iframe> <br/>
			</div>
          </div>
        </div>
        <div class="col-sm-6 text-center">
          <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="embed-responsive embed-responsive-4by3">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0DII2weartE"></iframe> <br/>
			</div>
          </div>
        </div>
		Our Related Link
		<ul>
			<li><a href="https://www.fimela.com/beauty-health/prosedur-fat-freezing-mematikan-lemak-tanpa-suntik-dan-bedah-1707047.html">
				https://www.fimela.com/beauty-health/prosedur-fat-freezing-mematikan-lemak-tanpa-suntik-dan-bedah-1707047.html</a>
			</li>
		</ul>
	</div>
  </section><!--/#about-us-->
	<?php $notr = 1; foreach($treat as $rowtr){?>
	<?php if($notr%2 == 0){ ?>
	<div class="content-section-a" >

        <div class="container">

            <div class="row wow fadeInDown data-wow-duration='2000ms' data-wow-delay='550ms'">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading"><?php echo $rowtr->title?></h2>
					<?php 
						
						$wheres['group_id'] = $rowtr->id;
						$wheres['status'] = 1;
						$wheres['delete_status'] = 0;
						$treats = $this->Model_dop->get_table_wheres('m_treat',$wheres);
						
					?>
                    <p class="lead">
					<?php foreach($treats as $col){?>
					<a onclick="showTreath(<?php echo $col->id; ?>)" href="#editModal" data-toggle="modal"><?php echo $col->title; ?></a>, 
					<?php } ?>
					</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    
					<div class="post-thumb">
						<div id="post-carousel<?php echo $rowtr->id; ?>"  class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
							<?php $orli = 0; foreach($treats as $img){?>
							  <li data-target="#post-carousel<?php echo $rowtr->id; ?>" data-slide-to="<?php echo $orli; ?>" <?php if($orli == 0 ){ echo 'class="active"'; } $orli++;?>></li>
							<?php } ?>
							</ol>
							<div class="carousel-inner">
							  <?php $or = 1; foreach($treats as $img){?>
							  <div class="item <?php if ($or == 1){echo "active"; } $or++;?>">
								<a href="#B"><img class="img-responsive" src="<?php echo base_url().'upload/img/'.$img->file_name;?>" alt=""></a>                          
								  <div class="post-meta">
									<span><i class="fa fa-th"></i> <?php echo $img->title; ?></span>
								  </div>
							  </div>
							  <?php } ?>                            
							<a class="blog-left-control" href="#post-carousel<?php echo $rowtr->id; ?>" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
							<a class="blog-right-control" href="#post-carousel<?php echo $rowtr->id; ?>" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
						  </div>    
						</div>
					</div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
	<?php }else{ ?>
	<div class="content-section-a wow fadeInDown data-wow-duration='2000ms' data-wow-delay='550ms'" style='background-color:#fff;'>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading"><?php echo $rowtr->title; ?></h2>
					<?php 
						
						$wheres['group_id'] = $rowtr->id;
						$wheres['status'] = 1;
						$wheres['delete_status'] = 0;
						$treats = $this->Model_dop->get_table_wheres('m_treat',$wheres);
						
					?>
                    <p class="lead">
					<?php foreach($treats as $col){?>
					<a onclick="showTreath(<?php echo $col->id; ?>)" href="#editModal" data-toggle="modal" ><?php echo $col->title; ?></a>, 
					<?php } ?>
					</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
					<div class="post-thumb">
					  <div id="post-carousel<?php echo $rowtr->id; ?>"  class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
						<?php $orli = 0; foreach($treats as $img){?>
						  <li data-target="#post-carousel<?php echo $rowtr->id; ?>" data-slide-to="<?php echo $orli; ?>" <?php if($orli == 0 ){ echo 'class="active"'; } $orli++;?>></li>
						<?php } ?>
						</ol>
						<div class="carousel-inner">
						  <?php $or = 1; foreach($treats as $img){?>
						  <div class="item <?php if ($or == 1){echo "active"; } $or++;?>">
							<a href="#B"><img class="img-responsive" src="<?php echo base_url().'upload/img/'.$img->file_name;?>" alt=""></a>                          
							  <div class="post-meta">
								<span><i class="fa fa-th"></i> <?php echo $img->title; ?></span>
							  </div>
						  </div>
						  <?php } ?>                            
						<a class="blog-left-control" href="#post-carousel<?php echo $rowtr->id; ?>" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
						<a class="blog-right-control" href="#post-carousel<?php echo $rowtr->id; ?>" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
					  </div>  
					</div>
                </div>
            </div>
            </div>
        </div>
    </div>
	<?php }  $notr++; ?>
    
	<?php } ?>
	
  <section id="portfolio">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2>Before After</h2>
        </div>
      </div> 
    </div>
    <div class="container-fluid">
      <div class="row">
	  <?php foreach($after as $afters){ ?>
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="folio-image">
              <img class="img-responsive" src="<?php echo base_url().'upload/img/'.$afters->file_name;?>" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3><?php echo $afters->title; ?></h3>
                    <p><?php echo $afters->desc; ?></p>
                  </div>
                  <div class="folio-overview">
                    <span class="folio-link"><a class="folio-read-more" href="#B" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a href="<?php echo base_url().'upload/img/'.$afters->file_name;?>" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		<?php } ?>
      </div>
    </div>
    <div id="portfolio-single-wrap">
      <div id="portfolio-single">
      </div>
    </div><!-- /#portfolio-single-wrap -->
  </section><!--/#portfolio-->

   <section id="features" class="parallax">
    <div class="container">
      <div class="row count">
	  <!--
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
          <i class="fa fa-user"></i>
          <h3 class="timer">4000</h3>
          <p>Happy Clients</p>
        </div>
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
          <i class="fa fa-desktop"></i>
          <h3 class="timer">200</h3>                    
          <p>Modern Websites</p>
        </div> 
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="700ms">
          <i class="fa fa-trophy"></i>
          <h3 class="timer">10</h3>                    
          <p>WINNING AWARDS</p>
        </div> 
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="900ms">
          <i class="fa fa-comment-o"></i>                    
          <h3>24/7</h3>
          <p>Fast Support</p>
        </div> 
-->		
      </div>
    </div>
  </section><!--/#features-->

  <section id="testy">
	<h1 class="animated fadeInUpBig text-center"><span> <a href="#b">Testimony</a></span></h1><hr/>
    <div class="container">
      <div class="blog-posts">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="post-thumb">
              <div id="post-carouseltesti"  class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#post-carouseltesti" data-slide-to="0" class="active"></li>
                  <li data-target="#post-carouseltesti" data-slide-to="1"></li>
                  <li data-target="#post-carouseltesti" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
				  <?php $tor = 1; foreach($testi as $testy){?>
                  <div class="item <?php if($tor == 1){ echo "active"; } $tor++; ?>">
                    <a href="#B"><img class="img-responsive img-circle" src="<?php echo base_url().'upload/img/'.$testy->file_name;?>" alt="" ></a>
					<div class="entry-header">
					  <h3 class="text-center"><a href="#B"><?php echo $testy->title; ?></a></h3>
					</div>
					<div class="entry-content">
					  <p><b>"</b> <?php echo $testy->desc; ?> <b>"</b></p>
					</div>
                  </div>
				  <?php } ?>
                </div>                               
                <a class="blog-left-control" href="#post-carouseltesti" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carouseltesti" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
              </div>
              <div class="post-icon">
                <i class="fa fa-comment-o"></i>
              </div>
            </div>
          </div>                    
        </div>               
      </div>
      </div>
  </section><!--/#pricing-->

  <section id="twitter" class="parallax">
    <div>
		<div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Our Event</h2>
        </div>
      </div>
      <div class="pricing-table">
        <div class="row">
          <div class="col-sm-3">
            <div class="single-table wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
              <h2><a href="#b">Wedding Packages</a></h2>
              <ul>
                <li><s>Rp. 20.000.000</s></li>
                <li><h3>ALL IN Rp. 9.900.000 </h3></li>
                <li>Let's shine like a diamond on your special day with our "Beauty Bridal Treatment Packages"</li>
              </ul>
              <a href="#B" class="btn btn-lg btn-primary">Reserve</a>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    </div>
  </section><!--/#twitter-->

  <section id="blog">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Gallery</h2>
        </div>
      </div>
      <div class="blog-posts">
        <div class="row">
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="post-thumb">
              <div id="post-carousel"  class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
				  <?php $r = 1; foreach($room as $roms){?>
                  <div class="item <?php if($r == 1){ echo "active"; } $r++; ?>">
                    <a href="#B"><img class="img-responsive" style="width: 550px" src="<?php echo base_url().'upload/img/'.$roms->file_name;?>" alt=""></a>
					<div class="entry-header">
					  <h3><a href="#B"><?php echo $roms->title; ?></a></h3>
					</div>
					<div class="entry-content">
					  <p> <?php echo $roms->desc; ?></p>
					</div>
                  </div>
				  <?php } ?>
                </div>                               
                <a class="blog-left-control" href="#post-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
              </div>
              <div class="post-icon">
                <i class="fa fa-picture-o"></i>
              </div>
            </div>
          </div>       
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="post-thumb">
              <div id="post-carousel22"  class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
				  <?php $d = 1; foreach($dokter as $dok){?>
                  <div class="item <?php if($d == 1){ echo "active"; } $d++; ?>">
                    <a href="#B"><img class="img-responsive" src="<?php echo base_url().'upload/img/'.$dok->file_name;?>" alt=""></a>
					<div class="entry-header">
					  <h3><a href="#B"><?php echo $dok->title; ?></a></h3>
					</div>
					<div class="entry-content">
					  <p> <?php echo $dok->desc; ?> </p>
					</div>
                  </div>
				                  
				  <?php } ?>
                </div>                               
                <a class="blog-left-control" href="#post-carousel22" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carousel22" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
              </div>
              <div class="post-icon">
                <i class="fa fa-user"></i>
              </div>
            </div>
          </div>       
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="post-thumb">
              <div id="post-carousel23"  class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
				  <?php $o = 1; foreach($other as $otr){?>
                  <div class="item <?php if($o == 1){ echo "active"; } $o++; ?>">
                    <a href="#B"><img class="img-responsive" src="<?php echo base_url().'upload/img/'.$otr->file_name;?>" alt=""></a>
					<div class="entry-header">
					  <h3><a href="#B"><?php echo $otr->title; ?></a></h3>
					</div>
					<div class="entry-content">
					  <p> <?php echo $otr->desc; ?> . </p>
					</div>
                  </div>
				  <?php } ?>
                </div>                               
                <a class="blog-left-control" href="#post-carousel23" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carousel23" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
              </div>
              <div class="post-icon">
                <i class="fa fa-picture-o"></i>
              </div>
            </div>
          </div>                    
        </div>               
      </div>
    </div>
  </section><!--/#blog-->

  <section id="contact">
  
	<iframe width="100%" height="100%" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0636634290495!2d106.81010671424157!3d-6.255343495472226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f180f6211ab5%3A0xcbbf8e44c545364e!2sTrue+Care+Medical+%26+Dental+Clinic!5e0!3m2!1sid!2sid!4v1500119145425"></iframe>
	<small>
		
		<a href="https://www.google.com/maps/place/True+Care+Medical+%26+Dental+Clinic/@-6.2553435,106.8101067,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69f180f6211ab5:0xcbbf8e44c545364e!8m2!3d-6.2553435!4d106.8122954?hl=id-ID"></a>
	</small>
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Contact Us</h2>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms" >
          <div class="row">
            <div class="col-sm-6">
              <form  name="contact-form" method="post" action="<?php echo base_url()."AdminWeb/simpanKontak"?>">
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" placeholder="Email Address" required="required">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                </div>
                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message" required="required"></textarea>
                </div>                        
                <div class="form-group">
                  <button type="submit" class="btn-submit">Send Now</button>
                </div>
              </form>   
            </div>
            <div class="col-sm-6" >
              <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <p>	Open Hours
					Mon-Fri 10 am - 5 pm<br/>
					Sat 10 am - 3 pm
					Sun Close
				</p>
                <ul class="address">
                  <li><i class="fa fa-map-marker"></i> <span> Address :</span> <br/>Kemang Building. Jalan Kemang Raya no. 15, 4th Floor. South Jakarta.</li>
                  <li><i class="fa fa-phone"></i> <span> Phone :</span> 021-71792337 / 0813 1555 5741</li>
                  <li><i class="fa fa-envelope"></i> <span> Email :</span><a href="mailto:truecare.aesthetic@gmail.com"> info@youthbeautyclinic.com</a></li>
                  <li><i class="fa fa-instagram"></i> <span> Instagram :</span> <a href="#https://www.instagram.com/explore/locations/1388424014552071/youth-beauty-clinic/">@youthbeautyclinic</a></li>
                </ul>
              </div>                            
            </div>
          </div>
        </div>
      </div>
    </div>        
  </section>
  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
    </div>
    <div class="footer-bottom">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="<?php echo base_url().'assets/';?>images/logo.png" alt=""></a>
        </div>
		<!--
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#B"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#B"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#B"><i class="fa fa-instagram"></i></a></li>
            <li><a class="facebook" href="#B"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#B"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#B"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
		-->
      </div>
    </div>
  </footer>
  
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
	  <div class="modal-dialog primary modal-lg">
		<div class="modal-content">
		  <div class="modal-header text-center">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title primary" id="memberModalLabel"><i class="icon-info"></i> INFO</h4>
		  </div>
		  <div class="modal-body text-center">
			<p>Detail Here ...</p>
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
	  </div>
	</div>
	<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
	  <div class="modal-dialog primary modal-lg">
		<div class="modal-content">
		  <div class="modal-header text-center">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<img id='img-upload' src='<?php echo base_url().'upload/images/logoHead.png'; ?>' width="110px">
			<p><b>Our Promo</b></p>
		  </div>
		  <div class="modal-body text-center">
			
              <div id="post-carouselza"  class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
				  <?php $ra = 1; foreach($promo as $roms){?>
                  <div class="item <?php if($ra == 1){ echo "active"; } $ra++; ?>">
                    <a href="#B"><img class="img-rounded" src="<?php echo base_url().'upload/img/'.$roms->file_name;?>" style="width: 60%; margin-left: 20%" alt=""></a>
					<div class="entry-header">
					  <h3><a href="#B"><?php echo $roms->title; ?></a></h3>
					</div>
					<div class="entry-content">
					  <p> <?php echo $roms->desc; ?></p>
					</div>
                  </div>
				  <?php } ?>
                </div>                               
                <a class="blog-left-control" href="#post-carouselza" role="button" data-slide="prev" style="color:#0EB3C7"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carouselza" role="button" data-slide="next" style="color:#0EB3C7"><i class="fa fa-angle-right"></i></a>
              </div>
		  
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
	  </div>
	</div>

  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/bootstrap.min.js"></script>
  
  
<script type="text/javascript">

$(document).ready(function() {
	$('#memberModal').modal('show');
});

</script>

  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/wow.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/mousescroll.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/smoothscroll.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/jquery.countTo.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/lightbox.min.js"></script>



  <script type="text/javascript" src="<?php echo base_url().'assets/';?>js/main.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
</body>
</html>