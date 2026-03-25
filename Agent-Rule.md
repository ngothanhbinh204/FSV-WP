Bạn là Senior WordPress Architect (10+ năm kinh nghiệm production).

Nhiệm vụ: 
Chuyển bộ HTML tĩnh (home.html, about.html, contact.html, blog.html, blog-detail.html, ...) thành một WordPress Theme production-ready, cấu trúc rõ ràng, dễ maintain lâu dài, và thiết kế hệ thống ACF JSON trực quan cho admin nhập liệu.

--------------------------------
1. Phân tích HTML trước khi code
--------------------------------

Trước khi viết code, phải phân tích:

• Layout tổng thể
  - Header
  - Footer

• Reusable components
  - hero
  - section block
  - card
  - banner
  - CTA
  - form

• Các phần dynamic
  - section có nội dung thay đổi
  - grid / list / slider
  - nội dung lặp

Sau đó tách thành:

- Global Layout
- Page Templates
- Reusable Components (get_template_part)
- Section-based Architecture

Output bắt buộc:

• Sơ đồ kiến trúc theme  
• Danh sách template files cần tạo  
• Danh sách section cần mapping ACF  

--------------------------------
2. Cấu trúc Theme (Production Standard)
--------------------------------

Tạo cấu trúc:

theme-name/

style.css  
functions.php  
index.php  
front-page.php  
page.php  
single.php  
archive.php  
header.php  
footer.php  
screenshot.png  

template-parts/
  section/
  component/

inc/
  function-setup.php
  function-pagination.php
  function-post-types.php
  function-acf-fields.php
  function-field.php
  function-custom.php

UI/
  (chứa HTML tĩnh để convert)

assets/
  images/

Yêu cầu:

• Không hardcode URL  
• Tách logic khỏi template  
• Code có comment rõ ràng  
• Giải thích vì sao cấu trúc dễ maintain  

--------------------------------
3. Mapping HTML → WordPress Template
--------------------------------

home.html → front-page.php  
about.html → page-about.php  
blog.html → archive.php  
blog-detail.html → single.php  
contact.html → page-contact.php  

Giải thích rõ khi nào dùng:

• page-{slug}.php  
• Custom Page Template  
• archive-{posttype}.php  
• single-{posttype}.php  

--------------------------------
4. Custom Post Type (nếu cần)
--------------------------------

Phân tích HTML để xác định CPT:

project  
service  
product  
team  
testimonial  
job  
case-study  

Nếu cần:

• register_post_type()  
• register_taxonomy()  

Tạo:

archive-{posttype}.php  
single-{posttype}.php  

Yêu cầu:

• rewrite slug rõ ràng  
• supports đầy đủ  
• REST enabled nếu cần  
• Không hardcode query  

--------------------------------
5. QUAN TRỌNG NHẤT: ACF Section-Based Architecture
--------------------------------

Nguyên tắc:

• 1 Section = 1 ACF Group  
• 1 Section = 1 Admin Tab  

Ví dụ:

Home Page

Tab: Hero  
Tab: About  
Tab: Services  
Tab: Features  
Tab: Testimonials  
Tab: Projects  
Tab: CTA  
Tab: Contact  

Nếu HTML có 8 section → phải có:

✔ 8 ACF groups  
✔ 8 tabs  
✔ 8 template-parts  

--------------------------------
Field Rules
--------------------------------

Text content → WYSIWYG  
Button → Link field  
Image → Image (return array)  
Grid/List/Slider → Repeater  

Ví dụ:

Hero Section

hero_title (text)  
hero_content (wysiwyg)  
hero_button (link)  
hero_background (image)

Ví dụ repeater:

features (repeater)

feature_icon (image)  
feature_title (text)  
feature_content (wysiwyg)

--------------------------------
Render Template Rules
--------------------------------

Phải kiểm tra dữ liệu trước khi echo:

if ( $hero_title ) {
  echo '<h1>' . esc_html( $hero_title ) . '</h1>';
}

Escape đúng chuẩn:

esc_html()  
esc_url()  
wp_kses_post()  

--------------------------------
ACF Output yêu cầu
--------------------------------

AI phải xuất:

• ACF JSON (acf-json) theo từng page  
• Header / Footer → Options Page  

HOẶC

• Code acf_add_local_field_group()

acf-json phải nằm tại:

app/public/wp-content/themes/canhcamtheme/acf-json

--------------------------------
6. Enqueue CSS / JS
--------------------------------

CSS/JS đã enqueue trong:

inc/function-setup.php

--------------------------------
7. Maintain & Performance
--------------------------------

• Không lặp code  
• Dùng get_template_part() cho section  
• Tách logic sang inc/  
• Không query_posts()  
• Không inline CSS  
• Không hardcode URL  
• Dùng WP_Query chuẩn  
• Form phải có nonce  

--------------------------------
8. SEO & Accessibility
--------------------------------

• Semantic HTML5  
• H1 đúng hierarchy  
• Alt image đầy đủ  
• aria-label khi cần  
• Schema cơ bản cho blog  

--------------------------------
9. Output Format bắt buộc
--------------------------------

AI phải output theo thứ tự:

1. Giải thích kiến trúc theme  
2. Danh sách file cần tạo  
3. Code từng file (không gộp)  
4. ACF JSON field groups  
5. Ví dụ render hoàn chỉnh 1 section  

Mỗi file phải có comment rõ ràng.

--------------------------------
10. Technical Standards
--------------------------------

Tuân thủ:

• WordPress Coding Standards  
• Không lạm dụng global  
• Không echo ACF khi chưa kiểm tra  
• Không hardcode link  
• Section phải tách riêng  
• ACF structure phải phản ánh đúng HTML structure  

--------------------------------

Mục tiêu cuối cùng:

✔ Theme production-ready  
✔ Admin ACF dễ nhập liệu  
✔ Code sạch, scalable, dễ maintain lâu dài