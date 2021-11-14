@php
    $options = ["Slovakia","Czech Republic", "Hungary", "United Kingdom"];
@endphp

<form method="POST" action="{{route("address.update")}}">
    @csrf
    <div class="modal fade" id="editAddress" tabindex="-1" aria-labelledby="editAddressLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="fs-5 modal-title" id="editAddressLabel">Edit Address</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="contactForm-name1">First name</label>
                        <input name="first_name" type="text" id="contactForm-name1"
                               class="form-control" value="{{auth()->user()->first_name}}">
                    </div>

                    <div class="mb-3">
                        <label for="contactForm-name2">Surname</label>
                        <input name="surname" type="text" id="contactForm-name2"
                               class="form-control" value="{{auth()->user()->surname}}">
                    </div>

                    <div class="mb-3">
                        <label for="street">Street</label>
                        <textarea name="street" id="street" class="form-control"
                                  rows="3">{{auth()->user()->street}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contactForm-city">City</label>
                        <input name="city" type="text" id="contactForm-city"
                               class="form-control" value="{{auth()->user()->city}}">
                    </div>
                    <div class="mb-3">
                        <label for="contactForm-postalCode">Postal Code</label>
                        <input name="postal_code" type="text" id="contactForm-postalCode"
                               class="form-control" value="{{auth()->user()->postal_code}}">
                    </div>

                    <div class="mb-3">
                        <label for="country">Country</label>
                        <!--    Bude doplnene vsetkymi krajinami-->
                        <select class="form-select " id="country" name="country"
                                data-bs-size="5"
                                aria-label="Select country">
                            @foreach($options as $option)
                                <option value="{{$option}}"
                                        @if($option == auth()->user()->country) selected @endif>{{$option}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-blue">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
