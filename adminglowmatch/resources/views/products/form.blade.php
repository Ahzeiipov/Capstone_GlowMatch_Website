<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="ProductName" class="col-lg-2 col-lg-offset-1 control-label">Product Name</label>
                        <div class="col-lg-6">
                            <input type="text" name="ProductName" id="ProductName" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="SkinType" class="col-lg-2 col-lg-offset-1 control-label">Skin Type</label>
                        <div class="col-lg-6">
                            <input type="text" name="SkinType" id="SkinType" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ConcernType" class="col-lg-2 col-lg-offset-1 control-label">Concern Type</label>
                        <div class="col-lg-6">
                            <input type="text" name="ConcernType" id="ConcernType" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ProductType" class="col-lg-2 col-lg-offset-1 control-label">Product Type</label>
                        <div class="col-lg-6">
                            <input type="text" name="ProductType" id="ProductType" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="KeyIngredients" class="col-lg-2 col-lg-offset-1 control-label">Key Ingredients</label>
                        <div class="col-lg-6">
                            <textarea name="KeyIngredients" id="KeyIngredients" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ShortDesrciption" class="col-lg-2 col-lg-offset-1 control-label">Short Description</label>
                        <div class="col-lg-6">
                            <textarea name="ShortDesrciption" id="ShortDesrciption" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="MoreDescription" class="col-lg-2 col-lg-offset-1 control-label">More Description</label>
                        <div class="col-lg-6">
                            <textarea name="MoreDescription" id="MoreDescription" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ProductDetails" class="col-lg-2 col-lg-offset-1 control-label">Product Details</label>
                        <div class="col-lg-6">
                            <textarea name="ProductDetails" id="ProductDetails" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ProductBenefits" class="col-lg-2 col-lg-offset-1 control-label">Product Benefits</label>
                        <div class="col-lg-6">
                            <textarea name="ProductBenefits" id="ProductBenefits" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-success"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-sm btn-flat btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>