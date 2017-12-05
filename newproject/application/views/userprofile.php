
 

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  </head>
  
 <div id="content">
  <div class="container">
  <div class="row">
    <div class="col-md-4">
 
      <table class="table table-bordered table-striped">
         <tr> <th colspan="2"><h4 class="text-center">User Info</th></tr>   
        <tr>  <?php foreach($userdata as $i){?>
               <td>Firstname</td>
              
           <td><?=$i->firstname;?></td>
              <td>Lastname</td>
            <td><?=$i->lastname;?></td>
        <?php }?>  </tr>     
      </table>
      </div>
   </div>
  </div>
    </div>
  
 
 