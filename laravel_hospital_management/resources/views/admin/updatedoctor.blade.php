<!DOCTYPE html>
<html lang="en">

<head>
    {{-- include all style files in css --}}
    <base href="/public">
    @include('admin.css')
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates,
                                and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/corona-free/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->

        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <div class="container-fluid page-body-wrapper">
            <div class="container-fluid page-body-wrapper">

                <div class="container" align="center" style="padding-top:100px">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-bs-dismiss="alert">
                                X
                            </button>

                        </div>
                    @endif
                    <form action="{{ url('editdoctor', $update_data_doctor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div style="padding: 20px">
                            <label>Doctor Name</label>
                            <input type="text" style="color: black" name="name" placeholder="Write Doctor's Name"
                                value="{{ $update_data_doctor->name }}" required>
                        </div>
                        <div style="padding: 20px">
                            <label>Phone #</label>
                            <input type="number" style="color: black" name="phone"
                                placeholder="Write Doctor's Phone Number" value="{{ $update_data_doctor->phone }}"
                                required>
                        </div>
                        <div style="padding: 20px">
                            <label>Speciality</label>
                            <select name="speciality" style="color: black; width: 200px;">
                                <option value="{{ $update_data_doctor->speciality }}" selected>
                                    {{ $update_data_doctor->speciality }}
                                </option>
                                <option value="Opthalmology">Opthalmology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="EENT">EENT</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="General Surgeon">General Surgeon</option>
                            </select>
                        </div>
                        <div style="padding: 20px">
                            <label>Room #</label>
                            <input type="number" style="color: black" name="room" placeholder="Write Doctor's Name"
                                value="{{ $update_data_doctor->room_num }}" required>
                        </div>
                        <div style="padding: 20px">
                            <label>Old Image</label>
                            <img src="doctorimage/{{ $update_data_doctor->image }}" alt="doctor image" height="150"
                                width="150">
                        </div>
                        <div style="padding: 20px">
                            <label>Change Image</label>
                            <input type="file" style="color: black" name="file"
                                value="{{ $update_data_doctor->room_num }}">
                        </div>
                        <div style="padding: 20px">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        @include('admin.script')
</body>

</html>
