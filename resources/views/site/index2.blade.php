@extends('layouts/landing/main')

@section('content')
<!--SLIDER START-->
<section class="slider slider2" id="slider">
	<div class="tp-banner">
		<ul>
			<li data-transition="cube" data-slotamount="7" data-masterspeed="1000">
				<img src="{{ URL::asset('rams/images/slider/sr1.jpg') }}"  alt="">
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="-40"
					 data-speed="1600"
					 data-start="1000"
					 data-easing="easeInOutCubic">
					<div class="revCon">
						<h5 class="text-uppercase color_white">Sistem Pengurusan Kemalangan Jalan Raya</h5>
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="35"
					 data-speed="2000"
					 data-start="1500"
					 data-easing="Power4.easeOut">
					<div class="revCon">
						<h2 class="lead color_white">RAMS</h2>
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="148"
					 data-speed="2000"
					 data-start="2000"
					 data-easing="Power4.easeOut">
					 <!--
					<div class="revCon revBtn home_page2">
						<a href="/login" class="bes_button2"><span>Log Masuk <i class="flaticon-arrows"></i></span></a>
					</div>
					-->
				</div>
			</li>
			<li data-transition="cube" data-slotamount="7" data-masterspeed="1000">
				<img src="{{ URL::asset('rams/images/slider/sr2.jpg') }}"  alt="">
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="-160"
					 data-speed="1600"
					 data-start="1000"
					 data-easing="easeInOutCubic">
					<div class="revCon">
						<img src="{{ URL::asset('rams/images/rams_banner.png') }}" />
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="-40"
					 data-speed="1600"
					 data-start="1000"
					 data-easing="easeInOutCubic">
					<div class="revCon">
						<h5 class="text-uppercase color_white">Sistem Pengurusan Kemalangan Jalan Raya</h5>
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="35"
					 data-speed="2000"
					 data-start="1500"
					 data-easing="Power4.easeOut">
					<div class="revCon">
						<h2 class="lead color_white">RAMS</h2>
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="148"
					 data-speed="2000"
					 data-start="2000"
					 data-easing="Power4.easeOut">
					 <!--
					<div class="revCon revBtn home_page2">
						<a href="/login" class="bes_button2"><span>Log Masuk <i class="flaticon-arrows"></i></span></a>
					</div>
					-->
				</div>
			</li>
			<li data-transition="cube" data-slotamount="7" data-masterspeed="1000">
				<img src="{{ URL::asset('rams/images/slider/sr3.jpg') }}"  alt="">
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="-160"
					 data-speed="1600"
					 data-start="1000"
					 data-easing="easeInOutCubic">
					<div class="revCon">
						<img src="{{ URL::asset('rams/images/rams_banner.png') }}" />
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="-40"
					 data-speed="1600"
					 data-start="1000"
					 data-easing="easeInOutCubic">
					<div class="revCon">
						<h5 class="text-uppercase color_white">Sistem Pengurusan Kemalangan Jalan Raya</h5>
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="35"
					 data-speed="2000"
					 data-start="1500"
					 data-easing="Power4.easeOut">
					<div class="revCon">
						<h2 class="lead color_white">RAMS</h2>
					</div>
				</div>
				<div class="tp-caption sfb"
					 data-x="center"
					 data-y="center"
					 data-hoffset="0"
					 data-voffset="148"
					 data-speed="2000"
					 data-start="2000"
					 data-easing="Power4.easeOut">
					<!--
					<div class="revCon revBtn home_page2">
						<a href="/login" class="bes_button2"><span>Log Masuk <i class="flaticon-arrows"></i></span></a>
					</div>
					-->
				</div>
			</li>
		</ul>
	</div>
	<div class="mouseSlider">
		<a href="#firstBlog" class="normal"><img src="{{ URL::asset('rams/images/mouse.png') }}" alt=""></a>
		<a href="#firstBlog" class="hover"><img src="{{ URL::asset('rams/images/mouseh.png') }}" alt=""></a>
	</div>
</section>
<!--SLIDER END-->

<!--FOOTER START-->
<footer class="footer bggreay" id="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<aside class="widget">
					<div class="textWidget2">
						<h3 class="widgetTitle"><b>Kementerian Kerja Raya</b></h3>
						<p>
							Bahagian Perancang Jalan (BPJ)<br />
							Kementerian Kerja Raya (KKR) Malaysia<br />
							Tingkat 2, Blok A<br />
							Kompleks Kerja Raya Malaysia<br />
							Jalan Sultan Salahuddin<br />
							50580 Kuala Lumpur<br />
							Malaysia<br />
							<i class="flaticon-technology"></i> (603) 8000 8000
						</p>
					</div>
				</aside>
			</div>
			<div class="col-sm-6">
				<aside class="widget">
					<div class="textWidget2">
						<h3 class="widgetTitle"><b>Sistem Pengurusan Kemalangan Jalan Raya</b></h3>
						<p>
							<img src="{{ URL::asset('rams/images/rams_banner.png') }}" height="111" />
						</p>
					</div>
				</aside>
			</div>
		</div>
	</div>
</footer>
<!--FOOTER END-->

<!--COPY RIGHT START-->
<section class="copyright" id="copyright2">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<p class="copyPera">Hakcipta Terpelihara <?php echo date('Y'); ?> &copy; Kementerian Kerja Raya Malaysia</p>
			</div>
		</div>
	</div>
</section>
<!--COPY RIGHT END-->

<a id="backToTop" href="#" class="showit">
	<i class="fa fa-angle-double-up"></i>
</a>
@endsection