<html>
<head>
	<title>Orders Dashboard</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: "/Orders/get_all_orders",
				type: "GET",
				success: function(response) {
					$('#orders_table').html(response);
				}
			});
		});

		$(document).on(function(){
			var search = $('#search_bar').text();
			$.ajax({
				data: search;
			})




		});

	</script>

</head>
<body>
	<h1>Dashboard</h1>
	<h2><a href="">Orders</a></h2>
	<h2><a href="">Products</a></h2>
	<h2><a href="">Log Off</a></h2>

	<form>
		<input id="search_bar" type="text" placeholder="Search">
		<select id="ship_status_all">
			<option>Show All</option>
			<option>Shipped</option>
			<option>Order in Process</option>
			<option>Cancelled</option>
		</select>
	</form>
	<table id="orders_table">
	</table>
</body>
</html>