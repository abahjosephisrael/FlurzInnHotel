<?php
// Initialize the date variables
$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d', strtotime('+3 days'));
?>

<!-- Masthead -->
<header class="masthead">
	<div class="container h-100">
		<div class="row h-100 align-items-center justify-content-center text-center">
			<div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
				<h1 class="text-uppercase text-white font-weight-bold">Rooms</h1>
				<hr class="divider my-4" />
			</div>
		</div>
	</div>
</header>

<section class="page-section bg-dark">
	<div class="container">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<form action="index.php?page=list" id="filter" method="POST">
						<div class="row">
							<div class="col-md-3">
								<label for="">Check-in Date</label>
								<input type="text" class="form-control datepicker" name="date_in" autocomplete="off" value="<?php echo date('Y-m-d', strtotime($date_in)); ?>">
							</div>
							<div class="col-md-3">
								<label for="">Check-out Date</label>
								<input type="text" class="form-control datepicker" name="date_out" autocomplete="off" value="<?php echo date('Y-m-d', strtotime($date_out)); ?>">
							</div>
							<div class="col-md-3">
								<br>
								<button class="btn btn-block btn-primary mt-3">Check Availability</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<hr>

			<?php
			// Fetch room categories and available rooms
			$cat = $connection->query("SELECT * FROM room_type");
			$cat_arr = [];
			while ($row = $cat->fetch_assoc()) {
				$cat_arr[$row['room_type_id']] = $row;
			}

			$qry = $connection->query("SELECT DISTINCT room_type_id FROM room_type WHERE room_type_id NOT IN (
                SELECT room_id FROM booking WHERE 
                ('$date_in' BETWEEN date(check_in) AND date(check_out) OR 
                '$date_out' BETWEEN date(check_in) AND date(check_out))
            )");

			while ($row = $qry->fetch_assoc()):
			?>
				<div class="card item-rooms mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-md-5">
								<img src="img/<?php echo $cat_arr[$row['room_type_id']]['cover_img']; ?>" alt="Room Image">
							</div>
							<div class="col-md-5">
								<!-- <h3><b>$<?php echo number_format($cat_arr[$row['room_type_id']]['price'], 2); ?></b><span> / per day</span></h3> -->
								<h3>
									<br>
									<!-- &#8358; -->
									<span class="currency">
									<?php echo $cat_arr[$row['room_type_id']]['price']; ?>
									</span>
									<span>
										/ per day
									</span>
								</h3>
								<h4><b><?php echo $cat_arr[$row['room_type_id']]['room_type']; ?></b></h4>
								<div class="align-self-end mt-5">
									<button class="btn btn-primary float-right book_now" type="button" room-type-id="<?php echo $row['room_type_id']; ?>" >Book now</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>

<style type="text/css">
	.item-rooms img {
		width: 23vw;
	}
</style>

<script>
	$('.book_now').click(function() {
		// uni_modal('Book', 'admin/book.php?in=<?php echo $date_in; ?>&out=<?php echo $date_out; ?>&cid=' + $(this).attr('data-id'));
		uni_modal('Book', `book.php?room_id=${$(this).attr('room-id')}&room_type_id=${$(this).attr('room-type-id')}`);
	});
</script>