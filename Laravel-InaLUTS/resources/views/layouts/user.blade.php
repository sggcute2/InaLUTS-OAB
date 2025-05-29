<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
      @hasSection('title')
        @yield('title')
        &ndash;
      @endif
      {{ \Config::get('app.name') }}
    </title>

<!-- Primary Meta Tags -->
<title>Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) Overactive Bladder</title>
<meta name="title" content="Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) Overactive Bladder" />
<meta name="description" content="Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) – Overactive Bladder akan menjadi sistem website registry pertama di Indonesia yang secara khusus mencatat data pasien dengan gejala overactive bladder (OAB). Website ini dapat diakses dan diisi oleh tenaga medis di seluruh Indonesia melalui browser saat menangani pasien dengan gejala LUTS/OAB dalam praktik sehari-hari. Formulir pada aplikasi ini dirancang singkat dan praktis, namun tetap mencakup parameter klinis penting yang membantu urolog dalam menilai, mendiagnosis, serta memantau respons terapi pasien OAB. Data yang telah diisikan dapat ditinjau kembali (dengan fitur edit yang hanya tersedia untuk pengisi awal) melalui sistem, sehingga memungkinkan penelusuran riwayat dan evaluasi progres pasien. Semua data akan tersimpan secara aman dalam pusat database nasional, yang dapat dikompilasi untuk menghasilkan statistik nasional mengenai prevalensi, pola gejala, dan respons terapi OAB di Indonesia. Data ini berpotensi menjadi landasan penting dalam merumuskan kebijakan nasional mengenai manajemen LUTS, khususnya OAB. Ke depannya, InaLUTS – Overactive Bladder diharapkan tidak hanya menjadi alat bantu klinis bagi tenaga medis, tetapi juga menjadi platform informasi terpercaya bagi pasien serta mendukung peningkatan mutu layanan kesehatan di bidang urologi secara menyeluruh." />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://inalutsoab.id/login" />
<meta property="og:title" content="Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) Overactive Bladder" />
<meta property="og:description" content="Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) – Overactive Bladder akan menjadi sistem website registry pertama di Indonesia yang secara khusus mencatat data pasien dengan gejala overactive bladder (OAB). Website ini dapat diakses dan diisi oleh tenaga medis di seluruh Indonesia melalui browser saat menangani pasien dengan gejala LUTS/OAB dalam praktik sehari-hari. Formulir pada aplikasi ini dirancang singkat dan praktis, namun tetap mencakup parameter klinis penting yang membantu urolog dalam menilai, mendiagnosis, serta memantau respons terapi pasien OAB. Data yang telah diisikan dapat ditinjau kembali (dengan fitur edit yang hanya tersedia untuk pengisi awal) melalui sistem, sehingga memungkinkan penelusuran riwayat dan evaluasi progres pasien. Semua data akan tersimpan secara aman dalam pusat database nasional, yang dapat dikompilasi untuk menghasilkan statistik nasional mengenai prevalensi, pola gejala, dan respons terapi OAB di Indonesia. Data ini berpotensi menjadi landasan penting dalam merumuskan kebijakan nasional mengenai manajemen LUTS, khususnya OAB. Ke depannya, InaLUTS – Overactive Bladder diharapkan tidak hanya menjadi alat bantu klinis bagi tenaga medis, tetapi juga menjadi platform informasi terpercaya bagi pasien serta mendukung peningkatan mutu layanan kesehatan di bidang urologi secara menyeluruh." />
<meta property="og:image" content="https://inalutsoab.id/assets/img/logo-perkina-00.png" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://inalutsoab.id/login" />
<meta property="twitter:title" content="Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) Overactive Bladder" />
<meta property="twitter:description" content="Indonesian Registry of Lower Urinary Tract Symptoms (InaLUTS) – Overactive Bladder akan menjadi sistem website registry pertama di Indonesia yang secara khusus mencatat data pasien dengan gejala overactive bladder (OAB). Website ini dapat diakses dan diisi oleh tenaga medis di seluruh Indonesia melalui browser saat menangani pasien dengan gejala LUTS/OAB dalam praktik sehari-hari. Formulir pada aplikasi ini dirancang singkat dan praktis, namun tetap mencakup parameter klinis penting yang membantu urolog dalam menilai, mendiagnosis, serta memantau respons terapi pasien OAB. Data yang telah diisikan dapat ditinjau kembali (dengan fitur edit yang hanya tersedia untuk pengisi awal) melalui sistem, sehingga memungkinkan penelusuran riwayat dan evaluasi progres pasien. Semua data akan tersimpan secara aman dalam pusat database nasional, yang dapat dikompilasi untuk menghasilkan statistik nasional mengenai prevalensi, pola gejala, dan respons terapi OAB di Indonesia. Data ini berpotensi menjadi landasan penting dalam merumuskan kebijakan nasional mengenai manajemen LUTS, khususnya OAB. Ke depannya, InaLUTS – Overactive Bladder diharapkan tidak hanya menjadi alat bantu klinis bagi tenaga medis, tetapi juga menjadi platform informasi terpercaya bagi pasien serta mendukung peningkatan mutu layanan kesehatan di bidang urologi secara menyeluruh." />
<meta property="twitter:image" content="https://inalutsoab.id/assets/img/logo-perkina-00.png" />

