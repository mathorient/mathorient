<?php
/*
Template Name: Shift Lookup Page
*/
?>
<?php
include_once('cas-functions.php');

casInit();
phpCAS::forceAuthentication();
$username = phpCAS::getUser();
$leader_shifts = lookupLeaderShift($username);
get_header();
if ($leader_shifts == null){
?>

    Oh no <?php echo $username ?>'s shifts are broken.  Contact FOC, that'll tell the website team to get back to work.
<?php
} else { # Authenticated
?>
<h2 class='shift-lookup-title'>Shift schedule for: <?php echo $username ?></h2>
<div class='shift-lookup-content'>
  <?php while ( have_posts() ) : the_post(); ?>

    <?php the_content(); ?>

  <?php endwhile; // end of the loop. ?>
</div>
<table class='shift-lookup'>
<tr><th>Date</th>
    <th>Time</th>
    <th>Event</th>
    <th>Place</th>
</tr>
<?php
    foreach( $leader_shifts as $shift ){
?>
  <tr> 
      <td><?php echo $shift['date'] ?></td>
      <td><?php echo $shift['time'] ?></td>
      <td><?php echo $shift['event'] ?></td>
      <td><?php echo $shift['place'] ?></td>
  </tr>
<?php
    }
?>
</table>
<?php
get_footer();
}
