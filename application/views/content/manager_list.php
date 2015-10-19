<?if(!empty($managers)){?>
<div class="row">
  <div class="col-md-10">
    <form action="#" data-toggle="validator" role="form" class="form-horizontal" id="manager_form">
      <div class="form-group radio">
      <?php foreach ($managers as $key => $manager) {?>
      <div class="radio col-md-10">
        <label>
        <input type="radio" name="manager" value="<?=$manager->id?>" required>&nbsp;<?=$manager->first.' '.$manager->last?>
      </label>
        <div class="help-block with-errors text-left"></div>
      </div>
      <?}?>
      </div>
      <div class="form-group text-center">
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
    </form>
  </div>
</div>
<?}else{?>
<div class="alert alert-warning" role="alert">There are no managers associated to you!</div>
<?}?>