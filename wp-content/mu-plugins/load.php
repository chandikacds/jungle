<?php
/*
Plugin Name:  MU Plugins Loader
Plugin URI:   http://prettydamngraphic.com
Description:  Site-specific functionality custom post types, taxonomies and meta boxes
Version:      1.0
Author:       Richard Chambers
Author URI:   http://prettydamngraphic.com
*/

// Site specific custom post types, taxonomies and meta box creation
require WPMU_PLUGIN_DIR . '/sitebase/base.php';
require WPMU_PLUGIN_DIR . '/meta-box/meta-box.php';
require WPMU_PLUGIN_DIR . '/meta-box-group/meta-box-group.php';
require WPMU_PLUGIN_DIR . '/meta-box-include-exclude/meta-box-include-exclude.php';
//require WPMU_PLUGIN_DIR . '/mb-term-meta/mb-term-meta.php';