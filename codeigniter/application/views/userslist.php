
        <div id="content">
        <h2>User List</h2>
        <?php 
            if($employees!=null)
            {?>
                <table id="table_id" align="center" class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Photo</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Address</th>
                            <th>View/Update</th>
                            <th>Delete</th>
                            <th>Assignedprojects</th>

                        </tr> 
                    </thead>
                    <tbody>
                        <?php foreach($employees as $row): ?>
                            <tr>   
                                <td><?php echo $row->duser;?></td>
                                <td><img class="imgsize" src="<?php echo image_url. $row->iname;?>">
                                <br/>
                                <?php echo form_open_multipart('home/update_photo/'.$row->id);?>
                                    <input type="file" name="image" size="20"/>
                                    <input type="submit" value="Update" />
                                </form> 
                                </td>
                                <td><?php echo $row->email;?></td>
                                <td><?php echo $row->department;?></td>
                                <td><?php echo $row->designation;?></td>
                                <td><?php echo $row->address;?></td>
                                <td><a href="<?php echo BASE_URL.'/home/update_user/'.$row->id?>">View/Update</a></td>
                                <td><a onclick="return confirm('Are you sure you want to delete?')" href="<?php echo BASE_URL.'/home/delete_user/'.$row->id?>">Delete</a></td>
                                <td><?php echo $row->duser1;?></td>
                            
                            </tr>
                        <?php endforeach; ?>
                    </tbody>  
                </table>
            <?php }
            else
            {
                echo 'No Users';
            }?>

<h3>My Google Maps Demo</h3>
<div id="map"></div>
<script>
    function makeRequest(url, callback) 
    {
        var request;
        if (window.XMLHttpRequest) 
        {
            request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
        }
        else 
        {
            request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
        }
        request.onreadystatechange = function() 
        {
            if (request.readyState == 4 && request.status == 200) 
            {
                callback(request);
            }
        }
        request.open("GET", url, true);
        request.send();
    }

    function initMap() 
    {
        var center = new google.maps.LatLng(20.593684, 78.96288000000004);
        var map = new google.maps.Map(document.getElementById('map'), 
        {
            zoom: 4,
            center: center,
        });
        load_location(map)
    }

    function load_location(map)
    {
        makeRequest('http://192.168.20.246/codeigniterproject/codeigniter/index.php/home/get_locations', function(data) 
        {
            var data = JSON.parse(data.responseText);
            for (var i = 0; i < data.length; i++)
            {
                displayLocation(data[i],map);
            }
        });
    }
    


    function displayLocation(location,map) 
    {
        var map;
        var infowindow = new google.maps.InfoWindow();
        console.log(location);
        if(!!location.latitude&&!!location.longitude)
        {
            var content =   '<div class="infoWindow"><strong>'  + location.duser + '</strong>'
                            + '<br/>'     + location.address + '</div>';
            
            var position = new google.maps.LatLng(parseFloat(location.latitude), parseFloat(location.longitude));
            var marker = new google.maps.Marker({
                    map: map, 
                    position: position,
                    title: location.duser
            });
            google.maps.event.addListener(marker, 'click', function() 
            {
                infowindow.setContent(content);
                infowindow.open(map,marker);
            });
        }
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuC2dlgos-41eNg5ZSI8DLjNePqNZfDxU&callback=initMap">
</script>

            </div>


            