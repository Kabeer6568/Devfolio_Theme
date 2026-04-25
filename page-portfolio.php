<?php
/* Template Name: Portfolio */

get_header('portfolio');

$portfolio_user = get_query_var('portfolio_user');

if (empty($portfolio_user)) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    exit;
}

$user = get_user_by('login', $portfolio_user);

if (!$user) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    exit;
}

$user_id    = $user->ID;
$user_name  = $user->display_name;
$user_email = $user->user_email;
$bio        = $user->description;
$location   = get_user_meta($user_id, 'devfolio_location', true);
$jobtitle   = get_user_meta($user_id, 'devfolio_jobtitle', true);
$years_exp  = get_user_meta($user_id, 'devfolio_years_exp', true);
$img_id     = get_user_meta($user_id, 'devfolio_profile_img', true);
$resume_id  = get_user_meta($user_id, 'devfolio_resume', true);
$social_links = get_user_meta($user_id, 'devfolio_social_links', true);
if (!is_array($social_links)) $social_links = [];

// Avatar
$avatar_url = $img_id ? wp_get_attachment_url($img_id) : '';

// Resume
$resume_url = $resume_id ? wp_get_attachment_url($resume_id) : '';

// Skills
$skills = new WP_Query([
    'post_type'      => 'skills',
    'author'         => $user_id,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

// Projects
$projects = new WP_Query([
    'post_type'      => 'projects',
    'author'         => $user_id,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

// Group skills by field
$skills_by_field = [];
if ($skills->have_posts()) :
    while ($skills->have_posts()) : $skills->the_post();
        $field      = get_post_meta(get_the_ID(), 'skill_field', true);
        $percentage = get_post_meta(get_the_ID(), 'skill_percentage', true);
        $skills_by_field[$field][] = [
            'name'       => get_the_title(),
            'percentage' => $percentage,
        ];
    endwhile;
    wp_reset_postdata();
endif;

?>

<!-- Hero -->
<section class="portfolio-hero" id="about">
    <div class="container--narrow">
        <div style="display:flex; align-items:flex-start; gap:2rem; flex-wrap:wrap;">

            <!-- Avatar -->
            <div style="width:72px; height:72px; border-radius:50%; background:var(--border); overflow:hidden; flex-shrink:0; border:1px solid var(--border);">
                <?php if ($avatar_url) : ?>
                    <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($user_name); ?>" style="width:100%; height:100%; object-fit:cover;">
                <?php else : ?>
                    <div style="width:100%; height:100%; background:linear-gradient(135deg,#D4CFC7,#A8A49C); display:flex; align-items:center; justify-content:center; font-family:var(--font-mono); font-size:1.5rem; color:#fff;">
                        <?php echo strtoupper(substr($user_name, 0, 1)); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div style="flex:1;">
                <?php if ($jobtitle) : ?>
                    <p class="section-label" style="margin-bottom:0.5rem;">// <?php echo esc_html($jobtitle); ?></p>
                <?php endif; ?>

                <h1 style="font-size:clamp(1.8rem,4vw,2.8rem); margin-bottom:1rem; font-weight:400;">
                    <?php echo esc_html(ucfirst($user_name)); ?>
                </h1>

                <?php if ($bio) : ?>
                    <p style="font-size:1rem; color:var(--text-2); line-height:1.75; max-width:520px; margin-bottom:1.5rem;">
                        <?php echo esc_html($bio); ?>
                    </p>
                <?php endif; ?>

                <div style="display:flex; gap:0.75rem; flex-wrap:wrap; align-items:center;">
                    <a href="mailto:<?php echo esc_attr($user_email); ?>" class="btn btn--primary">Get in touch</a>

                    <?php foreach ($social_links as $link) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>" target="_blank" class="btn btn--outline">
                            <?php echo esc_html($link['platform']); ?> ↗
                        </a>
                    <?php endforeach; ?>

                    <?php if ($resume_url) : ?>
                        <a href="<?php echo esc_url($resume_url); ?>" target="_blank" class="btn btn--ghost" style="font-family:var(--font-mono); font-size:0.75rem;">Resume ↓</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick stats -->
        <div style="display:flex; gap:2rem; margin-top:3rem; flex-wrap:wrap; padding-top:2rem; border-top:1px solid var(--border);">

            <?php if ($years_exp) : ?>
            <div>
                <div style="font-family:var(--font-mono); font-size:1.5rem; font-weight:300;"><?php echo esc_html($years_exp); ?>+</div>
                <div class="text-xs text-faint text-mono" style="text-transform:uppercase; letter-spacing:0.06em; margin-top:0.2rem;">Years exp.</div>
            </div>
            <?php endif; ?>

            <div>
                <div style="font-family:var(--font-mono); font-size:1.5rem; font-weight:300;"><?php echo $projects->found_posts; ?></div>
                <div class="text-xs text-faint text-mono" style="text-transform:uppercase; letter-spacing:0.06em; margin-top:0.2rem;">Projects</div>
            </div>

            <div>
                <div style="font-family:var(--font-mono); font-size:1.5rem; font-weight:300;"><?php echo $skills->found_posts; ?></div>
                <div class="text-xs text-faint text-mono" style="text-transform:uppercase; letter-spacing:0.06em; margin-top:0.2rem;">Skills</div>
            </div>

            <?php if ($location) : ?>
            <div>
                <div style="font-family:var(--font-mono); font-size:1.5rem; font-weight:300;"><?php echo esc_html($location); ?></div>
                <div class="text-xs text-faint text-mono" style="text-transform:uppercase; letter-spacing:0.06em; margin-top:0.2rem;">Location</div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Projects -->
<section class="portfolio-section" id="projects">
    <div class="container--narrow">
        <p class="section-label">// featured projects</p>
        <div class="project-grid">

            <?php
            $projects->rewind_posts();
            if ($projects->have_posts()) :
                while ($projects->have_posts()) : $projects->the_post();
                    $desc = get_post_meta(get_the_ID(), 'short_description', true);
                    $tags = get_the_terms(get_the_ID(), 'project_tags');
            ?>
                <div class="project-card">
                    <h3 class="project-card__title"><?php the_title(); ?></h3>

                    <?php if ($desc) : ?>
                        <p class="project-card__desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>

                    <?php if ($tags && !is_wp_error($tags)) : ?>
                        <div style="display:flex; gap:0.4rem; flex-wrap:wrap; margin-bottom:1rem;">
                            <?php foreach ($tags as $tag) : ?>
                                <span class="tag"><?php echo esc_html($tag->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-muted">No projects added yet.</p>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Skills -->
<section class="portfolio-section" id="skills">
    <div class="container--narrow">
        <p class="section-label">// skills & technologies</p>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; flex-wrap:wrap;">

            <?php foreach ($skills_by_field as $field => $field_skills) : ?>
                <div>
                    <h4 style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-3); font-family:var(--font-mono); margin-bottom:1rem;">
                        <?php echo esc_html($field); ?>
                    </h4>

                    <?php foreach ($field_skills as $skill) : ?>
                        <div class="skill-item">
                            <span class="skill-item__name"><?php echo esc_html($skill['name']); ?></span>
                            <div class="skill-item__bar">
                                <div class="skill-item__fill" data-width="<?php echo esc_attr($skill['percentage']); ?>%" style="width:0%"></div>
                            </div>
                            <span class="skill-item__pct"><?php echo esc_attr($skill['percentage']); ?>%</span>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- Contact -->
<section class="portfolio-section" id="contact">
    <div class="container--narrow">
        <p class="section-label">// get in touch</p>
        <div style="max-width:440px;">
            <h2 style="font-size:1.5rem; font-weight:400; margin-bottom:0.75rem;">Open to opportunities</h2>
            <?php if ($bio) : ?>
                <p class="text-muted" style="margin-bottom:1.5rem; line-height:1.7;"><?php echo esc_html($bio); ?></p>
            <?php endif; ?>
            <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                <a href="mailto:<?php echo esc_attr($user_email); ?>" class="btn btn--primary">Send an email</a>
                <?php foreach ($social_links as $link) : ?>
                    <a href="<?php echo esc_url($link['url']); ?>" target="_blank" class="btn btn--outline">
                        <?php echo esc_html($link['platform']); ?> ↗
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer style="border-top:1px solid var(--border); padding:1.5rem 0;">
    <div class="container--narrow" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
        <span class="text-mono text-faint" style="font-size:0.75rem;">
            <?php echo esc_html($user_name); ?> — made with <a href="<?php echo home_url('/'); ?>" style="color:var(--text-3); text-decoration:underline;">devfolio</a>
        </span>
        <a href="<?php echo home_url('/register'); ?>" class="btn btn--outline btn--sm">Build your portfolio →</a>
    </div>
</footer>

<?php wp_footer(); ?>