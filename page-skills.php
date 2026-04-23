<?php

get_header('common');

/* Template Name: Skills */

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login' ) );
    exit;
}

get_sidebar();


$skills = new WP_Query([

  'post_type' => 'skills',
  'author' => get_current_user_id(),
  'posts_per_page' => -1,
  'post_status' => 'publish',

]);

?>


    <main class="main-content">

      <div class="page-header">
        <div>
          <h1 class="page-header__title">Skills</h1>
          <p class="page-header__sub">Add technologies and proficiency levels to your portfolio.</p>
        </div>
        <button class="btn btn--primary" id="add-skill-btn">
        <a href="<?php echo admin_url('post-new.php?post_type=skills'); ?>">  
        + Add skill
        </a>
        </button>
      </div>

      <!-- Skills list -->
      <div class="card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem; flex-wrap:wrap; gap:0.5rem;">
          <h3 style="font-size:0.9375rem;">All Skills</h3>
          <div style="display:flex; gap:0.5rem;">
           
            <button class="btn btn--ghost btn--sm" onclick="filterSkills('all')" id="filter-all" style="color:var(--text);">All</button>
            
             <?php 
            $shown_fields = [];
            while ($skills->have_posts()) :

    
$skills->the_post();
    $field = get_post_meta( get_the_id(), 'skill_field', true );

    if (!in_array($field , $shown_fields)) :
      $shown_fields[] = $field;
    ?>
            
            <button class="btn btn--ghost btn--sm" onclick="filterSkills('<?php echo $field; ?>')"><?php echo $field; ?></button>
            <?php 
          endif;
          endwhile; $skills->rewind_posts();?>
            
          </div>
        </div>

        <div id="skills-list">
          
        
        <?php
        
        if ($skills->have_posts()) :
  while ($skills->have_posts()) :

    $skills->the_post();

    $percentage = get_post_meta( get_the_id(), 'skill_percentage', true );
    $field = get_post_meta( get_the_id(), 'skill_field', true );
    

        
        ?>

          <div class="skill-item" data-category="<?php echo $field; ?>">
            <span class="skill-item__name"><?php the_title(); ?></span>
            <div class="skill-item__bar"><div class="skill-item__fill" data-width="90%" style="width:0%"></div></div>
            <span class="skill-item__pct"><?php echo $percentage; ?></span>
            <span class="tag"><?php echo $field; ?></span>
            <button class="btn btn--ghost btn--sm delete-skill" title="Remove">
              <a href="<?php echo get_delete_post_link(get_the_ID()); ?>">
                ✕
              </a>
            </button>
          </div>
          <?php
          
  endwhile;
  wp_reset_postdata();
endif;
          
          ?>
          
          
          
         
        </div>

      </div>

    </main>
  </div>

<script>
    // Filter function (inline since it's page-specific UI)
    function filterSkills(category) {
      const items = document.querySelectorAll('.skill-item[data-category]');
      items.forEach(item => {
        item.style.display = (category === 'all' || item.dataset.category === category) ? 'flex' : 'none';
      });
    }
  </script>
  <?php
  
  get_footer();
  
  ?>