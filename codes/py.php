<?php require_once(dirname(__DIR__) . "/include/header_start.php"); ?>

<?php require_once(dirname(__DIR__) . "/include/header_end.php"); ?>

<?php
	$py_files = array();

	$py33_dir = dirname(__DIR__) . "/_my_codes/python_3_3/";

	if(is_dir($py33_dir)) {
		$opened_dir = opendir($py33_dir);

		if($opened_dir) {
			while(($file = readdir($opened_dir)) !== false) {
				array_push($py_files, $file);
			}
		}

		closedir($opened_dir);
	}
?>

		<div class="container-fluid mt-5">
			<div class="container mt-5">
				<h1 class="my-5">Python 3.3 codes</h1>

				<h5>Jump To</h5>
				<table class="table table-hover my-4">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">View File</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$serial = 1;

							for($i = 0; $i < count($py_files); $i++):
								if($py_files[$i] == "." or $py_files[$i] == ".." ) {
									continue;
								}

							echo PHP_EOL;
						?>
						<tr>
							<th scope="row"><?php echo $serial; ?></th>
							<td title="<?php echo putSpaceAfterCapitalAlphabet(substr($py_files[$i], 0, -3)); ?>">
								<?php echo putSpaceAfterCapitalAlphabet(substr($py_files[$i], 0, -3)); ?>
							</td>
							<td>
								<a href="#<?php echo substr($py_files[$i], 0, -3); ?>" class="text-dark" title="<?php echo $py_files[$i]; ?>">
									<?php echo $py_files[$i]; ?>
									<i class="fa fa-level-down-alt"></i>
								</a>
							</td>
						</tr>
							<?php
								echo PHP_EOL;

								$serial++;
								endfor;
							?>
					</tbody>
				</table>

				<?php
					for($i = 0; $i < count($py_files); $i++):
						if($py_files[$i] == "." or $py_files[$i] == ".." ) {
							continue;
						}

					echo PHP_EOL;
				?>
				<section id="<?php echo substr($py_files[$i], 0, -3); ?>" class="row align-items-center my-5">
					<h4>
						Code of
						<span class="text-success">
							<?php echo $py_files[$i]; ?>
						</span>
					</h4>
					<div class="col-12 col-lg-12 bg-light my-3">
						<code>Python 3.3 Code:</code>
						<pre class="pre-scrollable">
							<code><?php fetchFileContent($py_files[$i], "py33"); ?></code>
						</pre>
					</div>
				</section>
				<?php
					echo PHP_EOL;
					endfor;
				?>
			</div>
			
			<div id="scroll-to-top-div" class="d-none">
				<div id="scroll-to-top-btn" class="d-flex justify-content-end fixed-bottom">
					<span class="badge badge-success m-5 p-2">
						<i class="fa fa-arrow-up"></i>
					</span>
				</div>
			</div>
		</div>

<?php require_once(dirname(__DIR__) . "/include/footer_start.php") ?>

		<script>
			let scrollToTopDiv = document.getElementById("scroll-to-top-div");
			let scrollToTopBtn = document.getElementById("scroll-to-top-btn");

			window.addEventListener("scroll", showHideBtn);
			scrollToTopBtn.addEventListener("click", goToTop);
			
			function showHideBtn() {
				if (document.body.scrollTop > 26 || document.documentElement.scrollTop > 26) {
					scrollToTopDiv.classList.remove("d-none");
				} else {
					scrollToTopDiv.classList.add("d-none");
				}
			}

			function goToTop() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}
		</script>

<?php require_once(dirname(__DIR__) . "/include/footer_end.php") ?>
