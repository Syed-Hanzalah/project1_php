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
    $categories=[];
    $sql1 = "SELECT * FROM categories";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    do {
        $categories[] = $row1;
    } while ($row1 = mysqli_fetch_assoc($result1));
    return $categories;

}
