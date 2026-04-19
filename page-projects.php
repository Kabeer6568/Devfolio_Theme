<?php

get_header('common');

/* Template Name: Skills */

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login' ) );
    exit;
}

get_sidebar();

$projects = new WP_Query([

  'post_type' => 'projects',
  'author' => get_current_user_id(),
  'posts_per_page' => -1,
  'post_status' => 'publish',


]);
?>

    <main class="main-content">

      <div class="page-header">
        <div>
          <h1 class="page-header__title">Projects</h1>
          <p class="page-header__sub">Manage the projects displayed on your public portfolio.</p>
        </div>
        <button class="btn btn--primary" id="add-project-btn">+ Add project</button>
      </div>

      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Tags</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="projects-tbody">
              
            <?php
            
            if ($projects->have_posts()) :
            
              while ($projects->have_posts()) : 

                $projects->the_post();
                $desc = get_post_meta( get_the_id(), 'short_description', true );

                

                
            ?>
            
              <tr>
                <td class="text-mono"><?php the_title(); ?></td>
                <td class="text-muted text-sm"><?php echo $desc; ?></td>

                
                <td>
                  <?php

                $tags = get_the_terms(get_the_ID(), 'project_tags');

                if ($tags) {
                  foreach ($tags as $tag) {
                  ?>
                <span class="tag">
                 <?php echo $tag->name; ?> 
                </span>
                <?php 
                 }
                 }?>
              </td>
               
                <td>
                  <div class="flex gap-1">
                    <button class="btn btn--outline btn--sm">edit</button>
                    <button class="btn btn--danger btn--sm delete-project">delete</button>
                  </div>
                </td>
              </tr>

              <?php 
              endwhile;
              wp_reset_postdata();
            endif;

              ?>



              
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div> 
    
 <?php
  
get_footer();

 ?>