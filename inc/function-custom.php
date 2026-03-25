<?php
function log_dump($data)
{
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);
	$formatted = '<pre>' . substr($highlighted, 27, -8) . '</pre>';
	$custom_css = 'pre {position: static;
		background: #ffffff80;
		// max-height: 50vh;
		width: 100vw;
	}
	pre::-webkit-scrollbar{
	width: 1rem;}';

	$formatted_css = '<style>' . $custom_css . '</style>';
	echo ($formatted_css . $formatted);
}

function canhcam_custom_active_menu_classes($classes, $item) {
    if ($item->object !== 'page') {
        return $classes;
    }

    $post_type_to_template = array(
        'post'        => 'page-templates/template-news.php',
        'service'     => 'page-templates/template-service.php',
        'recruitment' => 'page-templates/template-recruitment.php',
    );

    $needed_template = '';

    if (is_singular('post') || is_category() || is_tag() || is_author() || is_date() || is_home()) {
        $needed_template = $post_type_to_template['post'];
    } elseif (is_singular('service') || is_post_type_archive('service') || is_tax('service_category')) {
        $needed_template = $post_type_to_template['service'];
    } elseif (is_singular('recruitment') || is_post_type_archive('recruitment') || is_tax('recruitment_category')) {
        $needed_template = $post_type_to_template['recruitment'];
    }

    if (!empty($needed_template)) {
        $item_template = get_page_template_slug($item->object_id);
        
        if ($item_template === $needed_template) {
            $classes[] = 'current-menu-ancestor';
            $classes[] = 'current-menu-parent';
            if (is_post_type_archive()) {
                $classes[] = 'current-menu-item';
            }
        }
    }

    return array_unique($classes);
}
add_filter('nav_menu_css_class', 'canhcam_custom_active_menu_classes', 10, 2);


function canhcam_custom_rankmath_breadcrumbs($crumbs, $class) {
    if (is_singular()) {
        $post_type = get_post_type();
        
        $post_type_to_template = array(
            'post'        => 'page-templates/template-news.php',
            'service'     => 'page-templates/template-service.php',
            'recruitment' => 'page-templates/template-recruitment.php',
        );

        if (array_key_exists($post_type, $post_type_to_template)) {
            $template_file = $post_type_to_template[$post_type];
            
            $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => $template_file,
                'number' => 1
            ));
            
            if (!empty($pages)) {
                $parent_page = $pages[0];
                
                $new_crumb = array(
                    $parent_page->post_title,
                    get_permalink($parent_page->ID),
                    ''
                );
                
                array_splice($crumbs, 1, 0, array($new_crumb));
            }
        }
    }
    
    return $crumbs;
}
add_filter('rank_math/frontend/breadcrumb/items', 'canhcam_custom_rankmath_breadcrumbs', 10, 2);

function empty_content($str)
{
	return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}

?>