<!-- Meta Tags Generated with https://metatags.io -->

    @if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @else
    <meta name="viewport" content="width=1920">
    @endif
    <link rel="stylesheet" href="{{ asset('FWAdmin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/base-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/skins/skin-blue.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/plugins/datatables/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/plugins/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/plugins/icheck-1.x/skins/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/plugins/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <span class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{ asset('img/logo-perkina-01.png') }}" alt="{{ Config::get('cfg.title') }}" title="{{ Config::get('cfg.title') }}" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="{{ asset('img/logo-perkina-02.png') }}" alt="{{ Config::get('cfg.title') }}" title="{{ Config::get('cfg.title') }}" /></span>
        </span>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <span style="line-height:50px;color:white">{{ USER_NAME }} ({{ USER_ROLE }})</span>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
              <li>
                <a href="javascript:doLogout()" title="Logout">
                  <i class="fa fa-sign-out"></i>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      @include('layouts.menu');

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          @if(Session::has('error'))
          {{ BS::error(Session::get('error')) }}
          @endif

          @if(Session::has('errors'))
          {{ BS::error('<ul><li>'.implode('</li><li>', $errors->all()).'</li></ul>') }}
          @endif

          @if(Session::has('warning'))
          {{ BS::warning(Session::get('warning')) }}
          @endif

          @if(Session::has('success'))
          {{ BS::info(Session::get('success')) }}
          @endif

          @if (defined('PAGE_IS_FOLLOW_UP') && defined('FOLLOW_UP___TITLE'))
          <h4>{{ FOLLOW_UP___TITLE }}</h4>
          @endif
        </section>
        <section class="content">
          @if (IS_DETAIL_PASIEN || defined('PAGE_IS_FOLLOW_UP'))
          <style>
          .section{
            margin-right:12px;
          }
          .section-vertical {
            width: 175px;
            text-align: left;
          }
          .section-vertical a {
            background-color: #eee;
            color: black;
            display: block;
            padding: 12px;
            text-decoration: none;
          }
          .section-vertical a:hover {
            background-color: #ccc;
          }
          .section-vertical a.active {
            background-color: #4CAF50;
            color: white;
          }
          </style>
          <div style="display:flex;"><!-- div.flex -->
            <div class="section"><!-- div.section -->
              {{-- BS::box_begin() --}}
              <div class="box box-primary">
                <div class="box-body">
                  <div class="section-vertical">
                    @include('layouts/sidebar-detail')
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              {{-- BS::box_end() --}}
            </div><!-- /div.section -->
            <div style="flex:1;"><!-- div.flex.1 -->
          @endif

          @yield('content')

          @if (IS_DETAIL_PASIEN)
            </div><!-- /div.flex.1 -->
          </div><!-- /div.flex -->
          @endif
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer" style="text-align:center">
        <strong>Copyright &copy; 2023{{ (date('Y') > 2023) ? ' - '.date('Y') : '' }}.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <form id="frmLogout" method="post" action="{{ route('logout') }}">
      @csrf
    </form>
    <script>
      const UserType = {
        Administrator: 1,
        NationalCoordinator: 20,
        RegionalCoordinator: 30,
        LocalCoordinator: 40,
        Submitter: 50,
        1: "Administrator",
        20: "NationalCoordinator",
        30: "RegionalCoordinator",
        40: "LocalCoordinator",
        50: "Submitter"
      }
    </script>
    <script src="{{ asset('FWAdmin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}?t=date('Y-m-d')"></script>
    <script src="{{ asset('FWAdmin/plugins/icheck-1.x/icheck.min.js') }}"></script>
    <script src="{{ asset('FWAdmin/plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
      function doLogout(){
        if (confirm('Are you sure to logout?')) $('#frmLogout').submit();
      }

      @yield('js')

      $(function () {
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        });
        $('.datatables').DataTable({
          "responsive": true
        });
        $('.select2').select2();
        $('.div_datepicker').each(function(){
          const id = $(this).attr('id');
          if (id) {
            $('#' + id).datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayBtn: true,
              todayHighlight: true
            });
          }
        });
        $('input.iCheck').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%'
        });
        $('[required]').parent().find('label:first').addClass('required');
        $('[fake_required]').parent().find('label:first').addClass('fake_required');
        $('.iCheck[required]').parent().parent().find('label:first').addClass('required');
        $('.iCheck[fake_required]').parent().parent().find('label:first').addClass('fake_required');
        $('.datepicker[required]').parent().parent().parent().find('label:first').addClass('required');
        $('.datepicker[fake_required]').parent().parent().parent().find('label:first').addClass('fake_required');

        // Menu
        if($('li[data-active-module-action_{{ MODULE }}___{{ ACTION }}]'))$('li[data-active-module-action_{{ MODULE }}___{{ ACTION }}]').addClass('active');
        if($('li[data-active-module_{{ MODULE }}]'))$('li[data-active-module_{{ MODULE }}]').addClass('active');

        // Section
        if($('div.section-vertical a[data-active-module-action_{{ MODULE }}___{{ ACTION }}]'))$('div.section-vertical a[data-active-module-action_{{ MODULE }}___{{ ACTION }}]').addClass('active');

        @yield('jquery_ready')

        {{ BS::show_jquery_ready() }}
      });
    </script>
  </body>
</html>
