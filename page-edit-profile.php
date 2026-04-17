<?php

get_header('common');

/* Template Name: Edit Profile */

if ( ! is_user_logged_in() ) {
    wp_redirect( home_url( '/login' ) );
    exit;
}

$user    = wp_get_current_user();
$user_id = $user->ID;

$fullname     = get_user_meta( $user_id, 'devfolio_fullname', true )    ?: $user->display_name;
$location     = get_user_meta( $user_id, 'devfolio_location', true );
$jobtitle     = get_user_meta( $user_id, 'devfolio_jobtitle', true );
$years_exp    = get_user_meta( $user_id, 'devfolio_years_exp', true );
$bio          = $user->description;
$img_id    = get_user_meta( $user_id, 'devfolio_profile_img', true );
$resume_id = get_user_meta( $user_id, 'devfolio_resume', true );

$social_links = get_user_meta($user_id , 'devfolio_social_links' , true);
if (!is_array($social_links)) $social_links = [];


get_sidebar();
?>


  

    <!-- Main Content -->
    <main class="main-content">

      <div class="page-header">
        <div>
          <h1 class="page-header__title">Edit Profile</h1>
          <p class="page-header__sub">Your profile info appears on your public portfolio.</p>
        </div>
      </div>

      <form id="profile-form" method="POST" enctype="multipart/form-data">

        <?php wp_nonce_field( 'devfolio_save_profile', 'profile_nonce' ); ?>

        <div style="display:grid; grid-template-columns:1fr 2fr; gap:2rem; align-items:start; flex-wrap:wrap;">

          <!-- Avatar column -->
          <div class="card" style="text-align:center;">
            <div style="width:80px; height:80px; border-radius:50%; background:var(--border); margin:0 auto 1rem; overflow:hidden; border:1px solid var(--border);">
              <img id="avatar-preview" src="" onerror="this.style.display='none'" alt="avatar" style="width:100%; height:100%; object-fit:cover; display:none;" />
              <div id="avatar-placeholder" style="width:100%; height:100%; background:linear-gradient(135deg,#D4CFC7,#A8A49C); display:flex; align-items:center; justify-content:center; font-family:var(--font-mono); font-size:2rem; color:#fff;">J</div>
            </div>
            <p class="text-xs text-faint mb-2">JPG or PNG, max 2MB</p>
            <label class="btn btn--outline btn--sm btn--full" style="cursor:pointer;">
              Upload photo
              <?php
              
              $img_id = get_user_meta( $user_id, 'devfolio_profile_img' );
              if ($img_id) {
                echo '<img src="' . esc_url( wp_get_attachment_url( $img_id )) . '">' ;
              }
              
              ?>
              <input type="file" id="avatar-input" name="profile_img" accept="image/*" style="display:none;" />
            </label>
          </div>

          <!-- Info column -->
          <div class="card">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
              <div class="form-group">
                <label class="form-label" for="prof-firstname">Full name</label>
                <input class="form-input" type="text" name="fullname" id="prof-firstname" value="<?php echo esc_attr( $fullname ); ?>" />
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="prof-title">Professional title</label>
              <input class="form-input" type="text" name="jobtitle" id="prof-title" value="<?php echo esc_attr( $jobtitle ); ?>" placeholder="e.g. Senior Frontend Engineer" />
            </div>

            <div class="form-group">
              <label class="form-label" for="prof-location">Location</label>
              <input class="form-input" type="text" name="location" id="prof-location" value="<?php echo esc_attr( $location ); ?>" placeholder="City, Country" />
            </div>

            <div class="form-group">
              <label class="form-label" for="prof-email">Contact email</label>
              <input class="form-input" type="email" name="email" id="prof-email" value="<?php echo esc_attr( $user->user_email ); ?>" />
            </div>

            <div class="form-group">
              <label class="form-label" for="prof-bio">Bio</label>
              <textarea class="form-textarea" name="bio" id="prof-bio" rows="4" placeholder="Write a short bio about yourself..."><?php echo esc_textarea( $bio ); ?></textarea>
              <p class="form-hint">Keep it concise — 2-3 sentences works best.</p>
            </div>

            <div class="form-group">
              <label class="form-label" for="prof-experience">Years of experience</label>
              <input class="form-input" type="number" name="years_exp" id="prof-experience" value="<?php echo esc_attr( $years_exp ); ?>" min="0" max="50" style="max-width:100px;" />
            </div>
          </div>

        </div>

        <!-- Social Links -->
        <div class="card mt-3">
          <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem;">
            <h3 style="font-size:0.9375rem;">Social Links</h3>
            <button type="button" class="btn btn--outline btn--sm" id="add-social">+ Add link</button>
          </div>

          <div id="social-list">
            <?php if ( empty( $social_links ) ) : ?>
                        <!-- Default empty row if no links saved yet -->
                        <div class="social-row" style="display:flex; gap:0.75rem; margin-bottom:0.75rem;">
                            <input class="form-input" name="social_platform[]" placeholder="Platform (e.g. GitHub)" style="max-width:140px;" />
                            <input class="form-input" name="social_link[]" placeholder="https://..." style="flex:1;" />
                            <button type="button" class="btn btn--ghost btn--sm remove-social">✕</button>
                        </div>
                    <?php else : ?>
                        <!-- ✅ Loop through saved social links and pre-fill them -->
                        <?php foreach ( $social_links as $link ) : ?>
                            <div class="social-row" style="display:flex; gap:0.75rem; margin-bottom:0.75rem;">
                                <input class="form-input" name="social_platform[]" value="<?php echo esc_attr( $link['platform'] ); ?>" placeholder="Platform" style="max-width:140px;" />
                                <input class="form-input" name="social_link[]" value="<?php echo esc_attr( $link['url'] ); ?>" placeholder="https://..." style="flex:1;" />
                                <button type="button" class="btn btn--ghost btn--sm remove-social">✕</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
            
          </div>
        </div>

        <!-- Resume -->
        <div class="card mt-3">
          <h3 style="font-size:0.9375rem; margin-bottom:1rem;">Resume</h3>
          <div style="display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
            <div style="flex:1;">
              <p class="text-sm text-muted">Upload a PDF resume to display a download link on your portfolio.</p>
              <p class="text-xs text-faint mt-1">Current: <span class="text-mono">jane_smith_resume.pdf</span></p>
            </div>
            <label class="btn btn--outline btn--sm" style="cursor:pointer;">
              Replace resume
              <?php
              
              $resume_id = get_user_meta( $user_id, 'devfolio_resume', true );
              if ( $resume_id ) {
                  echo '<p class="text-sm" style="margin-bottom:0.75rem;">Current: <a href="' . esc_url( wp_get_attachment_url( $resume_id ) ) . '" target="_blank">View resume ↗</a></p>';
              }
              ?>
             
              <input type="file" accept=".pdf" name="resume" style="display:none;" />
            </label>
          </div>
        </div>

        <!-- Actions -->
        <div style="display:flex; justify-content:flex-end; gap:0.75rem; margin-top:1.5rem;">
          <a href="dashboard.html" class="btn btn--outline">Cancel</a>
          <button type="submit" name="submit_profile" class="btn btn--primary">Save changes</button>
        </div>

      </form>

    </main>
  </div>
<?php

get_footer();

?>