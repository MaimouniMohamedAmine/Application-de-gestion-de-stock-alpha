<?php
error_reporting(0);
session_start();
$connect = mysqli_connect('localhost','root','','db_backoffice');
$select = $connect->prepare("select * from category INNER JOIN product ON category.ID = product.Category_id");
$select -> execute();
$result = $select->get_result();

if ($_SESSION['session'] != true) {
    exit('You are not allowed to that :)');
}
// delete button
if(isset($_GET['delete']))
{
      $delete_id = $_GET['delete'];
      $delete_req = "DELETE FROM product WHERE ID = $delete_id";
      $connect->query($delete_req);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <script src="https://kit.fontawesome.com/35d9b7530c.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="style/product_list.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <main>
        <section class="d-flex flex-row w-100">
            <div class=" side_nav d-flex flex-column flex-shrink-0 back_ground_color" style="width: 4.5rem">
                <a href="dashboard.php" class="d-block p-3 link-dark text-decoration-none" title="Icon-only"
                    data-bs-toggle="tooltip" data-bs-placement="right">
                    <img src="/Logo/logo.png" class="logo" alt="" />
                    <span class="visually-hidden">Icon-only</span>
                </a>
                <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link  py-3 border-bottom rounded-0" aria-current="page" title="Home"
                            data-bs-toggle="tooltip" data-bs-placement="right">
                            <svg id="" width="24" height="24" viewBox="0 0 61 54" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_16_106)">
                                    <path
                                        d="M29.6921 15.6368L10.1668 31.6522V48.9375C10.1668 49.3851 10.3453 49.8143 10.6631 50.1307C10.9809 50.4472 11.4118 50.625 11.8612 50.625L23.7287 50.5944C24.1766 50.5922 24.6054 50.4134 24.9214 50.0972C25.2373 49.781 25.4147 49.353 25.4147 48.9069V38.8125C25.4147 38.3649 25.5932 37.9357 25.911 37.6193C26.2287 37.3028 26.6597 37.125 27.1091 37.125H33.8869C34.3363 37.125 34.7673 37.3028 35.085 37.6193C35.4028 37.9357 35.5813 38.3649 35.5813 38.8125V48.8995C35.5806 49.1216 35.624 49.3416 35.7088 49.5469C35.7936 49.7523 35.9183 49.9389 36.0758 50.0962C36.2332 50.2534 36.4202 50.3782 36.6261 50.4634C36.832 50.5485 37.0528 50.5923 37.2758 50.5923L49.139 50.625C49.5884 50.625 50.0194 50.4472 50.3372 50.1307C50.6549 49.8143 50.8335 49.3851 50.8335 48.9375V31.6406L31.3124 15.6368C31.0829 15.4526 30.797 15.3521 30.5022 15.3521C30.2075 15.3521 29.9216 15.4526 29.6921 15.6368ZM60.5341 26.5222L51.6807 19.2544V4.6459C51.6807 4.31023 51.5468 3.98832 51.3085 3.75097C51.0701 3.51361 50.7469 3.38027 50.4098 3.38027H44.4793C44.1422 3.38027 43.819 3.51361 43.5807 3.75097C43.3423 3.98832 43.2085 4.31023 43.2085 4.6459V12.304L33.727 4.53515C32.8171 3.78947 31.6753 3.38176 30.4969 3.38176C29.3186 3.38176 28.1768 3.78947 27.2669 4.53515L0.45974 26.5222C0.331055 26.6282 0.224589 26.7583 0.146424 26.9052C0.0682593 27.0521 0.0199283 27.2129 0.00419265 27.3785C-0.011543 27.544 0.00562499 27.711 0.0547158 27.8699C0.103807 28.0288 0.183858 28.1766 0.290296 28.3046L2.99082 31.5742C3.09696 31.7027 3.22753 31.8092 3.37503 31.8874C3.52253 31.9656 3.68408 32.0141 3.85042 32.0301C4.01676 32.046 4.18463 32.0292 4.34442 31.9804C4.50421 31.9317 4.65279 31.8521 4.78163 31.7461L29.6921 11.3126C29.9216 11.1284 30.2075 11.0279 30.5022 11.0279C30.797 11.0279 31.0829 11.1284 31.3124 11.3126L56.2239 31.7461C56.3525 31.8521 56.5009 31.9318 56.6604 31.9807C56.82 32.0296 56.9877 32.0467 57.1539 32.031C57.3201 32.0154 57.4816 31.9672 57.6291 31.8894C57.7766 31.8115 57.9073 31.7055 58.0137 31.5773L60.7142 28.3078C60.8205 28.179 60.9002 28.0305 60.9487 27.8709C60.9972 27.7113 61.0136 27.5437 60.9969 27.3777C60.9801 27.2118 60.9307 27.0508 60.8512 26.904C60.7718 26.7572 60.6641 26.6274 60.5341 26.5222Z"
                                        fill="#F1F1F1" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_16_106">
                                        <rect width="61" height="54" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="product_list.php" class="nav-link active py-3 border-bottom rounded-0" title="Product list"
                            data-bs-toggle="tooltip" data-bs-placement="right">
                            <svg width="24" height="24" viewBox="0 0 54 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M49.5112 28.2487L53.9431 8.74866C54.2631 7.34072 53.1929 6 51.7491 6H14.9257L14.0664 1.79906C13.8523 0.751969 12.9309 0 11.8621 0H2.25C1.00734 0 0 1.00734 0 2.25V3.75C0 4.99266 1.00734 6 2.25 6H8.80153L15.3873 38.197C13.8117 39.1031 12.75 40.8021 12.75 42.75C12.75 45.6495 15.1005 48 18 48C20.8995 48 23.25 45.6495 23.25 42.75C23.25 41.2806 22.6456 39.953 21.6727 39H41.3272C40.3544 39.953 39.75 41.2806 39.75 42.75C39.75 45.6495 42.1005 48 45 48C47.8995 48 50.25 45.6495 50.25 42.75C50.25 40.6714 49.0417 38.8751 47.2895 38.0245L47.8067 35.7487C48.1267 34.3407 47.0565 33 45.6127 33H20.4485L19.8349 30H47.3172C48.3678 30 49.2785 29.2731 49.5112 28.2487Z"
                                    fill="#F1F1F1" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Orders"
                            data-bs-toggle="tooltip" data-bs-placement="right">
                            <svg width="24" height="24" viewBox="0 0 54 51" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M52.391 28.6874H28.8365L44.5233 44.4289C45.1228 45.0305 46.1095 45.0793 46.7259 44.4966C50.5675 40.8648 53.2099 35.969 53.9851 30.4655C54.1182 29.5232 53.3389 28.6874 52.391 28.6874ZM50.8196 22.2327C50.0017 10.3332 40.5259 0.824392 28.6678 0.00360192C27.7625 -0.0591527 27.0001 0.706852 27.0001 1.61729V23.9061H49.2125C50.1198 23.9061 50.8821 23.1411 50.8196 22.2327ZM22.2354 28.6874V5.05086C22.2354 4.09958 21.4026 3.31764 20.4646 3.45112C8.63523 5.12856 -0.406767 15.499 0.014114 27.9274C0.446907 40.6915 11.3987 51.1586 24.1244 50.9982C29.1274 50.9354 33.7501 49.3178 37.5509 46.6123C38.3351 46.0545 38.3867 44.896 37.7068 44.2137L22.2354 28.6874Z"
                                    fill="#F1F1F1" />
                            </svg>
                        </a>
                    </li>
                </ul>
                <div class="dropdown border-top">
                    <a href="logout.php">

                        <button  type="button" class="btn btn-primary logout_btn">
                            LOGOUT
                        </button>

                    </a>
                </div>
            </div>



            <!-- Sidebar  -->
            <!-- Search bar -->
            <section class="d-flex flex-column w-100">

                <section class=" mt-5 ms- mb-5 w-100">

                    <div class="d-flex justify-content-evenly">

                        <div class="w-50">
                            <h1 id="dashboard_title">Products List</h1>
                        </div>
                        <div>
                            <form class="d-flex search_form" role="search">
                                <input class="form-control me-2 search_input" type="search" placeholder="Search"
                                    aria-label="Search">
                                <a href="">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0.328125 21.2516L5.00156 16.5781C5.2125 16.3672 5.49844 16.25 5.79844 16.25H6.5625C5.26875 14.5953 4.5 12.5141 4.5 10.25C4.5 4.86406 8.86406 0.5 14.25 0.5C19.6359 0.5 24 4.86406 24 10.25C24 15.6359 19.6359 20 14.25 20C11.9859 20 9.90469 19.2313 8.25 17.9375V18.7016C8.25 19.0016 8.13281 19.2875 7.92188 19.4984L3.24844 24.1719C2.80781 24.6125 2.09531 24.6125 1.65937 24.1719L0.332813 22.8453C-0.107813 22.4047 -0.107813 21.6922 0.328125 21.2516ZM14.25 16.25C17.5641 16.25 20.25 13.5688 20.25 10.25C20.25 6.93594 17.5688 4.25 14.25 4.25C10.9359 4.25 8.25 6.93125 8.25 10.25C8.25 13.5641 10.9312 16.25 14.25 16.25Z"
                                            fill="#F1F1F1" />
                                    </svg>
                                </a>
                                </input>
                            </form>
                        </div>
                        <div>
                            <!-- Search bar -->

                            <!-- Modal section -->
                            <a href="add.php">

                                <button id="add_btn" type="button" type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#product_modal">
                                    ADD
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="modal fade" id="product_modal" tabindex="-1" aria-labelledby="product_modal_label"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="product_modal_label">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="add.php" method="POST" enctype="multipart/form-data">
                                        <label for="">Select category</label><br>
                                        <select name="" id=""></select>
                                        <!-- <input type="" name="input0"><br> -->
                                        <label for="">Product name</label><br>
                                        <input type="text" name="input1"><br>
                                        <label for="">Product quantity</label><br>
                                        <input type="text" name="input2"><br>
                                        <label for="">Product price</label><br>
                                        <input type="date" name="input3"><br>
                                        <label for="">Product description</label><br>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">CANCEL</button>
                                    <button type="button" class="btn btn-primary">ADD</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- Table section -->
                <section class="w-75 ms-5">
                    <div class="dashboard_table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th_thead">
                                        Products
                                    </th>
                                    <th class="th_thead">
                                        Products code
                                    </th>
                                    <th class="th_thead">
                                        Price
                                    </th>
                                    <th class="th_thead">
                                        Category
                                    </th>
                                    <th class="th_thead">
                                        Quantity
                                    </th>
                                    <th class="th_thead">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              while($row = $result-> fetch_assoc()):
                              ?>
                                <tr>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['ID']*0+12;?></td>
                                    <td><?php echo $row['Price']."<b> MAD</b>";?></td>
                                    <td><?php echo $row['Cat_name']; ?></td>
                                    <td><?php echo $row['Quantity']; ?></td>
                                    <td><a href='add.php?edit=<?php echo $row['ID'];?>' class="edit_btn">EDIT</a>
                                        <a onClick="return confirm('Are you sure you want to delete this article?')"
                                            href='product_list.php?delete=<?php echo $row['ID'];?>' name='delete_btn'
                                            class="delete_btn">DELETE</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>

        </section>
    </main>
</body>

</html>