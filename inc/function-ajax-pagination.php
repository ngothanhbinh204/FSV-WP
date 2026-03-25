<?php
/**
 * Generic AJAX Pagination for CanhCam Theme
 * Reusable for any post type loop by providing data attributes to the wrapper container.
 */

// 1. AJAX Handler
function canhcam_ajax_pagination_handler() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 10;
    $template_part = isset($_POST['template_part']) ? sanitize_text_field($_POST['template_part']) : '';
    $empty_msg = isset($_POST['empty_msg']) ? sanitize_text_field($_POST['empty_msg']) : 'Không có dữ liệu.';

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post_status' => 'publish'
    );
    
    $query = new WP_Query($args);
    
    ob_start();
    if ($query->have_posts()) {
        $count = ($paged - 1) * $posts_per_page + 1;
        while ($query->have_posts()) {
            $query->the_post();
            set_query_var('current_ajax_count', $count);
            if ($template_part) {
                // If template part is provided, load it
                get_template_part($template_part);
            }
            $count++;
        }
    } else {
        // Fallback or empty message
        echo '<tr><td colspan="5" class="text-center py-4">' . esc_html($empty_msg) . '</td></tr>';
    }
    $html = ob_get_clean();
    
    ob_start();
    if (function_exists('canhcam_pagination') && $query->max_num_pages > 1) {
        canhcam_pagination($query, array('is_ajax' => true, 'wrapper_class' => ''));
    }
    $pagination = ob_get_clean();
    
    wp_send_json_success(array(
        'html' => $html,
        'pagination' => $pagination,
        'max_pages' => $query->max_num_pages
    ));
}
add_action('wp_ajax_canhcam_ajax_pagination', 'canhcam_ajax_pagination_handler');
add_action('wp_ajax_nopriv_canhcam_ajax_pagination', 'canhcam_ajax_pagination_handler');

// 2. JS Script for Frontend
function canhcam_ajax_pagination_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ajaxWrappers = document.querySelectorAll('.canhcam-ajax-wrapper');
        
        ajaxWrappers.forEach(wrapper => {
            wrapper.addEventListener('click', function(e) {
                const target = e.target.closest('.ajax-pagination a, .modulepager a');
                
                if (target && target.hasAttribute('data-page')) {
                    e.preventDefault();
                    const page = target.getAttribute('data-page');
                    const postType = wrapper.getAttribute('data-post-type');
                    const postsPerPage = wrapper.getAttribute('data-posts-per-page');
                    const templatePart = wrapper.getAttribute('data-template-part');
                    const emptyMsg = wrapper.getAttribute('data-empty-msg');
                    const listContainer = wrapper.querySelector('.ajax-list-container');
                    const paginationContainer = wrapper.querySelector('.ajax-pagination-container');
                    
                    if (!listContainer || !postType || !templatePart) return;

                    // Cấu hình Spinner Loading
                    let spinner = wrapper.querySelector('.canhcam-ajax-spinner');
                    if (!spinner) {
                        spinner = document.createElement('div');
                        spinner.className = 'canhcam-ajax-spinner flex items-center justify-center';
                        spinner.innerHTML = '<div class="loader"><svg fill="#ff6300" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="1" y="6" width="2.8" height="12"><animate id="spinner_CcmT" begin="0;spinner_IzZB.end-0.1s" attributeName="y" calcMode="spline" dur="0.6s" values="6;1;6" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/><animate begin="0;spinner_IzZB.end-0.1s" attributeName="height" calcMode="spline" dur="0.6s" values="12;22;12" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/></rect><rect x="5.8" y="6" width="2.8" height="12"><animate begin="spinner_CcmT.begin+0.1s" attributeName="y" calcMode="spline" dur="0.6s" values="6;1;6" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/><animate begin="spinner_CcmT.begin+0.1s" attributeName="height" calcMode="spline" dur="0.6s" values="12;22;12" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/></rect><rect x="10.6" y="6" width="2.8" height="12"><animate begin="spinner_CcmT.begin+0.2s" attributeName="y" calcMode="spline" dur="0.6s" values="6;1;6" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/><animate begin="spinner_CcmT.begin+0.2s" attributeName="height" calcMode="spline" dur="0.6s" values="12;22;12" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/></rect><rect x="15.4" y="6" width="2.8" height="12"><animate begin="spinner_CcmT.begin+0.3s" attributeName="y" calcMode="spline" dur="0.6s" values="6;1;6" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/><animate begin="spinner_CcmT.begin+0.3s" attributeName="height" calcMode="spline" dur="0.6s" values="12;22;12" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/></rect><rect x="20.2" y="6" width="2.8" height="12"><animate id="spinner_IzZB" begin="spinner_CcmT.begin+0.4s" attributeName="y" calcMode="spline" dur="0.6s" values="6;1;6" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/><animate begin="spinner_CcmT.begin+0.4s" attributeName="height" calcMode="spline" dur="0.6s" values="12;22;12" keySplines=".36,.61,.3,.98;.36,.61,.3,.98"/></rect></svg></div>';
                        spinner.style.position = 'absolute';
                        spinner.style.top = '50%';
                        spinner.style.left = '50%';
                        spinner.style.transform = 'translate(-50%, -50%)';
                        spinner.style.zIndex = '100';
                        wrapper.style.position = 'relative';
                        wrapper.appendChild(spinner);
                    }
                    spinner.style.display = 'flex';
                    const loaderInner = spinner.querySelector('.loader');
                    if (loaderInner) loaderInner.style.display = 'block';

                    // Thêm lớp loading (tùy chỉnh css opacity nếu muốn)
                    wrapper.style.opacity = '0.6';
                    wrapper.style.pointerEvents = 'none';

                    const formData = new FormData();
                    formData.append('action', 'canhcam_ajax_pagination');
                    formData.append('page', page);
                    formData.append('post_type', postType);
                    formData.append('posts_per_page', postsPerPage);
                    formData.append('template_part', templatePart);
                    if (emptyMsg) formData.append('empty_msg', emptyMsg);

                    fetch('<?= admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            listContainer.innerHTML = res.data.html;
                            if (paginationContainer) {
                                paginationContainer.innerHTML = res.data.pagination;
                            }
                            
                            // Scroll nhẹ lên đầu container sau khi load
                            const y = wrapper.getBoundingClientRect().top + window.scrollY - 100;
                            // window.scrollTo({top: y, behavior: 'smooth'}); // Bỏ scroll theo yêu cầu chung hoặc bạn có thể cmt
                        }
                    })
                    .finally(() => {
                        if (spinner) {
                            spinner.style.display = 'none';
                            if (loaderInner) loaderInner.style.display = 'none';
                        }
                        wrapper.style.opacity = '1';
                        wrapper.style.pointerEvents = 'auto';
                    });
                }
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'canhcam_ajax_pagination_script', 100);
