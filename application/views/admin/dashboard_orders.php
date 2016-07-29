<html>
<head>
	<title>Orders Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/assets/admin_dashboard_orders.css">
	<link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var search = $('#search_bar').val();
			var ship_status = $('#ship_status_all').val();
			$('#current_page_number').val(0);
			var page = $('#current_page_number').val();
			var url = "/orders/get_all_orders/"+page+"/"+ship_status+"/"+search;
			console.log(url);
			$.ajax({
				url: url,
				type: "GET",
				success: function(res) {
					$('#orders').html(res);
				}
			});
		});

		$(document).on('change', '#ship_status_all', function(){
			var page = $('#current_page_number').val();
			var search = $('#search_bar').val();
			var ship_status = $('#ship_status_all').val();
			var url = "/orders/get_all_orders/"+page+"/"+ship_status+"/"+search;
			$.ajax({
				url: url,
				type: "GET",
				success: function(res) {
					$('#orders').html(res);
				}
			})
		});

		$(document).on('change', '#search_bar', function(){
			var page = $('#current_page_number').val();
			var search = $('#search_bar').val();
			var ship_status = $('#ship_status_all').val();
			var url = "/orders/get_all_orders/"+page+"/"+ship_status+"/"+search;
			console.log(url);
			$.ajax({
				url: url,
				type: "GET",
				success: function(res) {
					$('#orders').html(res);
				}
			})
		});

		$(document).on('submit', 'form', function(){
			return false;
		});

		$(document).on('click', 'li', function(){
			if ($(this).html() == 'First') {
				$('#current_page_number').val(0);
				var page = $('#current_page_number').val();
			}
			//back button -> set page
			else if ($(this).html() == 'Back') {
				if ($('#current_page_number').val() == 0) {
					var page = $('#current_page_number').val();
				} else {
					$('#current_page_number').val($('#current_page_number').val() - 1);
					var page = ($('#current_page_number').val()) * 5;
				}
			} else if ($(this).html() == 'Next'){
				//next button
				var current_page_number = parseInt($('#current_page_number').val());
				$('#current_page_number').val(current_page_number + 1);
				var page = ($('#current_page_number').val()) * 5;
			} else {
				//numbered li item -> set page
				$('#current_page_number').val($(this).html() - 1);
				var page = ($(this).html() - 1) * 5;
			};
			var search = $('#search_bar').val();
			var ship_status = $('#ship_status_all').val();
			var url = "/orders/get_all_orders/"+page+"/"+ship_status+"/"+search;
			$.ajax({
				url: url,
				type: "GET",
				success: function(res) {
					$('#orders').html(res);
				}
			})
		});

		$(document).on('change', '.select_ship_status', function(){
			var order_id = $(this).attr('id');
			var status = $(this).val();
			var url = "/orders/change_orders_ship_status/"+status+"/"+order_id;
			$.ajax({
				url: url,
				type: "GET",
				success: function(res) {
				}
			})
		});
	</script>
</head>
<body>
	<div id="container">
		<?php $this->load->view('admin_partials/admin_header') ?>
		<div id="filters">
			<form>
				<input name="search" id="search_bar" type="text" placeholder="Search">
				<select id="ship_status_all">
					<option>Show All</option>
					<option>Shipped</option>
					<option>Order in Process</option>
					<option>Cancelled</option>
				</select>
				<input type="hidden" id='current_page_number'>
			</form>
		</div>
		<div id="orders">
		</div>
		<h2 id="logo">vinylize</h2>
	</div>
</body>
</html>
