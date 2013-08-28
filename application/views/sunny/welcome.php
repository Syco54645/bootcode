Hi, <strong><?=$userinfo['user_fname']?></strong>! You are logged in now. <?=anchor('/auth/logout/', 'Logout')?>
<br />
<a href="/profile/edit">Edit Profile</a><br />
<a href="/profile/view">View Profile</a><br />
<a href="/profile/view?id=2">View Someone Else's Profile</a><br />
<a href="/magesoft">View a company</a><br />
<a href="/do_admin">Beginnings of an admin panel</a>(never upgrade tankauth without backing it up. i added functionality to the library -FeC)<br />

<?php pre_print_r($userinfo); ?>
