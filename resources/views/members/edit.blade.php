@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/members') }}">Member</a></li>
				<li class="active">Edit Member</li>
			</ul>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Member</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($member, ['url'=>route('members.update',$member->id), 'method'=>'put', 'files'=>'true','class'=>'form-horizontal']) !!}
					@include('members._from')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection