<ul class="navbar-nav sidebar sidebar-dark accordion admin_sidebar_section" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-light text-primary">
        <!-- <div class="sidebar-brand-text mx-3">Kakinada <br> Hub</div>
          -->
    </a>


    <!-- <hr class="sidebar-divider my-0"> -->


    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-blog"></i>
            <span>Advertisings</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item side_content" href="home_index.php"> <i class="fas fa-fw fa-blog"></i> Home</a>
                <a class="collapse-item side_content" href="banner_ads.php"> <i class="fas fa-fw fa-edit"></i> Banner Ads</a>
                <a class="collapse-item side_content" href="side_piller_ads.php"> <i class="fas fa-fw fa-edit"></i> Side Piller Ads</a>
            </div>
        </div>
    </li>




    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePDFMenu" aria-expanded="true" aria-controls="collapsePDFMenu">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Services</span>
        </a>
        <div id="collapsePDFMenu" class="collapse" aria-labelledby="headingPDFMenu" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <!-- Movies Main Item -->
                <a class="collapse-item side_content collapsed" href="#" data-toggle="collapse" data-target="#collapseMovies" aria-expanded="false" aria-controls="collapseMovies">
                    <i class="fas fa-film"></i> &nbsp; Movies
                </a>
                <div id="collapseMovies" class="collapse" data-parent="#collapsePDFMenu">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <!-- Theater Sub Menu -->
                        <a class="collapse-item side_content collapsed" href="#" data-toggle="collapse" data-target="#collapseTheater" aria-expanded="false" aria-controls="collapseTheater">
                            <i class="fas fa-theater-masks"></i> &nbsp; Theater
                        </a>
                        <div id="collapseTheater" class="collapse">
                            <a class="collapse-item side_content" href="add_theater.php">
                                <i class="fas fa-plus-circle"></i> Add Theater
                            </a>
                            <a class="collapse-item side_content" href="view_theater.php">
                                <i class="fas fa-eye"></i> View Theater
                            </a>
                        </div>

                        <!-- Screens Sub Menu -->
                        <a class="collapse-item side_content collapsed" href="#" data-toggle="collapse" data-target="#collapseScreens" aria-expanded="false" aria-controls="collapseScreens">
                            <i class="fas fa-tv"></i> &nbsp; Screens
                        </a>
                        <div id="collapseScreens" class="collapse">
                            <a class="collapse-item side_content" href="add_screen.php">
                                <i class="fas fa-plus-circle"></i> Add Screens
                            </a>
                            <a class="collapse-item side_content" href="view_screen.php">
                                <i class="fas fa-eye"></i> View Screens
                            </a>
                        </div>

                        <!-- Show Sub Menu -->
                        <a class="collapse-item side_content collapsed" href="#" data-toggle="collapse" data-target="#collapseShow" aria-expanded="false" aria-controls="collapseShow">
                            <i class="fas fa-video"></i> &nbsp; Show
                        </a>
                        <div id="collapseShow" class="collapse">
                            <a class="collapse-item side_content" href="add_show.php">
                                <i class="fas fa-plus-circle"></i> Add Show
                            </a>
                            <a class="collapse-item side_content" href="view_show.php">
                                <i class="fas fa-eye"></i> View Show
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Continue other main services -->
                <a class="collapse-item side_content" href="#" data-toggle="collapse" data-target="#collapseRestaurants" aria-expanded="false" aria-controls="collapseRestaurants">
                    <i class="fas fa-utensils"></i> &nbsp; Restaurants
                </a>
                <div id="collapseRestaurants" class="collapse">
                    <a class="collapse-item side_content" href="add_restaurant.php"><i class="fas fa-plus-circle"></i> Add   Restaurants</a>
                    <a class="collapse-item side_content" href="view_restaurants.php"><i class="fas fa-eye"></i> View Restaurants</a>
                </div>
                 




                <a class="collapse-item side_content" href="#">
                    <i class="fas fa-spa"></i> &nbsp; Saloons & Spa
                </a>
                <a class="collapse-item side_content" href="#">
                    <i class="fas fa-gem"></i> &nbsp; Gifts & Jewellery
                </a>
                <a class="collapse-item side_content" href="#">
                    <i class="fas fa-tshirt"></i> &nbsp; Fashion
                </a>
                <a class="collapse-item side_content" href="#">
                    <i class="fas fa-hospital-alt"></i> &nbsp; Hospitals
                </a>
                <a class="collapse-item side_content" href="#">
                    <i class="fas fa-dumbbell"></i> &nbsp; Sports & Gym
                </a>
                <a class="collapse-item side_content" href="#">
                    <i class="fas fa-baby"></i> &nbsp; Kids & Babies
                </a>
                <!-- Jobs -->
                <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapseJobs" aria-expanded="false" aria-controls="collapseJobs">
                    <i class="fas fa-briefcase"></i> &nbsp; Jobs
                </a>
                <div id="collapseJobs" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <!-- Job Categories -->
                        <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapseJobCategories" aria-expanded="false" aria-controls="collapseJobCategories">
                            <i class="fas fa-building"></i>&nbsp; Companies
                        </a>
                        <div id="collapseJobCategories" class="collapse">
                            <a class="collapse-item side_content" href="add_companies.php"><i class="fas fa-building"></i> Add Company</a>
                            <a class="collapse-item side_content" href="companies.php"><i class="fas fa-eye"></i> View Company</a>
                        </div>

                        <!-- Postings -->
                        <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapseJobPostings" aria-expanded="false" aria-controls="collapseJobPostings">
                            <i class="fas fa-briefcase"></i>&nbsp; Jobs
                        </a>
                        <div id="collapseJobPostings" class="collapse">
                            <a class="collapse-item side_content" href="add_job.php"><i class="fas fa-plus-circle"></i> Add Job</a>
                            <a class="collapse-item side_content" href="view_jobs.php"><i class="fas fa-eye"></i> View Jobs</a>
                        </div>

                        <!-- Applicants -->
                        <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapseApplicants" aria-expanded="false" aria-controls="collapseApplicants">
                            <i class="fas fa-ad"></i> &nbsp; Add Ads
                        </a>
                        <div id="collapseApplicants" class="collapse">
                            <a class="collapse-item side_content" href="add_companies.php"><i class="fas fa-plus-circle"></i> Add Ads</a>
                            <a class="collapse-item side_content" href="view_company_ads.php"><i class="fas fa-eye"></i> View Ads</a>
                        </div>

                    </div>
                </div>

                <a class="collapse-item side_content" href="#"  data-toggle="collapse" data-target="#collapseEvent" aria-expanded="false" aria-controls="collapseEvent">
                    <i class="fas fa-calendar-alt"></i> &nbsp; Events
                </a>

                <div id="collapseEvent" class="collapse">
                    <a class="collapse-item side_content" href="add_event.php "><i class="fas fa-plus-circle"></i> Add   Events</a>
                    <a class="collapse-item side_content" href="events.php"><i class="fas fa-eye"></i> View Events</a>
                </div>



                <a class="collapse-item side_content" href="#" data-toggle="collapse" data-target="#collapseTravels" aria-expanded="false" aria-controls="collapseTravels">
                    <i class="fas fa-bus"></i> &nbsp; Travel
                </a>

                <div id="collapseTravels" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">



                        <!-- Postings -->
                        <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapseTraveltype" aria-expanded="false" aria-controls="collapseTraveltype">
                            <i class="fas fa-file-alt"></i> &nbsp; Travel Type
                        </a>
                        <div id="collapseTraveltype" class="collapse">
                            <a class="collapse-item side_content" href="add_travel.php "><i class="fas fa-plus-circle"></i> Add Travel Type</a>
                            <a class="collapse-item side_content" href="travel.php"><i class="fas fa-eye"></i> View Travel Type</a>
                        </div>


                        <!-- Job Categories -->
                        <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapseTravelservice" aria-expanded="false" aria-controls="collapseTravelservice">
                            <i class="fas fa-tags"></i> &nbsp; Travel Service
                        </a>
                        <div id="collapseTravelservice" class="collapse">
                            <a class="collapse-item side_content" href="add_travel_type.php"><i class="fas fa-plus-circle"></i> Add Travel Service</a>
                            <!-- <a class="collapse-item side_content" href="companies.php"><i class="fas fa-eye"></i> View Travel Service</a> -->
                        </div>





                    </div>
                </div>
                <a class="collapse-item side_content" href="#" data-toggle="collapse" data-target="#collapseProperties" aria-expanded="false" aria-controls="collapseProperties">
                    <i class="fas fa-home"></i> &nbsp; Properties
                </a>
                <div id="collapseProperties" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">



                        <!-- Postings -->
                        <a class="collapse-item collapsed side_content" href="#" data-toggle="collapse" data-target="#collapsePropertiestype" aria-expanded="false" aria-controls="collapsePropertiestype">
                            <i class="fas fa-file-alt"></i> &nbsp; Add properties
                        </a>
                        <div id="collapsePropertiestype" class="collapse">
                            <a class="collapse-item side_content" href="add_property_type.php "><i class="fas fa-plus-circle"></i> Add properties</a>
                            <a class="collapse-item side_content" href="properties.php"><i class="fas fa-eye"></i> View properties</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </li>







    <hr class="sidebar-divider">





    <div class="sidebar-heading">Services</div>
    <li class="nav-item">
        <a class="nav-link" href="add_service.php">
            <i class="fas fa-plus-circle"></i>
            <span>Add Service</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="view_services.php">
            <i class="fas fa-eye"></i>
            <span>View Services</span>
        </a>
    </li>






    <hr class="sidebar-divider">







    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>