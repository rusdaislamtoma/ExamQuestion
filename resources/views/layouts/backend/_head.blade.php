<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ env('APP_NAME') }} | {{ isset($page_title)?$page_title:'Page Title' }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{asset('default_rss/images/favicon.jpg')}}" type="image/x-icon"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" charset="utf-8">
  <meta name="description" content=""/>
  <meta name=keywords content=""/>
  <meta name="author" content="">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/ionicons.min.css') }}">
  <!-- icofont icons -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/icofont/icofont.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/adminlte.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/blue.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/datepicker3.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/daterangepicker-bs3.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/iCheck/all.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/bootstrap3-wysihtml5.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('assets/css/backend/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/backend/dropify.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .select2-container .select2-selection--single {
      height: 38px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 2.1!important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
      /*padding-left: 13px!important;*/
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 36px!important;
      right: 6px!important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #000000!important;
    }
  </style>
  @stack('css')
  @stack('customCss')
</head>