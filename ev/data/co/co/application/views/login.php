<style type="text/css">
.login
{
	position: absolute;
	top:20%;
}
</style>
      <div class="container login">
        <br>
        <br>
        <div class="row">

          <div class="col-md-4 align-middle mx-auto"">
            <form action="<?=base_url("admin/login")?>" method="POST">
              <?php if (isset($alert) && $alert): ?>
                <div class="alert alert-danger" role="alert">
                  მომხ. სახელი ან პაროლი არასწორია
                </div>
              <?php endif ?>
              <div class="form-group">
                <!-- <label for="">მომხმარებლის სახელი</label> -->
                <input type="text" class="form-control" name="username" placeholder="მომხ. სახელი">                
              </div>
              <div class="form-group">
                <!-- <label for="">პაროლი</label> -->
                <input type="password" class="form-control" name="password" placeholder="პაროლი">
              </div>              
              <button type="submit" class="btn btn-light" style="width: 100%">შესვლა</button>
            </form>
          </div>          

        </div>
      </div>

