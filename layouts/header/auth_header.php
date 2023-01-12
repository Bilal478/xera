<!DOCTYPE html>
<html lang="en" class="bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="<?php echo $address_path; ?>assets/images/favicon.png" rel="icon" type="image/png">

    <!-- Basic Page Needs
        ================================================== -->
    <title>Socialite Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Socialite is - Professional A unique and beautiful collection of UI elements">

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="<?php echo $address_path; ?>assets/css/icons.css">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?php echo $address_path; ?>assets/css/uikit.css">
    <link rel="stylesheet" href="<?php echo $address_path; ?>assets/css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>
        input , .bootstrap-select.btn-group button{
            background-color: #f3f4f6  !important;
            height: 44px  !important;
            box-shadow: none  !important;
        }
    </style>
</head>
<body>

    <body class="bg-gray-100">


        <div id="wrapper" class="flex flex-col justify-between h-screen">

            <!-- header-->
            <div class="bg-white py-4 shadow dark:bg-gray-800">
                <div class="max-w-6xl mx-auto">


                    <div class="flex items-center lg:justify-between justify-around">

                        <a href="trending.html">
                            <img src="<?php echo $address_path; ?>assets/images/logo.png" alt="" class="w-32">
                        </a>

                        <div class="capitalize flex font-semibold hidden lg:block my-2 space-x-3 text-center text-sm">
                            <a href="<?php echo $address_path; ?>login" class="py-3 px-4">Login</a>
                            <a href="<?php echo $address_path; ?>signup" class="bg-purple-500 purple-500 px-6 py-3 rounded-md shadow text-white">Register</a>
                        </div>

                    </div>
                </div>
            </div>
