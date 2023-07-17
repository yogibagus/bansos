<div class="app-wrapper  d-flex " id="kt_app_wrapper">



    <div class="app-container  container-fluid d-flex ">


        <div id="kt_app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true"
            style="border-top-left-radius: 0px;" data-kt-drawer-name="app-sidebar"
            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
            data-kt-drawer-width="auto" data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">



            <div id="kt_app_sidebar_menu" data-kt-menu="true" class="
                menu 
                menu-sub-indention 
                menu-rounded 
                menu-column 
                menu-active-bg 
                menu-title-gray-600 
                menu-icon-gray-400 
                menu-state-primary 
                menu-arrow-gray-500 
                fw-semibold 
                fs-6 
                py-4 
                py-lg-6 
                ms-lg-n7
                px-2 px-lg-0">

                <div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-y px-1 px-lg-5" data-kt-sticky="true"
                    data-kt-sticky-name="app-sidebar-menu-sticky" data-kt-sticky-offset="{default: false, xl: '500px'}"
                    data-kt-sticky-release="#kt_app_stats" data-kt-sticky-width="250px" data-kt-sticky-left="auto"
                    data-kt-sticky-top="100px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95"
                    data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}"
                    data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header, #kt_app_header"
                    data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="20px">

                    <div class="menu-item">
                        <a class="menu-link <?= ($this->uri->segment(2) == "dashboard_utama" ? 'active' : '') ?>"
                            href="<?= base_url('dashboard') ?>">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">📊
                                Dashboard
                            </span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link <?= ($this->uri->segment(2) == "data_user" ? 'active' : '') ?>"
                            href="<?= base_url('user/data_user') ?>">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">🙎🏻‍♂️
                                Data User
                            </span>
                        </a>
                    </div>

                    <div class="menu-item <?= ($this->uri->segment(1) == "bansos" ? 'active' : '') ?>">
                        <div class="menu-content "><span class="menu-section fs-5 fw-bolder ps-1 py-1">💿 Master
                            </span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link <?= ($this->uri->segment(2) == "data_master_bansos" ? 'active' : '') ?>"
                            href="<?= base_url('bansos/data_master_bansos') ?>">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">📑 Master Bansos</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link <?= ($this->uri->segment(2) == "proses" && $filter['status'] == 0 ? 'active' : '') ?>"
                            href="<?= base_url('bansos/all') ?>">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">🔖 Data Bansos</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <div class="menu-link"><span class="menu-section fs-5 fw-bolder ps-1 py-1">♻️ Penyaluran</span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link <?= ($this->uri->segment(2) == "data_master_penyaluran") ?>"
                            href="<?= base_url('penyaluran/data_master_penyaluran') ?>">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">🗂 Master Penyaluran</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <div class="menu-link"><span class="menu-section fs-5 fw-bolder ps-1 py-1">🧾 Laporan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">

                <!--begin::Toolbar-->
                <div id="kt_app_toolbar" class="app-toolbar  pt-7 pt-lg-10 ">

                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">



                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">

                                <?= '<i class="fa fa-home p-2" aria-hidden="true"></i> <a href="' . base_url() . '" class="text-dark">Home</a>&nbsp;/&nbsp;</span>' . ($this->uri->segment(1) ? '<a class="text-none text-' . ($this->uri->segment(2) ? 'dark' : 'dark') . '" href="' . site_url($this->uri->segment(1)) . '">' . str_replace(array("-", "_"), " ", $this->uri->segment(1)) . '</a>' : ''); ?>
                                <?= ($this->uri->segment(2) ? '<span class="ml-2 mr-2">&nbsp;/&nbsp;</span> <a class="text-none text-' . ($this->uri->segment(2) ? 'dark' : 'dark') . '" href="' . site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) . '">' . str_replace(array("-", "_"), " ", $this->uri->segment(2)) . '</a>' : ''); ?>
                                <?= ($this->uri->segment(3) == "Isi-Data" ? ($this->uri->segment(3) ? '<span class="ml-2 mr-2">/</span> <a class="text-none text-dark">' . str_replace(array("-", "_"), " ", $this->uri->segment(3)) . '</a>' : '') : '') ?>

                            </ul>
                            <!--end::Breadcrumb-->

                            <!--begin::Title-->
                            <!-- page-heading d-flex flex-column justify-content-center text-dark text-capitalize fw-bolder m-0 -->
                            <h1 class="page-heading text-dark text-capitalize fw-bolder m-0">
                                <?= ($this->uri->segment(2) ? '<span class="ml-2 mr-2"></span> <a class="text-none text-' . ($this->uri->segment(2) ? 'dark' : 'dark') . '" href="' . site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) . '">' . str_replace(array("-", "_"), " ", $this->uri->segment(2)) . '</a>' : ''); ?>
                                <?= (!empty($title) ? " - " . $title : "" ) ?>
                            </h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--end::Toolbar wrapper-->

                    <!-- Add User -->
                    <?php if ($this->uri->segment(2) == "data_user") { ?>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm btn-flex btn-icon btn-dark align-self-center px-3"
                            data-bs-toggle="modal" data-bs-target="#modalAddUser">
                            <i class="ki-outline ki-plus-square fs-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Tambah User"></i>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- Add berita acara -->
                    <?php if ($this->uri->segment(2) == "data_berita_acara") { ?>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm btn-flex btn-icon btn-dark align-self-center px-3"
                            data-bs-toggle="modal" data-bs-target="#modalAddBeritaAcara">
                            <i class="ki-outline ki-plus-square fs-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Tambah Berita Acara"></i>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- add master bansos -->
                    <?php if ($this->uri->segment(2) == "data_master_bansos") { ?>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm btn-flex btn-icon btn-dark align-self-center px-3"
                            data-bs-toggle="modal" data-bs-target="#modalAddMasterBansos">
                            <i class="ki-outline ki-plus-square fs-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Tambah Master Bansos"></i>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- add data bansos -->
                    <?php if ($this->uri->segment(2) == "all") { ?>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm btn-flex btn-icon btn-dark align-self-center px-3"
                            data-bs-toggle="modal" data-bs-target="#modalAddBansos" id="btnAddBansos">
                            <i class="ki-outline ki-plus-square fs-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Tambah Data Bansos"></i>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- add master penyaluran -->
                    <?php if ($this->uri->segment(2) == "data_master_penyaluran") { ?>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm btn-flex btn-icon btn-dark align-self-center px-3"
                            data-bs-toggle="modal" data-bs-target="#modalAddMasterPenyaluran">
                            <i class="ki-outline ki-plus-square fs-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Tambah Master Penyaluran"></i>
                        </a>
                    </div>
                    <?php } ?>

                    <!-- add data penyaluran -->
                    <?php if ($this->uri->segment(2) == "data_bansos") { ?>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-sm btn-flex btn-dark align-self-center px-3"
                            data-bs-toggle="modal" data-bs-target="#modalAddDataPenyaluran">
                            <i class="fa fa-plus fs-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Kirim Data Ke CO Magang"></i>
                                Tambah Data
                        </a>
                    </div>
                    <?php } ?>

                </div>
                <!--end::Toolbar-->

                <!-- Flash Data -->
                <?php if($this->session->flashdata('message')){echo "<br>" . $this->session->flashdata('message');} ?>

                <!--begin::Content-->
                <div id="kt_app_content" class="app-content  flex-column-fluid">