  
<div id="content">
    
        <?php foreach($projectdata as $i){?>
        <form method="post"id="update" action="<?php echo BASE_URL."/welcome/updateproject/".$i->projectid;?>">
        <input type="hidden" name="projectid" value="<?php echo $i->projectid ?>">
        project name:<br>
        <input type="text" name="projectname" value="<?php echo $i->projectname?>"><br> 
        project status:<br>
        <input type="text" name="projectstatus"  value="<?php echo $i->projectstatus?>" ><br>
        project rating:<br>
        <input type="text" name="projectrating" value="<?php echo $i->projectrating?>" required><br>
        Projecthead:<br>
        <input type="text"  name="projecthead" value="<?php echo $i->projecthead?>" required><br>
        Projectdate:<br>
        <input type="text"  name="projectdate" value="<?php echo $i->projectdate?>" readonly required><br>
        

      <select name="country" id="countryid" >
      <option value="" selected="selected" >Select Country</option>
       <?php foreach($country as $count): ?>
        <option name="country" value="<?php echo $count->id; ?>"><?php echo $count->name; ?></option>
        <?php endforeach; ?> 
        </select>
      
      <select name="state" id="state">
     <option name="state" value="" selected="selected" ><span id="state">Select country first</span></option>
     </select>
     <select name="city" id="city">
     <option name="city" value=""><span id="city">Select state first</span></option>
     </select>
     <div id="locationField">
      <input id="autocomplete" name="addresses" placeholder="Enter your address" onFocus="geolocate()" type="text"></input>
      </div>
     <table id="address">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
       </tr> 

       <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr><tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
        </table>

    <script>
        var placeSearch, autocomplete;
            var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
          };

          function initAutocomplete() 
          {
            
            autocomplete = new google.maps.places.Autocomplete(
               (document.getElementById('autocomplete')),
                {types: ['geocode']});
            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
          }
          function fillInAddress() 
          {
            // Get the place details from the autocomplete object.
           var place = autocomplete.getPlace();
            for (var component in componentForm) 
            {
              document.getElementById(component).value = '';
              document.getElementById(component).disabled = false;
            }
    
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
          function geolocate() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                  center: geolocation,
                  radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
              });
            }
          }
       
           </script>

    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXAgN5Sn7Shpvys4tJ4qjj26fBFIlA3DM&libraries=places&callback=initAutocomplete"
        async defer></script> 
      
       <?php }?>

 
<select class="chosen "name="duser[]" multiple="true" style="width:400px;">
  <?php foreach($userdata as $i):?>
  <option  value="<?php echo $i->id;?>"><?php echo $i->duser;?></option>
  <?php endforeach; ?>
</select>
        <input type="submit" name="submit" id="updateproject" value="submit"><br>
        </form> 
        <?php echo form_open_multipart('welcome/uploadimage');?> 
        <label> Upload Your image </label>
        <input type="file" name="userimage" size="20">
        <input type="submit" name="userimage" value="upload">
        </form>

       <a href="<?php echo BASE_URL."/welcome/view_image";?>">View Image</a>  

      </div>  
     