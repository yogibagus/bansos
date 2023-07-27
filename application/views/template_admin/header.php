    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">


            <!--begin::Header-->
            <div id="kt_app_header" class="app-header shadow-sm" data-kt-sticky="true"
                data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
                data-kt-sticky-offset="{default: false, lg: '300px'}" style="z-index: 10;">

                <!--begin::Header container-->
                <div class="app-container  container-fluid d-flex align-items-stretch justify-content-between "
                    id="kt_app_header_container">
                    <!--begin::Header logo-->
                    <div class="app-header-logo d-flex align-items-center me-lg-9">
                        <!--begin::Mobile toggle-->
                        <div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px ms-n2 me-2 d-flex d-lg-none"
                            id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-outline ki-abstract-14 fs-1"></i> </div>
                        <!--end::Mobile toggle-->

                        <!--begin::Logo image-->
                        <a href="<?= base_url() ?>index.html">
                            <img alt="Logo" src="<?= base_url() ?>assets/media/logos/demo44.svg"
                                class="h-25px theme-light-show" />
                            <img alt="Logo" src="<?= base_url() ?>assets/media/logos/demo44-dark.svg"
                                class="h-25px theme-dark-show" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Header logo-->

                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">

                        <!--begin::Menu wrapper-->
                        <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
                            <!-- CODE HERE -->
                        </div>
                        <!--end::Menu wrapper-->

                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">

                            <!--begin::User menu-->
                            <div class="app-navbar-item ms-1 ms-lg-4" id="kt_header_user_menu_toggle">

                                <!--begin::Notifications-->
                                <div class="app-navbar-item ms-1 ms-lg-4">
                                    <!--begin::Menu- wrapper-->
                                    <div class="btn btn-icon btn-light-dark position-relative me-5"
                                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-primary">
                                            <?php $total=0;foreach ($notif as $n) :
                                                if ($n->is_read == 0) {
                                                    $total = $total + 1;
                                                }
                                            endforeach;
                                            echo $total;
                                            ?>
                                        </span>
                                    </div>

                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px"
                                        data-kt-menu="true" id="kt_menu_notifications">
                                        <!-- begin::Heading-->
                      
                                        <!--end::Heading -->

                                        <!--begin::Tab content-->
                                        <div class="tab-content">
                                            <!--begin::Tab panel-->
                                            <div class="tab-pane fade show active" id="kt_topbar_notifications_1"
                                                role="tabpanel">
                                                <!--begin::Items-->
                                                <div class="scroll-y mh-325px p-3">
                                                    <!--begin::Item-->
                                                    <?php foreach ($notif as $n) : ?>
                                                    <div
                                                        class="card text-left p-3 mb-3 <?php if ($n->is_read == 0) { echo 'bg-light-primary';} ?>">
                                                        <div class="align-items-center">
                                                            <div class="mb-0 me-2">
                                                                <a href="<?= base_url() ?>notification/read/<?= $n->id ?>"
                                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">
                                                                    <?= $n->judul ?>
                                                                </a>
                                                                <div class="text-gray-600 fs-7"><?= $n->pesan ?></div>
                                                            </div>
                                                            <span
                                                                class="badge badge-light-primary"><?php echo date('d M Y h:i', strtotime($n->created_at)); ?></span>
                                                            <span
                                                                class="badge badge-light-info text-uppercase"><?= $n->jenis ?></span>
                                                            <?php if ($n->is_read == 0) : ?>
                                                            <span class="badge badge-danger float-end">NEW!</span><br>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <!--end::Item-->

                                                    <!-- data empty -->
                                                    <?php if (empty($notif)) { ?>
                                                    <div class="card text-left p-3 mb-3">
                                                        <div class="align-items-center">
                                                            <div class="mb-0 me-2">
                                                                <a href="#"
                                                                    class="fs-6 text-gray-800 text-hover-primary fw-bold">
                                                                    Tidak ada notifikasi
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <!--end::Items-->

                                                <!--begin::View more-->
                                                <!-- <div class="py-3 text-center border-top">
                                                    <a href="/metronic8/demo44/../demo44/pages/user-profile/activity.html"
                                                        class="btn btn-color-gray-600 btn-active-color-primary">
                                                        View All
                                                        <i class="ki-outline ki-arrow-right fs-5"></i> </a>
                                                </div> -->
                                                <!--end::View more-->
                                            </div>
                                            <!--end::Tab panel-->
                                        </div>
                                        <!--end::Tab content-->
                                    </div>
                                    <!--end::Menu-->
                                    <!--end::Menu wrapper-->
                                </div>
                                <!--end::Notifications-->

                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px px-4 me-2"
                                    style="padding-left: 0rem !important;"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <img class="symbol symbol-35px symbol-md-40px"
                                        src="<?= base_url() ?>assets/media/avatars/300-5.jpg" alt="user" />
                                </div>

                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5 text-capitalize">
                                        <!-- get nama from session -->
                                        <?= $this->session->userdata('nama'); ?>
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                            Super Admin
                                        </span>
                                    </div>

                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                        <?= $this->session->userdata('email'); ?> </a>
                                </div>

                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="<?= base_url() ?>assets/media/avatars/300-5.jpg" />
                                            </div>
                                            <!--end::Avatar-->

                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5 text-capitalize">
                                                    <!-- get nama from session -->
                                                    <?= $this->session->userdata('nama'); ?>
                                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                                        Super Admin
                                                    </span>
                                                </div>

                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                                    <?= $this->session->userdata('email'); ?> </a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="<?= base_url() ?>dashboard/profile" class="menu-link px-5">
                                            My Profile
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="<?= base_url() ?>login/logout" id="btnLogout" class="menu-link px-5">
                                            Sign Out
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->

            <!-- jquery script to remocve all local storage -->
            <script>
                $(document).ready(function () {
                    $('#btnLogout').click(function () {
                        localStorage.clear();
                        console.log('localStorage cleared')
                    });
                });
            </script>