<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set up profile </title>
    <link rel="stylesheet" href="{{asset("css/setprofile.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Set up your profile
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">{{$user->email}}</a>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <form action="{{ route('save-profile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    <img id="avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                        alt class="d-block ui-w-80">

                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input type="file" class="account-settings-fileinput"
                                                onchange="previewImage(this)" name="image_url">
                                        </label> &nbsp;

                                        <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of
                                            800K</div>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" value="{{$user->name}}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Full Name<span style="color: red;">*</span> </label>
                                        <input type="text" class="form-control" name="full_name" required>
                                    </div>


                                </div>
                                <div class="card-body pb-2">

                                    <div class="form-group">
                                        <label class="form-label">Birthday<span style="color: red;">*</span> </label>
                                        <input type="date" class="form-control" name="birth_day" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Country<span style="color: red;">*</span> </label>
                                        <input type="text" class="form-control" name="country" required>

                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">

                                    <div class="form-group">
                                        <label class="form-label">Phone<span style="color: red;">*</span> </label>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="xxx xxx xx" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address<span style="color: red;">*</span> </label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">X (formerly twitter)</label>
                                        <input type="text" class="form-control" name="x_twitter"
                                            placeholder="https://">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook"
                                            placeholder="https://">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" name="linkedin"
                                            placeholder="https://">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="instagram"
                                            placeholder="https://">
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <label class="form-label" style="font-weight:500;">Choose account type<span style="color: red;">*</span> </label>
                                    <br><br>
                                    <div class="form-group">
                                        <label class="form-label" for="buyer">I am a buyer</label>
                                        <input type="radio" name="buyer-seller" value="buyer" id="buyer" class="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="seller">I am a seller</label>
                                        <input type="radio" name="buyer-seller" value="seller" id="seller"
                                            class="">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3" id="buttonBox">
                                <button type="submit" class="btn btn-primary">Save and continue</button>&nbsp;
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
    <script data-cfasync="false"
        src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
