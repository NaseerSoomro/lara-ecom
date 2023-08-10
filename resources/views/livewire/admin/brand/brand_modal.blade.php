<!-- Insert Brand Modal -->
<div wire:ignore.self class="modal fade" id="insertBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Brand</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeBrand">
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="name"> Name </label>
                        <input type="text" wire:model.defer="name" class="form-control rounded bordered" />
                        <span class="text-danger"> @error('name')
                                {{ $message }}
                            @enderror </span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="slug"> Slug </label>
                        <input type="text" wire:model.defer="slug" class="form-control rounded bordered" />
                        <span class="text-danger"> @error('slug')
                                {{ $message }}
                            @enderror </span>
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <label for="statuss"> Status </label>
                        <input type="checkbox" wire:model.defer="status" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Insert</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Brand Modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Brand</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                Loading...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="name"> Name </label>
                            <input type="text" wire:model.defer="name" class="form-control rounded bordered" />
                            <span class="text-danger"> @error('name')
                                    {{ $message }}
                                @enderror </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="slug"> Slug </label>
                            <input type="text" wire:model.defer="slug" class="form-control rounded bordered" />
                            <span class="text-danger"> @error('slug')
                                    {{ $message }}
                                @enderror </span>
                        </div>
                        <div class="col-md-12 mb-3 text-center">
                            <label for="statuss"> Status </label>
                            <input type="checkbox" wire:model.defer="status" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary text-white">Insert</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- View Brand Modal -->
<div wire:ignore.self class="modal fade" id="showBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Brand</h1>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                Loading...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="name"> Name </label>
                            <input type="text" wire:model.defer="name" class="form-control rounded bordered" readonly/>
                            <span class="text-danger"> @error('name')
                                    {{ $message }}
                                @enderror </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="slug"> Slug </label>
                            <input type="text" wire:model.defer="slug" class="form-control rounded bordered" readonly />
                            <span class="text-danger"> @error('slug')
                                    {{ $message }}
                                @enderror </span>
                        </div>
                        <div class="col-md-12 mb-3 text-center">
                            <label for="statuss"> Status </label>
                            <input type="checkbox" wire:model.defer="status" readonly/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary text-white">Insert</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Brand Modal -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Brand</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyBrand">
                @csrf
                <div class="modal-body">
                    <h3 class="text-danger">Are you sure you want to delete?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
