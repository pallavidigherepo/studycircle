<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('meritest/images/ico/favicon.ico') }}" rel="shortcut icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="An online exam software service provider brought to you by MERITEST SOLUTIONS Pvt Ltd." />
	<meta name="keywords" content="study, learn, course, tutor, tutorial, teach, college, school, institute, teacher, instructor" />
	<meta name="author" content="meritest">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Fav and Touch Icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('meritest/images/ico/android-chrome-192x192.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('meritest/images/ico/android-chrome-512x512.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('meritest/images/ico/apple-touch-icon.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('meritest/images/ico/apple-touch-icon.png')}}">
    <meta name="title" content="Online Exam Software|Test Generator|Test Maker:MERITEST|Try for free">
    <meta name="description" content="🔥 Create Online Exams, Generate Test Paper with our Online Exam Software ✔️Easy to use ✔️Fast processing speed ✔️Secure and simple ✔️Save time and Money🔥">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.facebook.com/meritestdotin/">
    <meta property="og:title" content="Online Exam Software|Test Generator|Test Maker:MERITEST|Try for free">
    <meta property="og:description" content="🔥 Create Online Exams, Generate Test Paper with our Online Exam Software ✔️Easy to use ✔️Fast processing speed ✔️Secure and simple ✔️Save time and Money🔥">
    <meta property="og:image" content="https://meritest.in/meritest/images/logo/150_height.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://twitter.com/meritestdotin/">
    <meta property="twitter:title" content="Online Exam Software|Test Generator|Test Maker:MERITEST|Try for free">
    <meta property="twitter:description" content="🔥 Create Online Exams, Generate Test Paper with our Online Exam Software ✔️Easy to use ✔️Fast processing speed ✔️Secure and simple ✔️Save time and Money🔥">
    <meta property="twitter:image" content="https://meritest.in/meritest/images/logo/150_height.png">

    <!-- Linkedin -->
    <meta property="linkedin:card" content="summary_large_image">
    <meta property="linkedin:url" content="https://www.linkedin.com/company/meritestdotin/">
    <meta property="linkedin:title" content="Online Exam Software|Test Generator|Test Maker:MERITEST|Try for free">
    <meta property="linkedin:description" content="🔥 Create Online Exams, Generate Test Paper with our Online Exam Software ✔️Easy to use ✔️Fast processing speed ✔️Secure and simple ✔️Save time and Money🔥">
    <meta property="linkedin:image" content="https://meritest.in/meritest/images/logo/150_height.png">
    <!-- Pinterest -->
    <meta property="pinterest:card" content="summary_large_image">
    <meta property="pinterest:url" content="https://www.pinterest.com/meritestdotin/">
    <meta property="pinterest:title" content="Online Exam Software|Test Generator|Test Maker:MERITEST|Try for free">
    <meta property="pinterest:description" content="🔥 Create Online Exams, Generate Test Paper with our Online Exam Software ✔️Easy to use ✔️Fast processing speed ✔️Secure and simple ✔️Save time and Money🔥">
    <meta property="pinterest:image" content="https://meritest.in/meritest/images/logo/150_height.png">

    <!-- YouTube -->
    <meta property="youtube:card" content="summary_large_image">
    <meta property="youtube:url" content="https://www.youtube.com/channel/UC2jXBWiTxsr-KQlBexxPvXA/">
    <meta property="youtube:title" content="Online Exam Software|Test Generator|Test Maker:MERITEST|Try for free">
    <meta property="youtube:description" content="🔥 Create Online Exams, Generate Test Paper with our Online Exam Software ✔️Easy to use ✔️Fast processing speed ✔️Secure and simple ✔️Save time and Money🔥">
    <meta property="youtube:image" content="https://meritest.in/meritest/images/logo/150_height.png">
    <!-- Styles -->
    
    <!-- CSS Plugins -->
	<link rel="stylesheet" type="text/css" href="{{ asset('meritest/bootstrap/css/bootstrap.min.css') }}" media="screen">	
	<link href="{{ asset('meritest/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('meritest/css/main.css')}}" rel="stylesheet">
	<link href="{{ asset('meritest/css/plugin.css')}}" rel="stylesheet">

	<!-- CSS Custom -->
	<link href="{{ asset('meritest/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('meritest/css/your-style.css')}}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="main">
    <div id="app"></div>
    
    <!-- start Back To Top -->
    <div id="back-to-top">
    <a href="#"><i class="ion-ios-arrow-up"></i></a>
    </div>
    <!-- end Back To Top -->
    <script src="{{ mix('js/app.js')}}" defer></script>
    
    
    <script type="text/javascript" src="{{ asset('meritest/js/jquery-2.2.4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery-migrate-1.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery.waypoints.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery.easing.1.3.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/SmoothScroll.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/spin.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery.introLoader.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/typed.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/placeholderTypewriter.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery.slicknav.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/readmore.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery.nicescroll.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/creditly.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/jquery.placeholder.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/select2.full.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/ion.rangeSlider.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/bootstrap-rating.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/bootstrap-modalmanager.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/bootstrap-modal.js')}}"></script>
    <script type="text/javascript" src="{{ asset('meritest/js/customs.js')}}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205583255-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-205583255-1');
    </script>
</body>
</html>
