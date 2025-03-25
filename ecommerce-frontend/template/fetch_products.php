<?php
include './connection.php'; // Include database connection

if (isset($_POST['subcategory_id'])) {
    $subcategory_id = intval($_POST['subcategory_id']);

    $query = $conn->prepare("SELECT * FROM products WHERE subcategory = ?");
    $query->execute([$subcategory_id]);
    $products = $query->fetchAll();

    if ($products) {
        foreach ($products as $p) {
            echo '<div class="item" style="padding: 15px; border: 1px solid #ddd; margin: 10px; border-radius: 5px;">
                    <div class="product">
                        <a href="single.php?product=' . $p["id"] . '" style="text-decoration: none; color: inherit;">
                            <div class="product-header">
                                <span style="background: green; color: white; padding: 5px; border-radius: 3px;">50% OFF</span>
                                <img style="width: 100%; height: auto;" src="../../ecommerce-backend/pages/uploads/products/' . htmlspecialchars($p["product_image"]) . '" alt="' . htmlspecialchars($p["product_name"]) . '">
                            </div>
                            <div class="product-body">
                                <h5>' . htmlspecialchars($p["product_name"]) . '</h5>
                                <h6>Available in - ' . htmlspecialchars($p["variant_name"]) . '</h6>
                            </div>
                            <div class="product-footer">
                                <button style="background: orange; border: none; padding: 10px; color: white; border-radius: 5px; cursor: pointer;">
                                    <i class="mdi mdi-cart-outline"></i> Add To Cart
                                </button>
                                <p>₹' . number_format($p["retailer_price"], 2) . ' <span style="text-decoration: line-through;">₹' . number_format($p["mrp"], 2) . '</span></p>
                            </div>
                        </a>
                    </div>
                </div>';
        }
    } else {
        echo '<p>No products found.</p>';
    }
}
