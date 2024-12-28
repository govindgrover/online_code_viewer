<?php
	$index_pg = "";
	$index_pg = (getPhpScript() === "index") ? "./" : "./../";
	$codes_pg = (getPhpScript() === "py") ? "./py.php" : "./codes/py.php";
?>
		<nav class="navbar fixed-top navbar-light bg-light">
			<a class="navbar-brand" href="<?php echo $index_pg; ?>">Online Codes By <span class="text-info">Govind Grover</span></a>
			<ul class="nav nav-pills" id="sNavbar">
			<li class="nav-item">
					<a class="nav-link" href="<?php echo $index_pg; ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $codes_pg; ?>">Python</a>
				</li>
			</ul>
		</nav>
