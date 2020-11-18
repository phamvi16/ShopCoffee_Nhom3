    <span class="col-sm-1 my-5 icon-dlt">
        <a href="{{ url('/del-pro-cart/' . $item['session_id']) }}">
            <i class="fas fa-times text-danger"></i>
        </a>
    </span> --}}
    <span class="col-xs-12 col-sm-12 d-flex align-items-center">
        <span class="col-sm-1 my-5 icon-dlt w-auto">
            <a href="{{ url('/del-pro-cart/' . $item['session_id']) }}">
                <i class="fas fa-times text-danger"></i>
            </a>
        </span>
        <img id="img-cart" class="item-img cart-img-respon"
            src="/ProductImages/Products/{{ $item['product_image'] ?? "" }}">
        <div class="item-content" style=" width:200px">
            <div class="mt-3 cart-proname-respon" style="font-weight: 600; font-size: 16px;">{{ $item['product_name'] ?? "" }}
            </div>
            <div class="text mt-4">
                @if ($item['product_size'] != "None")
                    <div> Size: {{ $item['product_size'] ?? "" }}</div>
                    <div>Topping:
                        @if (count($item['topping']) > 0)
                            @foreach ($item['topping'] as $key => $value)
                                @php
                                    $topping = App\Models\Topping::find($key);
                                @endphp
                                @if ($loop->last)
                                    {{ $topping->Name ?? "" }}
                                @else
                                    {{ $topping->Name ?? ""}},
                                @endif
                                <br>
                            @endforeach
                        @else
                            Chưa thêm topping
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <span class="col-sm-2 price-cart cart-price-respon">{{ number_format($item['product_price'], 0, ',', '.') }}
            đ</span>

        <span data-id_form="{{ $item['product_id'] }}" name="add-to-cart" type="add-to-cart"
            data-toggle="modal" data-target="#exampleModal"
            class="col-sm-2 show-form cart-price-respon">{{ number_format((new App\Services\CartService())->getCartItemTotal($cartkey), 0, ',', '.') }}
            đ
        </span>
        <span class="col-md-2 btn btn-success btn-update text-white cart-btn-update">
            <a href="#" data-id_form="{{ $item['product_id'] }}" name="add-to-cart" type="add-to-cart"
                data-toggle="modal" data-key="{{ $cartkey }}" data-target="#exampleModal{{ $cartkey }}" class="mt-5 text-white">
                Cập nhật
            </a>
        </span>
    </span>

        <div class="btn btn-success btn-update text-white btn-2 d-none" style="margin-left: 70%">
            <a href="#" data-id_form="{{ $item['product_id'] }}" name="add-to-cart" type="add-to-cart"
                data-toggle="modal" data-key="{{ $cartkey }}" data-target="#exampleModal{{ $cartkey }}" class="mt-5 text-white">
                Cập nhật
            </a>
        </div>


    {{-- <span class="col-sm-2 mt-5 price-cart cart-price-respon">{{ number_format($item['product_price'], 0, ',', '.') }}
        đ</span>

    <span data-id_form="{{ $item['product_id'] }}" name="add-to-cart" type="add-to-cart"
        data-toggle="modal" data-target="#exampleModal"
        class="col-sm-2 mt-5 show-form cart-price-respon">{{ number_format((new App\Services\CartService())->getCartItemTotal($cartkey), 0, ',', '.') }}
        đ
    </span>
    <span class="col-sm-2 btn btn-success btn-update text-white cart-btn-update">
        <a href="#" data-id_form="{{ $item['product_id'] }}" name="add-to-cart" type="add-to-cart"
            data-toggle="modal" data-key="{{ $cartkey }}" data-target="#exampleModal{{ $cartkey }}" class="mt-5 text-white">
            Cập nhật
        </a>
    </span> --}}
    <div class="hr mt-4 w-100"></div>
{{-- </div> --}}
