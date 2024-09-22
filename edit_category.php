<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <?php
        include '../db.php';

        // Check if category ID is provided via GET
        if (isset($_GET['id'])) {
            $category_id = $_GET['id'];

            // Fetch category details from the database
            $sql = "SELECT * FROM theloai WHERE ma_tloai = $category_id";
            $result = mysqli_query($conn, $sql);
            $category = mysqli_fetch_assoc($result);

            if (!$category) {
                echo "Category not found!";
                exit;
            }
        }

        // Check if the form has been submitted
        if (isset($_POST['txtCatId']) && isset($_POST['txtCatName'])) {
            $category_id = $_POST['txtCatId'];
            $category_name = $_POST['txtCatName'];
        
            // Update query
            $sql = "UPDATE theloai SET ten_tloai = '$category_name' WHERE ma_tloai = $category_id";
        
            if (mysqli_query($conn, $sql)) {
                echo "Category updated successfully.";
                header("Location: category.php");
                exit();
            } else {
                echo "Error updating category: " . mysqli_error($conn);
            }
        }

        // Close the connection
        mysqli_close($conn);
    ?>
    <?php include 'header.php';?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
                <form action="edit_category.php?id=<?php echo $category['ma_tloai']; ?>" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã thể loại</span>
                        <input type="text" class="form-control" name="txtCatId" readonly value="<?php echo $category['ma_tloai']; ?>">
                    </div>
                    
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="txtCatName" value="<?php echo $category['ten_tloai']; ?>">
                    </div>
                    
                    <div class="form-group float-end">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include '../footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>