<!-- <!DOCTYPE html>
<html>
    <head>
        <title>Update user</title>
    </head>
    <body> -->
        <div id="content">
            <h2>Update User Data</h2>
            <?php foreach($users as $row):?>
            <form id="update_user_form" action="<?php echo BASE_URL.'/home/update_now/'.$row->id;?>" method="post">
            <input type="hidden" name="userid" value="<?php echo $row->id?>" />
            <p class="p3">Username:<input type="text" name="username" placeholder="username" value="<?php echo $row->duser?>"/><br/></p>
            <p class="p3">Email:<input type="email" name="email" placeholder="email" value="<?php echo $row->email?>" readonly/><br/></p>
            <p class="p3">Department:<input type="text" name="department" placeholder="department" value="<?php echo $row->department?>"/><br/></p>
            <p class="p3">Designation:<input type="text" name="designation" placeholder="designation" value="<?php echo $row->designation?>"/><br></p>
            <?php endforeach;?>
            <p class="p3">Update User Address:</p>

            <select name="country" id="countryid" >
                <option value="" selected="selected" >Select Country</option>
                <?php foreach($country as $count): ?>
                <option value="<?php echo $count->id; ?>"><?php echo $count->name; ?></option>
                <?php endforeach; ?> 
            </select>
            <br/>
            <br/>

            <select name="state" id="state">
                <option value="" selected="selected"><span id="state">Select country first</span></option>
            </select>
            <br/>
            <br/>

            <select name="city" id="city">
                <option value=""><span id="city">Select state first</span></option>
            </select>
            <br/>
            <br/>

            <div id="locationField">
                <input name="address" id="autocomplete" placeholder="Enter your address"  type="text"></input>
            </div>
            <br/>

            <table id="address">
                <tr>
                    <td class="label">Street address</td>
                    <td class="slimField"><input class="field" id="street_number" disabled="true"></input></td>
                    <td class="wideField" colspan="2"><input class="field" id="route" disabled="true"></input></td>
                </tr>
                
                <tr>
                    <td class="label">City</td>
                    <td class="wideField" colspan="3"><input class="field" id="locality" disabled="true"></input></td>
                </tr>

                <tr>
                    <td class="label">State</td>
                    <td class="slimField"><input class="field" id="administrative_area_level_1" disabled="true"></input></td>
                    <td class="label">Zip code</td>
                    <td class="wideField"><input class="field" id="postal_code" disabled="true"></input></td>
                </tr>

                <tr>
                    <td class="label">Country</td>
                    <td class="wideField" colspan="3"><input class="field" id="country" disabled="true"></input></td>
                </tr>
            </table>
            <br/>
             
            <p class="p3">Latitude</p>
            <input type="text" name="latitude" id="latitude" placeholder="Latitude" value="" ><br>
            <p class="p3">Longitude</p>        
            <input type="text" name="longitude" id="longitude" placeholder="Longitude" value="" ><br>

            <script>
                var placeSearch, autocomplete;
                var componentForm = 
                {   
                    street_number: 'short_name',
                    route: 'long_name',
                    locality: 'long_name',
                    administrative_area_level_1: 'short_name',
                    country: 'long_name',
                    postal_code: 'short_name'
                };

                function initAutocomplete() 
                {
                    autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types: ['geocode']});
                    // When the user selects an address from the dropdown, populate the address
                    // fields in the form.
                    autocomplete.addListener('place_changed', fillInAddress);
                }

                function fillInAddress() 
                {
                    // Get the place details from the autocomplete object.
                    var place = autocomplete.getPlace();
                    
                    document.getElementById('latitude').value = place.geometry.location.lat();
                    document.getElementById('longitude').value = place.geometry.location.lng();

                    // var lat = place.geometry.location.lat(),
                    //  lng = place.geometry.location.lng();
                    // console.log(lat);
                    // console.log(lng);

                    for (var component in componentForm) 
                    {
                        document.getElementById(component).value = '';
                        document.getElementById(component).disabled = false;
                    }
                    // Get each component of the address from the place details and fill the corresponding field on the form.
                    for (var i = 0; i < place.address_components.length; i++) 
                    {
                        var addressType = place.address_components[i].types[0];
                        if (componentForm[addressType]) 
                        {
                            var val = place.address_components[i][componentForm[addressType]];
                            document.getElementById(addressType).value = val;
                        }
                    }
                }
            </script>


            <br/>
            <input id="update_button" type="submit" name="update" value="update"/><br/>
            </form>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUNqVQZjA4GIOZtneJ8JbwngWvnJqXOmg&libraries=places&callback=initAutocomplete" async defer></script>
    <!-- </body>
</html> -->