<div class="d-flex flex-column flex-root" id="kt_app_root">

    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10 shadow-sm rounded-3">

                    <?= $this->session->flashdata('message') ?>

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                        action="<?= base_url('login/cek_login') ?>" method="POST">

                        <!-- image logo -->
                        <div class="text-center mb-10">
                            <img alt="Logo" src="https://i.ibb.co/nwKFY68/Screenshot-2023-07-31-at-00-32-55.png"
                                class="h-80px theme-light-show" />
                        </div>

                        <div class="text-center mb-11">
                            <!-- <h1 class="text-dark fw-bolder mb-3">
                                Masuk
                            </h1> -->

                            <div class="text-gray-500 fw-semibold fs-6">
                                Masuk ke aplikasi dengan email dan password
                            </div>
                        </div>

                        <div class="fv-row mb-8">
                            <input type="email" placeholder="Email" name="email" autocomplete="off"
                                class="form-control bg-transparent" required />
                        </div>

                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                class="form-control bg-transparent" required />
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">Sign In</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



</div>

<script>
    $(document).ready(function () {
        $('#kt_sign_in_submit').click(function () {
            var form = $('#kt_sign_in_form')[0]; // Get the form element

            if (!form.checkValidity()) {
                event.preventDefault(); // Prevent form submission if invalid
                form.reportValidity(); // Display default validation messages
            } else {
                // Form is valid, allow submission
                $(this).html('Loading...');
                $(this).attr('disabled', true);
                form.submit();
            }
        });
    });
</script>