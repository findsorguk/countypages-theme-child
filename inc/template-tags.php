<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package countypages
 */

if ( ! function_exists( 'countypages_child_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author and
 * update date/time and editor, if any.
 */
function countypages_child_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'countypages' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'countypages' ),
		'<span class="author vcard"><a class="url fn n" href="'
		. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'
		. esc_html( get_the_author() ) . '</a></span>'
	);

	// If the post has been modified, add 'last updated' information
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		$update_string = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';

		$update_string = sprintf( $update_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$updated_on = sprintf(
			_x( 'Last updated %s', 'updated date', 'countypages' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $update_string . '</a>'
		);
		$editor_byline = sprintf(
			_x( 'by %s', 'post editor', 'countypages' ),
			'<span class="editor vcard"><a class="url fn n" href="'
			. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'
			. esc_html( get_the_modified_author() ) . '</a></span>'
		);
	}

	echo '<span class="posted-on">' . $posted_on . '</span>
			<span class="byline"> ' . $byline . '</span>';
	if ( isset( $updated_on ) ) {
		echo '<br><span class="updated-on">' . $updated_on . '</span>
			<span class="byline">' . $editor_byline . '</span>';
	}

}
endif;
