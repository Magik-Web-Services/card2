<?php
session_start();
session_destroy();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Card</title>
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('db/connection.php');

        // Images
        $CompanyImg = isset($_POST["images"]["Company"]) ? json_encode($_POST["images"]["Company"]) : "-";
        $ProfileImg = isset($_POST["images"]["Profile"]) ? json_encode($_POST["images"]["Profile"]) : "-";
        $CoverImg = isset($_POST["images"]["Cover"]) ? json_encode($_POST["images"]["Cover"]) : "-";
        // Profile
        $Profile = isset($_POST["profile"]) ? json_encode($_POST["profile"]) : "-";
        // Social
        $Socail = isset($_POST["socail"]) ? json_encode($_POST["socail"]) : "-";


        // account
        $userName = $_POST["account"]["userName"];
        $password = $_POST["account"]["password"];
        $email = $_POST["account"]["email"];
        $country = $_POST["account"]["country"];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Check whether this username exists
        $existSql = "SELECT * FROM `card2_user` WHERE email = '$email' OR userName = '$userName'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);

        $date = date("ymhis");
        $rand = rand(0, $date);

        if ($numExistRows > 0) {
            mysqli_query($conn, "INSERT INTO `card2_data`(`user_email`, `rand_str`, `companyImg`, `profileImg`, `coverImg`, `profile`, `social`) VALUES ('$email','$rand','$CompanyImg','$ProfileImg','$CoverImg','$Profile','$Socail')");
        } else {
            mysqli_query($conn, "INSERT INTO `card2_user`(`userName`, `password`, `email`, `country`, `role`) VALUES ('$userName','$hash','$email','$country','user')");
            mysqli_query($conn, "INSERT INTO `card2_data`(`user_email`, `rand_str`,`companyImg`, `profileImg`, `coverImg`, `profile`, `social`) VALUES ('$email','$rand','$CompanyImg','$ProfileImg','$CoverImg','$Profile','$Socail')");
        }
    }
    ?>
    <form method="POST">
        <section class="d-flex">
            <div class="left">
                <div class="card" id="image-cropper-result">
                    <img src="images/cover.svg" class="card-img-top" id="company-img" alt="bg-img">
                    <div class="card-body pt-5 ps-4">
                        <!-- profile -->
                        <div class="card_profile mb-5">
                            <img class="img" id="profile-img" alt="Profile" src="images/profile.svg">
                            <img class="img2" id="cover-img" alt="park realty" src="images/logo.png">
                        </div>
                        <!--  -->
                        <div class="field_card_none card_border profile_con modal_open" data-box="Name" data-con="Name" data-id="name_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                            <h5 class="card-title fs-2">
                                <span class="field_card" data-Tfield="Name" data-text1="prefix"></span>
                                <span class="field_card" data-Tfield="Name" data-text1="firstname"></span>
                                <span class="extra_text d-none" data-extra="preferredname" id="extra_preferredname">
                                    "<span class="field_card" data-Tfield="Name" data-text1="preferredname"></span>"
                                </span>
                                <span class="field_card" data-Tfield="Name" data-text1="middlename"></span>
                                <span class="field_card" data-Tfield="Name" data-text1="lastname"></span>
                                <span class="field_card" data-Tfield="Name" data-text1="suffix"></span>
                                <span class="extra_text d-none" data-extra="maidenname" id="extra_maidenname">
                                    (<span class="field_card" data-text1="maidenname"></span>)
                                </span>
                                <span class="extra_text d-none fs-6" style="color: #6f7a80;" data-extra="pronouns" id="extra_pronouns">
                                    (<span class="field_card" data-Tfield="Name" data-text1="pronouns"></span>)
                                </span>
                            </h5>
                            <i class="card_edit fa-solid fa-pen-to-square"></i>
                        </div>
                        <!--  -->
                        <div class="field_card_none card_border profile_con modal_open" data-box="jobTitle" data-con="jobTitle" data-id="job_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                            <h6 class="card-title fs-4"><span class="field_card" data-Tfield="jobTitle" data-text1="j_title"></span>
                            </h6>
                            <i class="card_edit fa-solid fa-pen-to-square"></i>
                        </div>
                        <!--  -->
                        <div class="field_card_none card_border profile_con modal_open" data-box="Department" data-con="Department" data-id="deparment_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                            <h6 class="card-title fs-4"><span class="field_card" data-Tfield="Department" data-text1="department"></span>
                            </h6>
                            <i class="card_edit fa-solid fa-pen-to-square"></i>
                        </div>
                        <!--  -->
                        <div class="field_card_none card_border profile_con modal_open" data-box="companyName" data-con="companyName" data-id="company_name_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                            <h6 class="card-title fs-4"><span class="field_card" data-Tfield="companyName" data-text1="company"></span>
                            </h6>
                            <i class="card_edit fa-solid fa-pen-to-square"></i>
                        </div>
                        <!--  -->
                        <div class="field_card_none card_border profile_con modal_open" data-box="Accreditations" data-con="Accreditations" data-id="accred_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                            <ul class="card-title card_accreditations">
                                <li class="field_card" data-label="Accreditations" data-Tfield="Accreditations" data-text1="accreditations"></li>
                            </ul>
                            <i class="card_edit fa-solid fa-pen-to-square"></i>
                        </div>
                        <!--  -->
                        <div class="field_card_none card_border profile_con modal_open" data-box="Headline" data-con="Headline" data-id="headline_field" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#fildetail">
                            <h6 style="width: 80%;" class="field_card card-title fs-6" data-Tfield="Headline" data-text1="headline"></h6>
                        </div>
                        <!--  -->
                        <div class="card-text social_medias d-flex flex-column pt-3" id="sm_con">
                        </div>
                        <div id="ps_con">

                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <!-- top -->
                <div class="right_top">
                    <!-- one -->
                    <div data-step="1" class="next next_icon1 right_top_base right_top_one right_top_box d-flex flex-column align-items-center justify-content-center">
                        <div class="right_top_icon d-flex justify-content-center align-items-center">1</div>
                        <div class="right_top_para">Customize your card</div>
                    </div>
                    <!-- two -->
                    <div data-step="2" class="next_icon2 right_top_base d-flex flex-column align-items-center justify-content-center">
                        <div class="right_top_icon d-flex justify-content-center align-items-center">2</div>
                        <div class="right_top_para">Create an account</div>
                    </div>
                    <!-- three -->
                    <div class="right_top_base right_top_three d-flex flex-column align-items-center justify-content-center">
                        <div class="right_top_icon d-flex justify-content-center align-items-center">3</div>
                        <div class="right_top_para">Generate card</div>
                    </div>
                </div>
                <!-- Details -->
                <div class="step1 comman active1">
                    <!-- right_heading -->
                    <div class="right_heading">
                        <h1>Create your first card</h1>
                        <p>Ready to design your card? Pick a field below to get started!</p>
                    </div>
                    <!-- Images container -->
                    <div class="right_images_container">
                        <h3>Add images</h3>
                        <h4>Change Layout</h4>
                    </div>
                    <!-- right_images_box_container -->

                    <div class="right_images_box_container">
                        <div class="image_box">
                            <div class="image_box_inner">
                                <i class=" img-text fa-solid fa-plus fa-xs" style="color: #9c9fa3;"></i>
                                <div class="img-text">Company Logo</div>

                                <div class="img-logo1">
                                    <img id="uploadlogo" class="img-con" src="" height="148" alt="your image" class="float-end" />
                                    <input type="file" name="logo" class="form-control roundcorner img-upload" onchange="readURL(this);">
                                </div>
                            </div>
                        </div>
                        <div class="image_box">
                            <div class="image_box_inner">
                                <i class="fa-solid fa-plus fa-xs" style="color: #9c9fa3;"></i>
                                <div>Profile Picture</div>

                                <div class="img-logo1">
                                    <img id="uploadlogo2" class="img-con2" src="" height="148" alt="your image" class="float-end" />
                                    <input type="file" name="logo" class="form-control roundcorner img-upload" onchange="readURL2(this);">
                                </div>
                            </div>
                        </div>
                        <div class="image_box">
                            <div class="image_box_inner">
                                <i class="fa-solid fa-plus fa-xs" style="color: #9c9fa3;"></i>
                                <div>Cover Photo</div>

                                <div class="img-logo1">
                                    <img id="uploadlogo3" class="img-con3" src="" height="148" alt="your image" class="float-end" />
                                    <input type="file" name="logo" class="form-control roundcorner img-upload" onchange="readURL3(this);">
                                </div>
                            </div>
                        </div>
                        <div id="img_con">
                            <input type="hidden" class="imgHidden" id="Hcompanyimg">
                            <input type="hidden" class="imgHidden" id="HProfileimg">
                            <input type="hidden" class="imgHidden" id="Hcoverimg">
                        </div>
                    </div>
                    <!-- Add_details -->
                    <div class="Add_details">
                        <h3>Add your details</h3>
                        <!-- Personal -->


                        <div class="details_personal">
                            <h4>Personal</h4>
                            <div class="flex_wrap">
                                <div class="flex_item profile_con modal_open" data-box1="Name" data-box="Name" data-id="name_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                                    </svg>
                                    <div class="item_title">Name</div>
                                </div>
                                <div class="flex_item profile_con modal_open" data-box="jobTitle" data-box1="jobTitle" data-id="job_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M370.7 96.1C346.1 39.5 289.7 0 224 0S101.9 39.5 77.3 96.1C60.9 97.5 48 111.2 48 128v64c0 16.8 12.9 30.5 29.3 31.9C101.9 280.5 158.3 320 224 320s122.1-39.5 146.7-96.1c16.4-1.4 29.3-15.1 29.3-31.9V128c0-16.8-12.9-30.5-29.3-31.9zM336 144v16c0 53-43 96-96 96H208c-53 0-96-43-96-96V144c0-26.5 21.5-48 48-48H288c26.5 0 48 21.5 48 48zM189.3 162.7l-6-21.2c-.9-3.3-3.9-5.5-7.3-5.5s-6.4 2.2-7.3 5.5l-6 21.2-21.2 6c-3.3 .9-5.5 3.9-5.5 7.3s2.2 6.4 5.5 7.3l21.2 6 6 21.2c.9 3.3 3.9 5.5 7.3 5.5s6.4-2.2 7.3-5.5l6-21.2 21.2-6c3.3-.9 5.5-3.9 5.5-7.3s-2.2-6.4-5.5-7.3l-21.2-6zM112.7 316.5C46.7 342.6 0 407 0 482.3C0 498.7 13.3 512 29.7 512H128V448c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64l98.3 0c16.4 0 29.7-13.3 29.7-29.7c0-75.3-46.7-139.7-112.7-165.8C303.9 338.8 265.5 352 224 352s-79.9-13.2-111.3-35.5zM176 448c-8.8 0-16 7.2-16 16v48h32V464c0-8.8-7.2-16-16-16zm96 32a16 16 0 1 0 0-32 16 16 0 1 0 0 32z" />
                                    </svg>
                                    <div class="item_title">Job title
                                    </div>
                                </div>
                                <div class="flex_item profile_con modal_open" data-box="Department" data-box1="Department" data-id="deparment_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                                        <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                                    </svg>
                                    <div class="item_title">Department</div>
                                </div>
                                <div class="flex_item profile_con modal_open" data-box="companyName" data-box1="companyName" data-id="company_name_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M48 0C21.5 0 0 21.5 0 48V464c0 26.5 21.5 48 48 48h96V432c0-26.5 21.5-48 48-48s48 21.5 48 48v80h96c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H48zM64 240c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V240zm112-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V240c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V240zM80 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V112zM272 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16z" />
                                    </svg>
                                    <div class="item_title">Company name</div>
                                </div>
                                <div class="flex_item profile_con modal_open" data-box="Accreditations" data-box1="Accreditations" data-id="accred_field" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="file-certificate" class="svg-inline--fa fa-file-certificate " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M448 464H224v32c0 5.5-1 10.9-2.7 16H448c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L402.7 18.7C390.7 6.7 374.5 0 357.5 0H192c-35.3 0-64 28.7-64 64v71.1l.1-.1c1.5-.7 4-2 6.6-3c13.6-5.5 28.3-5.4 41.3-.5V64c0-8.8 7.2-16 16-16H352v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16zM109.2 161.6c-10-4.1-21.5-1-28.1 7.5L70.6 182.6c-1.3 1.7-3.2 2.7-5.2 3l-16.9 2.3c-10.7 1.5-19.1 9.9-20.5 20.5l-2.3 16.9c-.3 2.1-1.4 4-3 5.2L9.1 241.1c-8.5 6.6-11.6 18.1-7.5 28.1L8 285c.8 1.9 .8 4.1 0 6.1L1.6 306.8c-4.1 10-1 21.5 7.5 28.1l13.5 10.5c1.7 1.3 2.7 3.2 3 5.2l2.3 16.9c1.5 10.7 9.9 19.1 20.5 20.6L64 390.2V496c0 5.9 3.2 11.3 8.5 14.1s11.5 2.5 16.4-.8L128 483.2l39.1 26.1c4.9 3.3 11.2 3.6 16.4 .8s8.5-8.2 8.5-14.1V390.2l15.5-2.1c10.7-1.5 19.1-9.9 20.5-20.6l2.3-16.9c.3-2.1 1.4-4 3-5.2l13.5-10.5c8.5-6.6 11.6-18.1 7.5-28.1L248 291c-.8-1.9-.8-4.1 0-6.1l6.5-15.8c4.1-10 1-21.5-7.5-28.1l-13.5-10.5c-1.7-1.3-2.7-3.2-3-5.2l-2.3-16.9c-1.5-10.7-9.9-19.1-20.5-20.5l-16.9-2.3c-2.1-.3-4-1.4-5.2-3l-10.5-13.5c-6.6-8.5-18.1-11.6-28.1-7.5L131 168c-1.9 .8-4.1 .8-6.1 0l-15.8-6.5zM64 288a64 64 0 1 1 128 0A64 64 0 1 1 64 288z">
                                        </path>
                                    </svg>
                                    <div class="item_title">Accreditations</div>
                                </div>
                                <div class="flex_item profile_con modal_open" data-box="Headline" data-box1="Headline" data-id="headline_field" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M320 256l0 192c0 17.7 14.3 32 32 32s32-14.3 32-32l0-224V64c0-17.7-14.3-32-32-32s-32 14.3-32 32V192L64 192 64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-192 256 0z" />
                                    </svg>
                                    <div class="item_title">Headline</div>
                                </div>
                            </div>
                        </div>
                        <div class="details_personal">
                            <h4>General</h4>
                            <div class="flex_wrap">
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Email" data-box="Email" data-id="email_field" data-val1="email" data-val2="e_option" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                    </svg>
                                    <div class="item_title">Email</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Phone" data-box="Phone" data-id="phone_field" data-val1="phone" data-val2="ph_option" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                    </svg>
                                    <div class="item_title">Phone</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="companyUrl" data-box="companyUrl" data-id="company_field" data-val1="c_url" data-val2="c_url_option" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM96 96H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                                    </svg>
                                    <div class="item_title">Company URL</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Link" data-box="Link" data-id="link_field" data-val1="link" data-val2="link_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                                        <path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z" />
                                    </svg>
                                    <div class="item_title">Link</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Address" data-box="Address" data-id="address_field" data-val1="address" data-val2="address_option" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                    </svg>
                                    <div class="item_title">Address</div>
                                </div>
                            </div>
                        </div>
                        <div class="details_personal">
                            <h4>Social</h4>
                            <div class="flex_wrap">
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Twitter" data-box="Twitter" data-id="twitter_field" data-val1="twitter" data-val2="twitter_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                                    </svg>
                                    <div class="item_title">Twitter</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Instagram" data-box="Instagram" data-id="instagram_field" data-val1="instagram" data-val2="instagram_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                    </svg>
                                    <div class="item_title">Instagram</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="LinkedIn" data-box="LinkedIn" data-id="linkedIn_field" data-val1="linkedIn" data-val2="linkedIn_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" />
                                    </svg>
                                    <div class="item_title">LinkedIn</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Facebook" data-box="Facebook" data-id="facebook_field" data-val1="facebook" data-val2="facebook_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                    </svg>
                                    <div class="item_title">Facebook</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="YouTube" data-box="YouTube" data-id="youTube_field" data-val1="youTube" data-val2="youTube_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                        <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
                                    </svg>
                                    <div class="item_title">YouTube</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Snapchat" data-box="Snapchat" data-id="snapchat_field" data-val1="snapchat" data-val2="snapchat_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M496.926,366.6c-3.373-9.176-9.8-14.086-17.112-18.153-1.376-.806-2.641-1.451-3.72-1.947-2.182-1.128-4.414-2.22-6.634-3.373-22.8-12.09-40.609-27.341-52.959-45.42a102.889,102.889,0,0,1-9.089-16.12c-1.054-3.013-1-4.724-.248-6.287a10.221,10.221,0,0,1,2.914-3.038c3.918-2.591,7.96-5.22,10.7-6.993,4.885-3.162,8.754-5.667,11.246-7.44,9.362-6.547,15.909-13.5,20-21.278a42.371,42.371,0,0,0,2.1-35.191c-6.2-16.318-21.613-26.449-40.287-26.449a55.543,55.543,0,0,0-11.718,1.24c-1.029.224-2.059.459-3.063.72.174-11.16-.074-22.94-1.066-34.534-3.522-40.758-17.794-62.123-32.674-79.16A130.167,130.167,0,0,0,332.1,36.443C309.515,23.547,283.91,17,256,17S202.6,23.547,180,36.443a129.735,129.735,0,0,0-33.281,26.783c-14.88,17.038-29.152,38.44-32.673,79.161-.992,11.594-1.24,23.435-1.079,34.533-1-.26-2.021-.5-3.051-.719a55.461,55.461,0,0,0-11.717-1.24c-18.687,0-34.125,10.131-40.3,26.449a42.423,42.423,0,0,0,2.046,35.228c4.105,7.774,10.652,14.731,20.014,21.278,2.48,1.736,6.361,4.24,11.246,7.44,2.641,1.711,6.5,4.216,10.28,6.72a11.054,11.054,0,0,1,3.3,3.311c.794,1.624.818,3.373-.36,6.6a102.02,102.02,0,0,1-8.94,15.785c-12.077,17.669-29.363,32.648-51.434,44.639C32.355,348.608,20.2,352.75,15.069,366.7c-3.868,10.528-1.339,22.506,8.494,32.6a49.137,49.137,0,0,0,12.4,9.387,134.337,134.337,0,0,0,30.342,12.139,20.024,20.024,0,0,1,6.126,2.741c3.583,3.137,3.075,7.861,7.849,14.78a34.468,34.468,0,0,0,8.977,9.127c10.019,6.919,21.278,7.353,33.207,7.811,10.776.41,22.989.881,36.939,5.481,5.778,1.91,11.78,5.605,18.736,9.92C194.842,480.951,217.707,495,255.973,495s61.292-14.123,78.118-24.428c6.907-4.24,12.872-7.9,18.489-9.758,13.949-4.613,26.163-5.072,36.939-5.481,11.928-.459,23.187-.893,33.206-7.812a34.584,34.584,0,0,0,10.218-11.16c3.434-5.84,3.348-9.919,6.572-12.771a18.971,18.971,0,0,1,5.753-2.629A134.893,134.893,0,0,0,476.02,408.71a48.344,48.344,0,0,0,13.019-10.193l.124-.149C498.389,388.5,500.708,376.867,496.926,366.6Zm-34.013,18.277c-20.745,11.458-34.533,10.23-45.259,17.137-9.114,5.865-3.72,18.513-10.342,23.076-8.134,5.617-32.177-.4-63.239,9.858-25.618,8.469-41.961,32.822-88.038,32.822s-62.036-24.3-88.076-32.884c-31-10.255-55.092-4.241-63.239-9.858-6.609-4.563-1.24-17.211-10.341-23.076-10.739-6.907-24.527-5.679-45.26-17.075-13.206-7.291-5.716-11.8-1.314-13.937,75.143-36.381,87.133-92.552,87.666-96.719.645-5.046,1.364-9.014-4.191-14.148-5.369-4.96-29.189-19.7-35.8-24.316-10.937-7.638-15.748-15.264-12.2-24.638,2.48-6.485,8.531-8.928,14.879-8.928a27.643,27.643,0,0,1,5.965.67c12,2.6,23.659,8.617,30.392,10.242a10.749,10.749,0,0,0,2.48.335c3.6,0,4.86-1.811,4.612-5.927-.768-13.132-2.628-38.725-.558-62.644,2.84-32.909,13.442-49.215,26.04-63.636,6.051-6.932,34.484-36.976,88.857-36.976s82.88,29.92,88.931,36.827c12.611,14.421,23.225,30.727,26.04,63.636,2.071,23.919.285,49.525-.558,62.644-.285,4.327,1.017,5.927,4.613,5.927a10.648,10.648,0,0,0,2.48-.335c6.745-1.624,18.4-7.638,30.4-10.242a27.641,27.641,0,0,1,5.964-.67c6.386,0,12.4,2.48,14.88,8.928,3.546,9.374-1.24,17-12.189,24.639-6.609,4.612-30.429,19.343-35.8,24.315-5.568,5.134-4.836,9.1-4.191,14.149.533,4.228,12.511,60.4,87.666,96.718C468.629,373.011,476.119,377.524,462.913,384.877Z" />
                                    </svg>
                                    <div class="item_title">Snapchat</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="TikTok" data-box="TikTok" data-id="tikTok_field" data-val1="tikTok" data-val2="tikTok_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                                    </svg>
                                    <div class="item_title">TikTok</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Twitch" data-box="Twitch" data-id="twitch_field" data-val1="twitch" data-val2="twitch_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z" />
                                    </svg>
                                    <div class="item_title">Twitch</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Yelp" data-box="Yelp" data-id="yelp_field" data-val1="yelp" data-val2="yelp_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M42.9 240.32l99.62 48.61c19.2 9.4 16.2 37.51-4.5 42.71L30.5 358.45a22.79 22.79 0 0 1-28.21-19.6 197.16 197.16 0 0 1 9-85.32 22.8 22.8 0 0 1 31.61-13.21zm44 239.25a199.45 199.45 0 0 0 79.42 32.11A22.78 22.78 0 0 0 192.94 490l3.9-110.82c.7-21.3-25.5-31.91-39.81-16.1l-74.21 82.4a22.82 22.82 0 0 0 4.09 34.09zm145.34-109.92l58.81 94a22.93 22.93 0 0 0 34 5.5 198.36 198.36 0 0 0 52.71-67.61A23 23 0 0 0 364.17 370l-105.42-34.26c-20.31-6.5-37.81 15.8-26.51 33.91zm148.33-132.23a197.44 197.44 0 0 0-50.41-69.31 22.85 22.85 0 0 0-34 4.4l-62 91.92c-11.9 17.7 4.7 40.61 25.2 34.71L366 268.63a23 23 0 0 0 14.61-31.21zM62.11 30.18a22.86 22.86 0 0 0-9.9 32l104.12 180.44c11.7 20.2 42.61 11.9 42.61-11.4V22.88a22.67 22.67 0 0 0-24.5-22.8 320.37 320.37 0 0 0-112.33 30.1z" />
                                    </svg>
                                    <div class="item_title">Yelp</div>
                                </div>
                            </div>
                        </div>
                        <div class="details_personal">
                            <h4>Messaging</h4>
                            <div class="flex_wrap">
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="WhatsApp" data-box="WhatsApp" data-id="whatsApp_field" data-val1="whatsApp" data-val2="whatsApp_title" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
                                    <div class="item_title">WhatsApp</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Signal" data-box="Signal" data-id="signal_field" data-val1="signal" data-val2="signal_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg aria-hidden="true" focusable="false" data-icon="signal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M194.351 7.794l5.606 23.182c-22.418 5.595-44.035 14.389-64.05 26.38l-12.41-20.385c22.017-13.19 46.035-23.182 70.854-29.177zm123.298 0l-5.606 23.182c22.418 5.595 44.036 14.389 64.051 26.38l12.41-20.385c-22.018-13.19-46.037-23.182-70.855-29.177zm-281.02 115.91c-13.21 21.982-23.219 45.964-29.223 70.744l23.218 5.596c5.604-22.383 14.411-43.966 26.42-63.95l-20.415-12.39zM23.819 256c0-11.59.8-23.182 2.802-34.772L3.002 217.63C-1 243.21-1 268.79 3.002 294.37l23.619-3.598c-2.002-11.59-2.802-23.182-2.802-34.772zm364.685 219.03l-12.41-20.385c-20.015 11.99-41.633 21.183-64.451 26.78l5.605 23.181c25.22-6.396 49.238-16.387 71.256-29.576zM488.18 256c0 11.59-.8 23.182-2.801 34.772l23.618 3.598c4.003-25.58 4.003-51.16 0-76.74l-23.618 3.598c2 11.59 2.8 23.182 2.8 34.772zm16.414 61.552l-23.218-5.596c-5.606 22.782-14.412 44.366-26.421 64.35l20.415 12.391c13.212-22.384 23.218-46.364 29.224-71.145zm-213.768 167.87c-23.218 3.597-46.436 3.597-69.654 0l-3.603 23.58c25.62 3.997 51.24 3.997 76.86 0l-3.603-23.58zm152.12-91.93c-14.012 18.786-30.425 35.173-49.24 49.162l14.412 19.185c20.816-15.187 38.83-33.574 54.443-53.957l-19.616-14.39zm-49.24-324.146c18.815 13.989 35.228 30.376 49.24 49.161l19.215-14.388c-15.213-20.784-33.627-38.77-54.043-53.958l-14.412 19.185zM69.054 118.507c14.011-18.785 30.424-35.172 49.238-49.161l-14.41-19.185C83.064 65.349 65.05 83.735 49.838 104.119l19.215 14.388zm406.317 5.196l-20.415 12.39c12.009 19.985 21.215 41.568 26.82 64.351l23.22-5.596c-6.407-25.18-16.413-49.162-29.625-71.145zM221.173 26.58c23.218-3.597 46.436-3.597 69.654 0l3.603-23.581C268.81-1 243.19-1 217.57 2.998l3.603 23.581zM81.463 468.233l-49.638 11.593 11.609-49.562-23.618-5.596-11.61 49.562c-3.202 12.79 4.804 25.979 18.014 28.778 3.603.798 7.206.798 10.809 0l49.639-11.192-5.204-23.583zM25.02 403.484l23.218 5.596 8.006-34.372c-11.61-19.585-20.416-40.768-26.02-62.752l-23.219 5.596c5.205 21.183 13.21 41.567 23.619 60.752l-5.604 25.18zm112.087 51.96l-34.427 7.994 5.605 23.182 25.22-5.996c19.214 10.392 39.63 18.386 60.846 23.582l5.606-23.182c-22.018-5.196-43.235-13.989-62.85-25.58zM256 48.163C141.11 48.162 47.837 141.29 47.837 256c0 39.17 11.21 77.54 32.025 110.313l-20.015 85.535 85.266-19.985c97.277 61.151 225.776 31.975 287.024-65.15 61.249-97.124 32.025-225.423-65.251-286.576C333.66 59.354 295.23 48.162 256 48.162z">
                                        </path>
                                    </svg>
                                    <div class="item_title">Signal</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Discord" data-box="Discord" data-id="discord_field" data-val1="discord" data-val2="discord_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                                        <path d="M524.531,69.836a1.5,1.5,0,0,0-.764-.7A485.065,485.065,0,0,0,404.081,32.03a1.816,1.816,0,0,0-1.923.91,337.461,337.461,0,0,0-14.9,30.6,447.848,447.848,0,0,0-134.426,0,309.541,309.541,0,0,0-15.135-30.6,1.89,1.89,0,0,0-1.924-.91A483.689,483.689,0,0,0,116.085,69.137a1.712,1.712,0,0,0-.788.676C39.068,183.651,18.186,294.69,28.43,404.354a2.016,2.016,0,0,0,.765,1.375A487.666,487.666,0,0,0,176.02,479.918a1.9,1.9,0,0,0,2.063-.676A348.2,348.2,0,0,0,208.12,430.4a1.86,1.86,0,0,0-1.019-2.588,321.173,321.173,0,0,1-45.868-21.853,1.885,1.885,0,0,1-.185-3.126c3.082-2.309,6.166-4.711,9.109-7.137a1.819,1.819,0,0,1,1.9-.256c96.229,43.917,200.41,43.917,295.5,0a1.812,1.812,0,0,1,1.924.233c2.944,2.426,6.027,4.851,9.132,7.16a1.884,1.884,0,0,1-.162,3.126,301.407,301.407,0,0,1-45.89,21.83,1.875,1.875,0,0,0-1,2.611,391.055,391.055,0,0,0,30.014,48.815,1.864,1.864,0,0,0,2.063.7A486.048,486.048,0,0,0,610.7,405.729a1.882,1.882,0,0,0,.765-1.352C623.729,277.594,590.933,167.465,524.531,69.836ZM222.491,337.58c-28.972,0-52.844-26.587-52.844-59.239S193.056,219.1,222.491,219.1c29.665,0,53.306,26.82,52.843,59.239C275.334,310.993,251.924,337.58,222.491,337.58Zm195.38,0c-28.971,0-52.843-26.587-52.843-59.239S388.437,219.1,417.871,219.1c29.667,0,53.307,26.82,52.844,59.239C470.715,310.993,447.538,337.58,417.871,337.58Z" />
                                    </svg>
                                    <div class="item_title">Discord</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Skype" data-box="Skype" data-id="skype_field" data-val1="skype" data-val2="skype_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M424.7 299.8c2.9-14 4.7-28.9 4.7-43.8 0-113.5-91.9-205.3-205.3-205.3-14.9 0-29.7 1.7-43.8 4.7C161.3 40.7 137.7 32 112 32 50.2 32 0 82.2 0 144c0 25.7 8.7 49.3 23.3 68.2-2.9 14-4.7 28.9-4.7 43.8 0 113.5 91.9 205.3 205.3 205.3 14.9 0 29.7-1.7 43.8-4.7 19 14.6 42.6 23.3 68.2 23.3 61.8 0 112-50.2 112-112 .1-25.6-8.6-49.2-23.2-68.1zm-194.6 91.5c-65.6 0-120.5-29.2-120.5-65 0-16 9-30.6 29.5-30.6 31.2 0 34.1 44.9 88.1 44.9 25.7 0 42.3-11.4 42.3-26.3 0-18.7-16-21.6-42-28-62.5-15.4-117.8-22-117.8-87.2 0-59.2 58.6-81.1 109.1-81.1 55.1 0 110.8 21.9 110.8 55.4 0 16.9-11.4 31.8-30.3 31.8-28.3 0-29.2-33.5-75-33.5-25.7 0-42 7-42 22.5 0 19.8 20.8 21.8 69.1 33 41.4 9.3 90.7 26.8 90.7 77.6 0 59.1-57.1 86.5-112 86.5z" />
                                    </svg>
                                    <div class="item_title">Skype</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Telegram" data-box="Telegram" data-id="telegram_field" data-val1="telegram" data-val2="telegram_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512">
                                        <path d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z" />
                                    </svg>
                                    <div class="item_title">Telegram</div>
                                </div>

                            </div>
                        </div>
                        <div class="details_personal">
                            <h4>Business</h4>
                            <div class="flex_wrap">
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="GitHub" data-box="GitHub" data-id="github_field" data-val1="github" data-val2="github_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512">
                                        <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z" />
                                    </svg>
                                    <div class="item_title">GitHub</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Calendly" data-box="Calendly" data-id="calendly_field" data-val1="calendly" data-val2="calendly_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg aria-hidden="true" focusable="false" data-icon="calendly" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M424 61.12h-63.04v-8.56a12.4 12.4 0 10-24.72 0v8.56H172.4v-8a12.4 12.4 0 00-24.8 0v8H84.72a40 40 0 00-40 40V422a40 40 0 0040 40H424a40 40 0 0040-40V101.12a40 40 0 00-40-40zm14.56 361.44a16 16 0 01-16 16H85.28a16 16 0 01-16-16V100.8a16 16 0 0116-16h62.32v29.36a12.4 12.4 0 0024.8 0V84.8H336v29.04a12.4 12.4 0 0024.72 0V84.8h61.84a16 16 0 0116 16zM318.32 320.8a4.4 4.4 0 001.28-3.12 4.64 4.64 0 00-4.56-4.56 4.56 4.56 0 00-3.2 1.36 68.96 68.96 0 01-44 15.52 64.88 64.88 0 01-66.88-62.56 64.88 64.88 0 0166.88-62.64 69.52 69.52 0 0143.52 15.12 4.48 4.48 0 003.2 1.36 4.56 4.56 0 004.56-4.56 4.8 4.8 0 00-1.28-3.12 79.12 79.12 0 00-49.68-17.28c-42.08 0-76.16 32-76.16 71.36s34.08 71.36 76.16 71.36a78.4 78.4 0 0050.08-17.76z">
                                        </path>
                                    </svg>
                                    <div class="item_title">Calendly</div>
                                </div>
                            </div>
                        </div>
                        <div class="details_personal">
                            <h4>Payment</h4>
                            <div class="flex_wrap">
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="PayPal" data-box="PayPal" data-id="payPal_field" data-val1="payPal" data-val2="payPal_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4.7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9.7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z" />
                                    </svg>
                                    <div class="item_title">PayPal</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="Venmo" data-box="Venmo" data-id="venmo_field" data-val1="venmo" data-val2="venmo_title" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg aria-hidden="true" focusable="false" data-icon="venmo" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M432.356 47.091c15.17 25.284 22.123 51.2 22.123 84.07 0 104.928-89.442 240.83-162.133 336.592H126.42L60.05 69.847 205.431 55.94l35.082 283.18c32.869-53.412 73.323-137.798 73.323-195.002 0-31.29-5.373-52.78-13.906-70.48l132.425-26.548z">
                                        </path>
                                    </svg>
                                    <div class="item_title">Venmo</div>
                                </div>
                                <div class="flex_item sm_box sm_con2 modal_open" data-box1="CashApp" data-box="CashApp" data-id="cashApp_field" data-val1="cashApp" data-val2="cashApp_title" data-modal="modal3val" data-bs-toggle="modal" data-bs-target="#fildetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                        <path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z" />
                                    </svg>
                                    <div class="item_title">CashApp</div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="btn_container">
                        <div class="policy_text">By continuing, you agree to our<!-- --> <a class="customize-card_legal-disclaimer-link__B118d" href="#" target="_blank" rel="noreferrer">Privacy Policy</a> <!-- -->and<!-- --> <a class="customize-card_legal-disclaimer-link__B118d" href="#" target="_blank" rel="noreferrer">Terms of Service</a></div>
                        <div class="OnboardingLayout_forward-button__1ldwn step1 next" data-step="2" data-full-width="false">
                            <div data-state="tooltip-hidden" data-reach-tooltip-trigger="">
                                <div class="next_step" style="cursor: pointer;">
                                    <div class="Button_button-content__qRzkt">Next</div>
                                    <!-- <div class="Button_loader-container__0ZSYv"
                                    <div class="Loader_loader__oPvmc"></div>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Create Account -->
                <div class="step2 comman  container w-75 mt-5">
                    <div>
                        <h1>Create a Card account</h1>
                        <p>I think it's time we took the next step. Create a free account to customize your card even further or add new cards for any occasion.</p>
                    </div>
                    <div class="mb-3">
                        <label for="UserName" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="account[userName]" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="account[email]" required />
                    </div>
                    <div class="mb-3">
                        <label for="Country" class="form-label">Country</label>
                        <select class="form-select" name="account[country]">
                            <option value="Country">Country</option>
                            <option value="United States of America">United States of America</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="India">India</option>
                            <option value="Germany">Germany</option>
                            <option value="Argentina">Argentina</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="account[password]" required />
                    </div>
                    <button type="submit" class="form-control btn btn-primary">Continue</button>
                </div>

                <!-- Modal 1 Name  -->
                <div class="modal fade" id="fildetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="input_container" id="sm_content">
                                    <!-- Remove Field -->
                                    <div class="remove_filed field_box" id="remove_field">
                                        <div class="top">
                                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="xmark" class="svg-inline--fa fa-xmark " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" color="white">
                                                <path fill="currentColor" d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3>Remove this field?</h3>
                                        <p>The information will be removed</p>
                                    </div>
                                    <!--  -->
                                    <div class="names_filed field_box" id="name_field">
                                        <div class="mb-4  mt-4 updown">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" data-input="Name" id="firstname" aria-describedby="firstname">

                                        </div>

                                        <div class="mb-4 mt-4 updown name_hidden">
                                            <label for="middlename" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" data-input="Name" id="middlename">
                                        </div>

                                        <div class="mb-4 mt-4 updown">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" data-input="Name" id="lastname">
                                        </div>
                                        <span id="name_more">+ Show more</span>
                                        <div class="mb-4 mt-4 updown name_hidden">
                                            <label for="prefix" class="form-label">Prefix</label>
                                            <input type="text" class="form-control" data-input="Name" id="prefix">
                                        </div>
                                        <div class="mb-4 mt-4 updown name_hidden">
                                            <label for="suffix" class="form-label">Suffix</label>
                                            <input type="text" class="form-control" data-input="Name" id="suffix">
                                        </div>
                                        <div class="mb-4 mt-4 updown name_hidden">
                                            <label for="maidenname" class="form-label">Maiden Name</label>
                                            <input type="text" class="form-control" data-input="Name" id="maidenname">
                                        </div>
                                        <div class="mb-4 mt-4 updown name_hidden">
                                            <label for="preferredname" class="form-label">Preferred Name</label>
                                            <input type="text" class="form-control" data-input="Name" id="preferredname">
                                        </div>
                                        <div class="mb-4 mt-4 updown name_hidden">
                                            <label for="pronouns" class="form-label">Pronouns</label>
                                            <input type="text" class="form-control" data-input="Name" id="pronouns">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="jb_title field_box" id="job_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="job_title" class="form-label">Job Title</label>
                                            <input type="text" class="form-control" data-input="jobTitle" id="j_title" aria-describedby="jon_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="department field_box" id="deparment_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="department" class="form-label">Department</label>
                                            <input type="text" class="form-control" data-input="Department" id="department" aria-describedby="department">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="company field_box" id="company_name_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="company" class="form-label">Company name</label>
                                            <input type="text" class="form-control" data-input="companyName" id="company" aria-describedby="company">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="accreditations field_box" id="accred_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="accreditations" class="form-label">Accreditation #1</label>
                                            <input type="text" class="form-control" data-input="Accreditations" id="accreditations" aria-describedby="accreditations">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="headline field_box" id="headline_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="headline" class="form-label">Headline</label>
                                            <input type="text" class="form-control" data-input="Headline" id="headline" aria-describedby="headline">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="email field_box" id="email_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" data-input="Email" id="email">
                                        </div>
                                        <div class="mb-4 mt-4 updown">
                                            <label for="option" class="form-label">Label (Optional)</label>
                                            <input type="text" class="form-control" data-input="Email" id="e_option">
                                        </div>
                                        <p>Here are some suggestions for your </p>
                                        <div class="label_suggestion">
                                            <span data-suggestion="work">Work</span>
                                            <span data-suggestion="personal">Personal</span>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="phone field_box" id="phone_field">
                                        <div class="mb-4 mt-4 updown">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="number" class="form-control" data-input="Phone" id="phone" aria-describedby="phone">
                                        </div>
                                        <div class="mb-4 mt-4 updown">
                                            <label for="option" class="form-label">Label (Optional)</label>
                                            <input type="text" class="form-control" data-input="Phone" id="ph_option" aria-describedby="ph_option">
                                        </div>
                                        <p>Here are some suggestions for your </p>
                                        <div class="label_suggestion">
                                            <span class="cell">Cell</span>
                                            <span class="mobile">Mobile</span>
                                            <span class="work">Work</span>
                                            <span class="Home">Home</span>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="company_url field_box" id="company_field">
                                        <div class="url_type">
                                            <h3>Type</h3>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Company URL</option>
                                                <option value="snapchat">Snapchat</option>
                                                <option value="linkedin">LinkedIn</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="instagram">Instagram</option>
                                            </select>
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="c_url" class="form-label">Company URL</label>
                                            <input type="text" class="form-control" data-input="companyUrl" id="c_url" aria-describedby="c_url">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="companyUrl" id="c_url_option" aria-describedby="c_url_option">
                                        </div>
                                        <p>Here are some suggestions for your title:</p>
                                        <div class="label_suggestion">
                                            <span class="Visit_our_website">Visit our website</span>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="link field_box" id="link_field">
                                        <div class="url_type">
                                            <h3>Type</h3>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Company URL</option>
                                                <option value="snapchat">Snapchat</option>
                                                <option value="linkedin">LinkedIn</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="instagram">Instagram</option>
                                            </select>
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="link" class="form-label">Link</label>
                                            <input type="text" class="form-control" data-input="Link" id="link" aria-describedby="link">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="link" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="Link" id="link_title" aria-describedby="link">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="address_field">
                                        <div class="mb-4 updown">
                                            <label for="address" class="form-label">Value</label>
                                            <input type="text" class="form-control" data-input="Address" id="address" aria-describedby="address">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Label (Optional)</label>
                                            <input type="text" class="form-control" data-input="Address" id="address_option" aria-describedby="address_option">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="twitter_field">
                                        <div class="mb-4 updown">
                                            <label for="address" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Twitter" id="twitter" aria-describedby="address">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="twitter_title" id="twitter_title" aria-describedby="twitter_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="instagram_field">
                                        <div class="mb-4 updown">
                                            <label for="address" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Instagram" id="instagram" aria-describedby="instagram">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="instagram_title" id="instagram_title" aria-describedby="instagram_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="linkedIn_field">
                                        <div class="mb-4 updown">
                                            <label for="address" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="LinkedIn" id="linkedIn" aria-describedby="linkedIn">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="linkedIn_title" id="linkedIn_title" aria-describedby="linkedIn_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="facebook_field">
                                        <div class="mb-4 updown">
                                            <label for="address" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Facebook" id="facebook" aria-describedby="facebook">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="facebook_title" id="facebook_title" aria-describedby="facebook_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="youTube_field">
                                        <div class="mb-4 updown">
                                            <label for="address" class="form-label">Channal/URL</label>
                                            <input type="text" class="form-control" data-input="YouTube" id="youTube" aria-describedby="youTube">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="youTube_title" id="youTube_title" aria-describedby="youTube_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="snapchat_field">
                                        <div class="mb-4 updown">
                                            <label for="Snapchat" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Snapchat" id="snapchat" aria-describedby="snapchat">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="Snapchat_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="snapchat_title" id="snapchat_title" aria-describedby="snapchat_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="tikTok_field">
                                        <div class="mb-4 updown">
                                            <label for="TikTok" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="TikTok" id="tikTok" aria-describedby="tikTok">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="TikTok_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="tikTok_title" id="tikTok_title" aria-describedby="tikTok_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="twitch_field">
                                        <div class="mb-4 updown">
                                            <label for="Twitch" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Twitch" id="twitch" aria-describedby="twitch">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="Twitch_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="twitch_title" id="twitch_title" aria-describedby="twitch_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="yelp_field">
                                        <div class="mb-4 updown">
                                            <label for="Yelp" class="form-label">URL</label>
                                            <input type="text" class="form-control" data-input="Yelp" id="yelp" aria-describedby="yelp">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="option" class="form-label">Title</label>
                                            <input type="Yelp_" class="form-control" data-input="yelp_title" id="yelp_title" aria-describedby="yelp_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="whatsApp_field">
                                        <div class="mb-4 updown">
                                            <label for="WhatsApp" class="form-label">WhatsApp</label>
                                            <input type="number" class="form-control" data-input="WhatsApp" id="whatsApp" aria-describedby="whatsApp">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="WhatsApp_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="whatsApp_title" id="whatsApp_title" aria-describedby="whatsApp_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="signal_field">
                                        <div class="mb-4 updown">
                                            <label for="signal" class="form-label">Signal</label>
                                            <input type="number" class="form-control" data-input="Signal" id="signal" aria-describedby="signal">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="signal_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="signal_title" id="signal_title" aria-describedby="signal_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="discord_field">
                                        <div class="mb-4 updown">
                                            <label for="discord" class="form-label">URL</label>
                                            <input type="text" class="form-control" data-input="Discord" id="discord" aria-describedby="discord">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="discord_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="discord_title" id="discord_title" aria-describedby="discord_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="skype_field">
                                        <div class="mb-4 updown">
                                            <label for="skype" class="form-label">Username</label>
                                            <input type="text" class="form-control" data-input="Skype" id="skype" aria-describedby="skype">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="skype_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="skype_title" id="skype_title" aria-describedby="skype_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="telegram_field">
                                        <div class="mb-4 updown">
                                            <label for="telegram" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Telegram" id="telegram" aria-describedby="telegram">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="telegram_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="telegram_title" id="telegram_title" aria-describedby="telegram_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="github_field">
                                        <div class="mb-4 updown">
                                            <label for="GitHub" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="GitHub" id="github" aria-describedby="github">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="GitHub_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="github_title" id="github_title" aria-describedby="github_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="calendly_field">
                                        <div class="mb-4 updown">
                                            <label for="telegram" class="form-label">URL</label>
                                            <input type="text" class="form-control" data-input="Calendly" id="calendly" aria-describedby="calendly">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="calendly_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="Calendly_title" id="calendly_title" aria-describedby="calendly_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="payPal_field">
                                        <div class="mb-4 updown">
                                            <label for="PayPal" class="form-label">URL</label>
                                            <input type="text" class="form-control" data-input="PayPal" id="payPal" aria-describedby="payPal">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="PayPal_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="payPal_title" id="payPal_title" aria-describedby="payPal_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="venmo_field">
                                        <div class="mb-4 updown">
                                            <label for="Venmo" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="Venmo" id="venmo" aria-describedby="venmo">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="Venmo_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="venmo_title" id="venmo_title" aria-describedby="venmo_title">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="add field_box" id="cashApp_field">
                                        <div class="mb-4 updown">
                                            <label for="Venmo" class="form-label">Username/URL</label>
                                            <input type="text" class="form-control" data-input="CashApp" id="cashApp" aria-describedby="cashApp">
                                        </div>
                                        <div class="mb-4 updown">
                                            <label for="Venmo_" class="form-label">Title</label>
                                            <input type="text" class="form-control" data-input="cashApp_title" id="cashApp_title" aria-describedby="cashApp_title">
                                        </div>
                                    </div>
                                </div>
                                <!-- modal -->
                                <div class="modal-footer mt-4" id="modal_footer">
                                    <svg aria-hidden="true" focusable="false" id="delete_icon" style="cursor: pointer;" data-icon="trash" class="svg-inline--fa fa-trash fa-lg " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M177.1 48h93.7c2.7 0 5.2 1.3 6.7 3.6l19 28.4h-145l19-28.4c1.5-2.2 4-3.6 6.7-3.6zM354.2 80L317.5 24.9C307.1 9.4 289.6 0 270.9 0H177.1c-18.7 0-36.2 9.4-46.6 24.9L93.8 80H80.1 32 24C10.7 80 0 90.7 0 104s10.7 24 24 24H35.6L59.6 452.7c2.5 33.4 30.3 59.3 63.8 59.3H324.6c33.5 0 61.3-25.9 63.8-59.3L412.4 128H424c13.3 0 24-10.7 24-24s-10.7-24-24-24h-8H367.9 354.2zm10.1 48L340.5 449.2c-.6 8.4-7.6 14.8-16 14.8H123.4c-8.4 0-15.3-6.5-16-14.8L83.7 128H364.3z">
                                        </path>
                                    </svg>
                                    <div> <button type="button" class="btn poppup_btn" id="cancel_btn" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" id="btn_save" class="btn btn_save">Save</button>
                                    </div>
                                </div>
                                <!-- remove -->
                                <div class="modal-footer mt-4" id="remove_footer">
                                    <span></span>
                                    <div>
                                        <button type="button" class="btn poppup_btn" id="remove_cancel">Cancel</button>
                                        <button type="button" id="remove_btn" data-bs-dismiss="modal" class="btn poppup_btn">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>


</body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/script.js"></script>

</html>