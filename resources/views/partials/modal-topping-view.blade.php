@foreach (App\Models\Topping::where('Status', 'not like', '%Delete%')->get() as $topi)
    @if (array_key_exists($topi->Id, $session_toppings))
        <ul style="list-style: none" class="text-left col-md-6">
            <li class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="Topping[]" id="Topping{{ $topi->Id }}" data-Topping-price = "{{ $topi->Price ?? "" }}" value={{ $topi->Id ?? "" }} checked>
                <label class="form-check-label font-weight-normal ml-5" for="Topping{{ $topi->Id ?? "" }}">
                    {{ $topi->Name ?? "" }}
                    <span style="font-size: 1.3rem">
                        &nbsp;&nbsp;&nbsp;{{ number_format($topi->Price, 0, ',', '.') }}đ</span>
                </label>
            </li>
        </ul>
    @else
        <ul style="list-style: none" class="text-left col-md-6">
            <li class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="Topping[]" id="Topping{{ $topi->Id ?? "" }}" data-Topping-price = "{{ $topi->Price ?? "" }}" value={{ $topi->Id ?? "" }}>
                <label class="form-check-label font-weight-normal ml-5" for="Topping{{ $topi->Id ?? "" }}">
                    {{ $topi->Name ?? "" }}
                    <span style="font-size: 1.3rem">
                        &nbsp;&nbsp;&nbsp;{{ number_format($topi->Price, 0, ',', '.') }}đ</span>
                </label>
            </li>
        </ul>
    @endif
@endforeach