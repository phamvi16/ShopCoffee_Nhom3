<!-- Show all available size of current product -->
@foreach ($all_pro_sizes as $prosize)
	@if ($prosize->Size == $product_size)
	    <input class="form-check-input" type="radio" data-saleprice="{{ $prosize->Sale_Price }}" name="product_size" id="{{ $prosize }}"
	        value="{{ $prosize->Size }}" checked>
	    <label class="form-check-label" for="inlineRadio1">{{ $prosize->Size }}</label>
	@else
	    <input class="form-check-input" type="radio" data-saleprice="{{ $prosize->Sale_Price }}" name="product_size" id="{{ $prosize }}"
	        value="{{ $prosize->Size }}">
	    <label class="form-check-label" for="inlineRadio1">{{ $prosize->Size }}</label>
	@endif
@endforeach
