<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

/**
 * Fires between the xml and rss tags in a feed.
 *
 * @since 4.0.0
 *
 * @param string $context Type of feed. Possible values include 'rss2', 'rss2-comments',
 *                        'rdf', 'atom', and 'atom-comments'.
 */
do_action( 'rss_tag_pre', 'rss2' );
?>
<rss version="2.0"
	xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"

	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
>

<channel>
	<title><?php wp_title_rss(); ?></title>
	<link><?php bloginfo_rss('rss2_url') ?></link>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<copyright><?php echo '&#x2117; &amp; &#xA9; ' . date(Y) . ' ' . get_bloginfo_rss() ?></copyright>
	<itunes:subtitle><?php bloginfo_rss("description") ?></itunes:subtitle>
	<itunes:author><?php bloginfo_rss() ?></itunes:author>
	<itunes:summary></itunes:summary>
	<description></description>
	<itunes:owner>
		<itunes:name><?php bloginfo_rss() ?></itunes:name>
		<itunes:email><?php bloginfo_rss('admin_email') ?></itunes:email>
	</itunes:owner>
	<itunes:image href="" />
	<itunes:category text="Arts">
	<itunes:category text="Performing Arts"/>
	</itunes:category>
	<itunes:explicit>no</itunes:explicit>
	<?php
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_head');

	while( have_posts()) : the_post(); ?>
	<item>
		<title><?php the_title_rss() ?></title>
		<itunes:author><![CDATA[<?php the_author() ?>]]></itunes:author>
		<itunes:summary><![CDATA[<?php the_excerpt_rss(); ?>]]></itunes:summary>
		<itunes:image href=""/>
		<link><?php the_permalink_rss() ?></link>
		<enclosure length="" type="" url="">
		<guid isPermaLink="false"><?php the_guid(); ?></guid>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<itunes:duration></itunes:duration>
		<itunes:explicit></itunes:explicit>
	<?php $content = get_the_content_feed('rss2'); ?>
		<content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
		<?php rss_enclosure(); ?>
	<?php
	/**
	 * Fires at the end of each RSS2 feed item.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_item' );
	?>
	</item>
	<?php endwhile; ?>
</channel>
</rss>