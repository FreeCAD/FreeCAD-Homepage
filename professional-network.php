<?php
    $currentpage = "professional-network.php";
    include("header.php");
?>

    <main id="main" class="container-fluid">
        <!-- Hero Section -->
        <div class="row">
            <div class="col-12">
                <div class="text-center pt-5">
                    <div class="mb-4">
                        <img src="images/professional-network-logo.png" alt="FreeCAD Professional Network Logo" class="img-fluid" style="max-width: 300px; height: auto;">
                    </div>
                    <p class="lead text-light"><strong><?php echo _('Join the community shaping the future of FreeCAD.'); ?></strong></p>
                </div>
            </div>
        </div>

        <!-- Introduction Section -->
        <div class="row section rounded">
            <div class="col-lg-8 mx-auto text-light px-4">
                <p class="section-body lead">
                    <?php echo _('The FreeCAD Professional Network (FPN) is a voluntary association of professionals committed to strengthening the FreeCAD ecosystem for long-term growth and success.'); ?>
                </p>
                <p class="section-body">
                    <?php echo _('If FreeCAD is part of your livelihood—whether you design, teach, manufacture, research, or create content—the FPN is your place to connect, collaborate, and make an impact.'); ?>
                </p>
            </div>
        </div>

        <!-- Who is a FreeCAD Professional Section -->
        <div class="row section rounded">
            <div class="col-lg-8 mx-auto text-light px-4">
                <h2 class="section-title"><?php echo _('Who is a FreeCAD Professional?'); ?></h2>
                <p class="section-body"><?php echo _('Anyone with a commercial interest in FreeCAD:'); ?></p>
                <ul class="section-body">
                    <li><?php echo _('Engineers, designers, and makers who use FreeCAD at work'); ?></li>
                    <li><?php echo _('Content creators, YouTubers, authors, and Patreon publishers'); ?></li>
                    <li><?php echo _('Educators and trainers in classrooms or workshops'); ?></li>
                    <li><?php echo _('Researchers exploring open CAD in academia'); ?></li>
                    <li><?php echo _('Hardware manufacturers supporting CAD users'); ?></li>
                    <li><?php echo _('Software developers and consultants working with FreeCAD and Addons'); ?></li>
                    <li><?php echo _('Businesses building products and services on FreeCAD'); ?></li>
                </ul>
            </div>
        </div>

        <!-- What We Do Section -->
        <div class="row section rounded">
            <div class="col-lg-8 mx-auto text-light px-4">
                <h2 class="section-title"><?php echo _('What We Do'); ?></h2>
                <p class="section-body"><?php echo _('The FPN brings professionals together to:'); ?></p>
                <ul class="section-body">
                    <li><?php echo _('Advocate for features and improvements that matter most'); ?></li>
                    <li><?php echo _('Help set priorities for FreeCAD development'); ?></li>
                    <li><?php echo _('Provide domain expertise directly to maintainers and contributors'); ?></li>
                    <li><?php echo _('Organize real-world meetups and events'); ?></li>
                    <li><?php echo _('Share knowledge, best practices, and support'); ?></li>
                    <li><?php echo _('Co-develop tools and solutions for the community'); ?></li>
                </ul>
                <p class="section-body">
                    <?php echo _('This is where professionals make their voice heard and pool their strengths to move FreeCAD forward.'); ?>
                </p>
            </div>
        </div>

        <!-- Membership Section -->
        <div class="row section rounded">
            <div class="col-lg-10 mx-auto text-light px-4">
                <h2 class="section-title text-center mb-4"><?php echo _('Membership Tiers'); ?></h2>

                <div class="row">
                    <!-- Individual Membership -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-dark border-light h-100">
                            <div class="card-body text-center">
                                <h3 class="card-title text-primary"><?php echo _('Individual'); ?></h3>
                                <div class="display-6 text-light mb-3">€100<small class="fs-6 text-muted">/year</small></div>
                                <ul class="list-unstyled text-start section-body text-light">
                                    <li class="mb-2 text-light">✓ <?php echo _('Access to professional network'); ?></li>
                                    <li class="mb-2 text-light">✓ <?php echo _('Access to FPN private discord channel'); ?></li>
                                    <li class="mb-2 text-light">✓ <?php echo _('Voting rights on FPN initiatives'); ?></li>
                                    <li class="mb-2 text-light">✓ <?php echo _('Quarterly newsletter'); ?></li>
                                </ul>
                                <div class="mt-4">
                                    <a href="https://buy.stripe.com/eVqaEX2IteaO8bc7zVdZ602" class="btn btn-primary btn-lg rounded-pill px-4" target="_blank"><?php echo _('Join Individual'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Organization Membership -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-dark border-primary h-100">
                            <div class="card-body text-center">
                                <h3 class="card-title text-primary"><?php echo _('Organization'); ?></h3>
                                <div class="display-6 text-light mb-3">€1,000<small class="fs-6 text-muted">/year</small></div>
                                <ul class="list-unstyled text-start section-body text-light">
                                    <li class="mb-2 text-light">✓ <?php echo _('All individual membership benefits'); ?></li>
                                    <li class="mb-2 text-light">✓ <?php echo _('Unlimited employee memberships included'); ?></li>
                                    <li class="mb-2 text-light">✓ <?php echo _('Logo recognition as FPN supporter'); ?></li>
                                </ul>
                                <div class="mt-4">
                                    <a href="https://buy.stripe.com/aFa9AT2It7MqfDE4nJdZ603" class="btn btn-primary btn-lg rounded-pill px-4" target="_blank"><?php echo _('Join Organization'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="section-body text-center mt-4">
                    <?php echo _('Membership isn\'t just a fee—it\'s an investment in FreeCAD\'s future and in your own professional ecosystem.'); ?>
                </p>
            </div>
        </div>

        <!-- Why Join Section -->
        <div class="row section rounded">
            <div class="col-lg-8 mx-auto text-light px-4">
                <h2 class="section-title"><?php echo _('Why Join?'); ?></h2>
                <p class="section-body"><?php echo _('Because FreeCAD is already part of your professional life. Together, we can:'); ?></p>
                <ul class="section-body">
                    <li><?php echo _('Influence its direction'); ?></li>
                    <li><?php echo _('Create an ecosystem that is friendly to commercial interest'); ?></li>
                    <li><?php echo _('Build stronger connections across industries'); ?></li>
                    <li><?php echo _('Ensure FreeCAD continues to thrive as a tool you can rely on'); ?></li>
                </ul>
            </div>
        </div>

    </main>

<?php include 'footer.php'; ?>
