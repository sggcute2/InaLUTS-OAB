<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
      @hasSection('title')
        @yield('title')
        &ndash;
      @endif
      {{ \Config::get('app.name') }}
    </title>

<!-- Primary Meta Tags -->
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

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('FWAdmin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FWAdmin/dist/css/base-theme.min.css') }}">
  </head>
  <body class="hold-transition login-page">
    <br><br>
    <div class="login-box">
      <div class="login-box-body">
        <div class="login-logo">
          <img src="{{ asset('img/logo-perkina-00.png') }}" alt="{{ \Config::get('app.name') }}" title="{{ \Config::get('app.name') }}" />
        </div><!-- /.login-logo -->
        <p class="login-box-msg">Sign in to enter administration page</p>
        @if(Session::has('error'))
        {{ BS::error(Session::get('error')) }}
        @endif

        @if(Session::has('warning'))
        {{ BS::warning(Session::get('warning')) }}
        @endif

        @if(Session::has('success'))
        {{ BS::info(Session::get('success')) }}
        @endif

        @yield('content')
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('FWAdmin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script>
      $(function () {
        @if(Session::has('error'))
        $('#password').focus();
        @else
        $('#username').focus();
        @endif
      });
    </script>
  </body>
</html>
