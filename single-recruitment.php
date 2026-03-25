<?php
/*
Template Detail: Recruitment
*/
get_header();
$cid = get_the_ID();
$deadline = get_field('job_deadline', $cid);
$salary = get_field('job_salary', $cid);
$gender = get_field('job_gender', $cid);
$experience = get_field('job_experience', $cid);
?>

<main>
	<div class="global-breadcrumb">
		<div class="container-fluid">
			<?php 
            if (function_exists('rank_math_the_breadcrumbs')) {
                rank_math_the_breadcrumbs();
            }
            ?>
		</div>
	</div>
	<section class="recruit-detail pad-8">
		<div class="container relative">
			<h2 class="heading-2 pb-6 mb-6 border-b border-grey-100 text-primary-1"><?php the_title(); ?></h2>
			<div class="row">
				<div class="col w-full lg:w-8/12">
					<div class="block-wrapper">
						<h3 class="heading-1 text-primary-1 mb-5"><?= esc_html__('Mô tả công việc', 'canhcamtheme'); ?></h3>
						<div class="fullcontent">
							<?php the_content(); ?>
						</div>
					</div>
					
					<div class="share flex-start"><span class="body-1 mr-2"><?= esc_html__('Chia sẻ:', 'canhcamtheme'); ?></span>
						<div class="social flex-end gap-5">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink(); ?>" target="_blank" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-facebook-f"></em></a>
							<a href="https://twitter.com/intent/tweet?url=<?= get_permalink(); ?>&text=<?= get_the_title(); ?>" target="_blank" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-twitter"></em></a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= get_permalink(); ?>&title=<?= get_the_title(); ?>" target="_blank" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-linkedin-in"></em></a>
							<a href="https://sp.zalo.me/plugins/share?domain=<?= home_url(); ?>&url=<?= get_permalink(); ?>" target="_blank" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><img src="<?= get_template_directory_uri(); ?>/img/zalo.svg" alt="zalo"></a>
						</div>
					</div>
				</div>
				<div class="col w-full lg:w-4/12">
					<div class="btn-wrap p-6 bg-primary-1 mb-10 lg:p-8">
						<h2 class="heading-1 text-white mb-5 info-wrap"><?= esc_html__('Thông tin tuyển dụng', 'canhcamtheme'); ?></h2>
						<div class="list">
							<ul>
								<?php if($deadline): ?>
								<li>
									<div class="icon"> <em class="fa-regular fa-calendar"></em></div>
									<div class="txt">
										<p><span><?= esc_html__('hạn nộp hồ sơ', 'canhcamtheme'); ?></span><strong><?= esc_html($deadline); ?></strong></p>
									</div>
								</li>
								<?php endif; ?>
								<?php if($salary): ?>
								<li>
									<div class="icon"> <em class="fa-regular fa-dollar-sign"></em></div>
									<div class="txt">
										<p><span><?= esc_html__('Mức lương', 'canhcamtheme'); ?></span><strong><?= esc_html($salary); ?></strong></p>
									</div>
								</li>
								<?php endif; ?>
								<?php if($gender): ?>
								<li>
									<div class="icon"> <em class="fa-regular fa-user"></em></div>
									<div class="txt">
										<p><span><?= esc_html__('Giới tính', 'canhcamtheme'); ?></span><strong><?= esc_html($gender); ?></strong></p>
									</div>
								</li>
								<?php endif; ?>
								<?php if($experience): ?>
								<li>
									<div class="icon"> <em class="fa-regular fa-briefcase"></em></div>
									<div class="txt">
										<p><span><?= esc_html__('Kinh nghiệm', 'canhcamtheme'); ?></span><strong><?= esc_html($experience); ?></strong></p>
									</div>
								</li>
								<?php endif; ?>
							</ul>
						</div>
						<div class="btn-wrap mt-8">
							<a class="btn btn-primary" data-fancybox="recruit-modal" href="#recruit-modal">
								<span><?= esc_html__('Ứng tuyển ngay', 'canhcamtheme'); ?></span><em class="fa-regular fa-long-arrow-right"></em>
							</a>
						</div>
					</div>
					
					<?php 
					$related_args = array(
						'post_type' => 'recruitment',
						'posts_per_page' => 4,
						'post__not_in' => array($cid),
						'post_status' => 'publish'
					);
					$related = new WP_Query($related_args);
					if($related->have_posts()):
					?>
					<div class="bg-wrap overflow-hidden p-6 lg:p-8 shadow-lg other-job">
						<h3 class="heading-1 text-primary-1 mb-3"><?= esc_html__('Vị trí khác (Other vacancies)', 'canhcamtheme'); ?></h3>
						<div class="wrap">
							<?php 
							while($related->have_posts()): $related->the_post(); 
								$rel_deadline = get_field('job_deadline', get_the_ID());
							?>
							<div class="recruit-item group side-item border-b border-grey-100 pb-3 mb-3">
								<div class="txt">
									<?php if($rel_deadline): ?><time class="mb-2 block text-sm text-grey-500"><?= esc_html($rel_deadline); ?></time><?php endif; ?>
									<h3 class="headline"><a href="<?= get_permalink(); ?>" class="group-hover:underline group-hover:text-primary-1"><?php the_title(); ?></a></h3>
								</div>
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Popup Form Ứng tuyển -->
	<div class="popup-modal recruit-modal hidden" id="recruit-modal">
		<div class="modal-wrap p-6 lg:p-10 max-w-2xl mx-auto bg-white rounded-lg relative">
			<h2 class="heading-2 text-center mb-8"><?php the_title(); ?></h2>
			<div class="wrap-form">
				<?php $form_recruitment = get_field('form-recruitment', 'option') ?>
				<?php if($form_recruitment): ?>
					<?= do_shortcode($form_recruitment); ?>
				<?php else: ?>
					<p><?= esc_html__('Không có form ứng tuyển', 'canhcamtheme'); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
