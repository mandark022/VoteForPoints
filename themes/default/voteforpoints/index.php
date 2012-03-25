<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php if($vp): ?>
<br/>
<h3>Vote for Points</h3>
<table class="horizontal-table" width="100%">  
	<tr>
		<td colspan="3" align="left">
			<b>Current Vote Points:</b> <?php echo $curr_points; ?> <i>pt('s).</i>
		</td>
		<td align="left" colspan="2">
		<b>Website Time:</b> <?php echo date("Y-m-d G:i:s",time()); ?>
		</td>
	</tr>
	<tr>
		<th align="center">Name</th>
		<th align="center">Banner</th>
		<th align="center">Points</th>
		<th align="center">Block Time<i>(h:m:s)</i></th>
		<th align="center">Vote Button</th>
	</tr>
<?php foreach($vp as $site): ?>
	<tr>
		<td><?php echo $site->site_name;?></td>
		<td align="center" width="150" height="50"><img src="<?php if($site->banner_url!="") { echo $site->banner_url; } else { echo "index.php?module=voteforpoints&action=image&sid=".$site->site_id; } ?>" width="150" height="50"/></td>
		<td align="right"><?php echo $site->points;?> pt('s)</td>
		<td align="center"><?php echo strBlockTime($site->blocking_time); ?></td>
		<td align="center" style="width:100px;">
			<?php 
			$date_block = isBlock($account_id,$site->site_id,$current_time,$ip_address,$serverLogDB,$vp_logs,$serverObj);
			if($date_block<=0){ ?>

				<a href="index.php?module=voteforpoints&action=vote&sid=<?php echo $site->site_id; ?>">Vote Now</a>
			<?php } else { ?>
				<label style="color:red" onclick="javascript: alert('Blocked in voting for site until: <?php echo date("Y-m-d G:i:s",$date_block); ?>');">Vote</label>
			<?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php if(!$vp): ?>
<br/>
<i>No voting sites found</i>
<?php endif; ?>