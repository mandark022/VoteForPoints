<?php //A login is requiredinclude ('function.php');$this->loginRequired();//This will list the sites$vp = Flux::config('FluxTables.Sites'); $vp_voter = Flux::config('FluxTables.Voters'); $serverLogDB = $server->loginDatabase;$vp_voter = Flux::config('FluxTables.Voters'); $vp_logs = Flux::config('FluxTables.Logs'); 		$serverObj = $server->connection;$sql = "SELECT site_id,site_name,address,points,blocking_time,banner,banner_url FROM {$server->loginDatabase}.{$vp}";$sth = $server->connection->getStatement($sql);$sth->execute();$vp = $sth->fetchAll();$account_id = $session->account->account_id;$current_time= date("Y-m-d G:i:s",time());$ip_address = 0;if(Flux::config('IP_BLOCKING'))	$ip_address = $_SERVER['REMOTE_ADDR'];		$sql = "SELECT points FROM {$server->loginDatabase}.{$vp_voter} WHERE account_id=?";$sth = $server->connection->getStatement($sql);$sth->execute(array($session->account->account_id));$vp_voter = $sth->fetch();$curr_points = $vp_voter->points;function isBlock($account_id,$site_id,$current_time,$ip_address,$serverLogDB,$vp_logs,$serverObj){	if($ip_address!=0)	{		$sql = "SELECT `rtid`,`unblock_time`,`ip_address` FROM {$serverLogDB}.{$vp_logs} WHERE f_site_id=? AND unblock_time>? AND ip_address=? ORDER BY unblock_time ASC LIMIT 1";		$sth = $serverObj->getStatement($sql);		$sth->execute(array($site_id,$current_time,$ip_address));		$ip_check = $sth->fetchAll();				$diff_time = strtotime($ip_check[0]->unblock_time)-strtotime(date("Y-m-d G:i:s",time()));		if(!empty($ip_check))			return strtotime($ip_check[0]->unblock_time);	}		$sql = "SELECT `unblock_time` FROM {$serverLogDB}.{$vp_logs} WHERE account_id=? AND f_site_id=?";		$sth = $serverObj->getStatement($sql);		$sth->execute(array($account_id,$site_id));		$account_check = $sth->fetch();				if(!empty($account_check))			$diff_time = strtotime($account_check->unblock_time)-strtotime(date("Y-m-d G:i:s",time()));		else			$diff_time = 0;					if($diff_time>0)			return strtotime($account_check->unblock_time);		else			return 0;	return strtotime($account_check->unblock_time);}?>