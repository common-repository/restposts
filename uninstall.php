<?php /*

**************************************************************************

Copyright (C) 2021 Mathew Moore

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************/

if( !defined('ABSPATH') ) {
  exit(); // exit if accessed directly
}

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Uninstallation actions

// delete settings options
delete_option( 'restpost_link_checker' );
delete_option( 'enable_widget_shortcodes' );

// delete widget instances
delete_option( 'widget_restposts_widget' );

// delete all RESTposts posts
function delete_rest_posts() {
  $args = array (
    'post_type' => 'mrp_restposts',
    'nopaging' => true
  );
  $query = new WP_Query ($args);
  while ($query->have_posts()) {
    $query->the_post();
    $id = get_the_ID();
    wp_delete_post ($id, true);
  }
  wp_reset_postdata();
}
delete_rest_posts();
