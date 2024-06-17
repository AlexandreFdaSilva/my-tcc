<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>500</title>
	<style>
		* {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}

		body {
			padding: 0;
			margin: 0;
			background-color: #0c0c0c;
			/* Set background color to black */
			color: #3c4b74;
			/* Set text color to white */
			font-family: 'Montserrat', sans-serif;
			/* Use Montserrat font family for text */
		}

		#notfound {
			position: relative;
			height: 100vh;
		}

		#notfound .notfound {
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.notfound {
			max-width: 520px;
			width: 100%;
			line-height: 1.4;
			text-align: center;
			margin: auto;
			/* Center the content horizontally */
		}

		.notfound .notfound-500 {
			position: relative;
			height: 240px;
		}

		.notfound .notfound-500 h1 {
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			font-size: 252px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
			letter-spacing: -40px;
			margin-left: -20px;
			color: #3c4b74;
			/* Set text color to white */
		}

		.notfound .notfound-500 h1>span {
			text-shadow: -8px 0 0 #0c0c0c;
			/* Set text shadow color to black */
		}

		.notfound .notfound-500 h3 {
			font-size: 16px;
			font-weight: 700;
			text-transform: uppercase;
			margin: 0;
			letter-spacing: 3px;
			padding-left: 6px;
		}

		.notfound h2 {
			font-size: 20px;
			font-weight: 400;
			text-transform: uppercase;
			margin-top: 0;
			margin-bottom: 25px;
		}
	</style>
	<meta name="robots" content="noindex, follow">
</head>

<body>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-500">
				<h3>Oops!</h3>
				<h1><span>5</span><span>0</span><span>0</span></h1>
			</div>
			<h2>{{ isset($message) ? $message : 'Mensagem padrão' }}</h2>
		</div>
	</div>
</body>

</html>