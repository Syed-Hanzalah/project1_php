<?php
session_start();
$path = $_SERVER['PHP_SELF'];
$dir_path = dirname($path);
$last_dir = basename($dir_path);
if ($last_dir == 'dashboard') {
   include_once './includes/db_conn.php';
}else {
   include_once './dashboard/includes/db_conn.php';
}
function sanitize($value): string{
    global $conn;
    $value = mysqli_real_escape_string($conn, $value);
    $value = trim($value);
    $value = strip_tags($value);
    return $value;
}
function addCategory($category_name): array
{
    global $conn;
    $category_name = mysqli_real_escape_string($conn, $category_name);
    $sql1 = "SELECT * FROM categories WHERE category_name = '$category_name'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        return array(
            'status' => false,
            'message' => 'Category Allready exists'
        );
    }

    $query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    if (mysqli_query($conn, $query)) {
        return array(
            'status' => true,
            'message' => 'Category Added successfuly'
        );

    } else {
        return array(
            'status' => false,
            'message' => 'Some error occur'
        );
    }
}
function getCategories(): array
{
    global $conn;
    $categories = [];
    $sql1 = "SELECT * FROM categories";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1 && mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $categories[] = $row1;
        }
    }
    return $categories;
    // $row1 = mysqli_fetch_assoc($result1);
    // do {
    //     $categories[] = $row1;
    // } while ($row1 = mysqli_fetch_assoc($result1));
    // return $categories;

}
// edit category 
function getCategoryById($id): array|bool|null
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $sql1 = "SELECT * FROM categories WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    return $row1;
}
function updateCategory($category_name, $id): array|bool|null
{
    global $conn;
    $category_name = mysqli_real_escape_string($conn, $category_name);
    $id = mysqli_real_escape_string($conn, $id);
    $sql1 = "SELECT * FROM categories WHERE category_name = '$category_name' AND id != '$id'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        return array(
            'status' => false,
            'message' => 'Category Allready exists'
        );
    }

    $query = "UPDATE categories SET category_name ='$category_name' where id = '$id'";
    if (mysqli_query($conn, $query)) {
        return array(
            'status' => true,
            'message' => 'Category Update  successfuly'
        );

    } else {
        return array(
            'status' => false,
            'message' => 'Some error occur'
        );
    }
}
// delete category 
function deleteCategory($id): array|bool|null
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "DELETE FROM categories WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        return array(
            'status' => true,
            'message' => 'Category Deleted successfuly'
        );

    } else {
        return array(
            'status' => false,
            'message' => 'Some error occur'
        );
    }
}
// add products 
function addProduct($title, $category_id, $description, $price, $discount, $stock): array
{
    global $conn;

    $discount = !empty($discount) ? $discount : 0.0;

    // Check if product already exists
    $sql1 = "SELECT * FROM products WHERE category_id = '$category_id' AND title = '$title' AND price = '$price'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        return array(
            'status' => false,
            'message' => 'Product already exists'
        );
    }

    $uploadDir = 'uploads/';
    $imagePath = null;
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','jfif'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['image']['name'];
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate type
        if (!in_array($fileExt, $allowedExtensions)) {
            return array(
                'status' => false,
                'message' => 'Invalid file type'
            );
        }

        // Validate size
        if ($fileSize > $maxSize) {
            return array(
                'status' => false,
                'message' => 'File size should be less than 2MB'
            );
        }

        // Ensure upload folder exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newFileName = uniqid('img_', true) . '.' . $fileExt;
        $newFilePath = $uploadDir . $newFileName;

        // ✅ Corrected logic
        if (move_uploaded_file($fileTmpPath, $newFilePath)) {
            $imagePath = $newFilePath;
        } else {
            return array(
                'status' => false,
                'message' => 'Failed to upload image'
            );
        }
    }

    // ✅ FIXED INSERT query
    $query = "INSERT INTO products (title, category_id, description, price, discount, stock, image) 
              VALUES ('$title', '$category_id', '$description', '$price', '$discount', '$stock', '$imagePath')";

    if (mysqli_query($conn, $query)) {
        return array(
            'status' => true,
            'message' => 'Product added successfully'
        );
    } else {
        return array(
            'status' => false,
            'message' => 'DB Error: ' . mysqli_error($conn)
        );
    }
}


