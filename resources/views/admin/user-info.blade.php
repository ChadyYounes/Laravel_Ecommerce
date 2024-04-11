<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile </title>
    <link rel="stylesheet" href="{{asset("css/editprofile.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Edit profile
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
                        <form action="{{ route('save-profile-edited-by-admin', ['user_id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    @if ($user->getProfile && $user->getProfile->image_url)
                                    <img id="avatar" src="{{ asset('storage/profile-images/' . $user->getProfile->image_url) }}" alt="Avatar" class="d-block ui-w-80">
                                @else
                                    <img id="avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Default Avatar" class="d-block ui-w-80">
                                @endif
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
                                        <input type="text" class="form-control mb-1" value="{{$user->name}}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control mb-1" value="{{$user->password}}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Full Name </label>
                                        <input type="text" class="form-control" name="full_name"
                                         value="{{$user->getProfile->full_name}}" required>
                                    </div>


                                </div>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Birthday </label>
                                        @php
                                            try {
                                                // Convert varchar birth_day to date format
                                                $formattedBirthday = Carbon::createFromFormat('m/d/Y', $user->getProfile->birth_day)->format('Y-m-d');
                                            } catch (\Exception $e) {
                                                // Handle the exception (e.g., invalid date format)
                                                $formattedBirthday = null;
                                            }
                                        @endphp
                                        <input type="date" class="form-control" name="birth_day"
                                         value="{{ $formattedBirthday }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Country </label>
                                        <input type="text" class="form-control" name="country"
                                        value="{{$user->getProfile->country}}" required>

                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">

                                    <div class="form-group">
                                        <label class="form-label">Phone </label>
                                        <input type="text" class="form-control" name="phone"
                                        value="{{$user->getProfile->phone}}" placeholder="xxx xxx xx" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address </label>
                                        <input type="text" class="form-control" name="address"
                                        value="{{$user->getProfile->address}}" required>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">X (formerly twitter)</label>
                                        <input type="text" class="form-control" name="x_twitter"
                                        value="{{$user->getProfile->x_twitter}}"  placeholder="https://">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook"
                                        value="{{$user->getProfile->facebook}}"  placeholder="https://">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" name="linkedin"
                                        value="{{$user->getProfile->linkedin}}" placeholder="https://">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="instagram"
                                        value="{{$user->getProfile->instagram}}" placeholder="https://">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="text-right mt-3" id="buttonBox">
                                <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                                
                            </div>
                        </form>
                        <div class="text-right mt-3" id="buttonBox">
                        <form action="{{ route('delete-account', ['user_id' => $user->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </form>
                    </div>


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
