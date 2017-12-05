<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div id="content">
<h2>Image View Page</h2>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        foreach($image as $k => $row):
        ?>
            <div class="item <?php if($k===0) echo 'active'; ?> " >
                <img style='width:"100%"; height:100%; margin:auto' src="<?php echo image_url. $row->iname;?>">
            </div>
        <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
  </div>
</div>
    