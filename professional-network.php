<?php
    $currentpage = "professional-network.php";
    include("header.php");
?>

    <main id="main" class="container-fluid">
        <!-- Hero Section -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <img src="images/professional-network-logo.png" alt="FreeCAD Professional Network Logo" class="img-fluid" style="max-width: 300px; height: auto;">
                    </div>
                    <h1 class="display-4 text-light mb-4"><?php echo _('FreeCAD Professional Network'); ?></h1>
                    <p class="lead text-light mb-5"><strong><?php echo _('Join the community shaping the future of FreeCAD.'); ?></strong></p>
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
            <div class="col-lg-8 mx-auto text-light px-4">
                <h2 class="section-title"><?php echo _('Membership'); ?></h2>
                <ul class="section-body">
                    <li><strong><?php echo _('$100 per year'); ?></strong></li>
                    <li><?php echo _('Individual membership (not tied to organizations)'); ?></li>
                    <li><?php echo _('Funds support the ongoing operations of the FPN and its activities'); ?></li>
                </ul>
                <p class="section-body">
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

        <!-- Call to Action Section -->
        <div class="row section rounded">
            <div class="col-lg-8 mx-auto text-center text-light px-4">
                <p class="lead mb-4">👉 <strong><?php echo _('Be part of the network. Help shape the future of FreeCAD.'); ?></strong></p>
                <a href="https://buy.stripe.com/eVqaEX2IteaO8bc7zVdZ602" class="btn btn-primary btn-lg rounded-pill px-5" target="_blank"><?php echo _('Join Now'); ?></a>
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>
