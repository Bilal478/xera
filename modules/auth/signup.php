<?php
include_once("./layouts/header/auth_header.php");
?>

            <!-- Content-->
            <div>
                <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
                    <form class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
                        <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Register </h1>

                        <div class="grid lg:grid-cols-2 gap-3">
                            <div>
                                <label class="mb-0"> First Name </label>
                                <input type="text" placeholder="Your Name" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                            </div>
                            <div>
                                <label class="mb-0"> Last  Name </label>
                                <input type="text" placeholder="Last  Name" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                            </div>
                        </div>
                        <div>
                            <label class="mb-0"> Username </label>
                            <input type="text" placeholder="Username" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                        </div>
                        <div>
                            <label class="mb-0"> Email Address </label>
                            <input type="email" placeholder="Info@example.com" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                        </div>
                        <div>
                            <label class="mb-0"> Password </label>
                            <input type="password" placeholder="******" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                        </div>
                        <div class="grid lg:grid-cols-2 gap-3">
                            <div>
                                <label class="mb-0"> Gender </label>
                                <select class="selectpicker mt-2">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>

                            </div>
                            <div>
                                <label class="mb-0"> Phone: optional  </label>
                                <input type="text" placeholder="+543 5445 0543" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                            </div>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="chekcbox1" checked="">
                            <label for="chekcbox1"><span class="checkbox-icon"></span> I agree to the <a href="pages-terms.html" target="_blank" class="uk-text-bold uk-text-small uk-link-reset"> Terms and Conditions </a>
                            </label>
                        </div>

                        <div>
                            <button type="button" class="bg-blue-600 font-semibold p-2 mt-5 rounded-md text-center text-white w-full">
                                Get Started</button>
                        </div>
                    </form>


                </div>
            </div>

            <!-- Footer -->
<?php include_once("./layouts/footer/auth_footer.php"); ?>
