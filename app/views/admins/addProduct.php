<?php require APPROOT . '/views/inc/headerAdmin.php' ?>
    <div class="container bg-light p-5" id="addUserBox">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class="text-center">Upload product</h1>
                <form action="<?php echo URLROOT; ?>/admins/addProduct" method="post"
                      class="d-flex justify-content-center flex-column" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="productName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="productName"
                                   class="form-control <?php echo (!empty($data['productName_err'])) ? 'is-invalid' : ''; ?>"
                                   id="productName"
                                   placeholder="Product Name"
                                   value="<?php echo $data['productName']; ?>">
                            <span class="invalid-feedback"><?php echo $data['productName_err']; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="productImage" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="productImage" class="form-control-file" id="productImage">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="productPrice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="productPrice"
                                   class="form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>"
                                   id="productPrice"
                                   placeholder="Product Price"
                                   value="<?php echo $data['price']; ?>">
                            <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>

                        </div>
                    </div>
                    <input type="submit" value="Upload" class="btn btn-success mr-2" name="uploadProduct">
                    <a href="<?php echo URLROOT; ?>/admins" class="btn" id="cancelAdd">Cancel</a>
                </form>
            </div>
        </div>

    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }


        productPrice = document.getElementById('productPrice');
        productPrice.addEventListener('focusout', (e) => {
            // console.log(e.target.value);
            e.target.value = e.target.value.replace(/,/g, '');
            e.target.value = formatNumber(e.target.value);
        });
    </script>
