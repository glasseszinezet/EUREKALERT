<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome | ghpolls</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{URL::asset('assets/font-awesome/css/font-awesome.min.css')}}" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/animate.min.css')}}" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/creative.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('assets/bootstrap-sweetalert/lib/sweet-alert.css')}}" type="text/css">
{{--    <link rel="stylesheet" href="{{URL::asset('css/newStyles.css')}}" type="text/css">--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">GH POLLS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="page-scroll" href="#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">Services</a>
                </li>
                <li>
                    <a class="page-scroll" href="#polls">Poll</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
                <li>
                    <a class="page-scroll" href="#liveResults">Live Results</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h2>Your Most Trusted Authourity For All Your Polling Needs</h2>
            <hr>
            <p>Our Current Poll is On the December 7, 2016 elections in Ghana. We'll be glad to get your views</p>
            <a href="#polls" class="btn btn-primary btn-xl page-scroll wow tada">Take Poll</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">We've got what you need!</h2>
                <hr class="light">
                <p class="text-faded">With a deep understanding of polling methodologies, the best well trained human resource, and all the best and newest technology, We deliver your polling needs at the speed of light with little margin of error. Contact us today to get started</p>
                <a href="#contact" class="btn btn-default btn-xl wow bounceOut">Get In Touch</a>
            </div>
        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">At Your Service</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                    <h3>SMS Polling</h3>
                    <p class="text-muted">We conduct SMS polls helping reach a wide range of respondents with or without access to mobile or broadband data, helping us collate views from a wide range of people </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    <h3>Social Media Polling</h3>
                    <p class="text-muted">With the increasing number of people on social media networks, our polls cover a large group of people.Ensuring polls are delivered to where respondents spend a lot of time</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                    <h3>Web based Polls</h3>
                    <p class="text-muted">We take advantage of the huge power of the world wide web to get our polls to a high number of respondents. Ensuring that our conclusions are as close to reality as possible.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                    <h3>Custom Polls</h3>
                    <p class="text-muted">Need something different to cover your needs?. We have the team and technology to deliver this as fast as possible.Get in touch today for further discussions. </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-primary" id="polls">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Current Poll</h2>
                <hr class="light">
            </div>

            <div class="col-lg-12 text-center">
                {!! Form::open(['action' => 'UserRequestController@store']) !!}

                    @foreach($questions as $key=>$question)
                        <div class="panel panel-danger">
                            <div class="panel-heading text-center"><strong>{{++$key}}: {{$question->text}}</strong></div>
                            <div class="panel-body ">
                                <div class="radio text-muted">
                                @foreach($question->answerOptions as $key=>$option)
                                        <label>
                                            <input type="radio" name="question_{{$question->id}}" id="question_{{$question->id}}_options" value="{{$question->id}}_{{$option->id}}">
                                            {{$option->text}}
                                        </label>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    @php($iterator++)
                        @if($iterator >= count($panel_classes)) @php($iterator = 0) @endif
                    @endforeach
                    <div class="panel panel-danger">
                        <div class="panel-heading text-center">You can add your personal details for us to contact you later (optional)</div>
                        <div class="panel-body ">
                            <div class="col-lg-3">
                                {!!  Form::label('first_name', 'First Name', array('class' => 'control-label text-muted')) !!}
                                {!! Form::text("first_name", $value = null, $attributes = array('class' => "form-control", 'placeholder' => "Your First Name")) !!}
                            </div>
                            <div class="col-lg-3">
                                {!!  Form::label('last_name', 'Last Name', array('class' => 'control-label text-muted')) !!}
                                {!! Form::text("last_name", $value = null, $attributes = array('class' => "form-control", 'placeholder' => "Your Last Name")) !!}
                            </div>

                            <div class="col-lg-3">
                                {!!  Form::label('other_name', 'Other Name(s)', array('class' => 'control-label text-muted')) !!}
                                {!! Form::text("other_name", $value = null, $attributes = array('class' => "form-control", 'placeholder' => "Do you have any other names")) !!}
                            </div>
                            <div class="col-lg-3">
                                {!!  Form::label('msisdn', 'Phone', array('class' => 'control-label text-muted')) !!}
                                {!! Form::tel("msisdn", $value = null, $attributes = array('class' => "form-control", 'pattern' => "(233|\\+233|00233|0233|0)(2|5)\\d{8}", 'placeholder' => "Your Phone Number ")) !!}
                            </div>
                            <div class="col-lg-3">
                                {!!  Form::label('email', 'E-Mail Address', array('class' => 'control-label text-muted')) !!}
                                {!! Form::email("email", $value = null, $attributes = array('class' => "form-control", 'placeholder' => "Your Email Address")) !!}
                            </div>


                            <div class="col-lg-3">
                                {!!  Form::label('location', 'Location', array('class' => 'control-label text-muted')) !!}
                                {!! Form::text("location", $value = null, $attributes = array('class' => "form-control", 'placeholder' => "Where are you reaching us from..")) !!}
                            </div>
                            <div class="col-lg-3">
                                {!!  Form::label('occupation', 'Occupation', array('class' => 'control-label text-muted')) !!}
                                {!! Form::text("occupation", $value = null, $attributes = array('class' => "form-control", 'placeholder' => "What do you do?")) !!}
                            </div>
                            <div class="col-lg-3">
                                {!!  Form::label('gender', 'Gender', array('class' => 'control-label text-muted')) !!}
                                {!! Form::select('gender', ['Male' => 'male', 'Female' => 'female'], null, ['placeholder' => '----Gender---', 'class' => "form-control"]) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::submit('Submit',['class' => "form-control btn btn-success wow bounceIn"]) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">Let's Get In Touch!</h2>
                <hr class="primary">
                <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <i class="fa fa-phone fa-3x wow bounceIn"></i>
                <p>+233 24 423 9557</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                <p><a href="mailto:enquiries@ghpolls.org">enquiries@ghpolls.org</a></p>
            </div>
        </div>
    </div>
</section>

<section class="bg-primary" id="liveResults">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Poll Results</h2><br>
                <h3>Please Note: Poll is still in progress</h3>
                <hr class="light">
            </div>
            <div class="col-lg-12 text-center graphContainer">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw" id="spinner"></i>

            </div>

        </div>
    </div>
</section>

<!-- jQuery -->
<script src="{{URL::asset('assets/js/jquery.js')}}"></script>

<script src="{{URL::asset('assets/bootstrap-sweetalert/lib/sweet-alert.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{URL::asset('assets/js/jquery.easing.min.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.fittext.js')}}"></script>
<script src="{{URL::asset('assets/js/wow.min.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{URL::asset('assets/js/creative.js')}}"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

@if(Session::has('success'))
    <script type="text/javascript">
        sweetAlertInitialize();
        swal({
            type: "success",
            title: "{{ Session::get('success') }}",
            confirmButtonClass:"btn-raised btn-success",
            confirmButtonText:"OK"
        })

    </script>
@endif

@if(Session::has('error'))
    <script type="text/javascript">
        sweetAlertInitialize();
        swal({
            type: "error",
            title: "{{ Session::get('error') }}",
            confirmButtonClass:"btn-raised btn-danger",
            confirmButtonText:"OK"
        })
    </script>
@endif
<script type="text/javascript">
    loadGraphs();
    setInterval(function () {
        loadGraphs();
    },10000);

</script>
</body>

</html>
