<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>
            @if ($totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Item Total Amount :
                                <span class="float-end">${{ $totalProductAmount }}</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 3 - 5 days.</small>
                            <br />
                            <small>* Tax and other charges are included ?</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Basic Information
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" wire:model.defer="fullName" id="fullName"
                                        class="form-control" placeholder="Enter Full Name" />
                                    @error('fullName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" wire:model.defer="phone" id="phone" class="form-control"
                                        placeholder="Enter Phone Number" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" wire:model.defer="email" id="email" class="form-control"
                                        placeholder="Enter Email Address" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pin-code (Zip-code)</label>
                                    <input type="number" wire:model.defer="pinCode" id="pinCode" class="form-control"
                                        placeholder="Enter Pin-code" />
                                    @error('pinCode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea wire:model.defer="address" id="address" class="form-control" rows="2"></textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>Select Payment Mode: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr="disabled" class="nav-link active fw-bold"
                                                id="cashOnDeliveryTab-tab" data-bs-toggle="pill"
                                                data-bs-target="#cashOnDeliveryTab" type="button" role="tab"
                                                aria-controls="cashOnDeliveryTab" aria-selected="true">Cash
                                                on Delivery</button>
                                            <button wire:loading.attr="disabled" class="nav-link fw-bold"
                                                id="onlinePayment-tab" data-bs-toggle="pill"
                                                data-bs-target="#onlinePayment" type="button" role="tab"
                                                aria-controls="onlinePayment" aria-selected="false">Online
                                                Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane fade active show" id="cashOnDeliveryTab"
                                                role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>Cash on Delivery Mode</h6>
                                                <hr />
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="codOrder()" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="codOrder">
                                                        Place Order (Cash on Delivery)
                                                    </span>
                                                    <span wire:loading wire:target="codOrder">
                                                        Placing Order...
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                                aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment Mode</h6>
                                                <hr />
                                                {{-- <button wire:loading.attr="disabled"
                                                    wire:click="createPayment({{ $totalProductAmount }})" type="button"
                                                    class="btn btn-warning">Pay with Paypal (Online
                                                    Payment)
                                                </button> --}}
                                                {{-- <a href=""
                                                    wire:click="createPayment({{ $totalProductAmount }})" type="button"
                                                    class="btn btn-warning">Pay Now (Online
                                                    Payment)
                                                </a> --}}
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center">
                    <h4> No Items in Cart </h4>
                    <a href="{{ route('collections') }}" class="btn btn-primary btn-sm">Shop Now</a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=ATN4e7N3HO3Fxi5XFHM2wZ8DO8ZA1ilc9gfjqcntB37cFtR6WM4VGunbWktv-1IwEnqwMtXF0HDYtGk7&currency=USD">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        window.paypal
            .Buttons({
                onClick() {

                    // Show a validation error if the input is not filled

                    if (!document.getElementById('fullName').value ||
                        !document.getElementById('phone').value ||
                        !document.getElementById('email').value ||
                        !document.getElementById('pinCode').value ||
                        !document.getElementById('address').value) {

                        // document.querySelector('#error').classList.remove('hidden');
                        Livewire.emit('inputValidation');
                        return false;
                    } else {
                        @this->set('fullName', document.getElementById('fullName').value);
                        @this->set('phone', document.getElementById('phone').value);
                        @this->set('email', document.getElementById('email').value);
                        @this->set('pinCode', document.getElementById('pinCode').value);
                        @this->set('address', document.getElementById('address').value);
                    }

                },
                createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01' // "{{ $this->totalProductAmount }}"
                        }
                    }]
                });
            },

            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture Result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[
                    0]; // Fix typo here
                    if (transaction.status == 'COMPLETED') {
                        Livewire.emit('transactionIdEmit', transaction.id);
                    }
                });
            },               
            }).render("#paypal-button-container");
            });
            </script>
@endpush
