@extends('layouts.user')

@section('title')
Dashboard
@endsection

@section('content')
<h3>Dashboard</h3>
<hr>
<h2>Post</h2>
<hr>
menu :
@can('dashboard-menu')
Allow
@else
Disallow
@endcan
<br>
add :
@can('dashboard-add')
Allow
@else
Disallow
@endcan
<br>
view :
@can('dashboard-view')
Allow
@else
Disallow
@endcan
<br>
edit :
@can('dashboard-edit')
Allow
@else
Disallow
@endcan
<br>
delete :
@can('dashboard-delete')
Allow
@else
Disallow
@endcan
<br>
@endsection
