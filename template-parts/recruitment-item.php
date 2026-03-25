<?php
/**
 * Template part for displaying a recruitment row item
 */

$count = get_query_var('current_ajax_count');
if (!$count) {
    // Fallback if not loaded via AJAX or custom query var
    global $wp_query;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $count = ($paged - 1) * $wp_query->query_vars['posts_per_page'] + $wp_query->current_post + 1;
}

$post_id = get_the_ID();
$deadline = get_field('job_deadline', $post_id);
$location = get_field('job_location', $post_id) ?: 'Trụ sở'; 
?>
<tr>
	<td><?= sprintf("%02d", $count); ?></td>
	<td><a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a></td>
	<td><?= esc_html($deadline); ?></td>
	<td><?= esc_html($location); ?></td>
	<td>
		<div class="btn-wrap">
			<a href="<?= get_permalink(); ?>" class="btn btn-tertiary">
				<span><?= esc_html__('Ứng tuyển ngay', 'canhcamtheme'); ?></span><em class="fa-regular fa-arrow-right"></em>
			</a>
		</div>
	</td>
</tr>
