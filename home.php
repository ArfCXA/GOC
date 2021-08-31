<!DOCTYPE html>
<html>
<head>
	<?php include('dbconn.php'); ?>
	<?php include('session.php'); ?>
	
	  <script src="vendors/jquery-1.7.2.min.js"></script>
    <script src="vendors/bootstrap.js"></script>
	<link href="style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div id="container" class="center">
		<div class="postarea">
					<form method="post"> 
					<div align="center">
						<textarea name="post_content" placeholder="Type something..." required></textarea>
					</div>
						<br>
					<button name="post">POST&nbsp<i class="fa fa-send"></i></button>
					<br>
					</form>
</div>
<br>
<br>
<div class="postbox">
						<?php	
							$query = mysqli_query($conn,"SELECT *,UNIX_TIMESTAMP() - date_created AS TimeSpent from post LEFT JOIN user on user.user_id = post.user_id order by post_id DESC")or die(mysqli_error());
							while($post_row=mysqli_fetch_array($query)){
							$id = $post_row['post_id'];	
							$upid = $post_row['user_id'];	
							$posted_by = $post_row['firstname']." ".$post_row['lastname'];
						?>
					
					<h4><a href="#"> <?php echo $posted_by; ?></a>
					<br>
					<div class="commenttime">
						<?php				
								$days = floor($post_row['TimeSpent'] / (60 * 60 * 24));
								$remainder = $post_row['TimeSpent'] % (60 * 60 * 24);
								$hours = floor($remainder / (60 * 60));
								$remainder = $remainder % (60 * 60);
								$minutes = floor($remainder / 60);
								$seconds = $remainder % 60;
								if($days > 0)
								echo date('F d, Y - H:i:sa', $post_row['date_created']);
								elseif($days == 0 && $hours == 0 && $minutes == 0)
								echo "A few seconds ago";		
								elseif($days == 0 && $hours == 0)
								echo $minutes.' minutes ago';
						?>
					</div>
					</h4><h3><?php echo $post_row['content']; ?></h3>
<hr>		
							<?php 
								$comment_query = mysqli_query($conn,"SELECT * ,UNIX_TIMESTAMP() - date_posted AS TimeSpent FROM comment LEFT JOIN user on user.user_id = comment.user_id where post_id = '$id'") or die (mysqli_error());
								while ($comment_row=mysqli_fetch_array($comment_query)){
								$comment_id = $comment_row['comment_id'];
								$comment_by = $comment_row['firstname']." ".  $comment_row['lastname'];
							?>
				<div class="comment">
				<h4>
						<div id="commentname">
						
					<a href="#"><?php echo $comment_by; ?></a>
					<br>
					<?php echo $comment_row['content']; ?>
						</div>
					<div class="commenttime">
					<?php				
								$days = floor($comment_row['TimeSpent'] / (60 * 60 * 24));
								$remainder = $comment_row['TimeSpent'] % (60 * 60 * 24);
								$hours = floor($remainder / (60 * 60));
								$remainder = $remainder % (60 * 60);
								$minutes = floor($remainder / 60);
								$seconds = $remainder % 60;
								if($days > 0)
								echo date('F d, Y - H:i:sa', $comment_row['date_posted']);
								elseif($days == 0 && $hours == 0 && $minutes == 0)
								echo "A few seconds ago";		
								elseif($days == 0 && $hours == 0)
								echo $minutes.' minutes ago';
							?>
							</div>
							</h4>
				</div>
							<?php
							}
							?>
						
					<form method="post">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div align="center">
					<div id="comment">
					<textarea name="comment_content" rows="2" cols="44" style="" placeholder="Type comment here..." required></textarea>
					<button class="btn" name="comment"><i class="fa fa-send"></i></button>
				</div>
							</div>
					
					</form>
</div>



					&nbsp;
<div class="postbox">
					<?php 
					if ($u_id = $id){
					?>
					
				
					
					<?php }else{ ?>
						
					<?php
					} } ?>
					
				
							<?php
								if (isset($_POST['post'])){
								$post_content  = $_POST['post_content'];
								
								mysqli_query($conn,"insert into post (content,date_created,user_id) values ('$post_content','".strtotime(date("Y-m-d h:i:sa"))."','$user_id') ")or die(mysqli_error());
								header('location:home.php');
								}
							?>

							<?php
							
								if (isset($_POST['comment'])){
								$comment_content = $_POST['comment_content'];
								$post_id=$_POST['id'];
								
								mysqli_query($conn,"insert into comment (content,date_posted,user_id,post_id) values ('$comment_content','".strtotime(date("Y-m-d h:i:sa"))."','$user_id','$post_id')") or die (mysqli_error());
								header('location:home.php');
								}
							?>
</div>
</body>

  <?php include('footer.php');?>

</html>