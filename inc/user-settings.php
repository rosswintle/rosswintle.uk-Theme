<?php
/**
 * User settings and themeing
 *
 * @package rosswintle
 */

/*
 * Get the current user theme (from cookie)
 */
function rw_user_theme() {
	return isset($_COOKIE['rw_user_theme']) ? $_COOKIE['rw_user_theme'] : 'dark';
}
