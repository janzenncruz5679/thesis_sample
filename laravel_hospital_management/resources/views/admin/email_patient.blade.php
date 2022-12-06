<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <style>
        label {
            display: inline-block;
            width: 200px;
        }
    </style>
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

        @include('admin.sidebar')
        @include('admin.navbar')

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
                <form action="{{ url('send_email', $email_data->id) }}" method="POST">
                    @csrf
                    <div style="padding: 20px">
                        <label>Greeting</label>
                        <input type="text" style="color: black" name="greeting" required>
                    </div>
                    <div style="padding: 20px">
                        <label>Body</label>
                        <input type="text" style="color: black" name="body" required>
                    </div>
                    <div style="padding: 20px">
                        <label>Action Text</label>
                        <input type="text" style="color: black" name="action_text" required>
                    </div>
                    <div style="padding: 20px">
                        <label>Action Url</label>
                        <input type="text" style="color: black" name="action_url" required>
                    </div>
                    <div style="padding: 20px">
                        <label>End Part</label>
                        <input type="text" style="color: black" name="end_part" required>
                    </div>

                    <div style="padding: 20px">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>
