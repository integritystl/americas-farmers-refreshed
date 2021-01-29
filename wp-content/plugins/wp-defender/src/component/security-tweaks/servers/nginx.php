<?php

namespace WP_Defender\Component\Security_Tweaks\Servers;

class Nginx {
	/**
	 * Service type
	 *
	 * @var string
	 */
	private $type = null;

	/**
	 * Constructor method
	 *
	 * @param void
	 */
	public function __construct( $type ) {
		$this->type = $type;
	}

	/**
	 * Check whether the issue has been resolved or not
	 *
	 * @return bool
	 */
	public function check() {
		$url = '';

		if ( 'prevent-php-executed' === $this->type ) {
			$dir = wp_upload_dir();
			$url = $dir['baseurl'] . '/wp-defender/index.php';
		}

		if ( 'protect-information' === $this->type ) {
			$url = defender_asset_url( '/languages/wpdef-default.pot' );
		}

		return Server::ping_test_failed( $url );
	}

	/**
	 * Process the rule
	 *
	 * @return bool
	 */
	public function process() {
		return true;
	}

	/**
	 * Revert the rule
	 *
	 * @return bool
	 */
	public function revert() {
		return true;
	}

	/**
	 * Get rules
	 *
	 * @return string
	 */
	public function get_rules() {
		$rules = '';
		if ( 'prevent-php-executed' === $this->type ) {
			if ( defender_is_windows() ) {
				$wp_includes = str_replace( ABSPATH, '', WPINC );
				$wp_content  = str_replace( ABSPATH, '', WP_CONTENT_DIR );
			} else {
				$wp_includes = str_replace( $_SERVER['DOCUMENT_ROOT'], '', ABSPATH . WPINC );
				$wp_content  = str_replace( $_SERVER['DOCUMENT_ROOT'], '', WP_CONTENT_DIR );
			}

			$rules .= PHP_EOL;
			$rules .= "# Stop php access except to needed files in wp-includes" . PHP_EOL;
			$rules .= "location ~* ^$wp_includes/.*(?<!(js/tinymce/wp-tinymce))\.php$ {" . PHP_EOL;
			$rules .= "  internal; #internal allows ms-files.php rewrite in multisite to work" . PHP_EOL;
			$rules .= "}" . PHP_EOL;
			$rules .= PHP_EOL;
			$rules .= "# Specifically locks down upload directories in case full wp-content rule below is skipped" . PHP_EOL;
			$rules .= "location ~* /(?:uploads|files)/.*\.php$ {" . PHP_EOL;
			$rules .= "  deny all;" . PHP_EOL;
			$rules .= "}" . PHP_EOL;
			$rules .= PHP_EOL;
			$rules .= "# Deny direct access to .php files in the /wp-content/ directory (including sub-folders)." . PHP_EOL;
			$rules .= "# Note this can break some poorly coded plugins/themes, replace the plugin or remove this block if it causes trouble" . PHP_EOL;
			$rules .= "location ~* ^$wp_content/.*\.php$ {" . PHP_EOL;
			$rules .= "  deny all;" . PHP_EOL;
			$rules .= "}" . PHP_EOL;
		}

		if ( 'protect-information' === $this->type ) {
			if ( defender_is_windows() ) {
				$wp_content  = str_replace( ABSPATH, '', WP_CONTENT_DIR );
			} else {
				$wp_content  = str_replace( $_SERVER['DOCUMENT_ROOT'], '', WP_CONTENT_DIR );
			}
			$rules .= '# Turn off directory indexing autoindex off;' . PHP_EOL;
			$rules .= PHP_EOL;
			$rules .= '# Deny access to htaccess and other hidden files' . PHP_EOL;
			$rules .= 'location ~ /\. {' . PHP_EOL;
			$rules .= '  deny  all;' . PHP_EOL;
			$rules .= '}' . PHP_EOL;
			$rules .= PHP_EOL;
			$rules .= '# Deny access to wp-config.php file' . PHP_EOL;
			$rules .= 'location = /wp-config.php {' . PHP_EOL;
			$rules .= '  deny all;' . PHP_EOL;
			$rules .= '}' . PHP_EOL;
			$rules .= PHP_EOL;
			$rules .= '# Deny access to revealing or potentially dangerous files in the /wp-content/ directory (including sub-folders)' . PHP_EOL;
			$rules .= "location ~* ^$wp_content/.*\.(md|exe|sh|bak|inc|pot|po|mo|log|sql)$ {" . PHP_EOL;
			$rules .= '  deny all;' . PHP_EOL;
			$rules .= '}' . PHP_EOL;
		}

		return $rules;
	}
}