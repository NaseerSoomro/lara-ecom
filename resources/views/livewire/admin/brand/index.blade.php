<div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary text-white float-end" data-bs-toggle="modal"
                    data-bs-target="#insertBrandModal">
                    Add Brand
                </button>
            </div>
            @if (session('message'))
                <h6 class="alert alert-success"> {{ session('message') }} </h6>
            @endif
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->category->name }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>{{ $brand->status == '1' ? 'Visible' : 'Hidden' }}</td>
                                <td>
                                    <a wire:click="showBrand({{ $brand->id }})"
                                        class="btn btn-primary btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="#showBrandModal">View</a>
                                    <a wire:click="editBrand({{ $brand->id }})"
                                        class="btn btn-success btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="#updateBrandModal">Edit</a>
                                    <button wire:click="deleteBrand({{ $brand->id }})"
                                        class="btn btn-danger btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="#deleteBrandModal">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Record Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $brands->links() }}
                </div>
            </div>
            {{-- @if ($isModalOpen) --}}
            @include('livewire.admin.brand.brand_modal') <!-- Include the BrandModal component -->
            {{-- @endif --}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            window.addEventListener('close-modal', event => {
                $('#insertBrandModal').modal('hide');
                $('#updateBrandModal').modal('hide');
                $('#deleteBrandModal').modal('hide');
            });
        });
        document.addEventListener('livewire:load', function() {
            Livewire.on('hideMessage', function(data) {
                setTimeout(function() {
                    @this.call('hideMessage');
                }, data.delay);
            });
        });
    </script>
@endpush
