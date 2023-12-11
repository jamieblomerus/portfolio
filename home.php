<?php

// Template name: Static Front Page
include 'header.php';
?>
<div data-anchor="about-me" class="about-me section">
    <div class="content">
        <div class="container">
            <?php
            $biography = esc_html(get_theme_mod( 'biography' ));
            $biography = str_replace(PHP_EOL, '<br>', $biography);
            ?>
            <div class="container-content">
                <div class="section-header">
                    <!-- <img src="<?php echo get_template_directory_uri() . '/assets/images/profile.png' ?>" alt=""> -->
                    <h2>About me</h2>
                </div>
                <p class="description"><?php echo $biography?></p>
            </div>
        </div>
        <div class="container">
            <div class="socials">
                <h3>FIND ME ON SOCIALS</h3>
                <ul class="socials">
                    <li><a href="https://github.com/jamieblomerus" target="_blank" aria-label="Github"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                    <li><a href="https://stackoverflow.com/users/10879934" target="_blank" aria-label="Stack Overflow"><i class="fa fa-stack-overflow" aria-hidden="true"></i></a></li>
                    <li><a href="https://profiles.wordpress.org/jamieblomerus/" target="_blank" aria-label="WordPress"><i class="fa fa-wordpress" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div data-anchor="pastprojects" class="pastprojects section">
    <h2>My experience:</h2>
    <p class="description">Here are some of my past projects I have been working on lately. Perhaps your project will be here too one day :)</p>
    <div class="content">
        <div class="container grid-container">
            <?php
            // Shuffle the projects so they are not always in the same order
            shuffle($projects);
            foreach ($projects as $project) {
                ?>
                <a href="#pastprojects" class="item" id="project-<?php echo $project['slug'] ?>" onclick="openProject('<?php echo $project['slug'] ?>')">
                    <img src="<?php echo $project['image'] ?>" alt="">
                </a>
                <?php
            }
            ?>
        </div>
        <div class="container" id="active-project">
            <h3 id="active-project-title">Loading...</h3>
            <div class="seperator"></div>
            <p id="active-project-description">This might take a while...</p>
        </div>
        <script>
            var currentProject = '';
            function openProject(project) {
                if (currentProject == project) {
                    return;
                }
                if (currentProject != '') {
                    document.getElementById('project-' + currentProject).classList.remove('active');
                }
                document.getElementById('project-' + project).classList.add('active');
                currentProject = project;

                fetch('<?php echo get_rest_url() ?>portfolio/v1/projects&slug=' + project)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('active-project-title').innerHTML = data.title;
                        document.getElementById('active-project-description').innerHTML = data.description;
                    }).
                catch(error => {
                    document.getElementById('active-project-title').innerHTML = 'An error occured while loading the project';
                    document.getElementById('active-project-description').innerHTML = 'Please try again later.';
                });
            }
            openProject('<?php echo $projects[0]['slug'] ?>');
        </script>
    </div>
    <div class="contact-block">
        <div class="block-content">
            <h3>Want to work with me?</h3>
            <p class="description">If you have a project you would like to discuss, please feel free to contact me.</p>
            <p><a href="#contact" class="button">Contact me</a></p>
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
            $certifications = get_posts(array(
                'post_type' => 'certifications',
                'orderby' => 'publish_date',
                'order' => 'ASC',
            ));
            if (count($certifications) == 0) {
                ?>
                <p>You haven't added any certifications yet. Add your first one <a href="<?php echo admin_url("/post-new.php?post_type=certifications")?>">here</a></p>
                <?php
            }
            foreach ($certifications as $certification_item) {
                ?>
                <button type="button" class="collapsible"><?php echo esc_html__($certification_item->post_title) ?><i class="fa fa-chevron-down"></i></button>
                <div class="collapsible-content">
                    <p><?php echo $certification_item->post_excerpt ?></p>
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