<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="postit.css">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
<title>PostIT</title>
</head>

<body>

<?php session_start(); ?>

	<div class="top">
		<a href="index.php"><h1>Post-It</h1></a>

		<?php
		//If you are logged in, this will be shown
		 	if(isset($_SESSION['userid'])) {?>
				<!--
			<p>Currently logged in with user id <?=$_SESSION['userid']?></p>
		-->
			<form action="logout.php" method="post">
		 			<button class="logout_btn" type="submit">Log out</button>
		 		</form>

<button id="myBtn" class="add_note"><p>Add note</p></button>
	<div id="myModal" class="modal">
		<div class="postit_modal">
			<div class="container">
				<span class="close">&times;</span>

				<h2>Add note</h2>
				<form id="formular" action="submitform.php" method="post">
					<input class="content" type="text" placeholder="Headline" name="headline" required>
					<textarea class="content" type="text" maxlength="100" placeholder="Your message"
					name="content" required></textarea>
					<p id="p_choose_color"> Choose a color for your Post-It:</p>

<?php
			require_once('dbcon.php');
			$sql = 'SELECT id, colorname, cssclass FROM color';
			$stmt = $link->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($cid, $cnam, $cssclass);
			while($stmt->fetch()) { ?>
				<div id="choose_color">
					<div id="choose_color_box" class="<?=$cssclass?>">
					</div>
					<?php
					echo '<input class="colorid" type="radio" name="colorid" value="'.$cid.'" required>'
					?>
					<?=$cnam?>
			</div>

<?php
} // while end
?>
					<button class="submit" type="submit">Post your note!</button>

			</form>
	</div>
</div>
</div>

</div> <!-- top end -->


<?php
			require_once('dbcon.php');
				// SQL SELECT from database
				$sql = 'SELECT postit.id, date(createdate), headline, content, cssclass, users.id, username
					FROM postit, users, color
					WHERE users_id = users.id AND color_id=color.id';

					$stmt = $link->prepare($sql);
					$stmt->execute();
					$stmt->bind_result($pid, $createdate, $headline, $content, $cssclass, $userid, $username);

				while($stmt->fetch()) { ?>
				<!-- Post it note on board -->
				<div id="postit" class="<?=$cssclass?>">
					<p class="date"><?=$createdate?></p>
					<h2 class="headline_postit"><?=$headline?></h2>
	  			<p class="contenttext"><?=$content?></p>
	  			<p class="name"><?=$username?></p>

<?php
 if(isset($_SESSION['userid']) AND ($_SESSION['userid'] == $userid)) { ?>
					<form id="deleteform" action="dodelete.php" method="post">
		 		 				<input type="hidden" name="pid" value="<?=$pid?>">
		 		 				<input class="trash_img" type="image" src="trash1.png" alt="delete">
		 		 </form>
			<?php
		} // delete end
				 ?>
				 </div>
				<?php
			} // while is closed (Post it note on board)
			?>


	 <?php } // if logged in is closed - if not logged in
	 else { ?>
	 	<form class="user" action="loginuser.php" method="POST">
	 					<p class="headerform">Login</p>
	 					<input class="login" type="text" name="un" placeholder="Username" required>
	 					<input class="login" type="password"name="pw" placeholder="Password" required>
	 					<button type="submit">Log in</button>
	 	</form>

		<form class="user" action="createuser.php" method="POST">
					 <p class="headerform">Create User</p>
					 <input class="login" type="text" name="un" placeholder="Username" required>
					 <input class="login" type="password" name="pw" placeholder="Password" required>
					 <button type="submit">Create</button>
	 </form>

	</div> <!-- top end -->

	<div class="pimp">
	       <p>Log in to create<br>a post-it note!</p>
	    </div>

<?php }
 ?>


  <script src="postit.js" type="text/javascript"></script>

</body>
</html>
