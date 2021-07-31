<?php
/**
 * Metabox Values Class.
 *
 * This class fetches the metabox values from database.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

/**
 * Localize Class.
 *
 * @since  1.0.0
 */
class Meta_Values {

	/**
	 * Method to get options values.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function get() {
        $groups   = carbon_get_theme_option( 'merryll_cookie_group' );
        $key_posts = array();

        foreach ($groups as $group) {
            $group_id = $group['merryll_cookie_group_id'];

            $key_args = array(
                'post_type'      => 'merryll_cookies',
                'posts_per_page' => -1,
                'post_status'    => array( 'Publish' ),
                'meta_query'     => array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'merryll_cookie_group/merryll_cookie_group_id',
                        'value'   => $group_id,
                        'compare' => '=',
                    ),
                ),
            );

            $key_loop  = get_posts( $key_args );
            $key_posts = array_map(
                function( $v ) {
                    return $v->ID;
                },
                $key_loop
            );
        }

	}

	/**
	 * Validate the passed value.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @param string $id Settings ID.
	 * @param string $type Type of field.
	 *
	 * @return string
	 */
	private static function validate( $id, $type = 'string' ) {
		$check = carbon_get_theme_option( $id );

		if ( 'array' === $type ) {
			return ! empty( $check ) ? $check : array();
		}

		return ! empty( $check ) ? $check : '';
	}
}
