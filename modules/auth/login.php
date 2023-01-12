<?php
//Add backend
include_once("./inc/auth/login.php");

//Add Page header
include_once("./layouts/header/auth_header.php");
?>

            <!-- Content-->
            <div>

                <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">

                <?php if(isset($error)){ ?>
                   <div role="alert" class="mb-4">
                      <div class="border border-red-400 rounded bg-red-100 px-4 py-3 text-red-700">
                        <ul class="list-disc text-sm ml-4">
                              <?php foreach($error as $errormsg){
                                  echo "<li>$errormsg</li>"; } ?>
                        </ul>
                      </div>
                    </div>
                 <?php } ?>

                    <form method="post" class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
                        <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Login </h1>

                        <div>
                            <label class="mb-0"> Email Address </label>
                            <input type="email" name="email" placeholder="Info@example.com" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                        </div>
                        <div>
                            <label class="mb-0"> Password </label>
                            <input type="password" name="pass" placeholder="******" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-600 font-semibold p-2 mt-5 rounded-md text-center text-white w-full">
                                Login 
                            </button>
                            <input type="hidden" name="login_form" value="ok">
                        </div>
                    </form>

                </div>
            </div>

            <!-- Footer -->
<?php include_once("./layouts/footer/auth_footer.php"); ?>
