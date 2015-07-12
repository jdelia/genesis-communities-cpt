<div id="icon-options-general" class="icon32"></div>
<div class="wrap">
	<h2>Genesis Community CPT Settings: Version <?php echo GENAWPCOMM_VERSION ?></h2>
	<div id="poststuff" class="metabox-holder has-right-sidebar">
		<div id="side-info-column" class="inner-sidebar">
	<!--	<?php do_meta_boxes('awp-options', 'side', null); ?> -->
		</div>

        <div id="post-body">
            <div id="post-body-content" class="has-sidebar-content">
				<p>If you would like to manually move the plugin's CSS to your theme's css file for purposes of avoiding an additional HTTP request or for ease of customization, check the box below.</p>
				<?php
              
				$awp_options = get_option('plugin_awp_community_settings');

				if ( !isset($awp_options['singular_name']) ) {
					$awp_options['singular_name'] = 'Community';
				}

				if ( !isset($awp_options['plural_name']) ) {
					$awp_options['plural_name'] = 'Communities';

				}

				if ( !isset($awp_options['slug']) ) {
					$awp_options['slug'] = 'communities';
				}
				
				if ( !isset($awp_options['stylesheet_load']) ) {
					$awp_options['stylesheet_load'] = 0;
	  			    echo '<p style="color:green; font-weight: bold;">The plugin stylesheet is registered<p>';
				}

				if ($awp_options['stylesheet_load'] == 1) {
					echo '<p style="color:red; font-weight: bold;">The plugin stylesheet has been deregistered<p>';
				}
				
				$awp_options['slug'] = sanitize_title($awp_options['slug']);
			
				
				?>
				<form action="options.php" method="post" id="awp-stylesheet-options-form">
					<?php settings_fields('awp_community_options'); ?>
					<?php echo '<h4><input name="plugin_awp_community_settings[stylesheet_load]" type="checkbox" value="1" class="code" ' . checked(1, $awp_options['stylesheet_load'], false ) . ' /> Deregister the plugin stylesheet?</h4>'; ?>

					<?php echo '<h4>Singular Name for the Community CPT: <input type="text" name="plugin_awp_community_settings[singular_name]" value="' . wp_strip_all_tags($awp_options['singular_name']) . '" /></h4>'; ?>
					<?php echo '<h4>Plural Name for the Community CPT: <input type="text" name="plugin_awp_community_settings[plural_name]" value="' . wp_strip_all_tags($awp_options['plural_name']) . '" /></h4>'; ?>
					<?php echo '<h4>Slug for the Community Archive page: <input type="text" name="plugin_awp_community_settings[slug]" value="' . sanitize_title($awp_options['slug']) . '" /></h4>'; ?>
					<p>Don't forget to <a href="../wp-admin/options-permalink.php">save your permalinks settings again </a> if you change the slug.</p>
					<p>You do not need to change the permalinks - just visit the page and click Save Changes again.</p>
					<input name="submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Settings'); ?>" />

				</form>
				<br /><br />
				<h3>Your Community archive page is located at <a href="<?php echo site_url('/' . $awp_options['slug'] ); ?>"><?php echo site_url('/' . sanitize_title($awp_options['slug'])); ?></a></h3>
            
				
            </div>
        </div>
    </div>
</div>