function getProducts(): array
{
    global $conn;
    $products = [];
    $sql1 = "SELECT p.*, c.category_name FROM products p
    inner join categories c on p.category_id = c.id";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1 && mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $products[] = $row1;
        }
    }
    return $products;}

function getProductsById($id): array|bool|null
{
    global $conn;
    $id = sanitize( $id);
    $sql1 = "SELECT p.*, c.category_name FROM products p
    inner join categories c on p.category_id = c.id WHERE p.id = '$id'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    return $row1;
}
function updateProduct($id, $title, $category_id, $description, $price, $discount, $stock): array
{
    global $conn;
$attachQuery = '';
    $discount = !empty($discount) ? $discount : 0.0;

    // Check if product already exists
    $sql1 = "SELECT * FROM products WHERE category_id = '$category_id' AND title = '$title' AND price = '$price' AND id != '$id'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        return array(
            'status' => false,
            'message' => 'Product already exists'
        );
    }
 $sql2 = "SELECT * FROM products WHERE  id = '$id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $previousImage = $row2['image']  ;

    $uploadDir = 'uploads/';
    $imagePath = null;
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','jfif'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['image']['name'];
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate type
        if (!in_array($fileExt, $allowedExtensions)) {
            return array(
                'status' => false,
                'message' => 'Invalid file type'
            );
        }

        // Validate size
        if ($fileSize > $maxSize) {
            return array(
                'status' => false,
                'message' => 'File size should be less than 2MB'
            );
        }

        // Ensure upload folder exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newFileName = uniqid('img_', true) . '.' . $fileExt;
        $newFilePath = $uploadDir . $newFileName;

        // ✅ Corrected logic
        if (move_uploaded_file($fileTmpPath, $newFilePath)) {
            $imagePath = $newFilePath;
            $attachQuery = ",image = '$newFilePath'";
        } else {
            return array(
                'status' => false,
                'message' => 'Failed to upload image'
            );
        }
    }

    // ✅ FIXED INSERT query
    $query = "UPDATE products set title = '$title', category_id = '$category_id', description = '$description', price = '$price', discount = '$discount', stock = '$stock' ".$attachQuery." where id = '$id'";

    if (mysqli_query($conn, $query)) {
        unlink($previousImage); // Delete previous image if it exists
        return array(
            'status' => true,
            'message' => 'Product update successfully'
        );
    } else {
        return array(
            'status' => false,
            'message' => 'DB Error: ' . mysqli_error($conn)
        );
    }
}
function deleteProduct($id): array|bool|null
{
    global $conn;
    $id = sanitize( $id);
    $query = "DELETE FROM products WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        return array(
            'status' => true,
            'message' => 'Product Deleted successfuly'
        );

    } else {
        return array(
            'status' => false,
            'message' => 'Some error occur'
        );
    }}
    // register 
function registerUser($first_name, $last_name, $email, $phone, $password): array
{
    global $conn;
$sql1 = "SELECT * FROM users WHERE email = '$email'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        return array(
            'status' => false,
            'message' => 'Email already exists'
        );
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql2 = "INSERT INTO users (`first_name`, `last_name`,`email`,`phone_number`, `password`) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";
    if (mysqli_query($conn, $sql2)) {
        return array(
            'status' => true,
            'message' => 'User registered successfully'
        );

    } else {
        return array(
            'status' => false,
            'message' => 'Error: ' . mysqli_error($conn)
        );
    }
}
// login 
function loginUser($email, $password): array
{
    global $conn;
    $sql1 = "SELECT * FROM users WHERE email = '$email'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        $row1 = mysqli_fetch_assoc($result1);
        if (password_verify($password, $row1['password'])) {
            $_SESSION['user_id'] = $row1['id'];
            $_SESSION['user_name'] = $row1['first_name'] . ' ' . $row1['last_name'];
            $_SESSION['role'] = $row1['role'];
            if ($_SESSION['role'] == 'admin') {
               header('Location: ./dashboard/index.php'); // Redirect to admin dashboard
            } else {
                header('Location: ./index.php');
            }
            return array(
                'status' => true,
                'message' => 'Login successful'
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Invalid password'
            );
        }
    } else {
        return array(
            'status' => false,
            'message' => 'Email not found'
        );
    }
}

  function isLoggedIn(): bool{
    return isset($_SESSION['user_id']) && isset($_SESSION['role']) ;}
    function isAdmin(): bool{
    return isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';}
    function isUser(): bool{
    return isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'user';}