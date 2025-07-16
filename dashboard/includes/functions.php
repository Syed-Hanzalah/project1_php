<?php
session_start();
include_once './includes/db_conn.php';

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

    $query = "SELECT * FROM products ORDER BY id DESC";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return [
            'status' => false,
            'message' => 'Query Failed: ' . mysqli_error($conn),
            'data' => []
        ];
    }

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return [
        'status' => true,
        // 'message' => 'Products fetched successfully',
        'data' => $products
    ];
}

