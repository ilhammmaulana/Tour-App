@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Destinations'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Destinations</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-gradient-primary ms-4 mt-1 mb-4" data-bs-toggle="modal"
                            data-bs-target="#createDestination">
                            Create Destination
                        </button>

                        <div class="modal fade" id="createDestination" tabindex="-1" role="dialog"
                            aria-labelledby="createModelDestination" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModelDestination">Craete Destination</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <img id="imagePreview" src="#" alt="Image Preview"
                                                    style="display: none; max-width: 100%; max-height: 300px;">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="name" class="h6">Destination name</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="Destination name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="photo" class="h6">Destination photo</label>
                                                    <div class="form-group">
                                                        <input type="file" id="imageInput" accept=".jpg, .jpeg"
                                                            onchange="previewImage(event)"class="form-control"
                                                            name="image">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="latitude" class="h6">Latitude</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="latitude"
                                                            name="latitude" placeholder="Latitude">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="longitude" class="h6">Longitude</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="longitude"
                                                            name="longitude" placeholder="Longitude">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="address" class="h6">Destination address</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="address"
                                                            name="address" placeholder="Destination address">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn bg-gradient-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Photo</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Longtitude</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Latitude</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($destinations as $destination)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $destination['name'] }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ Str::limit($destination['description'], 40, '...') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <img src="{{ asset($destination['image']) }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                {{ $destination['longitude'] }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $destination['latitude'] }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-xs font-weight-bold">
                                                {{ $destination['address'] }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <script>
        function previewImage(event) {
            const imageInput = event.target;
            const imagePreview = document.getElementById('imagePreview');

            if (imageInput.files && imageInput.files[0]) {
                const file = imageInput.files[0];
                const reader = new FileReader();

                // Check file type
                const fileType = file.type;
                const validImageTypes = ['image/jpeg', 'image/jpg'];
                if (!validImageTypes.includes(fileType)) {
                    alert('Please select a valid JPG/JPEG image.');
                    imageInput.value = '';
                    return;
                }

                // Check file size
                const fileSizeMB = file.size / (1024 * 1024);
                const maxSizeMB = 2;
                if (fileSizeMB > maxSizeMB) {
                    alert('Image size must be less than 2MB.');
                    imageInput.value = '';
                    return;
                }

                // Read the image file and display the preview
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                // Reset the preview if no image is selected
                imagePreview.src = '#';
                imagePreview.style.display = 'none';
            }
        }
    </script>
@endsection
