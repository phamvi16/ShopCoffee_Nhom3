<!-- Show all available size of current product -->
@foreach ($all_pro_sizes as $prosize)
	@if ($prosize->Size == $product_size)
	    <input class="form-check-input" type="radio" data-saleprice="{{ $prosize->Sale_Price ?? "" }}" data-size="{{ $prosize->Size ?? "" }}" name="product_size" id="SizeId{{ $prosize->Id ?? "" }}"
	        value="{{ $prosize->Id ?? "" }}" checked>
	    <label class="form-check-label" for="SizeId{{ $prosize->Id }}">{{ $prosize->Size ?? "" }} ({{ number_format($prosize->Sale_Price, 0, ',', '.') }}đ)</label>
	@else
	    <input class="form-check-input" type="radio" data-saleprice="{{ $prosize->Sale_Price ?? "" }}" data-size="{{ $prosize->Size ?? "" }}" name="product_size" id="SizeId{{ $prosize->Id ?? "" }}"
	        value="{{ $prosize->Id ?? "" }}">
	    <label class="form-check-label" for="SizeId{{ $prosize->Id ?? "" }}">{{ $prosize->Size ?? "" }} ({{ number_format($prosize->Sale_Price, 0, ',', '.') }}đ)</label>
	@endif
@endforeach
