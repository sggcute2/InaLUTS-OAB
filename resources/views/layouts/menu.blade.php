<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li
        data-active-module_dashboard="1"
        data-active-module_hospital="1"
        data-active-module-action_patient___add="1"
        data-active-module-action_patient___edit="1"
      >
      @if (IS_USER_TYPE_1)
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      @else
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      @endif
      </li>
      @if (!IS_USER_TYPE_3)
      <li
        data-active-module_user="1"
      >
        <a href="{{ URL::to('user') }}">
          <i class="fa fa-users"></i> <span>User</span>
        </a>
      </li>
      @endif
      <li
        data-active-module_profile="1"
      >
        <a href="{{ URL::to('profile') }}">
          <i class="fa fa-user"></i> <span>Profile</span>
        </a>
      </li>
      @if (IS_DETAIL_PATIENT)
        @if (defined('DISALLOW_ACCESS_DETAIL_PATIENT') && DISALLOW_ACCESS_DETAIL_PATIENT)
        @else
      <li style="color:white"><a href="{{ route('hospital.list_patient', ['id' => $data_patient->Hospital_ID]) }}">{{ $data_patient->hospital_name }}</a></li>
      <li class="header"><b style="color:cyan;font-size:125%">Detail Patient</b></li>
          @if ($data_patient->Patient_Name)
      <li class="header" style="color:white">{{ $data_patient->Patient_Code . ' - ' . $data_patient->Patient_Name }}</li>
          @endif
        @endif
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
