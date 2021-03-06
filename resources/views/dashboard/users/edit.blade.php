@extends('layouts.dashboard.app')

@section('content')

	<div class="content-wrapper">
		<section class="content-header">
			<h1>@lang('site.users')</h1>
			
			<ol class="breadcrumb">
				<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
				<li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
				<li class="active">@lang('site.edit')</li>
			</ol>
		</section>

		<section class="content">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">@lang('site.edit')</h3>
				</div>

				@include('partials._errors')

				<div class="box-body">
					<form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('PUT')

						<div class="form-group">
							<label for="first_name">@lang('site.first_name')</label>
							<input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}" required>
						</div>

						<div class="form-group">
							<label for="last_name">@lang('site.last_name')</label>
							<input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}" required>
						</div>

						<div class="form-group">
							<label for="email">@lang('site.email')</label>
							<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
						</div>

						<div class="form-group">
							<label for="image">@lang('site.image')</label>
							<input type="file" name="image" id="image" class="form-control image-input">
						</div>

						<div class="form-group">
							<img src="{{ $user->image_path }}" class="img-thumbnail image-preview" style="width: 100px">
						</div>

						<div class="form-group">
							<label>@lang('site.permissions')</label>

							<div class="nav-tabs-custom">

								@php
									$models = ['users', 'categories', 'products', 'clients', 'orders'];
									$perms = ['create', 'read', 'update', 'delete'];
								@endphp

					            <ul class="nav nav-tabs">
					            	@foreach ($models as $index => $model)
					            		<li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab" aria-expanded="true">@lang("site.{$model}")</a></li>
					            	@endforeach
					            </ul>

					            <div class="tab-content">
					            	@foreach ($models as $index => $model)
						              	<div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
						              		@foreach ($perms as $key => $perm)
												<label>
													<input type="checkbox" name="permissions[]" value="{{ "{$perm}_{$model}" }}" 
														{{ old('permissions') ? (in_array("{$perm}_{$model}", old('permissions')) ? 'checked' : '') : ($user->hasPermission("{$perm}_{$model}") ? 'checked' : '') }}> @lang("site.{$perm}")
												</label>
						              		@endforeach
						              	</div>
						            @endforeach
					            </div>
				          	</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>

@endsection