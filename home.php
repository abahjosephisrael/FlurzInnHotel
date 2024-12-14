 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4">
                    	<div class="card" id="filter-book">
                    		<div class="card-body">
                    			<div class="container-fluid">
                    				<form action="index.php?page=list" id="filter" method="POST">
                    					<div class="row">
                    						<div class="col-md-3">
                    							<label for="">Chech-in Date</label>
                    							<input type="text" class="form-control datepicker" name="date_in" autocomplete="off">
                    						</div>
                    						<div class="col-md-3">
                    							<label for="">Chech-out Date</label>
                    							<input type="text" class="form-control datepicker" name="date_out" autocomplete="off">
                    						</div>
                    						
                    						<div class="col-md-3">
                    							<br>
                    							<button class="btn-btn-block btn-primary mt-3">Check Availability</button>
                    						</div>

                    					</div>
                    				</form>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                    
                </div>
            </div>
        </header>

<div class="container mt-4">
    <h1 class="text-center mb-4">Available Rooms</h1>
    <div class="d-flex flex-wrap justify-content-center">

	  				<?php 
                	include'admin/db.php';
                	$qry = $connection->query("SELECT * FROM room_type where room_type_id in (SELECT room_type_id from room)");
                	while($row = $qry->fetch_assoc()):
                	?>
                    <div class="p-2">
                        <a class="portfolio-box" href="#">
                            <img class="img-fluid rounded" src="img/<?php echo $row['cover_img'] ?>" alt="" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-30"><?php echo "$ ".number_format($row['price'],2) ?> per day</div>
                                <div class="project-name"><?php echo $row['room_type'] ?></div>
                            </div>
                        </a>
                    </div>
                	<?php endwhile; ?>


    </div>
  </div>

<section class="page-section">

</section>