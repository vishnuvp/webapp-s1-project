<?php 

include_once('require_include.inc');
$user = olm_session_get_name();
//echo date('Y m d',mktime(5800577320821));
?>
<script>
function searchToggle(){
	$("#header-search-listing-id").slideDown('slow');
}

</script>
<div class="header">
	<div class="header-utility-bar">
		<ul>
			<li><a id="csed-home" href="/m140163cs/olm/main.php"><img src="/m140163cs/olm/assets/images/CSEDL_HOME.png" alt="CSED Library" /></a></li>
			<li><a href="/m140163cs/olm/logout.php"><img src="/m140163cs/olm/assets/images/user_account.png" alt="Logout" title="Logout" /><div><?php echo $user; ?></div></a></li>
		</ul>
	</div>
	<div class="header-search-bar">
		<input class="header-search-box" type="search" id="header-search-box-id" onfocus="searchToggle()" value="" placeholder="Quick Search" />
		<!-- select class="header-search-options" id="header-search-op1">
			<option value="b">Book</option>
			<option value="u">User</option>
		</select -->
		<select class="header-search-options" id="header-search-op2">
			<option value="title">Title</option>
			<option value="bid">Book ID</option>
		</select>
	</div>
	
</div>
<div class="header-search-listing" id="header-search-listing-id" style="display:none;"><a class="button" id="search-result-close-btn" onclick="$('#header-search-listing-id').slideUp('slow');" href="#">[X]</a>
<div class="search-miss">Type in your search term in the search box</div>
</div>
<div class="head-breaker">&nbsp;</div>	

