<div class="modal fade" id="productCreation" tabindex="-1" role="dialog" aria-labelledby="productCreationLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productCreationLabel">Input Product Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="toggleModal('productCreation')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" method="post">
        <div class="form-group">
            <label for="title">Title*</label>
            <div class="input-group mb-3">
              <input class="form-control" type="text" name="title" required>
            </div>
          </div>
          <div class="form-group">
            <label for="category">Category*</label>
            <div class="input-group">
              <select class="form-control" name="category" id="category" required>
                <option value="" disabled selected>Choose option</option>
                <option value="apparel">Apparel</option>
                <option value="appliance">Appliance</option>
                <option value="electronics">Electronics</option>
                <option value="entertainment">Entertainment</option>
                <option value="furniture">Furniture</option>
                <option value="garden/lanscaping">Garden/Landscaping</option>
                <option value="hobbies">Hobbies</option>
                <option value="homeImpormentTools">Home Improvement Tools</option>
                <option value="Junk">Junk</option>
                <option value="outdoors/camping">Outdoors/Camping</option>
                <option value="toys/games">Toys/Games</option>
                <option value="misc">Misc...</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
          <input type="hidden" name="ownerId" value="<?= $profile['id'] ?>">
          <div class="form-group">
            <label for="price">Price*</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input class="form-control" type="number" name="price" id="price" placeholder="$0.00" min="1" step="any" required>
            </div>
          </div>
          <div class="form-group">
            <label for="quantity">Quantity</label>
            <div class="input-group mb-3">
              <input class="form-control" type="number" min="1" name="quantity" value="1">
            </div>
          </div>
          <div class="form-group">
            <label for="picture">Picture</label>
            <div class="input-group mb-3">
              <input class="form-control" type="text" name="picture">
            </div>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <div class="input-group mb-3">
              <textarea class="form-control" type="text" name="description"></textarea>
            </div>
          </div>
          <div class="w-100 d-flex justify-content-end">
            <input type="submit" name="productSubmit" class="btn btn-primary">
          </div>
        </form>
<sup class="text-danger">* required</sup>
      </div>
    </div>
  </div>
</div>