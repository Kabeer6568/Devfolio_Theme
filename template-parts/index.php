


  <!-- Features -->
  <section id="features" style="padding: 4rem 0; border-top: 1px solid var(--border);">
    <div class="container">
      <p class="section-label"><?php the_field('features_label'); ?></p>
      <div class="features-grid">
        <?php if (have_rows('feature_item')):?>

        <?php while( have_rows('feature_item') ): the_row(); ?>
        <div class="feature-item">
          <div class="feature-item__num"><?php the_sub_field('item_no'); ?></div>
          <h3 class="feature-item__title"><?php the_sub_field('features_title'); ?></h3>
          <p class="feature-item__desc"><?php the_sub_field('features_description'); ?></p>
        </div>
        <?php endwhile; ?>

        <?php endif; ?>
        
      </div>
    </div>
  </section>

  <!-- How it works -->
  <section id="how" style="padding: 4rem 0; border-top: 1px solid var(--border);">
    <div class="container">
      <p class="section-label">// how it works</p>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; max-width: 800px;">
        <div>
          <div style="font-family: var(--font-mono); font-size: 2rem; font-weight: 300; color: var(--border-dark); margin-bottom: 0.75rem;">1</div>
          <h4 style="font-size: 0.9375rem; margin-bottom: 0.5rem;">Create account</h4>
          <p class="text-sm text-muted">Register with your email in under 30 seconds.</p>
        </div>
        <div>
          <div style="font-family: var(--font-mono); font-size: 2rem; font-weight: 300; color: var(--border-dark); margin-bottom: 0.75rem;">2</div>
          <h4 style="font-size: 0.9375rem; margin-bottom: 0.5rem;">Fill in your profile</h4>
          <p class="text-sm text-muted">Add bio, skills, and projects from your dashboard.</p>
        </div>
        <div>
          <div style="font-family: var(--font-mono); font-size: 2rem; font-weight: 300; color: var(--border-dark); margin-bottom: 0.75rem;">3</div>
          <h4 style="font-size: 0.9375rem; margin-bottom: 0.5rem;">Share your link</h4>
          <p class="text-sm text-muted">Your portfolio is live. Share the link on LinkedIn, GitHub, or resumes.</p>
        </div>
      </div>
    </div>
  </section>

 
  