<!-- includes/product_box.php -->
<form action="" method="post" class="box" style="width: 300px; border: 1px solid #ccc; padding: 15px; border-radius: 10px;">
   <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
   <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
   <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

   <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
   <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

   <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" style="width: 100%; height: auto;">
   <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>

   <div class="name"><?= $fetch_products['name']; ?></div>

   <div class="flex">
      <div class="price">
         <?= $fetch_products['price']; ?>DH
         <?php if (!empty($fetch_products['old_price']) && $fetch_products['old_price'] > $fetch_products['price']) { ?>
            <small class="old-price"><?= $fetch_products['old_price']; ?>DH</small>
            <span class="discount-badge">
               <i class="fas fa-star"></i>
               -<?= round((($fetch_products['old_price'] - $fetch_products['price']) / $fetch_products['old_price']) * 100) ?>%
            </span>
         <?php } ?>
      </div>
      <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
   </div>
</form>
