@foreach (['success', 'error'] as $msg)
	@if (Session::has($msg))
		<div class="alert-box {{ $msg }}"><span>{{ \Str::title($msg) }}: </span> {{ Session::get($msg) }}</div>
	@endif
	@php
		Session::forget($msg);
	@endphp
@endforeach