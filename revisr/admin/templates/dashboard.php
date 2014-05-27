<?php
/**
 * Displays the main dashboard page.
 *
 * @package   Revisr
 * @author    Matt Shaw <matt@expandedfronts.com>
 * @license   GPL-2.0+
 * @link      https://revisr.io
 * @copyright 2014 Expanded Fronts, LLC
 */

$dir = plugin_dir_path( __FILE__ );
$loader_url = plugins_url( '../../assets/img/loader.gif' , __FILE__ );

include_once $dir . '../includes/functions.php';

?>
<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>Revisr Dashboard</h2>
	
	<?php 
		$pending = count_pending();
		if ( $pending != 0 ){
			if ( $pending == 1 ){
				$text = "<p>There is currently 1 pending file.</p>";
			}
			else {
				$text = "<p>There are currently {$pending} pending files.</p>";
			}
		}
		else {
			$text = "<p>There are currently no pending files.</p>";
		}
		echo "<div id='revisr_alert' class='updated'>{$text}</div>";
	?>

	<div id="poststuff">
	<div id="revisr_alert"></div>
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
					
						<h3><span>Recent Activity</span></h3>
						<div class="inside">
							
							<table class="widefat">
								<thead>
								    <tr>
								        <th>Event</th>
								        <th>Time</th>
								    </tr>
								</thead>
								<tbody id="revisr_activity">

								</tbody>
							</table>
						</div> <!-- .inside -->
					
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
				
			</div> <!-- post-body-content -->
			
			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				
				<div class="meta-box-sortables">
					
					<div class="postbox">
					
						<h3><span>Quick Actions</span> <div id='loader'><img src="<?php echo $loader_url; ?>"/></div></h3>
						<div class="inside">
							<button id="commit-btn" class="button button-primary quick-action-btn" onlick="confirmPull(); return false;">Commit Changes</button>
							<button id="discard-btn" class="button button-primary quick-action-btn">Discard Changes</button>
							<button id="pull-btn" class="button button-primary quick-action-btn" onlick="confirmPull(); return false;">Pull Changes</button>
							<button id="push-btn" class="button button-primary quick-action-btn" onlick="confirmPush(); return false;">Push Changes</button>
						</div> <!-- .inside -->
						
					</div> <!-- .postbox -->

					<div class="postbox">
					
						<h3><span>Branches <a id="new_branch" href="#">(Create Branch)</a> </span></h3>
						<div class="inside">
							<table class="widefat">
								<?php
									$dir = getcwd();
									chdir(ABSPATH);
									exec("git branch", $output);
									chdir($dir);

									foreach ($output as $key => $value){
										$branch = substr($value, 2);
										$disabled = "";

										echo "<tr><td>$branch</td><td width='70'><a href='" . get_admin_url() . "admin-post.php?action=checkout&branch={$branch}'>Checkout</a></td></tr>";
									}
								?>
							</table>

						</div> <!-- .inside -->
						
					</div> <!-- .postbox -->

					<div class="postbox">
					
						<h3><span>About this plugin</span></h3>
						<div class="inside">
							Please read more about this plugin at <a href="https://revisr.io/">revisr.io</a>.
							<br><br>
							&copy; 2014 Expanded Fronts, LLC.
						</div> <!-- .inside -->
						
					</div> <!-- .postbox -->


					
				</div> <!-- .meta-box-sortables -->
				
			</div> <!-- #postbox-container-1 .postbox-container -->
			
		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->