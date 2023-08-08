<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      @canany([
        'kota-menu',
        'rumah_sakit-menu',
        'departemen-menu',
        'dokter_pemeriksa-menu'
      ])
      <li class="treeview"
        data-active-module_kota="1"
        data-active-module_rumah_sakit="1"
        data-active-module_departemen="1"
        data-active-module_dokter_pemeriksa="1"
      >
        <a href="#">
          <i class="fa fa-table"></i>
          <span>Master Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right" style="padding-right:1em"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can('kota-menu')
          <li data-active-module_kota="1"><a href="{{ route('kota.index') }}"><i class="fa fa-circle-o"></i> Kota</a></li>
          @endcan
          @can('rumah_sakit-menu')
          <li data-active-module_rumah_sakit="1"><a href="{{ route('rumah_sakit.index') }}"><i class="fa fa-circle-o"></i> Rumah Sakit</a></li>
          @endcan
          @can('departemen-menu')
          <li data-active-module_departemen="1"><a href="{{ route('departemen.index') }}"><i class="fa fa-circle-o"></i> Departemen</a></li>
          @endcan
          @can('dokter_pemeriksa-menu')
          <li data-active-module_dokter_pemeriksa="1"><a href="{{ route('dokter_pemeriksa.index') }}"><i class="fa fa-circle-o"></i> Dokter Pemeriksa</a></li>
          @endcan
        </ul>
      </li>
      @endcanany

{{--
      <li
        data-active-module_dashboard="1"
        data-active-module_hospital="1"
        data-active-module-action_patient___add="1"
        data-active-module-action_patient___edit="1"
      >
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
--}}

      @can('user-menu')
      <li data-active-module_user="1"><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> User</a></li>
      @endcan
      @can('pasien-menu')
      <li data-active-module_pasien="1"><a href="{{ route('pasien.index') }}"><i class="fa fa-user"></i> Pasien</a></li>
      @endcan
      @can('profile-menu')
      <li data-active-module_profile="1"><a href="{{ route('profile.index') }}"><i class="fa fa-user"></i> Profile</a></li>
      @endcan
      @if (IS_DETAIL_PASIEN)
      <li style="color:white"><a href="{{ route('pasien.index') }}">{{ $data_pasien->rumah_sakit->name }}</a></li>
      <li class="header"><b style="color:cyan;font-size:125%">Detail Pasien</b></li>
        @if ($data_pasien->name)
      <li class="header" style="color:white">{{ $data_pasien->code . ' - ' . $data_pasien->name }}</li>
        @endif
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
