<?php
session_start();
include('../config/dbcon.php');
include('../functions/Myfunctions.php');
if (isset($_POST['add_category_btn'])) {
  $name = $_POST['name'];
  $Slug = $_POST['slug'];
  $description = $_POST['description'];
  $meta_title = $_POST['meta_title'];
  $meta_description = $_POST['meta_description'];
  $meta_keywords = $_POST['meta_keywords'];
  $Status = isset($_POST['Status']) ? '1' : '0';
  $populaire = isset($_POST['populaire']) ? '1' : '0';
  $image = $_FILES['image']['name'];
  $path = "../uploads";
  $image_ext = pathinfo($image, PATHINFO_EXTENSION);
  $filename = time() . '.' . $image_ext;
  $cate_query = "INSERT INTO categories (name,slug,description,meta_title,meta_description,meta_keywords,Status,populaire,image )
    VALUES ('$name','$Slug','$description','$meta_title',' $meta_description','$meta_keywords','$Status',' $populaire','$filename')";
  $cate_query_run = mysqli_query($con, $cate_query);
  if ($cate_query_run) {
    move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
    redirect("add-category.php", "Category Added Seccessflly");
  } else {
    redirect("add-category.php", "Somthing wWent wrong");
  }
} else if (isset($_POST['update_category_btn'])) {
  $category_id = $_POST['category_id'];
  $name = $_POST['name'];
  $Slug = $_POST['slug'];
  $description = $_POST['description'];
  $meta_title = $_POST['meta_title'];
  $meta_description = $_POST['meta_description'];
  $meta_keywords = $_POST['meta_keywords'];
  $Status = isset($_POST['Status']) ? '1' : '0';
  $populaire = isset($_POST['populaire']) ? '1' : '0';
  $new_image = $_FILES['image']['name'];
  $old_image = $_POST['old_image'];
  if ($new_image != "") {
    $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
    $update_filename = time() . '.' . $image_ext;
    //$update_filename = $new_image;
  } else {
    $update_filename = $old_image;
  }
  $path = "../uploads";
  $update_query = "UPDATE categories SET name= '$name', slug= '$Slug', description= '$description', meta_title= '$meta_title', meta_description= '$meta_description'
  , meta_keywords= '$meta_keywords', Status= '$Status', populaire= '$populaire', image= '$update_filename' WHERE id = '$category_id'";

  $update_query_run = mysqli_query($con, $update_query);
  if ($update_query_run) {
    if ($_FILES['image']['name'] != "") {
      move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);

      if (file_exists("../uploads/" . $old_image)) {
        unlink("../uploads/" . $old_image);
      }
    }
    redirect("edit-category.php?id=$category_id", "Category Updated Seccessfully");
  } else {
    redirect("edit-category.php?id=$category_id", "Somthing Went Wrong");

  }
} else
  if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
     $category_query = "SELECT * FROM categories WHERE id ='$category_id'";
     $category_querry_run = mysqli_query($con,$category_query);
     $category_data = mysqli_fetch_array($category_querry_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
      if (file_exists("../uploads/" .$image)) {
        unlink("../uploads/" .$image);
      }
      redirect("category.php", "Category deleted Successfully");
    } else {
      redirect("category.php", "Somthing Went Wrong");

    }
  }
else if(isset($_POST['add_product_btn']))
{
  $category_id = $_POST['category_id'];
  $name = $_POST['name'];
  $Slug = $_POST['slug'];
  $small_description = $_POST['small_description'];
  $description = $_POST['description'];
  $original_price = $_POST['original_price'];
  $selling_price = $_POST['selling_price'];
  $qty = $_POST['qty'];
  $meta_title = $_POST['meta_title'];
  $meta_description = $_POST['meta_description'];
  $meta_keywords = $_POST['meta_keywords'];
  $Status = isset($_POST['Status']) ? '1' : '0';
  $populaire = isset($_POST['trending']) ? '1' : '0';
  $image = $_FILES['image']['name'];
  $path = "../uploads";
  $image_ext = pathinfo($image, PATHINFO_EXTENSION);
  $filename = time() . '.' . $image_ext;

  $product_query = "INSERT INTO products () ";
}
?>