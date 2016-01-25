<div id="icon-options-general" class="icon32"></div>
<div class="wrap">
	<h2>Genesis Community CPT Settings: Version <?php echo GENAWPCOMM_VERSION ?></h2>
	<div id="poststuff" class="metabox-holder has-right-sidebar">
		<div id="side-info-column" class="inner-sidebar">
	<!--	<?php do_meta_boxes('awp-options', 'side', null); ?> -->
		</div>

        <div id="post-body">
            <div id="post-body-content" class="has-sidebar-content">
				<p><?php printf( __( 'If you would like to manually move the plugin\'s CSS to your theme\'s css file for purposes of avoiding an additional HTTP request or for ease of customization, check the box below.', 'genesis-communities-cpt' ) ); ?></p>
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
				
				if ( !isset($awp_options['stylesheet_load']) || $awp_options['stylesheet_load'] == 0 ) {
					$awp_options['stylesheet_load'] = 0;
	  			     echo '<p style="color:green; font-weight: bold;">';
	  			    _e( 'The plugin stylesheet is currently in use.', 'genesis-communities-cpt' );
	  			    echo '<p>';
				}

				if ($awp_options['stylesheet_load'] == 1) {
					echo '<p style="color:red; font-weight: bold;">';
	  			    _e( 'The plugin stylesheet is NOT currently in use.', 'genesis-communities-cpt' );
	  			    echo '<p>';
				}
				
				if ( !isset($awp_options['num_posts']) ) {
					$awp_options['num_posts'] = '8';
				}

				if ( !isset($awp_options['order_by']) ) {
					$awp_options['order_by'] = 'title';
				}

				if ( !isset($awp_options['sort_order']) ) {
					$awp_options['sort_order'] = 'ASC';
				}
				

				$awp_options['slug'] = sanitize_title($awp_options['slug']);
			
				
				?>
				<form action="options.php" method="post" id="awp-stylesheet-options-form">
					<?php settings_fields('awp_community_options'); ?>
					
					<p><label for="<?php echo 'plugin_awp_community_settings[stylesheet_load]'; ?>">
					<?php echo '<input name="plugin_awp_community_settings[stylesheet_load]" type="checkbox" value="1" class="code" ' . checked(1, $awp_options['stylesheet_load'], false ) . ' /> '; ?>
                    <?php printf( __( 'Check this box if you do NOT want to use the plugin stylesheet.', 'genesis-communities-cpt' ) ); ?></label></p>

					<p><label for="<?php echo 'plugin_awp_community_settings[singular_name]'; ?>">
					<?php printf( __( 'Singular Name for the Community CPT:', 'genesis-communities-cpt' ) ); ?>
					<?php echo '<input type="text" name="plugin_awp_community_settings[singular_name]" value="' . wp_strip_all_tags($awp_options['singular_name']) . '" />'; ?>
					</label></p>
					

					<p><label for="<?php echo 'plugin_awp_community_settings[plural_name]'; ?>">
					<?php printf( __( 'Plural Name for the Community CPT:', 'genesis-communities-cpt' ) ); ?>
					<?php echo '<input type="text" name="plugin_awp_community_settings[plural_name]" value="' . wp_strip_all_tags($awp_options['plural_name']) . '" />'; ?>
					</label></p>
					
					<h2><?php printf( __( 'Options for the Archive Page', 'genesis-communities-cpt' ) ); ?>:</h2>
					
					<label for="<?php echo 'plugin_awp_community_settings[num_posts]'; ?>">
					<?php printf( __( 'Number of Posts to show per page', 'genesis-communities-cpt' ) ); ?>:
			        <?php echo '<input type="text" maxlength="3" name="plugin_awp_community_settings[num_posts]" value="' . esc_attr($awp_options['num_posts']); ?>" size="3" />
					</label></p>

					<p>
						<label for="<?php echo 'plugin_awp_community_settings[order_by]'; ?>"><?php _e( 'Order By', 'genesis' ); ?>:</label>
						<select id="<?php echo  $awp_options['order_by'] ?>" name="plugin_awp_community_settings[order_by]" ?>">
							<option value="date" <?php selected( 'date', $awp_options['order_by'] ); ?>><?php _e( 'Date', 'genesis' ); ?></option>
							<option value="title" <?php selected( 'title', $awp_options['order_by'] ); ?>><?php _e( 'Title', 'genesis' ); ?></option>
							<option value="parent" <?php selected( 'parent', $awp_options['order_by'] ); ?>><?php _e( 'Parent', 'genesis' ); ?></option>
							<option value="menu_order" <?php selected( 'menu_order', $awp_options['order_by'] ); ?>><?php _e( 'Menu Order', 'genesis' ); ?></option>
							<option value="ID" <?php selected( 'ID', $awp_options['order_by'] ); ?>><?php _e( 'ID', 'genesis' ); ?></option>
							<option value="comment_count" <?php selected( 'comment_count', $awp_options['order_by'] ); ?>><?php _e( 'Comment Count', 'genesis' ); ?></option>
							<option value="rand" <?php selected( 'rand', $awp_options['order_by'] ); ?>><?php _e( 'Random', 'genesis' ); ?></option>
						</select>
					</p>

					<p>
						<label for="<?php echo 'plugin_awp_community_settings[sort_order]'; ?>"><?php _e( 'Sort Order', 'genesis' ); ?>:</label>
						<select id="<?php echo $awp_options['sort_order'] ?>" name="plugin_awp_community_settings[sort_order]" ?>">
							<option value="DESC" <?php selected( 'DESC', $awp_options['sort_order'] ); ?>><?php _e( 'Descending (3, 2, 1)', 'genesis' ); ?></option>
							<option value="ASC" <?php selected( 'ASC', $awp_options['sort_order'] ); ?>><?php _e( 'Ascending (1, 2, 3)', 'genesis' ); ?></option>
						</select>
					</p>


					<p><label for="<?php echo 'plugin_awp_community_settings[slug]'; ?>">
					<?php printf( __( 'Slug for the Community Archive page:', 'genesis-communities-cpt' ) ); ?>
					<?php echo '<input type="text" name="plugin_awp_community_settings[slug]" value="' . sanitize_title($awp_options['slug']) . '" />'; ?>
					</label></p>


					<p><?php printf( __( 'If you change the slug, remember to', 'genesis-communities-cpt' ) ); echo ' '; ?><a href="../wp-admin/options-permalink.php"><?php _e( 'save your permalinks settings again', 'genesis-communities-cpt' ); ?></a></p>
					<p>You do not need to change the permalinks - just visit the page and click Save Changes again.</p>
					<input name="submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Settings'); ?>" />

				</form>
				<br /><br />
				<p><?php printf( __( 'Your Community archive page is located at', 'genesis-communities-cpt' ) ); echo ' '; ?>
				<a href="<?php echo site_url('/' . $awp_options['slug'] ); echo ' '; ?>"><?php echo site_url('/' . sanitize_title($awp_options['slug'])); ?></a>
				
            </div>
        </div>
    </div>


</div>
