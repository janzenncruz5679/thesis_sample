<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
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
            <div align="center" style="padding: 100px">
                <table>
                    <tr style="background-color: #00d9a5; text-align:center;">
                        <th style="padding: 20px 30px; font-size: 1.5rem; color:white">Image</th>
                        <th style="padding: 20px 30px; font-size: 1.5rem; color:white">Doctor Name</th>
                        <th style="padding: 20px 30px; font-size: 1.5rem; color:white">Phone</th>
                        <th style="padding: 20px 30px; font-size: 1.5rem; color:white">Speciality</th>
                        <th style="padding: 20px 30px; font-size: 1.5rem; color:white">Room #</th>
                        <th style="padding: 20px 30px; font-size: 1.5rem; color:white">Actions</th>

                    </tr>
                    @foreach ($data_doctor as $data_doctors)
                        <tr style="text-align:center">
                            <td style="padding: 20px; font-size: 1rem; color:white"><img
                                    src="doctorimage/{{ $data_doctors->image }}" alt="doctor image"
                                    style="height: 150px; "></td>
                            <td style="padding: 20px; font-size: 1rem; color:white">{{ $data_doctors->name }}</td>
                            <td style="padding: 20px; font-size: 1rem; color:white">{{ $data_doctors->phone }}</td>
                            <td style="padding: 20px; font-size: 1rem; color:white">{{ $data_doctors->speciality }}</td>
                            <td style="padding: 20px; font-size: 1rem; color:white">{{ $data_doctors->room_num }}</td>
                            <td style="padding: 20px; font-size: 1rem; color:white">
                                <a class="btn btn-primary"
                                    href="{{ url('/updatedoctor', $data_doctors->id) }}">Update</a>
                                <a class="btn btn-danger" href="{{ url('deletedoctor', $data_doctors->id) }}"
                                    onclick="return confirm('are you sure you want to delete')">delete</a>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        @include('admin.script')
</body>

</html>
