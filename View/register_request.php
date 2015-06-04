<!DOCTYPE html>
<html no-repeat center center fixed>
      <head>
        <title>WAP / Request sign up</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <label class="navbar-brand">What a pro</label>
                </div>
                <div class="navbar-collapse collapse">

                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="row">
                    <form role="form" name="inputeditaccount" action="take_request_signup.php" method="post" enctype="multipart/form-data">

                        <div class="col-md-12">
                            <label class="titleFontSize">Request Signup</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputName">Shop name</label>
                                <input type="text" class="form-control" name="inputName" placeholder="WAP shop" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input type="email" class="form-control" name="inputEmail" placeholder="wapbar@wap.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPassword">Create a password</label>
                                <input type="password" class="form-control" name="inputPassword" placeholder="Your Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPasswordAgain">Confirm Password</label>
                                <input type="password" class="form-control" name="inputPasswordAgain" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPhoneNumber">Phone number</label>
                                <input type="text" class="form-control bfh-phone" name="inputPhoneNumber" placeholder="053222222" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputSubDistrict">Area</label>
                                <select name="comboDistrict" class="form-control" required>
                                    <option></option>
                                    <option value="1"> Suthep </option>;
                                    <option value="2"> Nai Maung </option>;
                                    <option value="3"> Si Phum </option>;
                                    <option value="4"> Phra Sing </option>;
                                    <option value="5"> Chang Phueak </option>;
                                    <option value="6"> Mae Hia </option>;
                                    <option value="7"> Pa Daet </option>;
                                    <option value="8"> Pa Tan </option>;
                                    <option value="9"> Chang Moi </option>;
                                    <option value="10"> Chang Khlan </option>;
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputOpenAndCloseTime">Open and Close</label>
                                    <input type="text" class="form-control" name="inputOpenAndCloseTime" placeholder="Mon - Sat from 09.00-23.00" required>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputImageLabel">Browse Image</label>
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="map">Pin your shop location on the map</label>
                                <div id="googleMap" ></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLatitude">Latitude</label>
                                <input type="text" class="form-control" id="inputLatitude"  name="inputLatitude" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputLongitude">Longitude</label>
                                <input type="text" class="form-control" id="inputLongitude"  name="inputLongitude" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label >A description for your shop</label>
                                <textarea class="form-control" name="inputDescription" rows="3" required></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label class="control-label">Terms and Conditions</label>
                                <textarea class="form-control" name="termAndConditions" rows="3" readonly="readonly">
By registering here and creating your "WAP Account", you can access different services that are offered by us without having to register for each service separately. If a service you wish to subscribe to has additional terms and conditions, you will be asked to accept these separately.
You agree that:
(1) you will keep your username and password safe, and won't share them with anyone.
(2) you will not pass yourself off as someone else or create multiple, false accounts.
                                </textarea>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="inputCheckbox" required > I agree to WAP's terms and conditions</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                    <div class="col-md-1">
                        <a class="btn btn-default" href="index.php" role="button">Back</a>
                    </div>
                </div>
            </div><!-- /row -->
        </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
    <style>
        #googleMap{
            width: 100%;
            height:300px;
        }
    </style>
    <script>
        var myCenter = new google.maps.LatLng(18.789570, 98.974244);
        var geocoder;
        var infowindow = new google.maps.InfoWindow();
        var map;
        function initialize()
        {
            geocoder = new google.maps.Geocoder();
            var mapProp = {
                center:myCenter,
                zoom:15,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });
        }
        var marker;
        function placeMarker(location) {
            if ( marker ) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
                
            var latlng = new google.maps.LatLng(location.lat(), location.lng());
            geocoder.geocode({'latLng': latlng}, function(results) {
                infowindow.setContent(results[1].formatted_address);
                infowindow.open(map, marker);
                document.inputeditaccount.temp.value = results[1].formatted_address;
            });
                
            document.inputeditaccount.inputLatitude.value= location.lat();
            document.inputeditaccount.inputLongitude.value= location.lng();
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>
</html>
