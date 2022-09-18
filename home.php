<?php

// Template name: Static Front Page
include 'header.php';
?>
<div id="pastprojects" class="snap-container">
    <h2>My past projects:</h2>
    <p class="description">Here are some of my past projects I have been working on lately. Perhaps your project will be here too one day :).</p>
    <div class="grid-container">
        <?php
        foreach ($projects as $project) {
            ?>
            <div class="item">
                <div class="project">
                    <div class="project-image">
                        <img src="<?php echo esc_url($project['image']) ?>" alt="">
                    </div>
                    <div class="text-container">
                        <h3 class="project-title"><?php echo esc_html__($project['title']) ?></h3>
                        <p class="project-description"><?php echo $project['description'] ?></p>
                        <button type="button" project-url="<?php echo esc_url($project['link']) ?>" onclick="visit_project(this)">Visit project</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div id="about-me" class="snap-container">
    <div class="content">
        <div class="container">
            <div class="image-container">
				<?php
				//Get image
				$image = esc_url(get_theme_mod('profile_image'));
				if (empty($image)) {
					$image = get_template_directory_uri() . '/assets/images/profile.webp';
				}
				?>
				<img src="<?php echo $image ?>" alt="">
                <div class="overlay">
                    <a href="https://www.linkedin.com/in/jamie-blomerus-1b1b4b1b1/" title="Check out my LinkedIn profile" target="_blank"><i class="fa fa-linkedin"></i></a>
                </div>
			</div>
        </div>
        <div class="container">
            <h2>About me:</h2>
            <p class="description"> Jamie Blomerus is a web developer from Sweden. Jamie has been working in the web development industry for over three years. During that time, Jamie has worked on a variety of projects, both in Sweden and internationally.<br><br>
            Jamie is a highly skilled web developer, with a keen eye for detail. Jamie's experience and skills allow them to create websites that are both functional and visually appealing.<br><br>
            In Jamies free time, Jamie enjoys spending time with family and friends and enjoys binge-watching Netflix. Jamie is also a keen traveler and has visited a wide variety of places.</p>
        </div>
    </div>
</div>
<div id="certifications" class="snap-container">
    <div class="content">
        <div class="container">
            <h2>My certifications:</h2>
            <p class="description">Most people agree experience is the best kind of learning. But anyways here's some of my certifications.</p>
        </div>
        <div class="container">
            <?php
            foreach ($certifications as $certification_item) {
                ?>
                <button type="button" class="collapsible"><?php echo esc_html__($certification_item['title']) ?></button>
                <div class="collapsible-content">
                    <p><?php echo $certification_item['description'] ?></p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();