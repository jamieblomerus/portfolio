<?php

// Template name: Static Front Page
include 'header.php';
?>
<div data-anchor="pastprojects" class="pastprojects section">
    <h2>My past projects:</h2>
    <p class="description">Here are some of my past projects I have been working on lately. Perhaps your project will be here too one day :)</p>
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
    <div class="contact-block">
        <div class="content">
            <h2>Want to work with me?</h2>
            <p class="description">If you have a project you would like to discuss, please feel free to contact me.</p>
            <a href="#contact" class="button">Contact me</a>
        </div>
    </div>
</div>
<div data-anchor="about-me" class="about-me section">
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
				<img src="<?php echo $image ?>" alt="A photo of Jamie Blomerus">
                <div class="overlay">
                    <a href="https://github.com/jamieblomerus" title="Check out my GitHub profile" target="_blank"><i class="fa fa-github"></i></a>
                </div>
			</div>
        </div>
        <div class="container">
            <h2>About me:</h2>
            <p class="description">Jamie Blomerus is a web developer from Sweden. Jamie has been working in the web development industry for over three years. During that time, they have worked on various projects in Sweden and internationally.<br><br>
            Jamie is a highly skilled web developer with a keen eye for detail. Their experience and skills allow them to create visually appealing websites without compromising functionality.<br><br>
            In their free time, Jamie likes spending time with family and friends and enjoys binge-watching Netflix. Jamie is also a keen traveler and has visited various places.</p>
        </div>
    </div>
</div>
<div data-anchor="certifications" class="certifications section">
    <div class="content">
        <div class="container">
            <h2>My certifications:</h2>
            <p class="description">Most people agree experience is the best kind of learning. But anyways here's some of my certifications.</p>
        </div>
        <div class="container">
            <?php
            foreach ($certifications as $certification_item) {
                ?>
                <button type="button" class="collapsible"><?php echo esc_html__($certification_item['title']) ?><i class="fa fa-chevron-down"></i></button>
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
if(!isset($skip_footer)) {
    get_footer();
}